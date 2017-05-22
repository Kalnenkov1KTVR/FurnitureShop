<?php

require_once '../../inc/db.php';
$db = new db();

$item_id = $_POST['item_id'];

$pict = $_POST['img'];


if ($pict != "") {

    $sql = "INSERT INTO `example_images` (`image_id`, `image_name`, `item_id`) VALUES (NULL, '$pict', '$item_id')";
    $result = $db->execute($sql);
}
?>