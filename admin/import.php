<?php
include "../includes/config.php"; 
require "../admin/auth.php";
require_once "../includes/session_init.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Import RK</title>
    <link rel="stylesheet" href="<?=SITE?>css/bootstrap.css">
    <link rel="stylesheet" href="<?=SITE?>css/style.css"/>
</head>
<body>
    <div class="wrapper d-flex flex-column justify-content-center">
	<?php
            if (isset($_POST['importmenu'])) {
                $command = escapeshellcmd('python3 /var/www/WebMenu/MenuExport/MenuExport.py');
                $message = shell_exec($command);      
                echo $message;         
                echo '<div class="text-center"><h2>Выполнен импорт блюд из RK</h2></div>';
            }
        ?>
        <div class="text-center div-back-btn"><a class="a-button" href="<?=PATH?>admin.php">Назад</a></div>
    </div>
</body>
</html>