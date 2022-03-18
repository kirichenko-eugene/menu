<?php
require_once "../includes/session_init.php";
include "../includes/config.php"; 
include "../includes/functions.php";
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Корзина</title>
    <link rel="stylesheet" href="<?=SITE?>css/bootstrap.css">
    <link rel="stylesheet" href="<?=SITE?>css/style.css"/>
</head>

<body>

<div class="wrapper text-center d-flex justify-content-center flex-column" id="wrapper">
   
    <div class="text-center div-back-btn"><a class="a-button cart-back-btn" href="<?=SITE?>index.php">К меню</a></div>
    <?php
    if (!isset($_SESSION['cart'])):?>
        <h2>Ваша корзина пуста</h2>
    <?php else :?>
    <div class="text-center">
    <table class="table table-sm table-striped table-center">
        <thead>
            <tr>
                <th scope="col">Название</th>
                <th scope="col">Цена</th>
                <th scope="col">Количество</th>
                <th scope="col">Удалить</th>
            </tr>
        </thead>
        <?php

        $cart = unserialize($_SESSION['cart']);
        $totalSum = 0;
            foreach($cart as $id => $dish): ?>
                <?php $sum = $dish['value'] * $dish['count']; $totalSum += $sum; ?>
                <tr id="<?=$id?>">
                    <td><?=$dish['name']?></td>
                    <td scope="col" id="<?=$id?>" class="count_price" data-price="<?=$dish['value']?>"><?=$sum?></td>
                    <td>
                        <span class="minus">-</span>
                        <input type="number" class="count-product quantity text-center" data-id="<?=$id?>" value="<?=$dish['count']?>" min="0" step="0" max="0">
                        <span class="plus">+</span>
                    </td>
                    <td><button class="btn btn-light btn-del" id="<?=$id?>">Удалить</button></td>
                </tr>
            <?php endforeach; ?>
    </table>     
    </div>     
    <div class="total_sum text-center text-uppercase border-top border-bottom">Сумма: <span class="total_sum_num font-weight-bold"><?=$totalSum?></span> руб.</div>
    <div class="text-center div-back-btn"><a class="a-button cart-back-btn" href="process_order.php">Заказать</a></div>
    <?php endif; ?>    
        <script src="<?=SITE?>js/jquery.min.js"></script>
        <script src="<?=SITE?>js/cart.js"></script>
</div>
</body>
</html>