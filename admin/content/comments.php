<?php 
	//информация скрыта под сессией 
	session_start();
			
			
			require_once '../../inc/db.php';
			$db = new db();
				echo '<h3>Новости / Комментарии</h3> <hr>'; 	 
			//////////////////////////////////////////////// 
				$id_uudised=$_GET['id'];
				$_SESSION['news']=$id_uudised; // номер новости, что бы вернуться
				$sqlUE="SELECT * FROM `news` WHERE `id_news`=".$id_uudised;	
			
			$rowUE=$db->getOne($sqlUE);
			
				 $text='<h4>'.$rowUE['news_title'].'</h4><br>'; // вывод название выбранной новости
				 
				 if(strlen($rowUE['news_text'])>500) $len=350; else $len=strlen($rowUE['news_text'])/2;
				 $pos=strpos($rowUE['news_text']," ",$len);
				 
				 //$text.='<p>'.$rowUE['news_text'].'</p>'; // вывод text выбранной новости	 
				 $text.='<p>'.substr($rowUE['news_text'],0,$pos).' ...</p>'; // вывод text выбранной новости	
			$sql = "SELECT * FROM `comment` WHERE `id_news`=".$id_uudised." ORDER BY `comment`.`date_comment` DESC";
			
			$rows=$db->getAll($sql);// выполнить запрос comment
			//----------------------------------------------------------------------
				$text.='<form id="formComment">';
					$text.='<a href="#" role="button"  data-toggle="modal" id="back" title="Back" style="margin-top:-50px;"><span class="glyphicon glyphicon-arrow-left"></span> BACK</a> | ';
					$text.='<a href="#" role="button"  data-toggle="modal"  title="Delete" id="DeleteC" style="margin-top:-50px;"><span class="glyphicon glyphicon glyphicon-remove"></span> DELETE</a>';	
				//------------------------------------------------------------------------
						$text.='<table class="table table-striped" > 
						<thead> 
							<tr> 
								<th><input type="checkbox" id="selectall"> #</th> 
								<th>Data</th> 
								<th>Author</th> 
								<th>Comment</th> 
							</tr> 
						</thead> 
					<tbody> ';   				
		foreach($rows as $row_com){	 
			$text.='<tr><td><input class="checkbox1" type="checkbox" name="check[]" value="'.$row_com['id_comment'].'"> '.$row_com['id_comment'].'</td> <!--  Id элемента  -->
			<td>'.$row_com['date_comment'].'</td>  <!--  Дата  -->
			<td>'.$row_com['author_comment'].'</td> <!--  Автор  -->
			<td style="width:420px;">
			<button class="btn btn-link" data-toggle="collapse" data-target="#demo'.$row_com['id_comment'].'">Читать</button> <!--  Кнопка раскрывающая текст коммента  -->
			<div id="demo'.$row_com['id_comment'].'" class="collapse">'.$row_com['comment'].'</div></td> <!--  Комментарий  -->'; 
							}// foreach  
					$text.='</tbody> 
					</table>'; 
				$text.='</form>';
				//-----------------------------------— вывод на страницу 
				echo $text;
		//}
?> 
<!--  ------------------------------------  Сообщение об шибки выделения  ----------------------------------------  -->
<div id="nom"></div>
<script type="text/javascript">
	$( "#back" ).click(function() {		
		$( "#main" ).load( "content/uudised.php");		
	});
</script>
<!--  ----------------------------------------  Delete  ------------------------------  -->
<script type="text/javascript"> 
//--------------------------delete checkbox
	$( "#DeleteC" ).click(function() {	
	var num = $('#formComment input[type=checkbox]:checked').length;
	if(num>0)   
	{		
		 if (confirm("Вы действительно хотите удалить запись?"))
			{	
				$.post( "actions/comment_delete.php", $( "#formComment" ).serialize())
					.done(function( data ) {								
					$( "#main" ).load( "content/comment.php?id="+ <?php echo $_SESSION['news'];  ?> );	
					});
			}
			else
			   $( "#main" ).load("content/comment.php?id="+ <?php echo $_SESSION['news'];  ?> );
		}
		else
		{
			$( "#nom" ).text( "News not selected" );
		}
	});
</script>
<!--  ---------------------------------------  Скрипт на выделение selectall  ---------------------------  -->
<script type="text/javascript"> 
	$(document).ready(function(){ 
		$("#selectall").change(function(){
		  $(".checkbox1").prop('checked', $(this).prop("checked"));
		  });
	});
</script>