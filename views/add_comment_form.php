<?php

$form_pr = '
<form name="form1" method="post" action="functions/action_add_comment.php?page=' . $page . '&idCat=' . $idCat . '&idItem=' . $idItem . '">
    <table width="500" border="0" cellspacing="1" cellpadding="1">
        <tr><br>
            <td width="96">
            </td>
            <td width="204">';

$form_pr .= date('d F Y');

$form_pr .= '</td>
        </tr>
        <tr>
            <td>Имя автора:</td>
            <td style="padding: 5px 5px;"><label for="author_name"></label>      
            <input type="text" class="form-control" name="author_name" id="author_name" placeholder="Имя..." required autofocus>
            </td>
        </tr>
        <tr>
            <td>Комментарий:</td>
            <td><label for="comment"></label>
            <textarea class="form-control" rows="5" cols="30" name="comment" id="comment" placeholder="Комментарий..." required></textarea>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
            <br>
            <input type="submit" name="send" value="Отправить">
            </td>
        </tr>
    </table>
</form>
<p>&nbsp;</p>';

echo $form_pr;
?>

