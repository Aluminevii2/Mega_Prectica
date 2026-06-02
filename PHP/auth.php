<?php
// php/auth.php — Authentication helpers

function getDataPath($file) {
    return __DIR__ . '/../data/' . $file;
}

function getUsers() {
    $path = getDataPath('users.json');
    if (!file_exists($path)) return [];
    return json_decode(file_get_contents($path), true) ?? [];
}

function saveUsers($users) {
    file_put_contents(getDataPath('users.json'), json_encode($users, JSON_PRETTY_PRINT));
}

function findUserByEmail($email) {
    foreach (getUsers() as $u) {
        if ($u['email'] === $email) return $u;
    }
    return null;
}

function registerUser($name, $email, $password) {
    if (findUserByEmail($email)) return ['ok' => false, 'msg' => 'Email deja înregistrat.'];
    $users = getUsers();
    $users[] = [
        'id'       => uniqid(),
        'name'     => $name,
        'email'    => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'joined'   => date('Y-m-d H:i:s'),
        'avatar'   => '',
    ];
    saveUsers($users);
    return ['ok' => true];
}

function loginUser($email, $password) {
    $user = findUserByEmail($email);
    if (!$user) return ['ok' => false, 'msg' => 'Email sau parolă incorectă.'];
    if (!password_verify($password, $user['password'])) return ['ok' => false, 'msg' => 'Email sau parolă incorectă.'];
    session_start();
    $_SESSION['user'] = ['id' => $user['id'], 'name' => $user['name'], 'email' => $user['email']];
    return ['ok' => true];
}

function isLoggedIn() {
    if (session_status() === PHP_SESSION_NONE) session_start();
    return isset($_SESSION['user']);
}

function currentUser() {
    if (!isLoggedIn()) return null;
    return $_SESSION['user'];
}

function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit;
    }
}

function logoutUser() {
    session_start();
    session_destroy();
    header('Location: index.php');
    exit;
}
