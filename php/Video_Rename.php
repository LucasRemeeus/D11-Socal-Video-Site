<?php
require 'config.php';

session_start();
$Title = $_POST['Title'];
$ID_Video = $_POST['ID_Video'];


$Rename = $mysqli -> prepare("UPDATE video SET Title=? WHERE ID_Video=? AND ID_User = ?");
$Rename -> bind_param('sii', $Title, $ID_Video, $_SESSION['ID_User']);
if ($Rename -> execute()){
    echo "success";
}else{
    echo "ErrorRename";
}