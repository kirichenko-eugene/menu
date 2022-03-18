<?php
require_once "../includes/session_init.php";
include "../includes/config.php";
include "../includes/functions.php";
?> 
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>WebMenuLogin</title>
	<meta name="viewport" content="initial-scale=1, width=device-width" />
	<link rel="stylesheet" href="<?=SITE?>css/bootstrap.css">
	<link rel="stylesheet" href="<?=SITE?>css/style_admin.css">
</head>
<body>
	<form method="post" class="decor">
		<div class="form-inner">
			<img src="<?=SITE?>img/logo.png" alt="RedCup">
			<h3>Войти в настройки</h3>
			<div><input class="input-text" type="text" name="user" placeholder="Имя пользователя:" /></div>
			<div><input class="input-text" type="password" name="pass" placeholder="Пароль:" /></div>
			<div><input type="submit" name="submit" value="Войти"/></div>
			<?php
			if($_SESSION['admin']){
				header("Location: https://mail.goodcity.com.ru/WebMenu/admin/admin.php");
				exit;
			}

			if(isset($_POST['submit']))	{
				
    // Вытаскиваем из БД запись, у которой логин равняется введенному
				$name = (mysqli_real_escape_string($db,$_POST['user']));
				$user_login = enter_user($name); ?>
				<?php if($user_login): ?>
		        <?php foreach($user_login as $u_login): ?>
		        	<?php
		            $user_id = $u_login['id'];
					$admin = $u_login['name'];
					$pass = $u_login['password']; ?>
		        <?php endforeach; ?>
		        <?php endif; ?>

		        <?php
		       
				if($admin == $_POST['user'] AND $pass == password_verify($_POST['pass'], $pass)){
					$_SESSION['user_id'] = $user_id;
					$_SESSION['admin'] = $admin;
					header("Location: https://mail.goodcity.com.ru/WebMenu/admin/admin.php");
					exit;
				} else { 
					echo '<p>Логин или пароль неверны!</p>'; 
				}
			} ?>
		</div>
	</form>
</body>
</html>
