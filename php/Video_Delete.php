<?php
session_start();
require 'config.php';

$ID_Video = $_POST['ID_Video'];


$Getinfo = $mysqli->prepare("SELECT Video FROM video WHERE ID_Video = ? AND ID_User = ?");
$Getinfo -> bind_param('ii', $ID_Video,$_SESSION['ID_User']);
$Getinfo -> execute();
$Getinfo -> bind_result($Path);
$Getinfo -> fetch();
$Getinfo -> close();
$Path = "../upload/".$Path;

if(is_numeric($ID_Video)){
    $DeleteVideo = $mysqli->prepare("DELETE FROM video WHERE ID_Video = ? AND ID_User = ?");
    $DeleteVideo -> bind_param('ii', $ID_Video, $_SESSION['ID_User']);
    if($DeleteVideo -> execute()){
        echo "success";
        unlink($Path);
    }else{
        echo "ErrorDelete"; }
}else{
    echo "ErrorNumber";
}