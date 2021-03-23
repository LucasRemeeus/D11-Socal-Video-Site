<?php
require 'config.php';

$token = $_POST['token'];
$Password = $_POST['password'];
$errors = 0;

if (strlen($Password) <= '8') {
    $errors++;
    echo "Your Password Must Contain At Least 8 Characters!<br>";
}
elseif(!preg_match("#[0-9]+#",$Password)) {
    $errors++;
    echo "Your Password Must Contain At Least 1 Number!<br>";
}
elseif(!preg_match("#[A-Z]+#",$Password)) {
    $errors++;
    echo "Your Password Must Contain At Least 1 Capital Letter!<br>";
}
elseif(!preg_match("#[a-z]+#",$Password)) {
    $errors++;
    echo "Your Password Must Contain At Least 1 Lowercase Letter!<br>";
} elseif(empty($Password)) {
    $errors++;
    echo "Please Check You've Entered Or Confirmed Your Password!";
}
if ($errors == 0){
    $getuser = $mysqli -> prepare("SELECT ID_User FROM passwordreset where Token =?");
    $getuser -> bind_param('i', $token);
    $getuser -> execute();
    $getuser -> bind_result($id_user);
    $getuser -> fetch();
    $getuser -> store_result();
    $getuser -> close();


    $hash = password_hash($Password, PASSWORD_BCRYPT);

    $UpdateInfo = $mysqli -> prepare("UPDATE user SET Password=? WHERE ID_User = ?");
    $UpdateInfo -> bind_param('ss', $hash, $id_user);

    if($UpdateInfo ->execute()) {

        $deleteToken = $mysqli -> prepare("DELETE FROM passwordreset where Token =?");
        $deleteToken -> bind_param('i', $token);
        if($deleteToken -> execute()){
            echo "password has ben reset";
        }
    }else{
        echo "something went wrong!";
    }
}