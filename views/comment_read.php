<?php
// $idItem передача номера новости, постройка вывода комментария из табл. comments
    global $db;
    //  $db = new db;             // тоже вариант
    $comment_table = '';
    
    $sql = 'SELECT * FROM `comments` WHERE `item_id` = '.$idItem.' ORDER BY `comments`.`comment_date` DESC';
    $rows = $db->getAll($sql);
    
    $comment_table .= '<h3>Комментарии</h3>';
    $comment_table .= '<table width="100%">'
            .'<thead><tr>'            
            .'<th width="20%">Автор:</th>'
            .'<th width="20%">Дата:</th>'
            .'<th>Комментарий:</th>'
            .'</tr></thead><tbody>';
    
    foreach($rows as $row) {
        $comment_table .= '<tr>'
                .'<td>'.$row['comment_author'].'</td>'
                .'<td>'.$row['comment_date'].'</td>'                
                .'<td>'.$row['comment_text'].'</td>'
                .'<tr>';
    }   
    
    $comment_table .= '</tbody></table>';
            
    echo $comment_table;

?>

