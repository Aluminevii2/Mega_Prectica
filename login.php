<?php
require_once 'php/auth.php';
if (isLoggedIn()) {
  header('Location: dashboard.php');
  exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = trim($_POST['email'] ?? '');
  $pass = $_POST['password'] ?? '';
  if (!$email || !$pass) {
    $error = 'Completați toate câmpurile.';
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = 'Email invalid.';
  } elseif (strlen($pass) < 6) {
    $error = 'Parola prea scurtă (min. 6 caractere).';
  } else {
    $result = loginUser($email, $pass);
    if ($result['ok']) {
      header('Location: dashboard.php');
      exit;
    }
    $error = $result['msg'];
  }
}
?>
<!DOCTYPE html>
<html lang="ro">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SoundWave — Conectare</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
</head>

<body>
  <nav class="navbar">
    <a href="index.php" class="logo">SoundWave</a>
    <div class="nav-actions">
      <div class="lang-switcher">
        <button class="lang-btn active" data-lang="ro" onclick="switchLang('ro')">RO</button>
        <button class="lang-btn" data-lang="en" onclick="switchLang('en')">EN</button>
        <button class="lang-btn" data-lang="ru" onclick="switchLang('ru')">RU</button>
      </div>
      <button class="btn-icon" id="themeBtn" onclick="toggleTheme()"><i class="ti ti-moon"></i></button>
    </div>
  </nav>

  <div class="auth-page">
    <div class="auth-card">
      <h2 data-i18n="loginTitle">Bun venit înapoi</h2>
      <p class="sub" data-i18n="loginSub">Conectează-te la contul tău</p>

      <?php if ($error): ?>
        <div class="alert alert-danger"><i class="ti ti-alert-circle"></i> <?= htmlspecialchars($error) ?></div>
      <?php endif; ?>
      <div class="alert" id="loginAlert" style="display:none"></div>

      <form method="POST" action="login.php">
        <div class="form-group">
          <label data-i18n="email">Email</label>
          <input type="email" name="email" id="login-email" placeholder="tu@email.com"
            value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
        </div>
        <div class="form-group">
          <label data-i18n="password">Parolă</label>
          <input type="password" name="password" id="login-pass" placeholder="••••••" required>
        </div>
        <button type="submit" class="btn-full" data-i18n="loginBtn">Conectare</button>
      </form>

      <div class="auth-footer">
        <span data-i18n="noAccount">Nu ai cont?</span>
        <a href="register.php"> <span data-i18n="register">Înregistrare</span></a>
      </div>
    </div>
  </div>

  <script src="js/script.js"></script>
</body>

</html>