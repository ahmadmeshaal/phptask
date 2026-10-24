<?php

session_start();

require_once __DIR__ . '/../classes/Database.php';
require_once __DIR__ . '/../classes/Login.php';
require_once __DIR__ . '/../classes/login-contr.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../public/login.php');
    exit();
}

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

$login = new LoginContr($email, $password);
$user = $login->authenticate();

if ($user === false) {
    header('Location: ../public/login.php?error=invalid');
    exit();
}

session_regenerate_id(true);

$_SESSION['user_id'] = $user['id'];
$_SESSION['name'] = $user['name'];
$_SESSION['role'] = $user['role'];

header('Location: ../public/login.php?login=success');
exit();