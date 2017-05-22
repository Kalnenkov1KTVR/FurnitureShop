<?php
session_start();
if (isset($_SESSION["rank"]) && ($_SESSION["rank"]) == "admin") {
    require_once '../../inc/db.php';
    $db = new db();
    $sql = "SELECT * FROM `categories` ORDER BY `categories`.`category_name` ASC";
    $rows = $db->getAll($sql);
    $text = "";
    foreach ($rows as $row) {
        $text .= '<h3>' . $row['category_name'] . '</h3>';

        $sqlItem = "SELECT * FROM `items` WHERE `category_id` = " . $row['category_id'] . " ORDER BY `items`.`item_name` ASC";
        $rowsItem = $db->getAll($sqlItem);
        foreach ($rowsItem as $rowItem) {
            $text .= '<h4>' . $rowItem['item_name'] . '</h4>';

            $sqlPic = "SELECT * FROM `example_images` WHERE `item_id` = " . $rowItem['item_id'] . " ORDER BY `example_images`.`image_name` ASC";
            $rowsPics = $db->getAll($sqlPic);

            $text .= '<table class="table">'
                    . '<tr><td><a href="#myModal" role="button" class="btn btn-primary btn-sm" data-toggle="modal" data-keyboard="false" '
                    . 'data-backdrop="static" data-remote="actions/image_add_window.php" title="Add">Add</a>'
                    . '<td></tr></table><table class="table table-striped">';

            foreach ($rowsPics as $rowPic) {
                $text .= '<tr>';
                $text .= '<td colspan=2><img>' . $rowPic['image_name'] . '</img></td>';
                $text .= '<td><img src="../files/' . $rowPic['image_name'] . '" alt=""class="img-responsive" style="width: 51px;"/></td>';
                $text .= '<td><a href="#" role="button" data-keyboard="false" class="btn btn-primary btn-sm" data-backdrop="static" data-toggle="modal" '
                        . 'data-target="#myModal" data-remote="actions/image_delete_window.php?id=' . $rowPic['image_id'] . '">
                    <span class="glyphicon glyphicon-remove" title="Delete" ></span></a></td>';
                $text .= '</tr>';
            }
            $text .= '</table>';
        }
    }
    $text .= '</tr>';
    echo '<div class="col-md-9"><ul>' . $text . '</ul></div>';
    ?>    

    <!-- модальное окно -->
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

            </div>
        </div>
    </div>      

    <?php
}
?>


