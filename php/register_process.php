<?php
session_start();

require_once 'config.php';

$errors = 0;

$register = $mysqli->prepare("INSERT INTO `user` (`ID_User`, `Username`, `Password`, `Email`, `ProfilePicture`, `Banner`) VALUES (NULL, ?, ?, ?, 'TwotchLogo.png', 'wauw.png')");

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
    echo "Wrong Username!";
    $errors++;
}

// check password
$Password = $_POST['Password'];

if (strlen($_POST['Password']) <= '8') {
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
} elseif(!empty($_POST["password"])) {
    $errors++;
    echo "Please Check You've Entered Or Confirmed Your Password!";
}


// check password_confirm
if ($_POST['Password'] !== $_POST['Password_confirm'] && $errors == 0) {
    echo "Passwords do not match!<br>";
    $errors++;
}

// check email
$Email = $_POST['Email'];
if(!filter_var($Email, FILTER_VALIDATE_EMAIL))
{
    echo "Wrong email!<br>";
    $errors++;
}

// check if username and email aren't taken
$Usernamecheck = $mysqli->prepare("SELECT Username FROM user WHERE Username = ? OR Email = ?");
$Usernamecheck->bind_param('ss', $Username, $Email);
$Usernamecheck->execute();
$UsernamecheckResult = $Usernamecheck->get_result();
if ($UsernamecheckResult->num_rows >= 1) {
    echo "Sorry username already taken<br>";
    $errors++;
}


$Usernamecheck -> close();
if ($errors == 0) {


    $hash = password_hash($Password, PASSWORD_BCRYPT);
    $register->bind_param('sss', $Username, $hash, $Email,);

    if ($register->execute()) {
        echo "success";
        $last_id = $mysqli->insert_id;
        $_SESSION['ID_User'] = $last_id;
        $_SESSION['loggedin'] = true;
    }else{
        echo "fail<br>";
    }
}else{

}

$register->close();