<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php  include_once 'link.php' ?>
</head>
<?php
    session_start();
    
    if (isset($_SESSION['login'])) {
        $text = $_SESSION['login'];
        $link = '#';
        $showLogout = true;
    } else {
        $text = 'Вход';
        $link = 'login.php';
        $showLogout = false;
    }
?>

<header class="header">
    <div class="container">
        <div class="header_inner">
            <div class="header_logo">
                <img src="img/r.png" class="header_img">
            </div>
            <nav class="nav">
                <a class="nav_link" href="index.php?page=main">Главная</a>
                <a class="nav_link" href="index.php?page=register">Регистрация</a>
            </nav>
            <div class="re">
                <a class="nav_link" href="<?php echo $link ?>"><?php echo $text ?></a>
                <?php if ($showLogout): ?>
                    <a href="auth.php?out=1" class="logout-link">Выйти</a>
                <?php endif; ?>  
            </div> 
        </div>
    </div>
</header>

</html>