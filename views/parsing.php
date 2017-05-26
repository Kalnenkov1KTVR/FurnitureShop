<?php

// связать пункты меню и файлы загрузки
// если установлена передача переменной page в адресной строке
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    $sql = "SELECT * FROM `menu` WHERE `menu_id` = $page";
} else {
    $sql = "SELECT * FROM `menu` WHERE `menu_order` IS NULL";
}

$db = new db();
$rowItm = $db->getOne($sql);
$file_page = $rowItm['file_name']; // имя файла страницы из БД

if (file_exists('views/' . $file_page) && $rowItm['file_name'] != "") {
    include ('views/' . $file_page);
} else {
    echo '<h3 style="margin-left:20px">File ' . $file_page . ' doesn\'t exist.</h3>';
}
?>

