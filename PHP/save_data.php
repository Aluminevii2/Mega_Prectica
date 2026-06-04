<?php
// php/save_data.php — AJAX endpoint for saving data
require_once __DIR__ . '/functions.php';

header('Content-Type: application/json');

$action = $_POST['action'] ?? $_GET['action'] ?? '';

switch ($action) {
    case 'add_song':
        requireLogin();
        if (empty($_POST['title']) || empty($_POST['artist'])) {
            echo json_encode(['ok' => false, 'msg' => 'Titlu și artist sunt obligatorii.']);
            exit;
        }
        $item = addItem($_POST);
        echo json_encode(['ok' => true, 'item' => $item]);
        break;

    case 'delete_song':
        requireLogin();
        $id = $_POST['id'] ?? '';
        if (!$id) {
            echo json_encode(['ok' => false, 'msg' => 'ID lipsă.']);
            exit;
        }
        deleteItem($id);
        echo json_encode(['ok' => true]);
        break;

    case 'update_song':
        requireLogin();
        $id = $_POST['id'] ?? '';
        if (!$id) {
            echo json_encode(['ok' => false, 'msg' => 'ID lipsă.']);
            exit;
        }
        updateItem($id, $_POST);
        echo json_encode(['ok' => true]);
        break;

    case 'get_songs':
        echo json_encode(['ok' => true, 'items' => getItems()]);
        break;

    case 'contact':
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $msg = trim($_POST['message'] ?? '');
        if (!$name || !$email || !$msg) {
            echo json_encode(['ok' => false, 'msg' => 'Completați toate câmpurile.']);
            exit;
        }
        if (!validateEmail($email)) {
            echo json_encode(['ok' => false, 'msg' => 'Email invalid.']);
            exit;
        }
        saveMessage($name, $email, $msg);
        echo json_encode(['ok' => true]);
        break;

    default:
        echo json_encode(['ok' => false, 'msg' => 'Acțiune necunoscută.']);
}
