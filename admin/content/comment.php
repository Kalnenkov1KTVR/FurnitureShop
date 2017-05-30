<?php
//информация скрыта под сессией 
session_start();


require_once '../../inc/db.php';
$db = new db();
echo '<h3>Комментарии</h3> <hr>';
//////////////////////////////////////////////// 
$id_item = $_GET['id'];
$_SESSION['item'] = $id_item; // номер новости, что бы вернуться
$sqlItm = "SELECT * FROM `items` WHERE `item_id`=" . $id_item;

$rowItm = $db->getOne($sqlItm);

$text = '<h4>' . $rowItm['item_name'] . '</h4><br>'; // вывод название выбранной новости


$sql = "SELECT * FROM `comments` WHERE `item_id`=" . $id_item . " ORDER BY `comments`.`comment_date` DESC";

$rows = $db->getAll($sql); // выполнить запрос comment
//----------------------------------------------------------------------
$text .= '<form id="formComment">';
$text .= '<a href="#" role="button"  data-toggle="modal" id="back" title="Back" style="margin-top:-50px;"><span class="glyphicon glyphicon-arrow-left"></span> BACK</a> | ';
$text .= '<a href="#" role="button"  data-toggle="modal"  title="Delete" id="DeleteC" style="margin-top:-50px;"><span class="glyphicon glyphicon glyphicon-remove"></span> DELETE</a>';
//------------------------------------------------------------------------
$text .= '<table class="table table-striped" > 
            <thead> 
            <tr> 
            <th><input type="checkbox" id="selectall"> #</th> 
            <th>Data</th> 
            <th>Author</th> 
            <th>Comment</th> 
            </tr> 
            </thead> 
        <tbody> ';
foreach ($rows as $row_com) {
    $text .= '<tr><td><input class="checkbox1" type="checkbox" name="check[]" value="' . $row_com['comment_id'] . '"> ' . $row_com['comment_id'] . '</td> <!--  Id элемента  -->
			<td>' . $row_com['comment_date'] . '</td>  <!--  Дата  -->
			<td>' . $row_com['comment_author'] . '</td> <!--  Автор  -->
			<td style="width:420px;">
			<button class="btn btn-link" data-toggle="collapse" data-target="#demo' . $row_com['comment_id'] . '">Читать</button> <!--  Кнопка раскрывающая текст коммента  -->
			<div id="demo' . $row_com['comment_id'] . '" class="collapse">' . $row_com['comment_text'] . '</div></td> <!--  Комментарий  -->';
}// foreach  
$text .= '</tbody> 
					</table>';
$text .= '</form>';
//-----------------------------------— вывод на страницу 
echo $text;
//}
?> 
<!--  ------------------------------------  Сообщение об шибки выделения  ----------------------------------------  -->
<div id="nom"></div>
<script type="text/javascript">
    $("#back").click(function () {
        $("#main").load("content/comments.php");
    });
</script>
<!--  ----------------------------------------  Delete  ------------------------------  -->
<script type="text/javascript">
//--------------------------delete checkbox
    $("#DeleteC").click(function () {
        var num = $('#formComment input[type=checkbox]:checked').length;
        if (num > 0)
        {
            if (confirm("Вы действительно хотите удалить запись?"))
            {
                $.post("actions/comment_delete.php", $("#formComment").serialize())
                        .done(function (data) {
                            $("#main").load("content/comment.php?id=" + <?php echo $_SESSION['item']; ?>);
                        });
            } else
                $("#main").load("content/comment.php?id=" + <?php echo $_SESSION['item']; ?>);
        } else
        {
            $("#nom").text("News not selected");
        }
    });
</script>
<!--  ---------------------------------------  Скрипт на выделение selectall  ---------------------------  -->
<script type="text/javascript">
    $(document).ready(function () {
        $("#selectall").change(function () {
            $(".checkbox1").prop('checked', $(this).prop("checked"));
        });
    });
</script>