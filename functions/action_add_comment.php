<?php

include_once '../inc/config.php';
include_once '../inc/db.php';
$db = new db();

if($_POST['send']) { 
    $page = $_GET['page'];
    $idCat = $_GET['idCat'];
    $idItem = $_GET['idItem'];
    $author_name = $_POST['author_name'];
    $comment = $_POST['comment'];
    $date = date('Y-m-d'); // как в БД: 2015-12-01

    if($author_name != "" && $comment != "") {
        $sql = "INSERT INTO `comments` (`comment_id`, `comment_author`, `comment_text`, `comment_date`, `item_id`) "
                . "VALUES (NULL, '$author_name', '$comment', '$date', '$idItem');";
        $result = $db->execute($sql);
    }
     
    header('Location: '.INDEX.'?page='.$page.'&idCat='.$idCat.'&idItem='.$idItem); //URL
}

?>

