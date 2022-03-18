<?php
require_once "../includes/session_init.php";
include "../includes/config.php"; 
?>
<!DOCTYPE html>
<html lang="ru">
<meta charset="UTF-8">
<meta name="viewport" content="initial-scale=1, width=device-width" />
<link rel="stylesheet" href="<?=SITE?>css/bootstrap.css">
<link rel="stylesheet" href="<?=SITE?>css/style.css"/>
<title>Оставить отзыв</title>
</head>
<body>

	<!-- На главную **************** -->
	<div class="d-flex flex-column justify-content-center">
		<h4 class="text-center">Оставьте свой отзыв или вернитесь на главную</h4>
		<div class="text-center div-back-btn"><a class="a-button" href="<?=SITE?>index.php">К меню</a></div>
		<!-- Начало работы с формой **************** -->
		<div class="container">
			<div class="row justify-content-center align-items-center">
				<form method="POST" action="feedback.php?id=01" class="form-review">
					<!-- Поле имя **************** -->
					<div class="form-group">      
						<input class="form-control" type="text" name="name" placeholder="Имя" required>
					</div>
					<!-- Поле телефона **************** -->
					<div class="form-group">      
						<input class="form-control" type="tel" name="phone" placeholder="Телефон" required>
					</div>
					<!-- Поле для комментария **************** -->
					<div class="form-group"> 
						<p class="form_text">Добавьте комментарий</p>
						<textarea class="form-control" name="msg" rows="5"></textarea>
					</div>
					<!-- Звезды для оценки **************** -->
					<div class="star-field">
						<div><p class="form_text">Ваша оценка</p></div>
						<div class="stars">
							<span class="starRating">
								<input class="star_input" id="rating5" type="radio" name="mark" value="5" checked>
								<label for="rating5" class="star_label">5</label>

								<input class="star_input" id="rating4" type="radio" name="mark" value="4">
								<label for="rating4" class="star_label">4</label>

								<input class="star_input" id="rating3" type="radio" name="mark" value="3">
								<label for="rating3" class="star_label">3</label>

								<input class="star_input" id="rating2" type="radio" name="mark" value="2">
								<label for="rating2" class="star_label">2</label>

								<input class="star_input" id="rating1" type="radio" name="mark" value="1">
								<label class="star_label" for="rating1">1</label>
							</span>
						</div>
					</div>
					<!-- Отправить форму **************** -->
					<div>      
						<input class="btn btn-danger btn-lg menu-button" type="submit" name="feedback" value="Отправить">
					</div>

				</form>
			</div>
		</div>
	</div>
</body>
</html>