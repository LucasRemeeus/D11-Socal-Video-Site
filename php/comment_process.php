<?php
require 'config.php';
session_start();
$Comment = $_POST['comment'];
$ID_Video = $_POST['ID_Video'];

$addComment = $mysqli -> prepare('INSERT INTO comment (ID_Comment, ID_User, ID_Video, Comment, Date) VALUE (NULL, ?, ?, ?, ?)');
$addComment -> bind_param('iiss', $_SESSION['ID_User'], $ID_Video, $Comment, date("Y/m/d"));
if($addComment -> execute()){
    echo "success";
}