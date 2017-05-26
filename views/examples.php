<h1>Продукция</h1>



<?php
$sql = "SELECT * FROM `items` ORDER BY `items`.`item_name` ASC";
$rowsItm = $db->getAll($sql);

foreach ($rowsItm as $rowItm) {

    $sqlG = 'SELECT * FROM `example_images` WHERE `item_id` = ' . $rowItm['item_id'];
    $rowsG = $db->getAll($sqlG);
    $memberG = count($rowsG);
    if ($memberG > 0) {
        echo '<h3>' . $rowItm['item_name'] . '</h3>';

        echo '<div class="row">';
        $pic = 0;
        foreach ($rowsG as $image) {
            $pic++;
            echo '<div style="width: 33.3%; display: inline-block;">';
            echo '<div class="fancyDemo">';
            echo '<a rel="group" title="" href="files/' . $image['image_name'] . '">'
            . '<img src="files/' . $image['image_name'] . '" alt=""class="img-responsive" style="height:145px;"/>'
            . '</a>';

            echo '</div>';
            echo '</div>';
            if ($pic == 3) {
                $pic = 0;
                echo '</div>';
                echo '<div class="row">';
            }
        }
        echo '</div>';
    }
}
?>


