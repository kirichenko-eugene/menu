<?php
    require_once "../../includes/session_init.php";
    include "../../includes/config.php";
    include "../../includes/functions.php";
    require "../auth.php";
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Категории</title>
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
        <h2 class='section__name'>Список категорий</h2>
        <?php include "category_list.php"; ?>
            <h2 class="section__name">Добавить категорию</h2>
            <form action="<?=PATH?>post_modules/register_category.php" method="POST" enctype="multipart/form-data">
            <div class="input_place"><input name="name" type="text" required placeholder="Название"></div>
            <div class="input_place"><input name="weight" type="text" required placeholder="Позиция (1-начало)"></div>
            <div class="input_place">
                <input name="image" type="file">
            </div>
            <select class="form_select user_select" name="parent">
                <option value=" ">Выберите категорию</option>
                <?php $total_categories = all_categories(); ?>
                <?php if($total_categories): ?>
                <?php foreach($total_categories as $one_category): ?>
                    <option value="<?=$one_category['id']?>"><?=$one_category['name']?></option>
                <?php endforeach; ?>
                <?php endif; ?>
            </select>
            <div class="submit_buttons"><button class="btn btn-success" name="addcategory" type="submit">Добавить</button></div>
            </form>
        

    </main>    
</body>
</html>