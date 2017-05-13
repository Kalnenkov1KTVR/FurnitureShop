
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" id="close" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Add item</h3>
</div>
<div class="modal-body">
    <form id="formI" class="form-horizontal col-sm-12" >
        <div class="form-group"><label>Item name</label>
            <input type="text" class="form-control required" placeholder="Item name" data-placement="top" data-trigger="manual" data-content="" name="item_name"></div>
        <div class="form-group"><label>Description</label>
            <textarea class="form-control" placeholder="Описание" data-placement="top" data-trigger="manual" name="item_descr"></textarea></div>
        <div class="form-group"><label>Category</label>
            <select name="category_id" class="form-control" data-placement="top" data-trigger="manual">
                <?php
                require_once '../../inc/db.php';
                $db = new db();
                $sql = "SELECT * FROM `categories`  ";
                $rows = $db->getAll($sql);
                foreach ($rows as $row) {
                    echo '<option value="' . $row['category_id'] . '">' . $row['category_name'] . '</option>';
                }
                ?>  
            </select>
        </div>         

        <div class="form-group">
            <button type="button"  class="btn btn-success pull-right" data-dismiss="modal" id="add">Add</button> 
        </div>
    </form>
</div>

<div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true" id="cancel">Cancel</button>
</div>

<script src="js/jquery.min.js"></script>

<script type="text/javascript">
    $("#add").click(function () {
        $.post("actions/item_add.php", $("#formI").serialize())
                .done(function (data) {
                    $("#main").load("content/items.php");
                });
    });
    $("#cancel").click(function () {
        $("#main").load("content/items.php");
    });
    $("#close").click(function () { // закрытие окна (крест)
        $("#main").load("content/items.php");
    });
</script>


