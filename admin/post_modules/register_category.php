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
    <title>Регистрация категории</title>
    <link rel="stylesheet" href="<?=SITE?>css/bootstrap.css">
    <link rel="stylesheet" href="<?=SITE?>css/style_block.css">
</head>
<body>
<?php

if(isset($_POST['addcategory']))
{
    $name = $_POST['name'];
    $weight = $_POST['weight'];
    $image = $_POST['image'];
    $parent = $_POST['parent'];
    if($name !=''){
            if($image != '')  {
                $query = "INSERT categories SET 
                            status = 1, 
                            name='".$name."', 
                            weight='".$weight."', 
                            img='".$image."',                          
                            parent='".$parent."'";           
                $result = mysqli_query($db, $query) or die("Ошибка " . mysqli_error($db)); 
                //сохраняем изображение
                resizeImage($_FILES['image'], 700, 150, '/var/www/WebMenu/img/categories/'); 

            } else {
                $query = "INSERT categories SET 
                            status = 1, 
                            name='".$name."', 
                            weight='".$weight."', 
                            img='".$image."',                          
                            parent='".$parent."'";           
                $result = mysqli_query($db, $query) or die("Ошибка " . mysqli_error($db)); 
            }                 
        ?>

        <div class="button_block">
            <div class="exit"><a href="<?=PATH?>webpanel/categories.php">Назад</a></div>
            <p>Категория успешно создана</p>
        </div>
    <?php } else { ?>
        <div class="button_block">
            <div class="exit"><a href="<?=PATH?>webpanel/categories.php">Назад</a></div>
            <p>При данной операции возникли ошибки</p>
        </div>
    <?php
    }
}
?>
</body>
</html>