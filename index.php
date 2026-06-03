<?php
require_once 'php/auth.php';
$user = currentUser();
?>
<!DOCTYPE html>
<html lang="ro">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SoundWave — Platforma ta muzicală</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
</head>

<body>

  <!-- NAVBAR -->
  <nav class="navbar">
    <a href="index.php" class="logo">SoundWave</a>
    <ul class="nav-links">
      <li><a href="index.php" class="active" data-i18n="home">Acasă</a></li>
      <li><a href="index.php#discover" data-i18n="discover">Descoperă</a></li>
      <?php if ($user): ?>
        <li><a href="dashboard.php" data-i18n="dashboard">Panou</a></li>
      <?php endif; ?>
      <li><a href="contact.php" data-i18n="contact">Contact</a></li>
    </ul>
    <div class="nav-actions">
      <div class="lang-switcher">
        <button class="lang-btn active" data-lang="ro" onclick="switchLang('ro')">RO</button>
        <button class="lang-btn" data-lang="en" onclick="switchLang('en')">EN</button>
        <button class="lang-btn" data-lang="ru" onclick="switchLang('ru')">RU</button>
      </div>
      <button class="btn-icon" id="themeBtn" onclick="toggleTheme()" title="Toggle theme">
        <i class="ti ti-moon"></i>
      </button>
      <?php if ($user): ?>
        <span style="font-size:.85rem;color:var(--text2);padding:0 .5rem"><?= htmlspecialchars($user['name']) ?></span>
        <a href="logout.php" class="btn btn-ghost" data-i18n="logout">Deconectare</a>
      <?php else: ?>
        <a href="login.php" class="btn btn-ghost" data-i18n="login">Conectare</a>
        <a href="register.php" class="btn btn-primary" data-i18n="register">Înregistrare</a>
      <?php endif; ?>
    </div>
  </nav>

  <div class="page-wrapper">
    <!-- SIDEBAR -->
    <aside class="sidebar">
      <div class="sidebar-section">
        <div class="sidebar-label">Meniu</div>
        <a href="index.php" class="sidebar-link active"><i class="ti ti-home"></i> <span
            data-i18n="home">Acasă</span></a>
        <a href="#discover" class="sidebar-link"><i class="ti ti-compass"></i> <span
            data-i18n="discover">Descoperă</span></a>
        <?php if ($user): ?>
          <a href="dashboard.php" class="sidebar-link"><i class="ti ti-layout-dashboard"></i> <span
              data-i18n="dashboard">Panou</span></a>
        <?php endif; ?>
        <a href="contact.php" class="sidebar-link"><i class="ti ti-mail"></i> <span
            data-i18n="contact">Contact</span></a>
      </div>
      <div class="sidebar-section">
        <div class="sidebar-label">Genuri</div>
        <a href="#" class="sidebar-link"><i class="ti ti-music"></i> Pop</a>
        <a href="#" class="sidebar-link"><i class="ti ti-headphones"></i> Hip-Hop</a>
        <a href="#" class="sidebar-link"><i class="ti ti-device-speaker"></i> Electronic</a>
        <a href="#" class="sidebar-link"><i class="ti ti-guitar-pick"></i> Rock</a>
        <a href="#" class="sidebar-link"><i class="ti ti-saxophone"></i> Jazz</a>
      </div>
    </aside>

    <!-- MAIN -->
    <main class="main-content">

      <!-- HERO -->
      <section class="hero">
        <div class="hero-tag" data-i18n="heroTag">🎵 Platforma ta muzicală</div>
        <h1 data-i18n="heroTitle">Ascultă muzica pe care o <span>iubești</span></h1>
        <p data-i18n="heroDesc">Descoperă milioane de melodii, creează playlist-uri și împărtășește muzica cu prietenii.
        </p>
        <div class="hero-actions">
          <a href="#discover" class="btn btn-primary"><i class="ti ti-player-play" style="margin-right:.4rem"></i><span
              data-i18n="btnExplore">Explorează acum</span></a>
          <?php if (!$user): ?>
            <a href="register.php" class="btn btn-ghost" data-i18n="btnSignup">Înregistrează-te gratuit</a>
          <?php endif; ?>
        </div>
      </section>

      <!-- FEATURED BANNER -->
      <div class="featured-banner">
        <div class="featured-cover">🌙</div>
        <div class="featured-meta">
          <div class="flabel" data-i18n="featured">Melodia zilei</div>
          <h3>Midnight Echoes</h3>
          <p>Luna Vega · Electronic · 3:42</p>
          <button class="btn btn-primary" style="padding:.4rem 1rem;font-size:.85rem" onclick="togglePlay()">
            <i class="ti ti-player-play"></i> Play
          </button>
        </div>
      </div>

      <!-- GENRE TAGS -->
      <div id="genreTags" class="genre-tags"></div>

      <!-- TRENDING -->
      <section class="section" id="discover">
        <div class="section-header">
          <h2 class="section-title" data-i18n="trending">Trending acum</h2>
          <a href="#" class="see-all" data-i18n="seeAll">Vezi toate</a>
        </div>
        <div class="cards-grid">
          <?php
          $cards = [
            ['🌙', 'Midnight Echoes', 'Luna Vega'],
            ['🔮', 'Neon Dreams', 'Synth Collective'],
            ['💎', 'Crystal Clear', 'The Waves'],
            ['🌅', 'Golden Hour', 'Solar Drift'],
            ['🎸', 'Velvet Sound', 'Dark Matter'],
            ['🎷', 'Jazz Rain', 'Miles Ahead'],
          ];
          foreach ($cards as [$emoji, $title, $artist]):
            ?>
            <div class="music-card" onclick="togglePlay()">
              <div class="card-cover">
                <?= $emoji ?>
                <div class="card-play-btn"><i class="ti ti-player-play"></i></div>
              </div>
              <div class="card-title"><?= $title ?></div>
              <div class="card-sub"><?= $artist ?></div>
            </div>
          <?php endforeach; ?>
        </div>
      </section>

      <!-- SONG LIST -->
      <section class="section">
        <div class="section-header">
          <h2 class="section-title" data-i18n="forYou">Recomandate pentru tine</h2>
        </div>
        <div class="song-list">
          <?php
          $songs = [
            ['demo1', '🌙', 'Midnight Echoes', 'Luna Vega', '3:42'],
            ['demo2', '🔮', 'Neon Dreams', 'Synth Collective', '4:15'],
            ['demo3', '💎', 'Crystal Clear', 'The Waves', '3:58'],
            ['demo4', '🌅', 'Golden Hour', 'Solar Drift', '5:02'],
            ['demo5', '🎸', 'Velvet Underground', 'Dark Matter', '4:33'],
            ['demo6', '🎷', 'Jazz in the Rain', 'Miles Ahead', '6:18'],
          ];
          foreach ($songs as $i => [$id, $emoji, $title, $artist, $dur]):
            ?>
            <div class="song-item" onclick="togglePlay()">
              <span class="song-num"><?= $i + 1 ?></span>
              <div class="song-thumb"><?= $emoji ?></div>
              <div class="song-info">
                <div class="song-name"><?= $title ?></div>
                <div class="song-artist"><?= $artist ?></div>
              </div>
              <span class="song-duration"><?= $dur ?></span>
              <span class="song-like" data-song-id="<?= $id ?>"><i class="ti ti-heart"></i></span>
            </div>
          <?php endforeach; ?>
        </div>
      </section>

    </main>
  </div>

  <!-- PLAYER -->
  <div class="player">
    <div class="player-track">
      <div class="player-thumb" id="trackThumb">🌙</div>
      <div class="player-track-info">
        <div class="track-name" id="trackName">Midnight Echoes</div>
        <div class="track-artist" id="trackArtist">Luna Vega</div>
      </div>
      <span class="song-like" data-song-id="player-liked" style="margin-left:.75rem"><i class="ti ti-heart"></i></span>
    </div>

    <div class="player-controls">
      <div class="control-btns">
        <button class="ctrl-btn" id="prevBtn"><i class="ti ti-player-skip-back"></i></button>
        <button class="ctrl-btn play" id="playBtn"><i class="ti ti-player-play"></i></button>
        <button class="ctrl-btn" id="nextBtn"><i class="ti ti-player-skip-forward"></i></button>
      </div>
      <div class="progress-bar">
        <span class="progress-time" id="currentTime">0:00</span>
        <div class="progress-track" id="progressTrack">
          <div class="progress-fill" id="progressFill"></div>
        </div>
        <span class="progress-time">3:42</span>
      </div>
    </div>

    <div class="volume-area">
      <div class="waveform">
        <div class="wave-bar"></div>
        <div class="wave-bar"></div>
        <div class="wave-bar"></div>
        <div class="wave-bar"></div>
        <div class="wave-bar"></div>
      </div>
      <i class="ti ti-volume vol-icon"></i>
      <input type="range" class="vol-slider" min="0" max="100" value="75">
    </div>
  </div>

  <script src="js/script.js"></script>
  <script>initLoginForm(); initRegisterForm();</script>
</body>

</html>