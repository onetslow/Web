<?php
session_start();

$static_login = 'admin';
$static_password = '12345';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($login === $static_login && $password === $static_password) {
        $_SESSION['login'] = $login;
        $_SESSION['message'] = "Добро пожаловать, $login!";
        header("Location: index.php");
    } else {
        unset($_SESSION['login']); 
        $_SESSION['message'] = "Неверный логин или пароль.";
        header("Location: login.php");
    }

    exit;
}

if (isset($_GET['out'])) {
    session_destroy();
    session_start();
    $_SESSION['message'] = "Вы успешно вышли.";
    header("Location: login.php");
    exit;;
}