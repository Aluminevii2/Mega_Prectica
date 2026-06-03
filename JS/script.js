// ── TRANSLATIONS ──
const translations = {
  ro: {
    home: "Acasă", discover: "Descoperă", features: "Funcționalități",
    contact: "Contact", login: "Conectare", register: "Înregistrare",
    logout: "Deconectare", dashboard: "Panou",
    heroTag: "🎵 Platforma ta muzicală",
    heroTitle: "Ascultă muzica pe care o <span>iubești</span>",
    heroDesc: "Descoperă milioane de melodii, creează playlist-uri și împărtășește muzica cu prietenii.",
    btnExplore: "Explorează acum", btnSignup: "Înregistrează-te gratuit",
    trending: "Trending acum", newReleases: "Lansări noi", forYou: "Recomandate pentru tine",
    featured: "Melodia zilei", seeAll: "Vezi toate",
    genres: ["Toate", "Pop", "Hip-Hop", "Electronic", "Rock", "Jazz", "R&B", "Indie"],
    loginTitle: "Bun venit înapoi", loginSub: "Conectează-te la contul tău",
    registerTitle: "Alătură-te SoundWave", registerSub: "Creează-ți contul gratuit",
    email: "Email", password: "Parolă", name: "Nume complet",
    confirmPass: "Confirmă parola", loginBtn: "Conectare", registerBtn: "Înregistrare",
    noAccount: "Nu ai cont?", haveAccount: "Ai deja cont?",
    contactTitle: "Contactează-ne", contactDesc: "Ai întrebări sau sugestii? Ne bucurăm să te auzim.",
    msgLabel: "Mesaj", sendBtn: "Trimite mesaj",
    successMsg: "Mesaj trimis cu succes!", errorMsg: "A apărut o eroare.",
    listeners: "Ascultători", plays: "Redări", favorites: "Favorite", playlists: "Playlist-uri",
  },
  en: {
    home: "Home", discover: "Discover", features: "Features",
    contact: "Contact", login: "Login", register: "Register",
    logout: "Logout", dashboard: "Dashboard",
    heroTag: "🎵 Your music platform",
    heroTitle: "Listen to the music you <span>love</span>",
    heroDesc: "Discover millions of songs, create playlists and share music with your friends.",
    btnExplore: "Explore now", btnSignup: "Sign up for free",
    trending: "Trending now", newReleases: "New releases", forYou: "Recommended for you",
    featured: "Song of the day", seeAll: "See all",
    genres: ["All", "Pop", "Hip-Hop", "Electronic", "Rock", "Jazz", "R&B", "Indie"],
    loginTitle: "Welcome back", loginSub: "Login to your account",
    registerTitle: "Join SoundWave", registerSub: "Create your free account",
    email: "Email", password: "Password", name: "Full name",
    confirmPass: "Confirm password", loginBtn: "Login", registerBtn: "Register",
    noAccount: "Don't have an account?", haveAccount: "Already have an account?",
    contactTitle: "Contact us", contactDesc: "Have questions or suggestions? We'd love to hear from you.",
    msgLabel: "Message", sendBtn: "Send message",
    successMsg: "Message sent successfully!", errorMsg: "An error occurred.",
    listeners: "Listeners", plays: "Plays", favorites: "Favorites", playlists: "Playlists",
  },
  ru: {
    home: "Главная", discover: "Открыть", features: "Функции",
    contact: "Контакт", login: "Войти", register: "Регистрация",
    logout: "Выйти", dashboard: "Панель",
    heroTag: "🎵 Ваша музыкальная платформа",
    heroTitle: "Слушайте музыку, которую вы <span>любите</span>",
    heroDesc: "Откройте миллионы песен, создайте плейлисты и делитесь музыкой с друзьями.",
    btnExplore: "Исследовать", btnSignup: "Зарегистрироваться бесплатно",
    trending: "В тренде", newReleases: "Новые релизы", forYou: "Рекомендовано для вас",
    featured: "Песня дня", seeAll: "Посмотреть все",
    genres: ["Все", "Поп", "Хип-хоп", "Электронная", "Рок", "Джаз", "R&B", "Инди"],
    loginTitle: "Добро пожаловать", loginSub: "Войдите в свой аккаунт",
    registerTitle: "Присоединяйтесь к SoundWave", registerSub: "Создайте бесплатный аккаунт",
    email: "Email", password: "Пароль", name: "Полное имя",
    confirmPass: "Подтвердите пароль", loginBtn: "Войти", registerBtn: "Зарегистрироваться",
    noAccount: "Нет аккаунта?", haveAccount: "Уже есть аккаунт?",
    contactTitle: "Свяжитесь с нами", contactDesc: "Есть вопросы? Мы рады вас услышать.",
    msgLabel: "Сообщение", sendBtn: "Отправить сообщение",
    successMsg: "Сообщение отправлено!", errorMsg: "Произошла ошибка.",
    listeners: "Слушатели", plays: "Прослушивания", favorites: "Избранное", playlists: "Плейлисты",
  }
};

// ── STATE ──
let currentLang = localStorage.getItem('sw_lang') || 'ro';
let isDark = localStorage.getItem('sw_theme') !== 'light';
let isPlaying = false;
let progress = 35;
let progressInterval = null;
let likedSongs = JSON.parse(localStorage.getItem('sw_liked') || '[]');

// ── INIT ──
document.addEventListener('DOMContentLoaded', () => {
  applyTheme();
  applyLang();
  initPlayer();
  initLikes();
  initGenreTags();
  initContactForm();
});

// ── THEME ──
function applyTheme() {
  document.documentElement.setAttribute('data-theme', isDark ? 'dark' : 'light');
  const btn = document.getElementById('themeBtn');
  if (btn) btn.innerHTML = isDark ? '<i class="ti ti-sun"></i>' : '<i class="ti ti-moon"></i>';
}

function toggleTheme() {
  isDark = !isDark;
  localStorage.setItem('sw_theme', isDark ? 'dark' : 'light');
  applyTheme();
}

// ── LANGUAGE ──
function applyLang() {
  const t = translations[currentLang];
  document.querySelectorAll('[data-i18n]').forEach(el => {
    const key = el.getAttribute('data-i18n');
    if (t[key] !== undefined) {
      if (key === 'heroTitle') { el.innerHTML = t[key]; }
      else { el.textContent = t[key]; }
    }
  });
  document.querySelectorAll('[data-i18n-placeholder]').forEach(el => {
    const key = el.getAttribute('data-i18n-placeholder');
    if (t[key]) el.placeholder = t[key];
  });
  document.querySelectorAll('.lang-btn').forEach(btn => {
    btn.classList.toggle('active', btn.getAttribute('data-lang') === currentLang);
  });
  updateGenreTags();
}

function switchLang(lang) {
  currentLang = lang;
  localStorage.setItem('sw_lang', lang);
  applyLang();
}

// ── GENRE TAGS ──
function initGenreTags() {
  const container = document.getElementById('genreTags');
  if (!container) return;
  updateGenreTags();
}

function updateGenreTags() {
  const container = document.getElementById('genreTags');
  if (!container) return;
  const t = translations[currentLang];
  container.innerHTML = '';
  t.genres.forEach((g, i) => {
    const span = document.createElement('span');
    span.className = 'genre-tag' + (i === 0 ? ' active' : '');
    span.textContent = g;
    span.onclick = () => {
      container.querySelectorAll('.genre-tag').forEach(x => x.classList.remove('active'));
      span.classList.add('active');
    };
    container.appendChild(span);
  });
}

// ── PLAYER ──
const songs = [
  { title: "Midnight Echoes", artist: "Luna Vega", emoji: "🌙", duration: "3:42" },
  { title: "Neon Dreams", artist: "Synth Collective", emoji: "🔮", duration: "4:15" },
  { title: "Crystal Clear", artist: "The Waves", emoji: "💎", duration: "3:58" },
  { title: "Golden Hour", artist: "Solar Drift", emoji: "🌅", duration: "5:02" },
];
let currentSong = 0;

function initPlayer() {
  loadSong(currentSong);
  const playBtn = document.getElementById('playBtn');
  if (playBtn) playBtn.addEventListener('click', togglePlay);
  const prevBtn = document.getElementById('prevBtn');
  if (prevBtn) prevBtn.addEventListener('click', prevSong);
  const nextBtn = document.getElementById('nextBtn');
  if (nextBtn) nextBtn.addEventListener('click', nextSong);
  const progressTrack = document.getElementById('progressTrack');
  if (progressTrack) {
    progressTrack.addEventListener('click', (e) => {
      const rect = progressTrack.getBoundingClientRect();
      progress = Math.round(((e.clientX - rect.left) / rect.width) * 100);
      updateProgress();
    });
  }
}

function loadSong(idx) {
  const s = songs[idx];
  const nameEl = document.getElementById('trackName');
  const artistEl = document.getElementById('trackArtist');
  const thumbEl = document.getElementById('trackThumb');
  if (nameEl) nameEl.textContent = s.title;
  if (artistEl) artistEl.textContent = s.artist;
  if (thumbEl) thumbEl.textContent = s.emoji;
  progress = 0;
  updateProgress();
}

function togglePlay() {
  isPlaying = !isPlaying;
  const btn = document.getElementById('playBtn');
  if (btn) btn.innerHTML = isPlaying
    ? '<i class="ti ti-player-pause"></i>'
    : '<i class="ti ti-player-play"></i>';
  if (isPlaying) {
    progressInterval = setInterval(() => {
      progress = Math.min(progress + 0.5, 100);
      updateProgress();
      if (progress >= 100) nextSong();
    }, 500);
  } else {
    clearInterval(progressInterval);
  }
}

function nextSong() {
  clearInterval(progressInterval);
  isPlaying = false;
  currentSong = (currentSong + 1) % songs.length;
  loadSong(currentSong);
  const btn = document.getElementById('playBtn');
  if (btn) btn.innerHTML = '<i class="ti ti-player-play"></i>';
}

function prevSong() {
  clearInterval(progressInterval);
  isPlaying = false;
  currentSong = (currentSong - 1 + songs.length) % songs.length;
  loadSong(currentSong);
  const btn = document.getElementById('playBtn');
  if (btn) btn.innerHTML = '<i class="ti ti-player-play"></i>';
}

function updateProgress() {
  const fill = document.getElementById('progressFill');
  if (fill) fill.style.width = progress + '%';
  const timeEl = document.getElementById('currentTime');
  if (timeEl) {
    const totalSecs = 220;
    const cur = Math.round((progress / 100) * totalSecs);
    timeEl.textContent = `${Math.floor(cur / 60)}:${String(cur % 60).padStart(2, '0')}`;
  }
}

// ── LIKES ──
function initLikes() {
  document.querySelectorAll('.song-like').forEach(btn => {
    const id = btn.getAttribute('data-song-id');
    if (likedSongs.includes(id)) btn.classList.add('liked');
    btn.addEventListener('click', (e) => {
      e.stopPropagation();
      toggleLike(btn, id);
    });
  });
}

function toggleLike(btn, id) {
  if (likedSongs.includes(id)) {
    likedSongs = likedSongs.filter(x => x !== id);
    btn.classList.remove('liked');
    btn.innerHTML = '<i class="ti ti-heart"></i>';
  } else {
    likedSongs.push(id);
    btn.classList.add('liked');
    btn.innerHTML = '<i class="ti ti-heart-filled"></i>';
  }
  localStorage.setItem('sw_liked', JSON.stringify(likedSongs));
}

// ── CONTACT FORM ──
function initContactForm() {
  const form = document.getElementById('contactForm');
  if (!form) return;
  form.addEventListener('submit', (e) => {
    e.preventDefault();
    const t = translations[currentLang];
    const name = form.querySelector('#cf-name').value.trim();
    const email = form.querySelector('#cf-email').value.trim();
    const msg = form.querySelector('#cf-message').value.trim();
    const alertEl = document.getElementById('contactAlert');

    if (!name || !email || !msg) {
      showAlert(alertEl, 'danger', '⚠ ' + (currentLang === 'ro' ? 'Completați toate câmpurile.' : currentLang === 'en' ? 'Fill in all fields.' : 'Заполните все поля.'));
      return;
    }
    if (!email.includes('@') || !email.includes('.')) {
      showAlert(alertEl, 'danger', '⚠ ' + (currentLang === 'ro' ? 'Email invalid.' : currentLang === 'en' ? 'Invalid email.' : 'Неверный email.'));
      return;
    }

    // Save to localStorage (simulating JSON save)
    const messages = JSON.parse(localStorage.getItem('sw_messages') || '[]');
    messages.push({ name, email, msg, date: new Date().toISOString() });
    localStorage.setItem('sw_messages', JSON.stringify(messages));

    showAlert(alertEl, 'success', '✓ ' + t.successMsg);
    form.reset();
  });
}

function showAlert(el, type, msg) {
  if (!el) return;
  el.className = `alert alert-${type}`;
  el.textContent = msg;
  el.style.display = 'flex';
  setTimeout(() => { el.style.display = 'none'; }, 4000);
}

// ── VALIDATION HELPERS ──
function validateEmail(email) {
  return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

function validatePassword(pass) {
  return pass.length >= 6;
}

// ── AUTH FORMS ──
function initLoginForm() {
  const form = document.getElementById('loginForm');
  if (!form) return;
  form.addEventListener('submit', (e) => {
    e.preventDefault();
    const email = form.querySelector('#login-email').value.trim();
    const pass = form.querySelector('#login-pass').value;
    const alertEl = document.getElementById('loginAlert');

    if (!validateEmail(email)) {
      showAlert(alertEl, 'danger', '⚠ Email invalid'); return;
    }
    if (!validatePassword(pass)) {
      showAlert(alertEl, 'danger', '⚠ Parola prea scurtă (min. 6 caractere)'); return;
    }

    const users = JSON.parse(localStorage.getItem('sw_users') || '[]');
    const user = users.find(u => u.email === email && u.password === btoa(pass));
    if (!user) {
      showAlert(alertEl, 'danger', '⚠ Date incorecte'); return;
    }
    localStorage.setItem('sw_session', JSON.stringify({ email: user.email, name: user.name }));
    showAlert(alertEl, 'success', '✓ Conectat! Redirecționare...');
    setTimeout(() => { window.location.href = 'dashboard.php'; }, 1200);
  });
}

function initRegisterForm() {
  const form = document.getElementById('registerForm');
  if (!form) return;
  form.addEventListener('submit', (e) => {
    e.preventDefault();
    const name = form.querySelector('#reg-name').value.trim();
    const email = form.querySelector('#reg-email').value.trim();
    const pass = form.querySelector('#reg-pass').value;
    const pass2 = form.querySelector('#reg-pass2').value;
    const alertEl = document.getElementById('registerAlert');

    if (!name) { showAlert(alertEl, 'danger', '⚠ Introduceți numele'); return; }
    if (!validateEmail(email)) { showAlert(alertEl, 'danger', '⚠ Email invalid'); return; }
    if (!validatePassword(pass)) { showAlert(alertEl, 'danger', '⚠ Parola min. 6 caractere'); return; }
    if (pass !== pass2) { showAlert(alertEl, 'danger', '⚠ Parolele nu coincid'); return; }

    const users = JSON.parse(localStorage.getItem('sw_users') || '[]');
    if (users.find(u => u.email === email)) {
      showAlert(alertEl, 'danger', '⚠ Email deja înregistrat'); return;
    }
    users.push({ name, email, password: btoa(pass), joined: new Date().toISOString() });
    localStorage.setItem('sw_users', JSON.stringify(users));
    showAlert(alertEl, 'success', '✓ Cont creat! Redirecționare...');
    setTimeout(() => { window.location.href = 'login.php'; }, 1200);
  });
}

function getSession() {
  return JSON.parse(localStorage.getItem('sw_session') || 'null');
}

function logout() {
  localStorage.removeItem('sw_session');
  window.location.href = 'index.php';
}
