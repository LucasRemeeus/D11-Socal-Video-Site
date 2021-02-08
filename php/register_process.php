<?php
session_start();

require_once 'config.php';

$errors = 0;

$register = $mysqli->prepare("INSERT INTO `user` (`ID_User`, `Username`, `Password`, `Email`) VALUES (NULL, ?, ?, ?)");

//check if fields are filled in
if (isset($_POST['Username']) &&
    isset($_POST['Password']) &&
    isset($_POST['Password_confirm']) &&
    isset($_POST['Email'])){ 
} else {
    $errors++;
}

// check username
$Username = $_POST['Username'];
$pattern = "/^[a-z\d_]{5,20}$/i";
if(!preg_match($pattern, $Username))
{
    $errors++;
}

// check password
$Password = $_POST['Password'];
$pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
if(!preg_match($pattern, $Password))
{
    echo "wrongpassword";
    $errors++;
}

// check password_confirm
$Password = $_POST['Password_confirm'];
$pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
if(!preg_match($pattern, $Password))
{
    echo "wrongpassword";
    $errors++;
}

if ($_POST['Password'] !== $_POST['Password_confirm']) {
    echo "Passwords do not match!";
    $errors++;
}

// check email
$Email = $_POST['Email'];
if(!filter_var($Email, FILTER_VALIDATE_EMAIL))
{
    $errors++;
}

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