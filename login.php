<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authoriz</title>
    <?php include_once 'link.php' ?>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <?php include_once 'header.php' ?>

    <main class="main">  
        <div class="main-container">
             <?php

                if (!empty($_SESSION['message'])) {
                    $message = $_SESSION['message'];
                    unset($_SESSION['message']);
                    
                    $style = 'text-align: center;';

                    if ($message === 'Неверный логин или пароль.') {
                        $style .= ' color: red;';
                    } 
                    elseif (str_starts_with($message, 'Вы успешно вышли')) {
                        $style .= ' color: green;';
                    }

                    echo '<p style="' . $style . '">' . htmlspecialchars($message) . '</p>';


                }
            ?>
            <h2 class="login">Вход</h2>
            <form action="auth.php?log=1" method="post" class="form">
                <input class="login-input" type="text" name="login" id="login" placeholder="Логин" require>
                <input class="login-input" type="password" name="password" id="password" placeholder="Пароль" require>
                <button class="login-input button">Вход</button>
            </form>
        </div>
    </main>

    <?php include_once 'footer.php' ?>
</body>
</html>