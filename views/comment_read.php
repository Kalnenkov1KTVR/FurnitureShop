<?php
// $idItem передача номера новости, постройка вывода комментария из табл. comments
    global $db;
    //  $db = new db;             // тоже вариант
    $comment_table = '';
    
    $sql = 'SELECT * FROM `comments` WHERE `item_id` = '.$idItem.' ORDER BY `comments`.`comment_date` DESC';
    $rowsItm = $db->getAll($sql);
    
    $comment_table .= '<h3>Комментарии</h3>';
    $comment_table .= '<table width="100%">'
            .'<thead><tr>'            
            .'<th width="20%">Автор:</th>'
            .'<th width="20%">Дата:</th>'
            .'<th>Комментарий:</th>'
            .'</tr></thead><tbody>';
    
    foreach($rowsItm as $rowItm) {
        $comment_table .= '<tr>'
                .'<td>'.$rowItm['comment_author'].'</td>'
                .'<td>'.$rowItm['comment_date'].'</td>'                
                .'<td>'.$rowItm['comment_text'].'</td>'
                .'<tr>';
    }   
    
    $comment_table .= '</tbody></table>';
            
    echo $comment_table;

?>

