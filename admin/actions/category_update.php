<?php

// запрос на изменение в БД
$category_id = $_POST['category_id'];
$category_name = $_POST['category_name'];
$category_description = $_POST['category_description'];
if ($category_name != "") {
    require_once '../../inc/db.php';
    $db = new db();
    $sql = "UPDATE `categories` SET `category_name` = '$category_name', `category_description` = '$category_description' WHERE `categories`.`category_id` = '$category_id';";
    $result = $db->execute($sql); // выполнить действие UPDATE
}
?>