<?php
    require_once "../../includes/session_init.php";
    require "../auth.php";
    include "../../includes/config.php";
    include "../../includes/functions.php";

try{
    
    $search_data = filter_input_array(INPUT_POST);
    if(!$search_data){
        throw new Exception('вызвали скрипт, а данных нет');
    }
    $name = isset($search_data['name']) ? $search_data['name'] : "";
    
    $dishes = getDishesByNameAndFilters($name);
    include 'alldishes_search.php';
    
    
} catch (Exception $ex) {
    // здесь выводим ошибку, если что-то пошло не так
    echo $ex->getMessage();
}