<?php
session_start();

require_once 'config.php';

$errors = 0;

$register = $mysqli->prepare("INSERT INTO `user` (`ID_User`, `Username`, `Password`, `Email`) VALUES (NULL, ?, ?, ?)");

// check if fields are filled in
if (isset($_POST['Username']) &&
    isset($_POST['Password']) &&
    isset($_POST['Email'])){ 
} else {
    $errors++;
}

// check username
$Username = $_POST['Username'];
$pattern = "/^(?=.{8,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])*$/";
if(!preg_match($pattern, $Username))
{
    $errors++;
}

// check password
$Password = $_POST['Password'];
$pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}*$/";
if(!preg_match($pattern, $Password))
{
    echo "wrongpassword";
    $errors++;
}

// check email
$Email = $_POST['Email'];
if(!filter_var($Email, FILTER_VALIDATE_EMAIL))
{
    $errors++;
}

// check if username and email aren't taken
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
        $last_id = $mysqli->insert_id;
        $_SESSION['ID_User'] = $last_id;
        $_SESSION['loggedin'] = true;
    }else{
        echo "fail";
    }
}

$register->close();