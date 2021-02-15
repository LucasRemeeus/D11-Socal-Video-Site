<?php
$_SESSION['ID_User'];
require 'config.php';

$ID_Video = $_POST['ID_Video'];


$Getinfo = $mysqli->prepare("SELECT Video FROM video WHERE ID_Video = ?");
$Getinfo -> bind_param('i', $ID_Video);
$Getinfo -> execute();
$Getinfo -> bind_result($Path);
$Getinfo -> fetch();
$Getinfo -> close();
$Path = "../upload/".$Path;

if(is_numeric($ID_Video)){
    $DeleteVideo = $mysqli->prepare("DELETE FROM video WHERE ID_Video = ?");
    $DeleteVideo -> bind_param('i', $ID_Video);
    if($DeleteVideo -> execute()){
        echo "success";
        unlink($Path);
    }else{
        echo "ErrorDelete"; }
}else{
    echo "ErrorNumber";
}