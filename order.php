<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once 'link.php' ?>
    <link rel="stylesheet" href="login.css">
    <title>Zakaz</title>
</head>
<body>
    <?php include_once 'header.php'?>

    <?php
    $namef = array_key_exists("fName", $_COOKIE) ? $_COOKIE['fName'] : "";
    $namel = array_key_exists("lName", $_COOKIE) ? $_COOKIE['lName'] : "";
    $nameE = array_key_exists("Email", $_COOKIE) ? $_COOKIE['Email'] : "";

?>

    <main class="main">
        <div class="main-container">
            <h2 class="login">Оформление заказа</h2><br>
            <form action="user.php" method="POST" enctype="multipart/form-data" >
                <input class="login-input" type="text" name="fName" id="fName" placeholder="Имя" value="<?=$namel?>"><br>
                <input class="login-input" type="text" name="lName" id="lName" placeholder="Фамилия"  value="<?=$namef?>"><br>
                <input class="login-input" type="text" name="Email" id="Email" placeholder="Почта" value="<?=$nameE?>"><br>
                Выберите формат переплета: <br>
                <select class="login-input" name="format" id="format" placeholder="format">
                    <option value="Твердый"></option>
                    <option value="Твердый">Твердый </option>
                    <option value="Мягкий">Мягкий</option>
                    <option value="Подарочный">Подарочный</option>
                    <option value="Как повезет">Как повезет</option>
                </select><br>
                <textarea class="login-input" name="Comment" rows="5" cols="30" placeholder="Комментарий к заказу"></textarea><br>
                <input type="file" name="picture"><br>
                <button class="button login-input">Отправить</button>
            </form>
        </div>
    </main>

    <?php include_once 'footer.php' ?>
</body>
</html>