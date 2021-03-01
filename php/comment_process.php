<?php
require 'config.php';
session_start();

$addComment = $mysqli -> prepare('INSERT INTO comment (ID_Comment, ID_User, ID_Video, Comment, Date) VALUE (NULL, ?, ?, ?, ?, ?)');
$addComment -> bind_param('iiiss', $_SESSION['ID_User'], $ID_Video, $Comment, date("d/m/Y"));