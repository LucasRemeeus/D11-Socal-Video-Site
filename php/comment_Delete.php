<?php
session_start();
require 'config.php';
$ChangeLike = $mysqli->prepare("DELETE FROM `comment` WHERE ID_Comment = ? AND ID_User = ?");
$ChangeLike -> bind_param('ii',$_POST['ID_comment'], $_SESSION['ID_User']);
$ChangeLike -> execute();