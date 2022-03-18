<?php
require_once "../includes/session_init.php";
$id = $_POST['id_tov'];//получаем id
$col = $_POST['col_tov'];//получаем количество

$cart = unserialize($_SESSION['cart']); // берем корзину

$cart[$id]['count'] = $col;     // устанавливаем новое значение для поля `count`
$_SESSION['cart'] = serialize($cart); // сохраняем корзину
?>