<?php
require_once "../includes/session_init.php";
$id = $_POST['id_tov'];//получаем id
$cart = unserialize($_SESSION['cart']); // получим массив корзины из $_SESSION['cart']
if (array_key_exists($id, $cart)){
    unset ($cart[$id]);//удаляем запись, если она есть
}

// если в корзине после удаления ничего нет, очистим $_SESSION['cart']
// иначе вместо "Ваша корзина пуста" будет пустая таблица.
if(empty($cart)){
    unset($_SESSION['cart']);
} else {
    $_SESSION['cart'] = serialize($cart); // сохраняем корзину
}
?>