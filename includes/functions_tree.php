<?php

/**
* Распечатка массива
**/
function print_arr($array){
	echo "<pre>" . print_r($array, true) . "</pre>";
}

/**
* Получение массива категорий
**/
function get_cat(){
	global $db;
	$query = "SELECT * FROM categories WHERE status = 1 AND parent != 0 ORDER BY weight ASC";
	$res = mysqli_query($db, $query);

	$arr_cat = array();
	while($row = mysqli_fetch_assoc($res)){
		$arr_cat[$row['id']] = $row;
	}
	return $arr_cat;
}

/**
* Построение дерева
**/
function map_tree($dataset) {
	$tree = array();

	foreach ($dataset as $id=>&$node) {    
		if (!$node['parent']){
			$tree[$id] = &$node;
		}else{ 
            $dataset[$node['parent']]['childs'][$id] = &$node;
		}
	}

	return $tree;
}

/**
* Дерево в строку HTML
**/
function categories_to_string($data){
	$string = "";
	foreach($data as $item){
		$string .= categories_to_template($item);
	}
	return $string;
}

/**
* Шаблон вывода категорий
**/
function categories_to_template($category){
	ob_start();
	include 'category_template.php';
	return ob_get_clean();
}

/**
* Хлебные крошки
**/
function breadcrumbs($array, $id){
	if(!$id) return false;

	$count = count($array);
	$breadcrumbs_array = array();
	for($i = 0; $i < $count; $i++){
		if($array[$id]){
			$breadcrumbs_array[$array[$id]['id']] = $array[$id]['name'];
			$id = $array[$id]['parent'];
		}else break;
	}
	return array_reverse($breadcrumbs_array, true);
}

/**
* Получение ID дочерних категорий
**/
function cats_id($array, $id){
	if(!$id) return false;

	foreach($array as $item){
		if($item['parent'] == $id){
			$data .= $item['id'] . ",";
			$data .= cats_id($array, $item['id']);
		}
	}
	return $data;
}

/**
* Получение блюд
**/
// function get_products($ids, $start_pos, $perpage){
// 	global $db;
// 	if($ids){
// 		$query = "SELECT * FROM elements WHERE status = 1 AND Parent IN($ids) ORDER BY Name LIMIT $start_pos, $perpage";
// 	}else{
// 		$query = "SELECT * FROM elements WHERE status = 1 ORDER BY Name LIMIT $start_pos, $perpage";
// 	}
// 	$result = mysqli_query($db, $query);
// 	$products = array();
// 	while($row = mysqli_fetch_assoc($result)){
// 		$products[] = $row;
// 	}
// 	return $products;
// }

/**
* Получение блюд
**/
function get_products($ids, $start_pos, $perpage){
	global $db;
	if($ids){
		$query = "SELECT e.id AS id, e.genName0419 AS dishname, e.genLongComment0419 AS comment, e.Parent AS parent, e.price AS price, e.LargeImagePath AS image, e.status AS status, e.weight AS weight, e.property AS property, c.name AS categname 
		FROM elements e 
		inner join categories c on e.Parent = c.id 
		WHERE e.status = 1 AND e.Parent IN($ids) ORDER BY e.weight ASC LIMIT $start_pos, $perpage";
	}else{
		$query = "SELECT e.id AS id, e.genName0419 AS dishname, e.genLongComment0419 AS comment, e.Parent AS parent, e.price AS price, e.LargeImagePath AS image, e.status AS status, e.weight AS weight, e.property AS property, c.name AS categname 
		FROM elements e 
		inner join categories c on e.Parent = c.id 
		WHERE e.status = 1 ORDER BY e.weight ASC LIMIT $start_pos, $perpage";
	}
	$result = mysqli_query($db, $query);
	$products = array();
	while($row = mysqli_fetch_assoc($result)){
		$products[] = $row;
	}
	return $products;
}


/**
* Получение отдельного блюда
**/
function get_one_product($product_id){
	global $db;
	$query = "SELECT * FROM elements WHERE status = 1 AND id = $product_id";
	$res = mysqli_query($db, $query);
	return mysqli_fetch_assoc($res);
}

/**
* Кол-во блюд
**/
function count_goods($ids){
	global $db;
	if( !$ids ){
		$query = "SELECT COUNT(*) FROM elements WHERE status = 1";
	}else{
		$query = "SELECT COUNT(*) FROM elements WHERE status = 1 AND Parent IN($ids)";
	}
	$res = mysqli_query($db, $query);
	$count_goods = mysqli_fetch_row($res);
	return $count_goods[0];
}

/**
* Постраничная навигация
**/
function pagination($page, $count_pages){
	// << < 3 4 5 6 7 > >>
	// $back - ссылка НАЗАД
	// $forward - ссылка ВПЕРЕД
	// $startpage - ссылка В НАЧАЛО
	// $endpage - ссылка В КОНЕЦ
	// $page2left - вторая страница слева
	// $page1left - первая страница слева
	// $page2right - вторая страница справа
	// $page1right - первая страница справа

	$uri = "?";
	// если есть параметры в запросе
	if( $_SERVER['QUERY_STRING'] ){
		foreach ($_GET as $key => $value) {
			if( $key != 'page' ) $uri .= "{$key}=$value&amp;";
		}
	}

	if( $page > 1 ){
		$back = "<a class='nav-link' href='{$uri}page=" .($page-1). "'>&lt;</a>";
	}
	if( $page < $count_pages ){
		$forward = "<a class='nav-link' href='{$uri}page=" .($page+1). "'>&gt;</a>";
	}
	if( $page > 3 ){
		$startpage = "<a class='nav-link' href='{$uri}page=1'>&laquo;</a>";
	}
	if( $page < ($count_pages - 2) ){
		$endpage = "<a class='nav-link' href='{$uri}page={$count_pages}'>&raquo;</a>";
	}
	if( $page - 2 > 0 ){
		$page2left = "<a class='nav-link' href='{$uri}page=" .($page-2). "'>" .($page-2). "</a>";
	}
	if( $page - 1 > 0 ){
		$page1left = "<a class='nav-link' href='{$uri}page=" .($page-1). "'>" .($page-1). "</a>";
	}
	if( $page + 1 <= $count_pages ){
		$page1right = "<a class='nav-link' href='{$uri}page=" .($page+1). "'>" .($page+1). "</a>";
	}
	if( $page + 2 <= $count_pages ){
		$page2right = "<a class='nav-link' href='{$uri}page=" .($page+2). "'>" .($page+2). "</a>";
	}

	return $startpage.$back.$page2left.$page1left.'<a class="nav-active">'.$page.'</a>'.$page1right.$page2right.$forward.$endpage;
}