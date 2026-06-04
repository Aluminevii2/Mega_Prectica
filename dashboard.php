<?php
require_once 'php/functions.php';
requireLogin();
$user = currentUser();
$items = getItems();
$userItems = array_filter($items, fn($i) => $i['user_id'] === $user['id']);

$error = '';
$success = '';

// Handle add
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'add') {
        $title = trim($_POST['title'] ?? '');
        $artist = trim($_POST['artist'] ?? '');
        $genre = trim($_POST['genre'] ?? '');
        $emoji = trim($_POST['emoji'] ?? '🎵');
        if (!$title || !$artist) {
            $error = 'Titlu și artist sunt obligatorii.';
        } else {
            addItem(['title' => $title, 'artist' => $artist, 'genre' => $genre, 'emoji' => $emoji, 'duration' => '3:00']);
            $success = 'Melodia a fost adăugată!';
            header('Location: dashboard.php?ok=1');
            exit;
        }
    } elseif ($_POST['action'] === 'delete') {
        deleteItem($_POST['id'] ?? '');
        header('Location: dashboard.php?deleted=1');
        exit;
    } elseif ($_POST['action'] === 'edit') {
        updateItem($_POST['id'], $_POST);
        header('Location: dashboard.php?edited=1');
        exit;
    }
}

if (isset($_GET['ok']))
    $success = 'Melodia a fost adăugată!';
if (isset($_GET['deleted']))
    $success = 'Melodia a fost ștearsă.';
if (isset($_GET['edited']))
    $success = 'Melodia a fost actualizată.';

$items = getItems();
$userItems = array_filter($items, fn($i) => $i['user_id'] === $user['id']);
$totalItems = count($items);
$userCount = count($userItems);
?>
<!DOCTYPE html>
<html lang="ro">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SoundWave — Panou</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <style>
        .table-card {
            background: var(--bg2);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: .9rem;
        }

        thead th {
            padding: .75rem 1rem;
            text-align: left;
            background: var(--bg3);
            font-size: .75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text3);
        }

        tbody tr {
            border-top: 1px solid var(--border);
            transition: var(--transition);
        }

        tbody tr:hover {
            background: var(--bg3);
        }

        tbody td {
            padding: .65rem 1rem;
            color: var(--text);
        }

        .add-card {
            background: var(--bg2);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .add-card h3 {
            margin-bottom: 1rem;
            font-size: 1rem;
            font-weight: 700;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .action-btns {
            display: flex;
            gap: .5rem;
        }

        .btn-sm {
            padding: .25rem .65rem;
            font-size: .78rem;
            border-radius: 6px;
            border: 1px solid var(--border);
            background: transparent;
            color: var(--text2);
            cursor: pointer;
            transition: var(--transition);
            font-family: 'DM Sans', sans-serif;
        }

        .btn-sm:hover {
            background: var(--bg3);
            color: var(--text);
        }

        .btn-sm-danger:hover {
            color: var(--danger);
            border-color: var(--danger);
            background: rgba(248, 113, 113, .08);
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <a href="index.php" class="logo">SoundWave</a>
        <ul class="nav-links">
            <li><a href="index.php" data-i18n="home">Acasă</a></li>
            <li><a href="dashboard.php" class="active" data-i18n="dashboard">Panou</a></li>
            <li><a href="contact.php" data-i18n="contact">Contact</a></li>
        </ul>
        <div class="nav-actions">
            <div class="lang-switcher">
                <button class="lang-btn active" data-lang="ro" onclick="switchLang('ro')">RO</button>
                <button class="lang-btn" data-lang="en" onclick="switchLang('en')">EN</button>
                <button class="lang-btn" data-lang="ru" onclick="switchLang('ru')">RU</button>
            </div>
            <button class="btn-icon" id="themeBtn" onclick="toggleTheme()"><i class="ti ti-moon"></i></button>
            <span style="font-size:.85rem;color:var(--text2)"><?= htmlspecialchars($user['name']) ?></span>
            <a href="logout.php" class="btn btn-ghost" data-i18n="logout">Deconectare</a>
        </div>
    </nav>

    <div class="page-wrapper">
        <aside class="sidebar">
            <div class="sidebar-section">
                <div class="sidebar-label">Navigare</div>
                <a href="index.php" class="sidebar-link"><i class="ti ti-home"></i> <span
                        data-i18n="home">Acasă</span></a>
                <a href="dashboard.php" class="sidebar-link active"><i class="ti ti-layout-dashboard"></i> <span
                        data-i18n="dashboard">Panou</span></a>
                <a href="contact.php" class="sidebar-link"><i class="ti ti-mail"></i> <span
                        data-i18n="contact">Contact</span></a>
                <a href="logout.php" class="sidebar-link"><i class="ti ti-logout"></i> <span
                        data-i18n="logout">Deconectare</span></a>
            </div>
        </aside>

        <main class="main-content">
            <div style="margin-bottom:1.5rem">
                <h1 style="font-size:1.5rem;margin-bottom:.25rem">Bun venit, <?= htmlspecialchars($user['name']) ?>! 👋
                </h1>
                <p style="color:var(--text2);font-size:.9rem"><?= htmlspecialchars($user['email']) ?></p>
            </div>

            <!-- STATS -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon"><i class="ti ti-music"></i></div>
                    <div class="stat-value"><?= $totalItems ?></div>
                    <div class="stat-label">Melodii totale</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="ti ti-user"></i></div>
                    <div class="stat-value"><?= $userCount ?></div>
                    <div class="stat-label">Melodiile mele</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="ti ti-heart"></i></div>
                    <div class="stat-value">12</div>
                    <div class="stat-label" data-i18n="favorites">Favorite</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="ti ti-playlist"></i></div>
                    <div class="stat-value">3</div>
                    <div class="stat-label" data-i18n="playlists">Playlist-uri</div>
                </div>
            </div>

            <?php if ($error): ?>
                <div class="alert alert-danger"><i class="ti ti-alert-circle"></i> <?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div class="alert alert-success"><i class="ti ti-check"></i> <?= htmlspecialchars($success) ?></div>
            <?php endif; ?>

            <!-- ADD SONG FORM -->
            <div class="add-card">
                <h3><i class="ti ti-plus" style="color:var(--accent)"></i> Adaugă melodie nouă</h3>
                <form method="POST" action="dashboard.php">
                    <input type="hidden" name="action" value="add">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Titlu *</label>
                            <input type="text" name="title" placeholder="Titlul melodiei" required>
                        </div>
                        <div class="form-group">
                            <label>Artist *</label>
                            <input type="text" name="artist" placeholder="Numele artistului" required>
                        </div>
                        <div class="form-group">
                            <label>Gen muzical</label>
                            <select name="genre">
                                <option value="">— Selectează —</option>
                                <option>Pop</option>
                                <option>Hip-Hop</option>
                                <option>Electronic</option>
                                <option>Rock</option>
                                <option>Jazz</option>
                                <option>R&B</option>
                                <option>Indie</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Emoji</label>
                            <input type="text" name="emoji" placeholder="🎵" maxlength="4" value="🎵">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="ti ti-plus"></i> Adaugă</button>
                </form>
            </div>

            <!-- SONGS TABLE -->
            <div class="section">
                <div class="section-header">
                    <h2 class="section-title">Toate melodiile (<?= $totalItems ?>)</h2>
                </div>
                <div class="table-card">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Melodie</th>
                                <th>Artist</th>
                                <th>Gen</th>
                                <th>Adăugat</th>
                                <th>Acțiuni</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $allItems = getItems();
                            foreach ($allItems as $idx => $item):
                                $isOwner = $item['user_id'] === $user['id'];
                                ?>
                                <tr id="row-<?= $item['id'] ?>">
                                    <td style="color:var(--text3)"><?= $idx + 1 ?></td>
                                    <td><strong><?= $item['emoji'] ?>     <?= htmlspecialchars($item['title']) ?></strong></td>
                                    <td style="color:var(--text2)"><?= htmlspecialchars($item['artist']) ?></td>
                                    <td>
                                        <?php if ($item['genre']): ?>
                                            <span
                                                style="background:var(--accent-glow);color:var(--accent);padding:.15rem .55rem;border-radius:99px;font-size:.75rem;font-weight:600">
                                                <?= htmlspecialchars($item['genre']) ?>
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td style="color:var(--text3);font-size:.8rem"><?= substr($item['created'], 0, 10) ?></td>
                                    <td>
                                        <?php if ($isOwner): ?>
                                            <div class="action-btns">
                                                <button class="btn-sm"
                                                    onclick="openEdit('<?= $item['id'] ?>','<?= htmlspecialchars($item['title'], ENT_QUOTES) ?>','<?= htmlspecialchars($item['artist'], ENT_QUOTES) ?>')">
                                                    <i class="ti ti-edit"></i> Edit
                                                </button>
                                                <form method="POST" style="display:inline"
                                                    onsubmit="return confirm('Ștergi melodia?')">
                                                    <input type="hidden" name="action" value="delete">
                                                    <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                                    <button type="submit" class="btn-sm btn-sm-danger"><i
                                                            class="ti ti-trash"></i> Șterge</button>
                                                </form>
                                            </div>
                                        <?php else: ?>
                                            <span style="font-size:.75rem;color:var(--text3)">—</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if (!$allItems): ?>
                                <tr>
                                    <td colspan="6" style="text-align:center;padding:2rem;color:var(--text3)">Nicio melodie
                                        adăugată încă.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- EDIT MODAL (inline form) -->
    <div id="editModal"
        style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.6);z-index:200;align-items:center;justify-content:center">
        <div
            style="background:var(--bg2);border:1px solid var(--border);border-radius:20px;padding:2rem;width:100%;max-width:440px;margin:1rem">
            <h3 style="margin-bottom:1rem">Editează melodia</h3>
            <form method="POST" action="dashboard.php">
                <input type="hidden" name="action" value="edit">
                <input type="hidden" name="id" id="edit-id">
                <div class="form-group">
                    <label>Titlu</label>
                    <input type="text" name="title" id="edit-title" required>
                </div>
                <div class="form-group">
                    <label>Artist</label>
                    <input type="text" name="artist" id="edit-artist" required>
                </div>
                <div style="display:flex;gap:.75rem;margin-top:.5rem">
                    <button type="submit" class="btn btn-primary">Salvează</button>
                    <button type="button" class="btn btn-ghost" onclick="closeEdit()">Anulează</button>
                </div>
            </form>
        </div>
    </div>

    <!-- PLAYER -->
    <div class="player">
        <div class="player-track">
            <div class="player-thumb" id="trackThumb">🌙</div>
            <div class="player-track-info">
                <div class="track-name" id="trackName">Midnight Echoes</div>
                <div class="track-artist" id="trackArtist">Luna Vega</div>
            </div>
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
            <i class="ti ti-volume vol-icon"></i>
            <input type="range" class="vol-slider" min="0" max="100" value="75">
        </div>
    </div>

    <script src="js/script.js"></script>
    <script>
        function openEdit(id, title, artist) {
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-title').value = title;
            document.getElementById('edit-artist').value = artist;
            document.getElementById('editModal').style.display = 'flex';
        }
        function closeEdit() {
            document.getElementById('editModal').style.display = 'none';
        }
    </script>
</body>

</html>