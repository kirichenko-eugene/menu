<?php
if(isset($_GET['category']) ){
	$root = (int)$_GET['category']; 
} else {
	$root = first_category();
}


$all_categories = all_categories();
if(isset($_GET['category'])){
	$breadcrumbs_array = breadcrumbs_menu($all_categories, $root);
	if($breadcrumbs_array){
		$breadcrumbs = "<a href='https://mail.goodcity.com.ru/WebMenu/'>Меню RedCup</a> / ";
		foreach($breadcrumbs_array as $id => $name){
			$breadcrumbs .= "<a href='https://mail.goodcity.com.ru/WebMenu?category={$id}'>{$name}</a> / ";
				// $breadcrumbs .= "{$name} / "; Тогда кликабельной будет только главная страница
		}
		$breadcrumbs = rtrim($breadcrumbs, " / ");
		$breadcrumbs = preg_replace("#(.+)?<a.+>(.+)</a>$#", "$1$2", $breadcrumbs);
	}else{
		$breadcrumbs = "<a href='https://mail.goodcity.com.ru/WebMenu/'>Меню RedCup</a> / Каталог";
	}
} ?>