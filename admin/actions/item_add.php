<?php

require_once '../../inc/db.php';
$db = new db();


$item_name = $_POST['item_name'];
$item_descr = $_POST['item_descr'];
$category_id = $_POST['category_id'];

if ($item_name != "" && $category_id != "" && $item_descr != "") {
    $sql = "INSERT INTO `items` (`item_id`, `item_name`, `category_id`, `item_descr`) VALUES (NULL, '$item_name', '$category_id', '$item_descr')";
    $result = $db->execute($sql);
}
?>