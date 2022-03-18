<?php
require_once "../includes/session_init.php";
include "../includes/config.php"; 
include "../includes/functions.php";


$dish_id = $_POST['dish_id'];//получаем id блюда
$dish_name = $_POST['dish_name'];  // получаем имя блюда
$dish_price = $_POST['dish_price'];  // получаем цену блюда

// Получим массив блюд из корзины или пустой массив, если $_SESSION['cart'] не определена
$cart_content = isset($_SESSION['cart']) ? unserialize($_SESSION['cart']) : array();

if(array_key_exists($dish_id, $cart_content)){
    // если в корзине есть уже это блюдо, прибавим ему количество
    $cart_content[$dish_id]['count'] += 1;
} else {
    $cart_content[$dish_id] = array(
        'count' => 1,
        'name' => $dish_name,
        'value' => $dish_price
    );
}

// сохраняем корзину
$_SESSION['cart'] = serialize($cart_content);

// jquery у нас ждет json формат, так подготовим его. Сунем количество в массив:
$response = array('value' => getCartSum());
// и отправим json строку
echo json_encode($response);