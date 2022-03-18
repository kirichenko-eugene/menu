<?php 
include "../includes/config.php"; 
include "../includes/functions_tree.php";
require "auth.php";
require_once "../includes/session_init.php";
include "catalog.php"; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Каталог</title>
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
		<div class="sidebar">
			<ul class="category">
				<?php echo $categories_menu ?>
			</ul>
		</div>
		<div class="content">
			<p><?=$breadcrumbs;?></p>
			<br>
			<hr>
<?php if($get_one_product): ?>
	<?php print_arr($get_one_product); ?>
<?php else: ?>
	Такого блюда нет
<?php endif; ?>
		</div>
	</div>
</body>
</html>