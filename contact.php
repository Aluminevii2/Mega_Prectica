<?php
require_once 'php/functions.php';
$user = currentUser();

$error = '';
$success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $msg = trim($_POST['message'] ?? '');
    if (!$name || !$email || !$msg) {
        $error = 'Completați toate câmpurile.';
    } elseif (!validateEmail($email)) {
        $error = 'Email invalid.';
    } else {
        saveMessage($name, $email, $msg);
        $success = 'Mesaj trimis cu succes! Vă vom răspunde în curând.';
    }
}
?>
<!DOCTYPE html>
<html lang="ro">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SoundWave — Contact</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
</head>

<body>
    <nav class="navbar">
        <a href="index.php" class="logo">SoundWave</a>
        <ul class="nav-links">
            <li><a href="index.php" data-i18n="home">Acasă</a></li>
            <?php if ($user): ?>
                <li><a href="dashboard.php" data-i18n="dashboard">Panou</a></li>
            <?php endif; ?>
            <li><a href="contact.php" class="active" data-i18n="contact">Contact</a></li>
        </ul>
        <div class="nav-actions">
            <div class="lang-switcher">
                <button class="lang-btn active" data-lang="ro" onclick="switchLang('ro')">RO</button>
                <button class="lang-btn" data-lang="en" onclick="switchLang('en')">EN</button>
                <button class="lang-btn" data-lang="ru" onclick="switchLang('ru')">RU</button>
            </div>
            <button class="btn-icon" id="themeBtn" onclick="toggleTheme()"><i class="ti ti-moon"></i></button>
            <?php if ($user): ?>
                <a href="logout.php" class="btn btn-ghost" data-i18n="logout">Deconectare</a>
            <?php else: ?>
                <a href="login.php" class="btn btn-ghost" data-i18n="login">Conectare</a>
                <a href="register.php" class="btn btn-primary" data-i18n="register">Înregistrare</a>
            <?php endif; ?>
        </div>
    </nav>

    <div class="page-wrapper">
        <aside class="sidebar">
            <div class="sidebar-section">
                <div class="sidebar-label">Navigare</div>
                <a href="index.php" class="sidebar-link"><i class="ti ti-home"></i> <span
                        data-i18n="home">Acasă</span></a>
                <?php if ($user): ?>
                    <a href="dashboard.php" class="sidebar-link"><i class="ti ti-layout-dashboard"></i> <span
                            data-i18n="dashboard">Panou</span></a>
                <?php endif; ?>
                <a href="contact.php" class="sidebar-link active"><i class="ti ti-mail"></i> <span
                        data-i18n="contact">Contact</span></a>
            </div>
        </aside>

        <main class="main-content">
            <div style="margin-bottom:2rem">
                <h1 style="font-size:1.8rem;margin-bottom:.35rem" data-i18n="contactTitle">Contactează-ne</h1>
                <p style="color:var(--text2)" data-i18n="contactDesc">Ai întrebări sau sugestii? Ne bucurăm să te auzim.
                </p>
            </div>

            <div class="contact-grid">
                <!-- INFO -->
                <div class="contact-info">
                    <h3>SoundWave</h3>
                    <p>Platforma muzicală modernă pentru toți iubitorii de muzică din Moldova și nu numai.</p>

                    <div class="contact-detail">
                        <div class="contact-detail-icon"><i class="ti ti-mail"></i></div>
                        <span>contact@soundwave.md</span>
                    </div>
                    <div class="contact-detail">
                        <div class="contact-detail-icon"><i class="ti ti-phone"></i></div>
                        <span>+373 22 000 000</span>
                    </div>
                    <div class="contact-detail">
                        <div class="contact-detail-icon"><i class="ti ti-map-pin"></i></div>
                        <span>Chișinău, Republica Moldova</span>
                    </div>
                    <div class="contact-detail">
                        <div class="contact-detail-icon"><i class="ti ti-brand-instagram"></i></div>
                        <span>@soundwave.md</span>
                    </div>

                    <div
                        style="margin-top:1.5rem;background:var(--bg2);border:1px solid var(--border);border-radius:var(--radius);padding:1.25rem">
                        <p style="font-size:.85rem;color:var(--text2);margin-bottom:.5rem"><strong
                                style="color:var(--text)">Ore de lucru</strong></p>
                        <p style="font-size:.85rem;color:var(--text2)">Lun – Vin: 09:00 – 18:00</p>
                        <p style="font-size:.85rem;color:var(--text2)">Sâm – Dum: Închis</p>
                    </div>
                </div>

                <!-- FORM -->
                <div class="contact-form-card">
                    <?php if ($error): ?>
                        <div class="alert alert-danger"><i class="ti ti-alert-circle"></i> <?= htmlspecialchars($error) ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($success): ?>
                        <div class="alert alert-success"><i class="ti ti-check"></i> <?= htmlspecialchars($success) ?></div>
                    <?php endif; ?>
                    <div class="alert" id="contactAlert" style="display:none"></div>

                    <form method="POST" action="contact.php" id="contactForm">
                        <div class="form-group">
                            <label>Nume complet</label>
                            <input type="text" name="name" id="cf-name" placeholder="Ion Popescu"
                                value="<?= htmlspecialchars($_POST['name'] ?? ($user['name'] ?? '')) ?>" required>
                        </div>
                        <div class="form-group">
                            <label data-i18n="email">Email</label>
                            <input type="email" name="email" id="cf-email" placeholder="tu@email.com"
                                value="<?= htmlspecialchars($_POST['email'] ?? ($user['email'] ?? '')) ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Subiect</label>
                            <select name="subject">
                                <option>Întrebare generală</option>
                                <option>Sugestie</option>
                                <option>Problemă tehnică</option>
                                <option>Parteneriat</option>
                                <option>Altceva</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label data-i18n="msgLabel">Mesaj</label>
                            <textarea name="message" id="cf-message" rows="5" placeholder="Scrie mesajul tău..."
                                required></textarea>
                        </div>
                        <button type="submit" class="btn-full" data-i18n="sendBtn">Trimite mesaj</button>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <script src="js/script.js"></script>
</body>

</html>