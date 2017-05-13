
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" id="close" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Categories</h3>
</div>
<div class="modal-body">
    <form id="formC" class="form-horizontal col-sm-12" >
        <div class="form-group"><label>Category</label>
            <input type="text" class="form-control required" placeholder="Category name" data-placement="top" data-trigger="manual" data-content="" name="category_name"></div>
        <div class="form-group"><label>Description</label>
            <textarea class="form-control" placeholder="Description" data-placement="top" data-trigger="manual" name="description"></textarea></div>


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
        $.post("actions/category_add.php", $("#formC").serialize())
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