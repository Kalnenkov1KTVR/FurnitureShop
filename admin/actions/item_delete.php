<?php

require_once '../../inc/db.php';
$db = new db();

$id = $_POST['item_idDel'];

$sql = "SELECT * FROM `items` WHERE `item_id`=$id";

$row = $db->getOne($sql);

$sql = "DELETE FROM `items` WHERE `items`.`item_id` = $id";

$result = $db->execute($sql);
?>