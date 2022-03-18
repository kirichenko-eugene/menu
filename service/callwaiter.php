<?php
require_once "../includes/session_init.php";
include "../includes/config.php"; 
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1, width=device-width" />
	<link rel="stylesheet" href="<?=SITE?>css/bootstrap.css">
	<link rel="stylesheet" href="<?=SITE?>css/style.css"/>
	<title>Вызов</title>
</head>
<body>
	<!-- Подключить файл с настройками **************** -->
	<?php

	// Массив с GET запросом **************** 
$data = array('lic' => $lic,'table' => $table, 'id' => $id, 'msg' => $msg, 'smoke' => $smoke);

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Content-type: text/xml",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
if ($result === FALSE) { /* Handle error */ }

// Раскомментировать для просмотра дампа
// var_dump($result);
?>
<!-- Надпись внизу и на главную **************** -->
	<div class="wrapper d-flex flex-column justify-content-center">
		
	<div class="text-center div-back-btn"><a class="a-button" href="<?=SITE?>index.php">К меню</a></div>
	<div class="text-center"><h3>Ваш вызов принят, ожидайте</h3></div>
	</div>
</body>
</html>