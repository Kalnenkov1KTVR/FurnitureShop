<?php

session_start();
unset($_SESSION['rank']);
session_destroy();

header('Location: ../index.php');
?>