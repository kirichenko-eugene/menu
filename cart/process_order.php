<?php
	require_once "../includes/session_init.php";
	include "../includes/config.php"; 
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1, width=device-width" />
	<title>Заказ</title>
	<link rel="stylesheet" href="<?=SITE?>css/bootstrap.css">
	<link rel="stylesheet" href="<?=SITE?>css/style.css"/>
</head>
<body>
	<?php
	$header_ok = current(get_headers($url,0));
	if ($header_ok === "HTTP/1.0 200 OK") { ?>
		<div class="wrapper d-flex flex-column justify-content-center">
		<div class="text-center div-back-btn"><a class="a-button" href="<?=SITE?>index.php">К меню</a></div>
		<div class="text-center"><h2>Спасибо за ваш заказ!</h2></div>
		</div>		
	<?php
	$post_data = unserialize($_SESSION['cart']);
	$json_data = json_encode($post_data, JSON_UNESCAPED_UNICODE);
	//echo "$json_data";
	$send_data = array('lic' => $lic,'table' => $table, 'id' => '04', 'msg' => $json_data);

	// // отправляем запрос:
	// $ch = curl_init();
	// curl_setopt($ch, CURLOPT_URL, $url);
	// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	// curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	// curl_setopt($ch, CURLOPT_POST, 1);
	// curl_setopt($ch, CURLOPT_POSTFIELDS, $send_data);
	// $output = curl_exec($ch);
	// curl_close($ch);

	// use key 'http' even if you send the request to https://...
	$options = array(
    'http' => array(
        	'header'  => "Content-type: text/xml",
        	'method'  => 'POST',
        	'content' => http_build_query($send_data)
    	)
	);

	$context  = stream_context_create($options);
	$result = file_get_contents($url, false, $context);
	
	
	if ($result === FALSE) { /* Handle error */ }

		// очищаем сессию.
	$_SESSION['cart'] = null;
	} else { ?>
		<div class="wrapper d-flex flex-column justify-content-center">
			<div class="text-center div-back-btn"><a class="a-button" href="<?=SITE?>index.php">К меню</a></div>
			<div class="text-center"><h2>Возникла ошибка!</h2></div>
		</div>		
	<?php 
		}
	?>
</body>
</html>
