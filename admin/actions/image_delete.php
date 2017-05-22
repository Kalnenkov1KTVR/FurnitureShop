<?php

require_once '../../inc/db.php';
$db = new db();

$id = $_POST['image_idDel'];

$sql = "SELECT * FROM `example_images` WHERE `image_id`=$id";

$row = $db->getOne($sql);

$sql = "DELETE FROM `example_images` WHERE `example_images`.`image_id` = $id";

$result = $db->execute($sql);
?>