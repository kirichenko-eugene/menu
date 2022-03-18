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
	<title>Редактировать пользователя</title>
	<link rel="stylesheet" href="<?=SITE?>css/bootstrap.css">
	<link rel="stylesheet" href="<?=SITE?>css/style_block.css">
</head>
<body>
	<?php

// создание строки запроса для редактирования и удаления пользователей	
	if(isset($_POST['submit'])){
		if(isset($_POST['update'])) { 
			
			foreach($_POST['update'] as $updateid){
				$category = $_POST['category_'.$updateid];
				$weight = $_POST['weight_'.$updateid];
				$oldcategory = $_POST['oldcategory_'.$updateid];
				$property = $_POST['property_'.$updateid];
				$oldproperty = $_POST['oldproperty_'.$updateid];
				$picture = basename($_FILES['newpicture_'.$updateid]['name']);

				if($category =="no_category") {
					$category = $oldcategory;
				}

				if($property === '') {
					$property = $oldproperty;
				}

				if ($picture != '') {
					$query_insert = "UPDATE elements SET 
					Parent='".$category."', 
					weight='".$weight."', 
					property = '".$property."', 
					LargeImagePath='".$picture."'  		                      
					WHERE id=".$updateid;	          
					$result_insert = mysqli_query($db, $query_insert) or die("Ошибка " . mysqli_error($db)); 
					//сохраняем изображения
					resizeImage($_FILES['newpicture_'.$updateid], 600, 400, '/var/www/WebMenu/img/big/');
					resizeImage($_FILES['newpicture_'.$updateid], 144, 96, '/var/www/WebMenu/img/small/'); 

				} else {
					$query_insert = "UPDATE elements SET 
					Parent='".$category."', 
					property = '".$property."', 
					weight='".$weight."'   		                      
					WHERE id=".$updateid;	          
					$result_insert = mysqli_query($db, $query_insert) or die("Ошибка " . mysqli_error($db));   

				}
				
			}  
		}
   		// закрываем подключение
	mysqli_close($db);
	?>
	<div class="button_block">
		<div class="exit"><a href="<?=PATH?>admin.php">Назад</a></div>
		<p>Выбранные данные успешно обновлены</p>
	</div>
	<?php
}

elseif (isset($_POST['delsubmit'])) {
	if(isset($_POST['update'])) { 

		foreach($_POST['update'] as $updateid){

			$query_del = "UPDATE elements SET 
			status='2'  
			WHERE id=".$updateid;	

			$result_del = mysqli_query($db, $query_del) or die("Ошибка " . mysqli_error($db));  							

		}  
	}

	    // закрываем подключение
	mysqli_close($db);
	?>
	<div class="button_block">
		<div class="exit"><a href="<?=PATH?>admin.php">Назад</a></div>
		<p>Выбранные блюда успешно удалены</p>
	</div>
	<?php
}?>
</body>
</html>