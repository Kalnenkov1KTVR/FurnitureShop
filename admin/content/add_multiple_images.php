<script type="text/javascript" src="jsUp/jquery.form.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#images').on('change',function(){
		$('#multiple_upload_form').ajaxForm({
			target:'#images_preview',			
			success:function(e){
				$('.upload_div').hide();
			}
		}).submit();
	});
});
</script>
<?php
session_start();
$idItm=$_GET['id'];
$sqlItm = "SELECT * FROM  `items` WHERE  `item_id` =$idItm";	

	require_once '../../inc/db.php';
	$db = new db();
	$rowsIt=$db->getAll($sqlItm);
	//$rowsE=get_rows($sqlE);	
		foreach($rowsIt as $rowItm)
		{	
			$itmName=$rowItm['item_name'];
		}
		echo '<h3 style="margin-left:20px;">Gallery - '.$itmName.'</h3>';
?>
<div style="margin:50px;">
	<div class="upload_div">
    <form name="multiple_upload_form" id="multiple_upload_form" enctype="multipart/form-data" action="jsUp/upload.php?id=<?php echo $idItm; ?>" class="upload">
    	<input type="hidden" name="image_form_submit" value="1"/>
            <label>Выберите изображения</label><br>
            <input type="file" name="images[]" id="images" multiple >

    </form>
    </div>
	
    <div class="gallery" id="images_preview">     
    </div>
</div>
