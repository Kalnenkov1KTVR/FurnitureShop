<?php

// меню навигации - файл header.php
$text = "";

foreach ($rowsItm as $rowItm) {
    if ($rowItm['menu_id'] != 2) {   
        if ($rowItm['menu_order'] == "") {
            $text .= '<li><a href = "' . INDEX . '">' . $rowItm['menu_name'] . '</a></li>';
        } // if menu_order
        else {
            $text .= '<li><a href = "' . INDEX . '?page=' . $rowItm['menu_id'] . '">' . $rowItm['menu_name'] . '</a></li>';
        }
    }
}

echo $text;
?>

