<?php

require_once '../../inc/db.php';
$db = new db();

$id = $_POST['image_idDel'];

$sql = "SELECT * FROM `example_images` WHERE `image_id`=$id";

$rowItm = $db->getOne($sql);
unlink("../../files/".$rowItm['image_name']);

$sql = "DELETE FROM `example_images` WHERE `example_images`.`image_id` = $id";

$result = $db->execute($sql);
?>