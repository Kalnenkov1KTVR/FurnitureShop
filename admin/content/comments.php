<?php
session_start();


require_once '../../inc/db.php';
$db = new db();
echo '<h3>Комментарии:</h3><hr>';



$sql = "SELECT * FROM `items` ORDER BY `items`.`item_name` ASC";
$rowsItm = $db->getAll($sql);

foreach ($rowsItm as $rowItm) {
    echo '<h4>' . $rowItm['item_name'] . '</h4>';
    $sql = "SELECT * FROM `comments` WHERE `comments`.`item_id` = " . $rowItm['item_id'] . " ORDER BY `comments`.`comment_date` DESC";



    $rowsItm = $db->getAll($sql);

    $text = '<form id="formComment">';
    $text .= '<a href="#" role="button"  data-toggle="modal"  title="Delete" id="DeleteC" style="margin-top:-50px;">'
            . '<span class="glyphicon glyphicon glyphicon-remove"></span> Удалить</a>';



    $text .= '<table class="table table-striped" ><thead><tr> 
                <th><input type="checkbox" id="selectall"> # </th> 
                <th>Data</th> 
                <th>Author</th> 
                <th>Comment</th> 
            </tr></thead><tbody> ';

    foreach ($rowsItm as $rowComm) {
        $text .= '<tr><td><input class="checkbox1" type="checkbox" name="check[]" value="' . $rowComm['comment_id'] . '"> ' . $rowComm['comment_id'] . '</td> <!--  Id элемента  -->
			<td>' . $rowComm['comment_date'] . '</td>  <!--  Дата  -->
			<td>' . $rowComm['comment_author'] . '</td> <!--  Автор  -->
			<td style="width:420px;">
			<button class="btn btn-link" data-toggle="collapse" data-target="#demo' . $rowComm['comment_id'] . '">Раскрыть</button> <!--  Кнопка раскрывающая текст коммента  -->
			<div id="demo' . $rowComm['comment_id'] . '" class="collapse">' . $rowComm['comment_text'] . '</div></td> <!--  Комментарий  -->';
    }
    $text .= '</tbody></table>';
    $text .= '</form>';
    echo $text;
}
?> 


<div id="nom"></div>
<script type="text/javascript">
    $("#back").click(function () {
        $("#main").load("content/comments.php");
    });
</script>
<!--  ----------------------------------------  delete  ------------------------------  -->
<script type="text/javascript">
    
//-------------------------- delete checkbox
    $("#DeleteC").click(function () {
        var num = $('#formComment input[type=checkbox]:checked').length;
        if (num > 0)
        {
            if (confirm("Вы действительно хотите удалить запись?"))
            {
                $.post("actions/comment_delete.php", $("#formComment").serialize())
                        .done(function (data) {
                            $("#main").load("content/comments.php?id=" + <?php echo $_SESSION['items']; ?>);
                        });
            } else
                $("#main").load("content/comments.php?id=" + <?php echo $_SESSION['items']; ?>);
        } else
        {
            $("#nom").text("No items selected.");
        }
    });
</script>
<!--  --------------------------------------- select all  ---------------------------  -->
<script type="text/javascript">
    $(document).ready(function () {
        $("#selectall").change(function () {
            $(".checkbox1").prop('checked', $(this).prop("checked"));
        });
    });
</script>