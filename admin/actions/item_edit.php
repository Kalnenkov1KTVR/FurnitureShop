<?php

require_once '../../inc/db.php';
$db = new db();

// читаем всё из объектов
$item_id = $_POST['item_id'];
$item_name = $_POST['item_name'];
$description = $_POST['description'];
$category_id = $_POST['category_id'];


if ($item_name != "" && $description != "" && $category_id != "") {
    $sql = "UPDATE `items` SET  
    `item_name` =  '$item_name',
    `item_descr` =  '$description',
    `category_id` =  '$category_id'    
     WHERE  `items`.`item_id` =$item_id";
    $result = $db->execute($sql);
}
?>