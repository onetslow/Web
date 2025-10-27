<?php
session_start(["use_strict_mode" => true]);
require('dbconnect.php');

// Проверяем авторизацию
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once 'link.php' ?>
    <link rel="stylesheet" href="profile.css">
    <title>Профиль</title>
</head>
<body>
    <?php include_once 'header.php' ?>

    <?php
    try {
        // ИСПРАВЛЕНО: получаем пользователя по логину из сессии
        $stmt = $db->prepare("SELECT * FROM public.users WHERE login = :login");
        $stmt->execute(['login' => $_SESSION['login']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            die("Пользователь не найден");
        }

        // Получаем данные
        $fname = $user['name'] ?? 'Не указано';       // Имя
        $lname = $user['surname']?? 'Не указано';    // Фамилия
        $mal = $user['email']?? 'Не указано';

        // Обработка аватара
        if (!empty($user['ava'])) {
            $pfp = 'data:image/png;base64,' . $user['ava'];
        } else {
            $pfp = 'ava.png';
        }

    } catch (PDOException $e) {
        die("Ошибка базы данных: " . $e->getMessage());
    }
    ?>

    <main class="main">
        <div class="main-container">
            <div class="profile">
                <div class="profile_img">
                    <img class="pfp" src="<?php echo $pfp; ?>" width="220px" alt="Profile avatar">  
                </div>
                <div class="profile_name">
                    <h2>Имя</h2>
                    <?php echo htmlspecialchars($fname); ?>
                    
                    <h2>Фамилия</h2>
                    <?php echo htmlspecialchars($lname); ?>
                    
                    <h2>Email</h2>
                    <?php echo htmlspecialchars($mal); ?>
                    
                    <h2>Логин</h2>
                    <?php echo htmlspecialchars($_SESSION['login']); ?>
                    
                    <div>
                        <button class="button" onclick="window.location.href='auth.php?out=1'">Выйти</button>
                    </div>
                </div>
            </div>    
        </div>
    </main>

    <?php include_once 'footer.php' ?>
</body>
</html>