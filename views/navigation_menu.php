

<?php

// меню навигации - файл header.php
$text = "";

foreach ($rows as $row) {
    if ($row['menu_order'] == "") {
        $text .= '<li><a href = "' . INDEX . '">' . $row['menu_name'] . '</a></li>';
    } // if menyy_order
    else {
        $text .= '<li><a href = "' . INDEX . '?page=' . $row['menu_id'] . '">' . $row['menu_name'] . '</a></li>';
    }
}

echo $text;
?>

