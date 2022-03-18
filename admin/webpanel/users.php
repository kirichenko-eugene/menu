<?php
    require_once "../../includes/session_init.php";
    require "../auth.php";
    include "../../includes/config.php";
    include "../../includes/functions.php";
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Пользователи</title>
    <meta name="viewport" content="initial-scale=1, width=device-width" />
    <link rel="stylesheet" href="<?=SITE?>css/bootstrap.css">
    <link rel="stylesheet" href="<?=SITE?>css/style_admin.css">
    <link rel="stylesheet" href="<?=SITE?>css/style_table.css">
    <link rel="stylesheet" href="<?=SITE?>css/style_block.css">
</head>
<body>
    <nav>
        <ul class="topmenu">
            <li><a href="<?=PATH?>admin.php">Главная</a></li>
            <li><a href="<?=PATH?>webpanel/users.php">Пользователи</a></li>
            <li><a href="<?=PATH?>webpanel/alldishes.php">Блюда</a></li>
            <li><a href="<?=PATH?>webpanel/categories.php">Категории</a></li>
            <li><a href="<?=PATH?>admin.php?do=logout">Выход</a></li>
        </ul>
    </nav>
    <main>
        <h2 class='section__name'>Список пользователей</h2>
        <?php
            // Подготовка к постраничному выводу
            $perpage = 10; // Количество отображаемых данных из БД
            if (empty($_GET['page']) || ($_GET['page'] <= 0)) {
            $page = 1;
            } else {
            $page = (int) $_GET['page']; // Считывание текущей страницы
            }
            // Общее количество информации
            include "users_list.php";
        ?>

        <h2 class="section__name">Добавить пользователя</h2>
        <form action="<?=PATH?>post_modules/register_user.php" method="POST">
            <div class="input_place"><input name="login" type="text" required placeholder="Логин"></div>
            <div class="input_place"><input name="password" type="password" required placeholder="Пароль"></div>
            <div class="submit_buttons">
                <div class="submit_buttons"><button class="btn btn-success" name="adduser" type="submit">Зарегистрировать</button>
            </div>
        </form>
    </main>
</body>
</html>