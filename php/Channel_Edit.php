<?php

$errors = 0;

session_start();
require 'config.php';

if (isset($_POST['Username']) && 
    isset($_POST['Email']) &&
    isset($_POST['Description']) && 
    isset($_POST['Firstname']) && 
    isset($_POST['Lastname'])){

   
}
else{
   $errors++;
    echo "Missing input";
}

// check username
$Username = $_POST['Username'];
$pattern = "/^[a-z\d_]{5,20}$/i";
if(!preg_match($pattern, $Username))
{
    echo "Wrong Username";
    $errors++;
}

$Usernamecheck = $mysqli->prepare("SELECT Username FROM user WHERE Username = ? AND NOT ID_User = ?");
$Usernamecheck->bind_param('si', $Username, $_SESSION['ID_User']);
$Usernamecheck->execute();
$UsernamecheckResult = $Usernamecheck->get_result();
if ($UsernamecheckResult->num_rows >= 1) {
    echo "Username Already Taken";
    $errors++;
}

//Check Email
$Email = $_POST['Email'];
if (!filter_var($Email, FILTER_VALIDATE_EMAIL)){
    echo "Wrong Email";
    $errors++;
}


$Description = $_POST['Description'];

$Firstname = $_POST['Firstname'];
if ($Firstname !== "") {
    $pattern = "/^[A-Za-z ]{1,32}$/i";
    if (!preg_match($pattern, $Firstname)) {
        echo "Wrong Firstname";
        $errors++;
    }
}
$Lastname = $_POST['Lastname'];
if ($Lastname !== ""){

$pattern = "/^[A-Za-z ]{1,32}$/i";
if(!preg_match($pattern, $Lastname)){
    echo "Wrong lastname";
    $errors++;
}
}






if ($errors == 0) {

    $UpdateInfo = $mysqli -> prepare("UPDATE user SET Username=?, Email=?,  Description=?, Firstname=?, Lastname=? WHERE ID_User = ?");
    $UpdateInfo -> bind_param('sssssi', $Username, $Email,  $Description, $Firstname, $Lastname, $_SESSION['ID_User']);

    if($UpdateInfo ->execute()){
    echo "suc6";
    header('location: ../channel_info.php');

    }else{
    echo "oops something went wrong! ".$UpdateInfo -> error;
    }

}

else{
    echo "<br/ >fail";
}
