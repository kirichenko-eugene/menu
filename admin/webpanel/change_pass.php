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
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Сменить пароль</title>
		<link rel="stylesheet" href="<?=SITE?>css/bootstrap.css">
		<link rel="stylesheet" href="<?=SITE?>css/style_block.css">
		<link rel="stylesheet" href="<?=SITE?>css/style_table.css">
	</head>
	<body>
		<div class="exit"><a href="<?=PATH?>webpanel/users.php">Назад</a></div>
		<h2 class='section__name'>Смена пароля</h2>
		<form action="<?=PATH?>post_modules/new_pass.php" method="POST">
			<div><select class="form_select user_select" name="user">
				<?php $users = all_users(); ?>
		    	<?php if($users): ?>
				<?php foreach($users as $user): ?>
	        		<option value="<?=$user['id']?>"><?=$user['name']?></option>
	        	<?php endforeach; ?>
				<?php endif; ?>
       			</select></div>
        <div class="input_place"><input name="password" type="password" required placeholder="Новый пароль"></div>
        <div class="submit_buttons">
        	<div class="submit_buttons"><button class="btn btn-success" type="submit" name="changepass">Изменить</button></div>
        </div>
		</form>
	</body>
	</html>	