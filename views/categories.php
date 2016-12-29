
<?php

$sqlCat = 'SELECT * FROM `categories` ORDER BY `categories`.`category_name`';
$rows = $db->getAll($sqlCat);



if (!isset($_GET['idCat'])) {
    echo '<h1>' . $row['menu_name'] . '</h1>';
    echo '<ul>';
    foreach ($rows as $row) {
        echo '<li><a href="' . INDEX . '?page=' . $page . '&idCat=' . $row['category_id'] . '">' . $row['category_name'] . '</a></li>';
    }
    echo '</ul>';
}

if (isset($_GET['idCat']) & !isset($_GET['idItem'])) {
    $idCat = $_GET['idCat'];
    $sqlCatDescr = "SELECT * FROM `categories` WHERE `category_id` = " . $idCat;
    $rowC = $db->getOne($sqlCatDescr);
    echo '<h3>' . $rowC['category_name'] . '</h3>';
    echo '<p>' . $rowC['category_description'] . '</p>';

    $sqlItem = 'SELECT * FROM `items` WHERE `category_id` = ' . $idCat . ' ORDER BY `items`.`item_name`';
    $rowsItem = $db->getAll($sqlItem);
    foreach ($rowsItem as $rowItem) {
        echo '<a href="' . INDEX . '?page=' . $page . '&idCat=' . $rowC['category_id'] . '&idItem=' . $rowItem['item_id'] . '">' . $rowItem['item_name'] . '</a>';
        echo '<br>';
    }
    echo '<hr><a href="' . INDEX . '?page=' . $page . '">Назад (все категории)</a>';
}

if (isset($_GET['idItem'])) {
    $idItem = $_GET['idItem'];
    $sqlItem = "SELECT * FROM `items` WHERE `item_id` = " . $idItem;
    $rowI = $db->getOne($sqlItem);
    echo '<h3>' . $rowI['item_name'] . '</h3>';
    echo '<p>' . $rowI['item_descr'] . '</p>';

    echo '<hr><a href="' . INDEX . '?page=' . $page . '&idCat=' . $_GET['idCat'] . '">Назад (эта категория)</a>';
}
?>

