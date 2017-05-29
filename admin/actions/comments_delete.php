<?php
// запрос Delete удалить из базы

	require_once '../../inc/db.php';
	$db = new db();
			
	$idComm=$_POST['check'];// массив checkbox  
	
	foreach($idComm as $idC){
		$sql="DELETE FROM `comments` WHERE `comments`.`comment_id` =$idC";
		$result=$db->execute($sql);
	}
?>