<!DOCTYPE html>
<html lang="ro">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SoundWave</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@300;400;500&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
  <link rel="stylesheet" href="CSS/style.css">
</head>

<body>

  <!-- ── NAVBAR ── -->
  <nav class="navbar">
    <div class="logo">SoundWave</div>

    <ul class="nav-links">
      <li><a href="#" class="active">Acasă</a></li>
      <li><a href="#">Descoperă</a></li>
      <li><a href="#">Funcționalități</a></li>
      <li><a href="#">Contact</a></li>
    </ul>

    <div class="nav-actions">
      <button class="btn btn-ghost">Conectare</button>
      <button class="btn btn-primary">Înregistrare</button>
    </div>
  </nav>

  <!-- ── PAGE ── -->
  <div class="page">

    <!-- SIDEBAR -->
    <aside class="sidebar">
      <div class="sl">Meniu</div>
      <a href="#" class="slink active"><i class="ti ti-home"></i> Acasă</a>
      <a href="#" class="slink"><i class="ti ti-compass"></i> Descoperă</a>
      <a href="#" class="slink"><i class="ti ti-heart"></i> Favorite</a>
      <a href="#" class="slink"><i class="ti ti-playlist"></i> Playlist-uri</a>
      <a href="#" class="slink"><i class="ti ti-clock"></i> Istoric</a>

      <div class="sl">Genuri</div>
      <a href="#" class="slink"><i class="ti ti-music"></i> Pop</a>
      <a href="#" class="slink"><i class="ti ti-headphones"></i> Hip-Hop</a>
      <a href="#" class="slink"><i class="ti ti-device-speaker"></i> Electronic</a>
      <a href="#" class="slink"><i class="ti ti-guitar-pick"></i> Rock</a>
      <a href="#" class="slink"><i class="ti ti-saxophone"></i> Jazz</a>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="main">

      <!-- HERO -->
      <section class="hero">
        <div class="hero-chip"><i class="ti ti-bolt" style="font-size:.8rem"></i> Platforma ta muzicală</div>
        <h1>Ascultă muzica<br>pe care o <span>iubești</span></h1>
        <p>Descoperă milioane de melodii, creează playlist-uri și împărtășește muzica cu prietenii tăi.</p>
        <div class="hero-btns">
          <button class="btn btn-primary btn-lg"><i class="ti ti-player-play"
              style="margin-right:.35rem;font-size:.9rem"></i>Explorează acum</button>
          <button class="btn btn-ghost btn-lg">Înregistrează-te gratuit</button>
        </div>
      </section>

      <!-- FEATURED -->
      <div class="featured">
        <div class="f-cover">🌙</div>
        <div>
          <div class="f-tag">Melodia zilei</div>
          <div class="f-title">Midnight Echoes</div>
          <div class="f-sub">Luna Vega &nbsp;·&nbsp; Electronic &nbsp;·&nbsp; 3:42</div>
          <button class="btn-play"><i class="ti ti-player-play" style="font-size:.85rem"></i> Ascultă</button>
        </div>
      </div>

      <!-- GENRE TAGS -->
      <div class="genre-row">
        <span class="gtag active">Toate</span>
        <span class="gtag">Pop</span>
        <span class="gtag">Hip-Hop</span>
        <span class="gtag">Electronic</span>
        <span class="gtag">Rock</span>
        <span class="gtag">Jazz</span>
        <span class="gtag">R&B</span>
        <span class="gtag">Indie</span>
      </div>

      <!-- TRENDING CARDS -->
      <section class="section">
        <div class="sec-head">
          <h2 class="sec-title">Trending acum</h2>
          <a href="#" class="see-all">Vezi toate</a>
        </div>
        <div class="cards">
          <div class="card">
            <div class="ccover c1">🌙</div>
            <div class="cplay"><i class="ti ti-player-play"></i></div>
            <div class="ctitle">Midnight Echoes</div>
            <div class="csub">Luna Vega</div>
          </div>
          <div class="card">
            <div class="ccover c2">🔮</div>
            <div class="cplay"><i class="ti ti-player-play"></i></div>
            <div class="ctitle">Neon Dreams</div>
            <div class="csub">Synth Collective</div>
          </div>
          <div class="card">
            <div class="ccover c3">💎</div>
            <div class="cplay"><i class="ti ti-player-play"></i></div>
            <div class="ctitle">Crystal Clear</div>
            <div class="csub">The Waves</div>
          </div>
          <div class="card">
            <div class="ccover c4">🌅</div>
            <div class="cplay"><i class="ti ti-player-play"></i></div>
            <div class="ctitle">Golden Hour</div>
            <div class="csub">Solar Drift</div>
          </div>
          <div class="card">
            <div class="ccover c5">🎸</div>
            <div class="cplay"><i class="ti ti-player-play"></i></div>
            <div class="ctitle">Velvet Sound</div>
            <div class="csub">Dark Matter</div>
          </div>
          <div class="card">
            <div class="ccover c6">🎷</div>
            <div class="cplay"><i class="ti ti-player-play"></i></div>
            <div class="ctitle">Jazz Rain</div>
            <div class="csub">Miles Ahead</div>
          </div>
        </div>
      </section>

      <!-- SONG LIST -->
      <section class="section">
        <div class="sec-head">
          <h2 class="sec-title">Recomandate pentru tine</h2>
        </div>
        <div class="songlist">
          <div class="sitem">
            <span class="snum">1</span>
            <div class="sthumb c1">🌙</div>
            <div>
              <div class="sname">Midnight Echoes</div>
              <div class="sartist">Luna Vega</div>
            </div>
            <span class="sdur">3:42</span>
            <i class="ti ti-heart sheart"></i>
          </div>
          <div class="sitem">
            <span class="snum">2</span>
            <div class="sthumb c2">🔮</div>
            <div>
              <div class="sname">Neon Dreams</div>
              <div class="sartist">Synth Collective</div>
            </div>
            <span class="sdur">4:15</span>
            <i class="ti ti-heart sheart"></i>
          </div>
          <div class="sitem">
            <span class="snum">3</span>
            <div class="sthumb c3">💎</div>
            <div>
              <div class="sname">Crystal Clear</div>
              <div class="sartist">The Waves</div>
            </div>
            <span class="sdur">3:58</span>
            <i class="ti ti-heart sheart liked"></i>
          </div>
          <div class="sitem">
            <span class="snum">4</span>
            <div class="sthumb c4">🌅</div>
            <div>
              <div class="sname">Golden Hour</div>
              <div class="sartist">Solar Drift</div>
            </div>
            <span class="sdur">5:02</span>
            <i class="ti ti-heart sheart"></i>
          </div>
          <div class="sitem">
            <span class="snum">5</span>
            <div class="sthumb c5">🎸</div>
            <div>
              <div class="sname">Velvet Underground</div>
              <div class="sartist">Dark Matter</div>
            </div>
            <span class="sdur">4:33</span>
            <i class="ti ti-heart sheart"></i>
          </div>
          <div class="sitem">
            <span class="snum">6</span>
            <div class="sthumb c6">🎷</div>
            <div>
              <div class="sname">Jazz in the Rain</div>
              <div class="sartist">Miles Ahead</div>
            </div>
            <span class="sdur">6:18</span>
            <i class="ti ti-heart sheart"></i>
          </div>
        </div>
      </section>

    </main>
  </div>

  <!-- ── PLAYER ── -->
  <div class="player">
    <div class="ptrack">
      <div class="pthumb">🌙</div>
      <div>
        <div class="pname">Midnight Echoes</div>
        <div class="partist">Luna Vega</div>
      </div>
      <i class="ti ti-heart pheart"></i>
    </div>

    <div class="pcontrols">
      <div class="pbtns">
        <button class="pbtn"><i class="ti ti-arrows-shuffle"></i></button>
        <button class="pbtn"><i class="ti ti-player-skip-back"></i></button>
        <button class="pbtn play"><i class="ti ti-player-play"></i></button>
        <button class="pbtn"><i class="ti ti-player-skip-forward"></i></button>
        <button class="pbtn"><i class="ti ti-repeat"></i></button>
      </div>
      <div class="pbar">
        <span class="ptime">0:00</span>
        <div class="ptrack-bar">
          <div class="pfill"></div>
        </div>
        <span class="ptime">3:42</span>
      </div>
    </div>

    <div class="pvol">
      <div class="wave">
        <div class="wb"></div>
        <div class="wb"></div>
        <div class="wb"></div>
        <div class="wb"></div>
        <div class="wb"></div>
      </div>
      <i class="ti ti-volume"></i>
      <input type="range" class="vslider" min="0" max="100" value="75">
    </div>
  </div>

  <script>
    /* Genre tags */
    document.querySelectorAll('.gtag').forEach(t => {
      t.addEventListener('click', () => {
        document.querySelectorAll('.gtag').forEach(x => x.classList.remove('active'));
        t.classList.add('active');
      });
    });

    /* Heart toggle */
    document.querySelectorAll('.sheart, .pheart').forEach(h => {
      h.addEventListener('click', e => {
        e.stopPropagation();
        h.classList.toggle('liked');
      });
    });

    /* Play button toggle */
    const playBtn = document.querySelector('.pbtn.play');
    let playing = false;
    playBtn.addEventListener('click', () => {
      playing = !playing;
      playBtn.innerHTML = playing
        ? '<i class="ti ti-player-pause"></i>'
        : '<i class="ti ti-player-play"></i>';
    });
  </script>

</body>

</html>