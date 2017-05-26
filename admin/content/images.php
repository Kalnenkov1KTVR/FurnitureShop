<?php
session_start();
if (isset($_SESSION["rank"]) && ($_SESSION["rank"]) == "admin") {
    require_once '../../inc/db.php';
    $db = new db();
    $sql = "SELECT * FROM `categories` ORDER BY `categories`.`category_name` ASC";
    $rowsItm = $db->getAll($sql);
    $text = "";
    foreach ($rowsItm as $rowItm) {
        $text .= '<h3>' . $rowItm['category_name'] . '</h3>';

        $sqlItem = "SELECT * FROM `items` WHERE `category_id` = " . $rowItm['category_id'] . " ORDER BY `items`.`item_name` ASC";
        $_SESSION['item_id']=0;
        $rowsItem = $db->getAll($sqlItem);
        foreach ($rowsItem as $rowItem) {
            $text .= '<table class="table"><th><h4>' . $rowItem['item_name'] . '</h4><th>';

            $sqlPic = "SELECT * FROM `example_images` WHERE `item_id` = " . $rowItem['item_id'] . " ORDER BY `example_images`.`image_name` ASC";
            $rowsPics = $db->getAll($sqlPic);

            $text .= '<tr><td><label>Фотографии:</label></td>'
                    . '<td><a href="#myModal" role="button" class="btn btn-primary btn-sm" data-toggle="modal" data-keyboard="false" '
                    . 'data-backdrop="static" data-remote="actions/image_add_window.php?id=' . $rowItem['item_id'] . '"" title="Add">Загрузить</a>'
                    
                    . '</tr></table><table class="table table-striped">';



            foreach ($rowsPics as $rowPic) {
                $text .= '<tr>';
                $text .= '<td colspan=2><img>' . $rowPic['image_name'] . '</img></td>';
                $text .= '<td><img src="../files/' . $rowPic['image_name'] . '" alt=""class="img-responsive" style="width: 51px;"/></td>';
                $text .= '<td><a href="#" role="button" data-keyboard="false" class="btn btn-primary btn-sm" data-backdrop="static" data-toggle="modal" '
                        . 'data-target="#myModal" data-remote="actions/image_delete_window.php?id=' . $rowPic['image_id'] . '">
                    <span class="glyphicon glyphicon-remove" title="Delete" ></span></a></td>';
                $text .= '</tr>';
            }
            $text .= '</table><br>';
        }
    }
    $text .= '</tr>';
    echo '<div class="col-md-9"><ul>' . $text . '</ul></div>';
}
?>

<!-- модальное окно -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

        </div>
    </div>
</div> 

<script src="js/jquery.min.js"></script>
<script type="text/javascript">

    $("#back").click(function (data) {
        $("#main").load("content/items.php");
    });
    $("[id='multiple_images']").click(function () {
        $("#main").load("content/add_multiple_images.php?id=" + $(this).data("id"));//Галерея
    });
</script>

