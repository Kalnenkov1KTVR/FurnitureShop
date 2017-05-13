
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
        $sqlImg = 'SELECT `image_name` FROM `example_images` WHERE `item_id` = ' . $rowItem['item_id'] . ' ORDER BY `item_id` ASC LIMIT 1';
        $img = $db->getOne($sqlImg);
        foreach ($img as $pic) {
            echo '<img src="files/' . $pic . '" width=20%>';
        }
        echo '<br>';
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
    $sqlImg = 'SELECT * FROM `example_images` WHERE `item_id` = ' . $idItem . ' ORDER BY `example_images`.`item_id`';
    $img = $db->getAll($sqlImg);
    foreach ($img as $pic) {
        echo '<div class="feature fancyDemo">';
        echo '<a rel="group" title="" href="files/' . $pic['image_name'] . '"><img src="files/' . $pic['image_name'] . '" width=50% ></a>';
        echo '</div>';
    }


    // ----- читать комменты ----- 

    $sqlComment = "SELECT COUNT(*) as count FROM `comments` WHERE `item_id` =" . $idItem;
    $memberComment = $db->getOne($sqlComment);
    if ($memberComment['count'] > 0) {
        echo '<hr><button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo2">Комментарии (' . $memberComment['count'] . ')</button>';
        echo '<div id="demo2" class="collapse">';
        include('views/comment_read.php');
        echo '</div>';
    }

    // ----- добавить коммент -----
    echo '<br><br><button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo1">Добавить комментарий</button>';
    echo '<div id="demo1" class="collapse">';

    include_once 'views/add_comment_form.php';

    echo '</div>';

    // ------ ------ ------ ------   

    echo '<hr><a href="' . INDEX . '?page=' . $page . '&idCat=' . $_GET['idCat'] . '">Назад (эта категория)</a>';
}
?>

