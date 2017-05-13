<?php

// запрос на удаление из БД
$id = $_POST['category_id'];
require_once '../../inc/db.php';
$db = new db();
$sql = "DELETE FROM `categories` WHERE `category_id` = $id;";
$result = $db->execute($sql); // выполнить действие
?>

