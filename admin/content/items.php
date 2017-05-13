<?php
session_start();
if (($_SESSION["rank"] == "admin")) {

    require_once '../../inc/db.php';
    $db = new db();
//--------------------- categories
    $sqlCat = "SELECT * FROM `categories` ORDER BY `category_name`";
    $rowsCat = $db->getAll($sqlCat);
    $textR = "";
    foreach ($rowsCat as $rowCat) {

        $sqlItem = "SELECT * FROM `items` WHERE  `category_id` =" . $rowCat['category_id'] . " ORDER BY `items`.`item_name` ASC ";

        $rowsItem = $db->getAll($sqlItem);
        if (count($rowsItem) > 0) {
            $textR .= '<tr style="background-color:#ddd;"><td colspan=2>' . $rowCat['category_name'] . '<td><tr>';
            foreach ($rowsItem as $rowItem) {
                // Edit - запускается скриптом data-id - номер записи
                $textR .= '<tr>
                    <th scope="row">' . $rowItem['item_id'] . '</th>
                    <td>' . $rowItem['item_name'] . '</td>
                    <td>

                    <a href="#" role="button" data-keyboard="false" class="btn btn-primary btn-sm" data-backdrop="static" data-toggle="modal" '
                        . 'data-target="#myModal" data-remote="actions/item_edit_window.php?id=' . $rowItem['item_id'] . '">
                    <span class="glyphicon glyphicon-edit" title="Edit" ></span></a> 
                    <a href="#" role="button" data-keyboard="false" class="btn btn-primary btn-sm" data-backdrop="static" data-toggle="modal" '
                        . 'data-target="#myModal" data-remote="actions/item_delete_window.php?id=' . $rowItem['item_id'] . '">
                    <span class="glyphicon glyphicon-remove" title="Delete" ></span></a>

                    </td>
                    </tr>';
            } // foreach
        } // if
    }
    $heading = '<h3 style="margin-left:20px;">Items</h3>';
    $heading .= '<br>
    <div class="row">';
    $tableA = '<div class="col-md-7">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Item</th>
          <th style="margin-left:">Actions</th>
        </tr>
      </thead>
	  <tbody>';
    $tableB = '</tbody></table>   
	  <div class="clearfix visible-lg"></div>
	  </div>';

    $footer = '</div>';
    echo $heading . $tableA . $textR . $tableB . $footer;

?>

<div class="row">
    <div class="container">
        <div class="row">
            <a href="#myModal" role="button" class="btn btn-primary btn-sm" data-toggle="modal" data-keyboard="false" data-backdrop="static" data-remote="actions/item_add_window.php" title="Add">Add</a>
        </div>
    </div>
</div>

<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

        </div>
    </div>
</div>  

<?php
}
?>