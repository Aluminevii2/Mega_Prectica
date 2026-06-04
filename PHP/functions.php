<?php
// php/functions.php — General helper functions

require_once __DIR__ . '/auth.php';

function getItems()
{
    $path = getDataPath('items.json');
    if (!file_exists($path))
        return [];
    return json_decode(file_get_contents($path), true) ?? [];
}

function saveItems($items)
{
    file_put_contents(getDataPath('items.json'), json_encode(array_values($items), JSON_PRETTY_PRINT));
}

function addItem($data)
{
    $items = getItems();
    $item = [
        'id' => uniqid(),
        'title' => htmlspecialchars($data['title']),
        'artist' => htmlspecialchars($data['artist']),
        'genre' => htmlspecialchars($data['genre'] ?? ''),
        'emoji' => htmlspecialchars($data['emoji'] ?? '🎵'),
        'duration' => htmlspecialchars($data['duration'] ?? ''),
        'user_id' => currentUser()['id'] ?? '',
        'created' => date('Y-m-d H:i:s'),
    ];
    $items[] = $item;
    saveItems($items);
    return $item;
}

function deleteItem($id)
{
    $items = getItems();
    $items = array_filter($items, fn($i) => $i['id'] !== $id);
    saveItems($items);
}

function updateItem($id, $data)
{
    $items = getItems();
    foreach ($items as &$item) {
        if ($item['id'] === $id) {
            $item['title'] = htmlspecialchars($data['title']);
            $item['artist'] = htmlspecialchars($data['artist']);
            $item['genre'] = htmlspecialchars($data['genre'] ?? $item['genre']);
            break;
        }
    }
    saveItems($items);
}

function getMessages()
{
    $path = getDataPath('messages.json');
    if (!file_exists($path))
        return [];
    return json_decode(file_get_contents($path), true) ?? [];
}

function saveMessage($name, $email, $message)
{
    $msgs = getMessages();
    $msgs[] = [
        'id' => uniqid(),
        'name' => htmlspecialchars($name),
        'email' => htmlspecialchars($email),
        'message' => htmlspecialchars($message),
        'date' => date('Y-m-d H:i:s'),
    ];
    file_put_contents(getDataPath('messages.json'), json_encode($msgs, JSON_PRETTY_PRINT));
}

function validateEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function redirect($url)
{
    header('Location: ' . $url);
    exit;
}

function flash($key, $msg = null)
{
    if (session_status() === PHP_SESSION_NONE)
        session_start();
    if ($msg !== null) {
        $_SESSION['flash'][$key] = $msg;
    } else {
        $val = $_SESSION['flash'][$key] ?? null;
        unset($_SESSION['flash'][$key]);
        return $val;
    }
}
