<?php
session_start();
include "../includes/config.php"; 

if($_GET['do'] == 'logout'){
	unset($_SESSION['admin']);
	session_destroy();
}

if(!$_SESSION['admin']){
	header("Location: https://mail.goodcity.com.ru/WebMenu/admin/enter.php");
	exit;
}
?>