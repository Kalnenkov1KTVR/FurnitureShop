<?php
session_start();
$id = $_GET['id'];

require_once '../../inc/db.php';
$db = new db();

$sql = "SELECT * FROM  `items` WHERE  `item_id` =" . $id;
$rowItm = $db->getOne($sql);
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Add Item Photo</h3>
</div>
<div class="modal-body">
    <form id="formG" class="form-horizontal col-sm-12" >


        <div class="form-group"><label>Item</label>
            <select name="item" class="form-control" data-placement="top" data-trigger="manual" disabled  >
                <?php
                $sqlI = "SELECT * FROM `items`";
                $rowsI = $db->getAll($sqlI);
                foreach ($rowsI as $rowI) {
                    echo '<option value="' . $rowI['item_id'] . '"';
                    if ($rowI['item_id'] == $rowItm['item_id'])
                        echo 'selected';
                    echo '>' . $rowI['item_name'] . '</option>';
                }
                ?>  
            </select>
            <input type="hidden" class="form-control required" placeholder="" data-placement="top" data-trigger="manual" data-content="" name="item_id" value="<?php echo $id; ?>">
        </div>         
        <div class="form-group"><label>Картинка:</label>
            <div id="upload" ><span class="btn btn-success">Выбрать картинку<span></div>
                        <div id="pic_place" style="padding-top:10px;"></div>		
                        <div id="img_place"></div>
                        <span id="status" ></span>
                        </div>

                        <div class="form-group">
                            <button type="submit"  class="btn btn-success pull-right" data-dismiss="modal" id="add">Добавить</button> 
                            <p class="help-block pull-left text-danger hide" id="form-error">&nbsp; The form is not valid. </p>
                        </div>
                        </form>
                        </div>

                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true" id="cancelAdd">Cancel</button>
                        </div>

                        <script src="js/jquery.min.js"></script>

                        <script type="text/javascript">
                            $("#add").click(function () {
                                $.post("actions/image_add.php", $("#formG").serialize())
                                        .done(function (data) {
                                            var prov = <?php echo $_SESSION['item_id']; ?>;
                                            if (prov == 0)
                                                $("#main").load("content/images.php");
                                            else
                                                $("#main").load("content/images.php?id=" + <?php echo $_SESSION['item_id']; ?>);//
                                        });
                            });
                            $("#cancelAdd").click(function () {
                                var prov = <?php echo $_SESSION['item_id']; ?>;
                                if (prov == 0)
                                    $("#main").load("content/images.php");
                                else
                                    $("#main").load("content/images.php?id=" + <?php echo $_SESSION['item_id']; ?>);
                            });

                        </script>
                        <script type="text/javascript" >
                            $(function () {
                                var btnUpload = $('#upload');
                                var status = $('#status');
                                new AjaxUpload(btnUpload, {
                                    action: 'model/upload-file.php',
                                    name: 'uploadfile',
                                    onSubmit: function (file, ext) {
                                        if (!(ext && /^(jpg|png|jpeg|gif)$/.test(ext))) {
                                            // extension is not allowed 
                                            status.text('Поддерживаемые форматы BMP, JPG, PNG или GIF');
                                            return false;
                                        }
                                        status.text('Загрузка...');
                                    },
                                    onComplete: function (file, response) {
                                        //On completion clear the status
                                        status.text('');

                                        //Add uploaded file 			
                                        if (response === "success") {
                                            $('#pic_place').html('<img src="../files/' + file + '" alt="" width=50px height=50px /> ' + file).addClass('success');
                                            $('#img_place').html('<input type="hidden" class="form-control" id="img" name="img" value="' + file + '">').addClass('success');

                                        } else {
                                            $('<li></li>').appendTo('#files').text('Файл не загружен' + file).addClass('error');
                                        }
                                    }
                                });

                            });

                        </script>