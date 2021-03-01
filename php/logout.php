<?php
session_start();

session_destroy();

$Refer = $_SERVER['HTTP_REFERER'];
    header("location: ../index.php");
die();
?>