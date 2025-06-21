<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once 'link.php' ?>
    <link rel="stylesheet" href="user.css">
    <title>Zakaz</title>
</head>
<body>
    <?php include_once 'header.php' ?>

    <?php

    if(isset($_POST["fName"]) && isset($_POST["lName"]) && isset($_POST["Email"]) &&
    isset($_POST["Comment"]) && isset($_POST["format"])) 
    {
        $nname = ($_POST["fName"]);
        $surname = ($_POST["lName"]);
        $email = ($_POST["Email"]);
        $format = ($_POST["format"]);
        $comment = $_POST["Comment"];
        
    } else {
        echo "Произошла ошибка ";
    }
    
    $name = '';
    if ( isset($_FILES["picture"]) && $_FILES["picture"]['error'] == 0)
    {
        $name = "upload/" . $_FILES["picture"]["name"];
        move_uploaded_file($_FILES["picture"]["tmp_name"], $name);
    } 
    
    setcookie('fName', $nname, time()+3600);
    setcookie('lName', $surname, time()+3600);
    setcookie('Email', $email, time()+3600);

    ?>

<main class="main">
        <div class="main-container">
            <h2 class="login">Ваш заказ</h2><br>
            <p>Имя: <?php echo $nname; ?></p>
            <p>Фамилия: <?php echo $surname; ?></p>
            <p>Почта: <?php echo $email; ?></p>
            <p>Указанный формат переплета: <?php echo $format; ?></p>
            <p>Комментарий к заказу: <?php echo !empty($comment) ? htmlspecialchars($comment) : 'Отсутсвует'; ?></p>
            <p>Изображение:</p> 
            <?php if (!empty($name)): ?>
                <img src="<?php echo htmlspecialchars($name); ?>" alt="Загруженное изображение" style="max-width: 300px; display: block; margin-top: 10px;">
            <?php else: ?>
                <p>Файл не загружен</p>
            <?php endif; ?>
        </div>
    </main>
    <?php include_once 'footer.php' ?>
</body>
</html>


