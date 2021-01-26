<?php
session_start();

require_once'config.php';


$register = $mysqli->prepare("INSERT INTO `user` (`ID_User`, `Username`, `Password`, `Email`) VALUES (NULL, ?, ?, ?)");

$Username = $_POST['Username'];
$Password = $_POST['Password'];
$Email = $_POST['Email'];
$register->bind_param('sss', $Username, $Password, $Email);

$register->execute();
$register->close();


