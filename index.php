<?php
require_once "includes/session_init.php";
include "includes/config.php"; 
include "includes/functions.php";
include "breadcrumbs.php";
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Меню</title>
	<link rel="stylesheet" href="<?=SITE?>css/bootstrap.css">
	<link rel="stylesheet" href="<?=SITE?>css/style.css"/>
	<link rel="stylesheet" href="<?=SITE?>css/modal.css"/>
	<link rel="stylesheet" href="<?=SITE?>css/jquery.fancybox.css">
</head>
<body>
	<main class="body-main">
		<!-- Формирование кнопок категорий -->
		<?php include "categories.php"; ?>     	
	</main>

	<footer class="footer fixed-bottom">
		<!-- Футер -->

			<button type="button" class="btn btn-modal-margin btn-danger btn-img-style" onclick="document.location='index.php'">
				<img class="icon-img" src="<?=SITE?>/img/box-arrow-left.svg">
			</button>

			<div class="btn btn-modal-margin btn-danger">
						<a href="cart/cart.php">
							<span class="badge2"><img class="icon-img" src="<?=SITE?>/img/basket3.svg"></span>
							<span class="badge basker_kol"><?php echo getCartSum(); ?></span>	
						</a>
			</div>

			<button id="modalActivate1" type="button" class="btn btn-modal-margin btn-danger btn-img-style" data-toggle="modal" data-target="#exampleModalPreview1">
				<img class="icon-img" src="<?=SITE?>/img/chat-text.svg">
			</button>
			
	</footer>
	<?php include "navigation.php"; ?>
	<?php include "buttons.php"; ?>
	<script src="js/jquery.min.js"></script>
	<script src="js/jquery.fancybox.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/buy-button.js"></script>
	<script type="text/javascript">
		$(function() {
		  // Включаем поповер везде, где есть атрибут data-toggle="popover"
		  $('[data-toggle="popover"]').popover({
		    trigger: 'focus'
		  }); 
		})
	</script>
</body>
</html>