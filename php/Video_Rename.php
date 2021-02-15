<?php
require 'config.php';

$Title = $_POST['Title'];
$ID_Video = $_POST['ID_Video'];


$Rename = $mysqli -> prepare("UPDATE video SET Title=? WHERE ID_Video=?");
$Rename -> bind_param('si', $Title, $ID_Video);
if ($Rename -> execute()){
    echo "success";
}else{
    echo "ErrorRename";
}