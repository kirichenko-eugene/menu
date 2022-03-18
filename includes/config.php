<?php

define("SITE", "https://mail.goodcity.com.ru/WebMenu/");
define("PATH", "https://mail.goodcity.com.ru/WebMenu/admin/");
define("DBHOST", "localhost");
define("DBUSER", "WebOrders");
define("DBPASS", "");
define("DBNAME", "WebOrders");
$db = @mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME) or die("Нет подключения к БД");
mysqli_set_charset($db, "utf8") or die("Не установлена кодировка соединения");

$dir = 'img/small/';
$bdir = 'img/big/';

//настройка для запросов
	$lic = $_SESSION['lic'];
	$table = $_SESSION['table'];

	if (isset($_GET['smoke'])) {
		$smoke= $_GET['smoke']; 
	} else {
		$smoke= $_SESSION['smoke'];
	}

	$cardcrm= $_SESSION['cardcrm'];
	$lictab = $_SESSION['lictab'];

if (isset($_GET['table'])) {
	$_SESSION['table'] = $_GET['table'];
} else {
	$_SESSION['table'] = $table;
}

if (isset($_GET['lictab'])) {
	$_SESSION['lictab'] = $_GET['lictab'];
} else {
	$_SESSION['lictab'] = $lictab;
}

if (isset($_GET['lic'])) {
	$_SESSION['lic'] = $_GET['lic'];
} else {
	$_SESSION['lic'] = $lic;
}

if (isset($_GET['cardcrm'])) {
	$_SESSION['cardcrm'] = $_GET['cardcrm'];
} else {
	$_SESSION['cardcrm'] = $cardcrm;
}

if (isset($_GET['smoke'])) {
	$_SESSION['smoke'] = $_GET['smoke'];
} else {
	$_SESSION['smoke'] = $smoke;
}

if (isset($_GET['id'])) {
	$id = $_GET['id'];
} 

if (isset($_GET['msg'])) {
	$msg = $_GET['msg'];
} 

	//настройка для POST запроса формы
	$name=0;
	$phone=0;
	
	$mark=0;
if (isset($_POST['feedback'])) {
	$name=$_POST['name'];
	$phone=$_POST['phone'];
	$msg=$_POST['msg'];
	$mark=$_POST['mark'];
}
//******************************************************
	//настройка соответствия url и лицензий

	switch ($lic) {
		//SC Artema
		case '04': 
			$url = "http://109.254.37.112:8085";
			break;	

		//SC Boul
		case '05': 
			$url = "http://109.254.91.92:8085";
			break;	
		
		//Beerstown
		case '06': 
			$url = "http://178.158.165.27:8085";
			break;	

		//RC B
		case '09': 
			$url = "http://109.254.91.42:8085";
			break;				

		//FreshCity
		case '11': 
			$url = "http://109.254.10.102:8085";
			break;	

		//adachi
		case '12': 
			$url = "http://109.254.64.23:8085";
			break;	

		//office
		case '16': 
			//$url = "http://178.209.88.175:8085";
			$url = "http://mail.goodcity.com.ru:8085";
			break;	
	}
?>