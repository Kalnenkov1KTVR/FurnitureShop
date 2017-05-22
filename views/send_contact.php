<?php

require_once '../inc/config.php';
$page = $_GET['page'];
/* e-mail куда будут приходить сообщения */
$myemail = "mihhail.kalnenkov@gmail.com";
//считывание значений с формы
//check_input - проверяет введенные значения
$yourname = check_input($_POST['name'], "Enter your name", $page);

$email = check_input($_POST['email'], $problem = '', $page);

$comments = check_input($_POST['message'], "Write your comments", $page);
$subject = "Message from company site";
/* ошибка - неправильный e-mail адрес */
if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email)) {// проверка е-майл адреса (есть ли ".", "@" и .тд)
    show_error("Неверный E-mail адрес.", $page); // ошибка
}

// сообщение
$message = "Hello!

Your contact form has been submitted by:

Name: $yourname
E-mail: $email

Comments:
$comments

End of message.";

/* Send the message using mail() function */
mail($myemail, $subject, $message); // отправляет сообщение на указанный адрес

/* Redirect visitor to the thank you page */
header('Location: ' . INDEX . '?page=' . $page . '&message=send'); //возврат на ту страницу с кот. они пришли
exit();

/* Functions we used */

function check_input($data, $problem = '', $page) {
    $data = trim($data); // trim - удаляет незначащие пробелы до и после текста
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    if ($problem && strlen($data) == 0) {
        show_error($problem, $page);
    }
    return $data;
}

// если ошибка при заполнении 
function show_error($myError, $page) {
    header('Location: ' . INDEX . '?page=' . $page . '&message=' . $myError);
    exit();
}

?>
