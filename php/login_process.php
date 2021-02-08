<?php
require 'config.php';

$Username = $_POST['Username'];
$Password = $_POST['Password'];


    $GetUserData = $mysqli->prepare("SELECT * FROM user WHERE Username = ?");
    $GetUserData->bind_param('s', $Username);
    $GetUserData->execute();
    $GetUserDataResult = $GetUserData->get_result();

    if ($GetUserDataResult->num_rows >= 1) {
        while ($UserRow = $GetUserDataResult->fetch_assoc()) {
            if(password_verify($Password, $UserRow['Password'] )){
                echo "success";
                session_start();
                $_SESSION['Loggedin'] = true;
                $_SESSION['ID_User'] = $UserRow['ID_User'];
            }else{
                echo "fail";
            }
        }
    }else{
        echo "usernamefail";
    }