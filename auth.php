<?php
 session_start(["use_strict_mode" => true]);
 require('dbconnect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($login) || empty($password)) {
        $_SESSION['message'] = "Поля логина и пароля обязательны для заполнения.";
        header("Location: login.php");
        exit;
    }

    $stmt = $db->prepare("SELECT * FROM users WHERE name = :name");
    $stmt->execute(['name' => $login]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && md5($password) === $user['password']) {
        $_SESSION['login'] = $user['name'];
        $_SESSION['message'] = "Добро пожаловать, {$user['name']}!";
        header("Location: index.php");
        exit;
    } else {
        $_SESSION['message'] = "Неверный логин или пароль.";
        header("Location: login.php");
        exit;
    }
}

if (isset($_GET['out'])) {
    session_destroy();
    session_start();
    $_SESSION['message'] = "Вы успешно вышли.";
    header("Location: login.php");
    exit;;
}