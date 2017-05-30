<?php
session_start();
if (isset($_SESSION["rank"]) && ($_SESSION["rank"] == "admin")) {

    require_once '../../inc/db.php';
    $db = new db();
//---------------------
    $sqlU = "SELECT * FROM `items` ORDER BY `items`.`item_name`  DESC";

    $rowsU = $db->getAll($sqlU);
    $textR = "";
    foreach ($rowsU as $rowU) {
//----------------------Comment
        $query = "SELECT COUNT(`comment_id`) AS count FROM `comments` WHERE `item_id`=" . $rowU['item_id']; //колво элементов в массиве

        $member = $db->getOne($query);

//-----------------------------					
        $textR .= '<tr>
<th scope="row"><input class="checkbox1" type="checkbox" name="check[]" value="' . $rowU['item_id'] . '"> ' . $rowU['item_id'] . '</th>
						<td>' . $rowU['item_name'] . '</td>
						<td>

<a href="#" role="button" class="btn btn-link btn-xs" id="commentID" data-id="' . $rowU['item_id'] . '">Comment (' . $member['count'] . ')</a> 								
						</td>
						</tr>';
    }
    $heading = '<h3 style="margin-left:20px;">Все комментарии</h3>
					<form id="formDelUd">
					<div class="row">
					
		</div>'; //class="btn btn-primary btn-lg"

    $heading .= '<br>
<div class="row">';
    $tableA = '<div class="col-md-7">
<table class="table table-striped">
      <thead>
        <tr>
          <th><input type="checkbox" id="selectall"/> #</th>
          <th>Uudised</th>
          <th style="margin-left:">Actions</th>
        </tr>
      </thead>
	  <tbody>';

    $tableB = '</tbody>  </table>   
	  <div class="clearfix visible-lg"></div>
	  </div>
	  </form>';
    //-----------------------------form edit
    //-------------------------
    $footer = '</div>';
    echo $heading . $tableA . $textR . $tableB . $footer;
}
?>	
<div id="nom"></div>
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

        </div>
    </div>
</div> 



<script type="text/javascript">
    $(document).ready(function () {
        $("#selectall").change(function () {
            $(".checkbox1").prop('checked', $(this).prop("checked"));
        });
    });
</script>

<script type="text/javascript">

//------------------------------------------------------------------------------Comment
    $("[id='commentID']").click(function () {
        $("#main").load("content/comment.php?id=" + $(this).data("id"));//Основное
    });

//-------------------------------------------------------------------DELETE	
    $("#delete").click(function () {

        var num = $('#formDelUd input[type=checkbox]:checked').length;
        if (num > 0)   //??????????????????????
        {

            if (confirm("Вы действительно хотите удалить запись?"))
            {
                $.post("actions/news_delete.php", $("#formDelUd").serialize())
                        .done(function (data) {
                            $("#main").load("content/uudised.php");
                        });
            } else
                $("#main").load("content/uudised.php");
        } else
        {
            $("#nom").text("News not selected");
            //http://stackoverflow.com/questions/10402028/finding-and-counting-number-of-checked-boxes-using-jquery
        }
    });
</script>