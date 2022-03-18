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

		     	$name = $_POST['name_'.$updateid];
		     	$weight = $_POST['weight_'.$updateid];
		     	$picture = basename($_FILES['newpicture_'.$updateid]['name']);
		     	$oldpicture = $_POST['oldpicture_'.$updateid];
		     	$category = $_POST['category_'.$updateid];
		     	$oldcategory = $_POST['oldcategory_'.$updateid];

		     	if($category =="no_category") {
		     		$category = $oldcategory;
		     	}

		     	if($picture != '') {
		     		$image = $picture;
		     		resizeImage($_FILES['newpicture_'.$updateid], 700, 150, '/var/www/WebMenu/img/categories/'); 
		     	} else {
		     		$image = $oldpicture;
		     	}
		     	
		      	if($name !=''){
		         	$query_insert = "UPDATE categories SET 
		                      name='".$name."', 
		                      weight='".$weight."', 
		                      img='".$image."', 
		                      parent='".$category."' 
		                      WHERE id=".$updateid;	          
					$result_insert = mysqli_query($db, $query_insert) or die("Ошибка " . mysqli_error($db)); 
				} 
				}  
   		}
   		// закрываем подключение
	    mysqli_close($db);
	   ?>
	    <div class="button_block">
            <div class="exit"><a href="<?=PATH?>webpanel/categories.php">Назад</a></div>
            <p>Выбранные данные успешно обновлены</p>
        </div>
	   <?php
	    }

	    elseif (isset($_POST['delsubmit'])) {
	    	    	if(isset($_POST['update'])) { 

					foreach($_POST['update'] as $updateid){

				    $query_del = "UPDATE categories SET 
		                      status='0'  
		                      WHERE id=".$updateid;	

					$result_del = mysqli_query($db, $query_del) or die("Ошибка " . mysqli_error($db));  							
						
						}  
	    	    	}
	    	    	    
	    // закрываем подключение
	    mysqli_close($db);
	    ?>
	  	<div class="button_block">
            <div class="exit"><a href="<?=PATH?>webpanel/categories.php">Назад</a></div>
            <p>Выбранные данные успешно удалены</p>
        </div>
	  	<?php
		}?>
</body>
</html>