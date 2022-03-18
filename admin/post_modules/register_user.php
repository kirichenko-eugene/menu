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
    <title>Регистрация пользователя</title>
    <link rel="stylesheet" href="<?=SITE?>css/bootstrap.css">
    <link rel="stylesheet" href="<?=SITE?>css/style_block.css">
</head>
<body>
<?php

if(isset($_POST['adduser']))
{
    $login = $_POST['login'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $err = array();

    // проверям логин
    if(!preg_match("/^[a-zA-Z0-9\s]+$/",$login))
    {
        $err[] = "Логин может состоять только из букв английского алфавита и цифр";
    }
    
    if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30)
    {
        $err[] = "Логин должен быть не меньше 3-х символов и не больше 30";
    }

    // проверяем, не сущестует ли пользователя с таким именем
    $query = mysqli_query($db, "SELECT id FROM users WHERE name='".mysqli_real_escape_string($db, $_POST['login'])."'");
    if(mysqli_num_rows($query) > 0)
    {
        $err[] = "Пользователь с таким логином уже существует в базе данных";
    }

    // Если нет ошибок, то добавляем в БД нового пользователя
    if(count($err) == 0)
    {

        
        mysqli_query($db,"INSERT INTO users SET name='".$login."', password='".$password."', status = 1");
        ?>
         <div class="button_block">
            <div class="exit"><a href="<?=PATH?>webpanel/users.php">Назад</a></div>
            <p>Пользователь успешно добавлен</p>
        </div>
    <?php
    }
    else
    { ?>
        <div class="button_block">
            <div class="exit"><a href="<?=PATH?>webpanel/users.php">Назад</a></div>
        
       <p>При регистации произошли следующие ошибки:</p><br>
        <?php
        foreach($err AS $error)
        {
            print $error."<br>";
        }
    }
}
?>
</div>
</body>
</html>