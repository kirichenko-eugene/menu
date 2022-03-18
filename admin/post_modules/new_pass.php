<?php
    require_once '../../includes/session_init.php';
    require "../auth.php";
    include "../../includes/config.php";
    include "../../includes/functions.php";
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Новый пароль</title>
    <link rel="stylesheet" href="<?=SITE?>css/bootstrap.css">
    <link rel="stylesheet" href="<?=SITE?>css/style_block.css">
</head>
<body>
<?php

if(isset($_POST['changepass']))
{
        $id = $_POST['user'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        mysqli_query($db,"UPDATE users SET password='".$password."' WHERE id=".$id);
        ?>
        <div class="button_block">
            <div class="exit"><a href="<?=PATH?>webpanel/users.php">Назад</a></div>
            <p>Пароль успешно обновлен</p>
        </div>
<?php
} 
?>
</body>
</html>