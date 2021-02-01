<?php
session_start();

require_once 'config.php';

$errors = 0;

$register = $mysqli->prepare("INSERT INTO `user` (`ID_User`, `Username`, `Password`, `Email`) VALUES (NULL, ?, ?, ?)");

$Username = $_POST['Username'];
$Password = $_POST['Password'];
$Email = $_POST['Email'];

$Usernamecheck = $mysqli->prepare("SELECT Username FROM user WHERE Username = ? OR Email = ?");
$Usernamecheck->bind_param('ss', $Username, $Email);
$Usernamecheck->execute();
$UsernamecheckResult = $Usernamecheck->get_result();
if ($UsernamecheckResult->num_rows >= 1) {
    echo "usernametaken";
    $errors++;
}



if ($errors == 0) {

    $hash = password_hash($Password, PASSWORD_BCRYPT);
    $register->bind_param('sss', $Username, $hash, $Email);

    if ($register->execute()) {
        echo "success";
    }else{
        echo "fail";
    }
}


$register->close();


