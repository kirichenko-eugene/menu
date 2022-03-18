<?php
include "../includes/config.php"; 
include "../includes/functions.php";
include "../includes/functions_tree.php";
include "catalog.php";
require "auth.php";
require_once "../includes/session_init.php";

?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Главное меню</title>
    <meta name="viewport" content="initial-scale=1, width=device-width" />
    <link rel="stylesheet" href="<?=SITE?>css/bootstrap.css">
    <link rel="stylesheet" href="<?=SITE?>css/style_admin.css">
    <link rel="stylesheet" href="<?=SITE?>css/style_tree.css">
    
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
    <div class="wrapper">
        <form action="<?=SITE?>MenuExport/import.php" method="POST">
            <button class="btn btn-danger btn-lg" type="submit" name="importmenu">Импорт меню</button>
        </form>
        <div class="sidebar">
            <ul class="category">
                <?php echo $categories_menu; ?>
            </ul>
        </div>
        <div class="content">
            <p><?=$breadcrumbs;?></p>
            <br>
            <hr>
            <?php if($products): ?>
                
                <?php 
                if( $count_pages > 1 ): ?>
                    <div class="pagination"><?=$pagination?></div>
                <?php endif; ?>

               <!--  <?php foreach($products as $product): ?>
                    <a href="https://mail.goodcity.com.ru/WebMenu/admin/product.php?product=<?=$product['id']?>"><?=$product['Name']?></a><br>
                <?php endforeach; ?> -->
                <form action="<?=PATH?>post_modules/edit_dish.php" method="POST" enctype="multipart/form-data">
                <table class="table"><thead class="table_head"><tr><th>&#10004;</th><th>Блюдо</th><th>Описание</th><th>Цена</th><th>Позиция</th><th><?php include "webpanel/about_properties.php"; ?></th><th>Родитель</th><th>Превью</th><th>Изображение</th></tr></thead>

                <?php foreach($products as $product): ?>
                     <tr>
                <td class="table_column checkbox"><input type="checkbox" id="<?=$product['id']?>" name="update[]" value="<?=$product['id']?>"><label for="<?=$product['id']?>"></label></td>

                <td class="table_column"><span><?=$product['dishname']?></span></td>

                <td class="table_column"><span><?=$product['comment']?></span></td>

                <td class="table_column"><span><?=$product['price']/100?> руб.</span></td>

                <td class="table_column"><input type="text" class="w-50" name="weight_<?=$product['id']?>" value="<?=$product['weight']?>"></td>

                <!-- Свойства блюда -->
                <td class="table_column">
                    <input type="hidden" name="oldproperty_<?=$product['id']?>" value="<?=$product['property']?>">
                    <input type="text" name="property_<?=$product['id']?>" value="<?=$product['property']?>">
                </td>

                <!-- Родитель -->
                <td class="table_column">
                                <input type="hidden" name="oldcategory_<?=$product['id']?>" value="<?=$product['parent']?>">
                                <div class="text-danger"><?=$product['categname']?></div>
                                <select class="w-100" name="category_<?=$product['id']?>">
                                    <option value="no_category">Новый</option>
                                    <?php
                                    $total_categories = all_categories(); ?>
                                    <?php if($total_categories): ?>
                                        <?php foreach($total_categories as $one_category): ?>
                                            <option value="<?=$one_category['id']?>"><?=$one_category['name']?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </td>

                <!-- Превью -->
                <td class="table_column">
                    <img src="<?=SITE?>img/small/<?=$product['image']?>" width="120" alt="<?=$product['dishname']?>">
                </td>
                 <!-- Изображение -->
                <td class="table_column">
                    <input type="hidden" name="oldpicture_<?=$product['id']?>" value="<?=$product['image']?>">
                                <div class="red_text"><?=$product['image']?></div>
                    <input name="newpicture_<?=$product['id']?>" type="file">
                </td>
            </tr>
                <?php endforeach; ?>
            </table>
            <div class="submit_buttons">
                <button class="btn btn-danger" type="submit" name="submit">Редактировать</button>
                <button class="btn btn-danger" type="submit" name="delsubmit">Удалить</button>
            </div>
                <?php if( $count_pages > 1 ): ?>
                    <div class="pagination"><?=$pagination?></div>
                <?php endif; ?>
            </form>    
            <?php else: ?>
                <p>Здесь нет блюд!</p>
            <?php endif; ?>
        </div>
    </div>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>