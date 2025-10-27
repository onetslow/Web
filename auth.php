<?php
session_start(["use_strict_mode" => true]);
require('dbconnect.php');

if (isset($_GET['reg'])) {
    
    $stmt = $db->prepare("SELECT * FROM public.users WHERE login = :login");
    $stmt->execute(['login' => $_POST['login'] ?? '']);
    
    if ($stmt->fetch()) {
        $_SESSION['message'] = 'Такой пользователь уже существует';
        header("Location: register.php");
        exit;
    } else {

        $ava = null;
        if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
            $fp = fopen($_FILES['file']['tmp_name'], 'rb');
            $ava = base64_encode(fread($fp, $_FILES['file']['size']));
            fclose($fp);
        }

        if ($ava) {
            error_log("Avatar prepared, size: " . strlen($ava) . " chars");
        } else {
            error_log("No avatar uploaded");
        }

        $stmt = $db->prepare("
            INSERT INTO public.users 
            (surname, name, email, login, password, ava) 
            VALUES (:surname, :name, :email, :login, :password, :ava)
        ");
        
        $stmt->execute([
            'surname' => $_POST['fName'] ?? '',
            'name' => $_POST['lName'] ?? '',
            'email' => $_POST['mal'] ?? '',
            'login' => $_POST['login'] ?? '',
            'password' => md5($_POST['password'] ?? ''),
            'ava' => $ava
        ]);

        $_SESSION['login'] = $_POST['login'] ?? '';
        $_SESSION['user_name'] = $_POST['lName'] ?? '';
        header("Location: profile.php");
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_GET['reg'])) {
    $login = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($login) || empty($password)) {
        $_SESSION['message'] = "Поля логина и пароля обязательны для заполнения.";
        header("Location: login.php");
        exit;
    }

    $stmt = $db->prepare("SELECT * FROM users WHERE login = :login");
    $stmt->execute(['login' => $login]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && md5($password) === $user['password']) {
        $_SESSION['login'] = $user['login'];
        $_SESSION['user_name'] = $user['name'];
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
    exit;
}