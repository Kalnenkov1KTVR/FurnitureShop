<?php
$id = $_GET['id'];
require_once '../../inc/db.php';
$db = new db();
$sql = "SELECT * FROM `items` WHERE `item_id`=" . $id;
$row = $db->getOne($sql);
?>

<div class="modal-header">       
    <button type="button" class="close" data-dismiss="modal" id="close" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Edit item</h3>
</div>

<div class="modal-body">
    <form id="formE" class="form-horizontal col-sm-12" >
        <div class="form-group"><label>ID</label>
            <input type="text" class="form-control required" placeholder="Item ID" data-placement="top" data-trigger="manual" data-content="" name="item_id" value="<?php echo $row['item_id']; ?>"  readonly></div>
        <div class="form-group"><label>Item</label>
            <input type="text" class="form-control required" placeholder="item Name" data-placement="top" data-trigger="manual" data-content="" name="item_name" value="<?php echo $row['item_name']; ?>"></div>
        <div class="form-group"><label>Description</label>
            <textarea class="form-control" placeholder="Description" data-placement="top" data-trigger="manual" name="description" ><?php echo $row['item_descr']; ?></textarea></div>
        <div class="form-group"><label>Category</label>
            <select name="category_id" class="form-control" data-placement="top" data-trigger="manual">

                <?php
                $sqlCat = "SELECT * FROM `categories`  ";
                $rowsCat = $db->getAll($sqlCat);
                foreach ($rowsCat as $rowCat) {
                    echo '<option value="' . $rowCat['category_id'] . '"';
                    if ($rowCat['category_id'] == $row['category_id'])
                        echo 'selected';
                    echo '>' . $rowCat['category_name'] . '</option>';
                }
                ?>  

            </select>
        </div> 
        
        <div class="form-group">
            <button type="button"  class="btn btn-success pull-right" data-dismiss="modal" id="edit">Edit</button>
        </div>
    </form>
</div>

<div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true" id="cancel">Cancel</button>
</div>

<script src="js/jquery.min.js"></script>

<script type="text/javascript">
    $("#edit").click(function () {
        $.post("actions/item_edit.php", $("#formE").serialize())
                .done(function (data) {
                    $("#main").load("content/items.php");
                });
    });
    $("#cancel").click(function () {
        $("#main").load("content/items.php");
    });
    $("#close").click(function () {
        $("#main").load("content/items.php");
    });
</script>
