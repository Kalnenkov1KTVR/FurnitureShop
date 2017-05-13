<?php
$idCat = $_GET['id'];
require_once '../../inc/db.php';
$db = new db();
$sql = "SELECT * FROM `categories` WHERE `category_id` = " . $idCat;
$row = $db->getOne($sql);
?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" id="close" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Update category</h3>
</div>

<div class="modal-body">
    <form id="form0" class="form-horizontal col-sm-12" >
        <div class="form-group"><label>Category ID</label>
            <input type="text" class="form-control required" data-placement="top" data-trigger="manual" data-content="" name="category_id" readonly value="<?php echo $row['category_id']; ?>"></div>
        <div class="form-group"><label>Name</label>
            <input type="text" class="form-control required" placeholder="Category name" data-placement="top" data-trigger="manual" data-content="" name="category_name" value="<?php echo $row['category_name']; ?>"></div>
        <div class="form-group"><label>Description</label>
            <textarea class="form-control" placeholder="Description" data-placement="top" data-trigger="manual" name="category_description"><?php echo $row['category_description']; ?></textarea></div>

        <div class="form-group">
            <button type="button"  class="btn btn-success pull-right" data-dismiss="modal" id="upd">Update</button> 
        </div>
    </form>
</div>
<div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true" id="cancel">Cancel</button>
</div>
<script src="js/jquery.min.js"></script>

<script type="text/javascript">
    $("#upd").click(function () {
        $.post("actions/category_edit.php", $("#form0").serialize())
                .done(function (data) {
                    $("#main").load("content/categories.php");
                });
    });
    $("#cancel").click(function () { // кнопка cancel
        $("#main").load("content/categories.php");
    });
    $("#close").click(function () { // закрытие окна (крест)
        $("#main").load("content/categories.php");
    });

</script>
