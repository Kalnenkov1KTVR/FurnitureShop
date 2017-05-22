<?php
$id = $_GET['id'];



require_once '../../inc/db.php';
$db = new db();

$sql = "SELECT * FROM `example_images` WHERE `image_id`=" . $id;

$row = $db->getOne($sql);

//{
?>		
<div class="modal-header">
    <h3 id="myModalLabel">Delete item</h3>
</div>

<div class="modal-body">
    <form class="form-horizontal col-sm-12" id="formED" >

        <div class="form-group"><label>ID</label>
            <input type="text" class="form-control required" placeholder="" data-placement="top" data-trigger="manual" data-content="" name="image_idDel" value="<?php echo $row['image_id']; ?>" readonly></div>

        <div class="form-group"><label>Item</label>
            <input type="text" class="form-control required" placeholder="" data-placement="top" data-trigger="manual" data-content="" name="imageDel" value="<?php echo $row['image_name']; ?>" readonly></div>



        <div class="form-group">
            <button type="button"  class="btn btn-success pull-right" data-dismiss="modal" name="edit_1" id="delete" >Delete</button> 
            <p class="help-block pull-left text-danger hide" id="form-error">&nbsp; The form is not valid. </p>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true" id="cancel">Cancel</button>
</div>
<!--       -->
<script src="js/jquery.min.js"></script>
<script type="text/javascript">


    $("#delete").click(function () {
        $.post("actions/image_delete.php", $("#formED").serialize())
                .done(function (data) {
                    $("#main").load("content/images.php");
                });
    });
    $("#cancel").click(function () {
        $("#main").load("content/images.php");
    });
</script>