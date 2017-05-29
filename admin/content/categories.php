<?php
session_start();
if (isset($_SESSION["rank"]) && ($_SESSION["rank"]) == "admin") {
    require_once '../../inc/db.php';
    $db = new db();
    $sql = "SELECT * FROM `categories` ORDER BY `categories`.`category_name` ASC";
    $rowsComms = $db->getAll($sql);
    $text = "";
    foreach ($rowsComms as $rowItm) {
        $text .= '<p>';
        // delete
        $text .= '<a href="#" role="button" data-keyboard="false" class="btn btn-primary btn-sm" data-backdrop="static" data-toggle="modal" '
                . 'data-target="#myModal" data-remote="actions/category_delete_window.php?id=' . $rowItm['category_id'] . '">
        <span class="glyphicon glyphicon-remove" title="Delete" ></span></a> ';

        // update
        $text .= '<a href="#" role="button" data-keyboard="false" class="btn btn-primary btn-sm" data-backdrop="static" data-toggle="modal" '
                . 'data-target="#myModal" data-remote="actions/category_edit_window.php?id=' . $rowItm['category_id'] . '">
        <span class="glyphicon glyphicon-edit" title="Edit" ></span></a> ';


        // ------
        $text .= $rowItm['category_name'] . '</p>';
    }
    echo '<h3>Categories: </h3>';
    echo '<div class="col-md-9"><ul>' . $text . '</ul></div>';
    ?>    

    <!-- кнопка "Добавить" HTML -->
    <div class="row">
        <div class="container">
            <div class="row">
                <a href="#myModal" role="button" class="btn btn-primary btn-sm" data-toggle="modal" data-keyboard="false" data-backdrop="static" data-remote="actions/category_add_window.php" title="Add">Add</a>

            </div>
        </div>
    </div>


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

