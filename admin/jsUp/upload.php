<?php
session_start();
if ($_POST['image_form_submit'] == 1) {
    $images_arr = array();
    foreach ($_FILES['images']['name'] as $key => $val) {
        $image_name = $_FILES['images']['name'][$key];
        $tmp_name = $_FILES['images']['tmp_name'][$key];
        $size = $_FILES['images']['size'][$key];
        $type = $_FILES['images']['type'][$key];
        $error = $_FILES['images']['error'][$key];

        $target_dir = "../../images/";
        $target_file = $target_dir . $_FILES['images']['name'][$key];
        $file_name = $_FILES['images']['name'][$key];
        if (move_uploaded_file($_FILES['images']['tmp_name'][$key], $target_file)) {
            //$images_arr[] = $target_file;
            $images_arr[] = $file_name;
        }
    }
    //-------------------------------------------------
    ?>
    <?php
    $id = $_GET['id'];
    ?>	

    <div class="modal-body">
        <form id="formGM" class="form-horizontal col-sm-12" >

            <input type="hidden" class="form-control required" placeholder="Item name" data-placement="top" data-trigger="manual" data-content="" name="item_id" value="<?php echo $id; ?>">
            <ul>  
    <?php
    //Generate images view
    if (!empty($images_arr)) {
        $count = 0;
        foreach ($images_arr as $image_src) {
            $count++
            ?>			
                        <li>
                            <img src="<?php echo "../images/" . $image_src; ?>" width="100" alt="">
                            <?php
                            echo '<input type="hidden" id="img" name="img[]" value="' . $image_src . '">';
                            echo $image_src;
                            ?>
                        </li>

                        <?php
                    }
                    ?>
                </ul>
                <div class="form-group">
                    <button type="button"  class="btn btn-success pull-right" data-dismiss="modal" id="addM">Send It!</button> 
                    <p class="help-block pull-left text-danger hide" id="form-error">&nbsp; The form is not valid. </p>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true" id="cancelAddM">Cancel</button>
        </div>
        <?php
    }
}
?>
<script src="js/jquery.min.js"></script>
<script type="text/javascript">
    $("#addM").click(function () {
        $.post("actions/image_add_multi.php", $("#formGM").serialize())
                .done(function (data) {
                    var prov = <?php echo $_SESSION['item_id']; ?>;
                    if (prov == 0)
                        $("#main").load("content/images.php");
                    else
                        $("#main").load("content/images.php?id=" + <?php echo $_SESSION['item_id']; ?>);//
                });
    });
    $("#cancelAddM").click(function () {
        var prov = <?php echo $_SESSION['item_id']; ?>;
        if (prov == 0)
            $("#main").load("content/images.php");
        else
            $("#main").load("content/images.php?id=" + <?php echo $_SESSION['item_id']; ?>);	
    });

</script>
