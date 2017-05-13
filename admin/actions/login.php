<?php

session_start();
// создание переменных сессии для админа

if (isset($_POST["login"]) && isset($_POST["password"])) {
    $login = $_POST['login'];
    $password = $_POST['password'];

    if ($login == "admin" && $password == "123456") {
        $_SESSION["rank"] = "admin";
        echo "OK";
    } else {
        if (!$login)
            echo "no login";
        elseif (!$password)
            echo "no pass";
        else
            echo "vale";
    }
}
?>