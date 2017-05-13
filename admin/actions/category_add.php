<?php

// запрос на добавление в БД
$category_name = $_POST['category_name'];
$description = $_POST['description'];
if ($category_name != "") {
    require_once '../../inc/db.php';
    $db = new db();
    $sql = "INSERT INTO `categories` (`category_id`, `category_name`, `category_description`) VALUES (NULL, '$category_name', '$description');";
    $result = $db->execute($sql); // выполнить действие INSERT
}
?>