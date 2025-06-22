<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Knigkindom</title>
    <?php  include_once 'link.php' ?>
    <link rel="stylesheet" href="index.css">
</head>
<body>

<?php
session_start();
include ("header.php");

if (!empty($_SESSION['message'])) {
    echo '<div style="text-align: center; margin: 20px auto;">' . htmlspecialchars($_SESSION['message']) . '</div>';
    unset($_SESSION['message']);
}

if (isset($_GET['page'])) {
    switch ($_GET['page']) {
        case 'main':
            include "main.php";
            break;
        case 'register':
            include "register.php";
            break;
    }
} else {
    include "main.php";
    
}

include_once ("footer.php");
?>

</body>