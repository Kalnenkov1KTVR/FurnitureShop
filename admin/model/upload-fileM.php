<?php
session_start();
$_SESSION['pildid']=array();
//$images_arr = array();
$count1=count($_FILES['uploadfile']['name'] );
$count2=0;
foreach($_FILES['uploadfile']['name'] as $key=>$val){

	$uploaddir = '../../images/'; 
	$file = $uploaddir . basename($_FILES['uploadfile']['name'][$key]); 
	 
	$ext = substr($_FILES['uploadfile']['name'][$key],strpos($_FILES['uploadfile']['name'][$key],'.'),strlen($_FILES['uploadfile']['name'][$key])-1); 
	$filetypes = array('.jpg','.gif','.bmp','.png','.JPG','.BMP','.GIF','.PNG','.jpeg','.JPEG');
	 
	if(!in_array($ext,$filetypes)){
		echo "<p>Error format</p>";}
	else{ 
	  //echo "success"; 
		if (move_uploaded_file($_FILES['uploadfile']['tmp_name'][$key], $file)) { 
		 echo "success"; 
		 $count2++;
		 $_SESSION['pildid'][]=basename($_FILES['uploadfile']['name'][$key]);
		 
		} else {
			echo "error";
		}
	}
 }
//if($count1==$count2)
//	echo "success"; 
//else
//	echo "error";
?>