<?php
session_start();
require 'config.php';

$Username = $_POST['Username'];
$Email = $_POST['Email'];
$Displayname = $_POST['Displayname'];
$Description = $_POST['Description'];
$Firstname = $_POST['Firstname'];
$Lastname = $_POST['Lastname'];
// TODO: Security



$UpdateInfo = $mysqli -> prepare("UPDATE user SET Username=?, Email=?, Displayname=?, Description=?, Firstname=?, Lastname=? WHERE ID_User = ?");
$UpdateInfo -> bind_param('ssssssi', $Username, $Email, $Displayname, $Description, $Firstname, $Lastname, $_SESSION['ID_User']);
if($UpdateInfo ->execute()){
    echo "suc6";
    header('location: ../channel_info.php');
}else{
    echo "oops something went wrong! ".$UpdateInfo -> error;
}