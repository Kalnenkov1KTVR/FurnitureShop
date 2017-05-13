<h1>продукция</h1>
<p>картинки (по категориям)</p>

<?php
$sql = "SELECT * FROM `items` ORDER BY `items`.`item_name` ASC";
$rows = $db->getAll($sql);

foreach ($rows as $row) {

    $sqlG = 'SELECT * FROM `example_images` WHERE `item_id` = ' . $row['item_id'];
    $rowsG = $db->getAll($sqlG);
    $memberG = count($rowsG);
    if ($memberG > 0) {
        echo '<h3>' . $row['item_name'] . '</h3>';

        echo '<div class="row features_list1">';
        $pic = 0;
        foreach ($rowsG as $image) {
            $pic++;
            echo '<div class="col-md-4 feature">';
            echo '<div class="fancyDemo">';
            echo '<a rel="group" title="" href="files/' . $image['image_name'] . '">'
            . '<img src="files/' . $image['image_name'] . '" alt=""class="img-responsive" style="height:150px;"/>'
            . '</a>';

            echo '</div>';
            echo '</div>';
            if ($pic == 4) {
                $pic = 0;
                echo '</div>';
                echo '<div class="row features_list1">';
            }
        }
        echo '</div>';
    }
}
?>


