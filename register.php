<?php
require_once 'php/auth.php';
if (isLoggedIn()) {
  header('Location: dashboard.php');
  exit;
}

$error = '';
$success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['name'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $pass = $_POST['password'] ?? '';
  $pass2 = $_POST['password2'] ?? '';
  if (!$name || !$email || !$pass) {
    $error = 'Completați toate câmpurile.';
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = 'Email invalid.';
  } elseif (strlen($pass) < 6) {
    $error = 'Parola trebuie să aibă cel puțin 6 caractere.';
  } elseif ($pass !== $pass2) {
    $error = 'Parolele nu coincid.';
  } else {
    $result = registerUser($name, $email, $pass);
    if ($result['ok']) {
      $success = 'Cont creat cu succes! Redirectare...';
    } else {
      $error = $result['msg'];
    }
  }
}
?>
<!DOCTYPE html>
<html lang="ro">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SoundWave — Înregistrare</title>
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
      <h2 data-i18n="registerTitle">Alătură-te SoundWave</h2>
      <p class="sub" data-i18n="registerSub">Creează-ți contul gratuit</p>

      <?php if ($error): ?>
        <div class="alert alert-danger"><i class="ti ti-alert-circle"></i> <?= htmlspecialchars($error) ?></div>
      <?php endif; ?>
      <?php if ($success): ?>
        <div class="alert alert-success"><i class="ti ti-check"></i> <?= htmlspecialchars($success) ?></div>
        <script>setTimeout(() => window.location.href = 'login.php', 1500);</script>
      <?php endif; ?>

      <form method="POST" action="register.php">
        <div class="form-group">
          <label data-i18n="name">Nume complet</label>
          <input type="text" name="name" id="reg-name" placeholder="Ion Popescu"
            value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" required>
        </div>
        <div class="form-group">
          <label data-i18n="email">Email</label>
          <input type="email" name="email" id="reg-email" placeholder="tu@email.com"
            value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
        </div>
        <div class="form-group">
          <label data-i18n="password">Parolă</label>
          <input type="password" name="password" id="reg-pass" placeholder="Min. 6 caractere" required>
        </div>
        <div class="form-group">
          <label data-i18n="confirmPass">Confirmă parola</label>
          <input type="password" name="password2" id="reg-pass2" placeholder="••••••" required>
        </div>
        <button type="submit" class="btn-full" data-i18n="registerBtn">Înregistrare</button>
      </form>

      <div class="auth-footer">
        <span data-i18n="haveAccount">Ai deja cont?</span>
        <a href="login.php"> <span data-i18n="login">Conectare</span></a>
      </div>
    </div>
  </div>

  <script src="js/script.js"></script>
</body>

</html>