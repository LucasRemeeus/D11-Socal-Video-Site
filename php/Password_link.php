<?php
session_start();
require 'config.php';

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

$email = $_POST['Email'];

$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$email = filter_var($email, FILTER_VALIDATE_EMAIL);

$Usernamecheck = $mysqli->prepare("SELECT ID_User, Username,Firstname,Lastname FROM user WHERE Email = ?");
$Usernamecheck->bind_param('s', $email);
$Usernamecheck->execute();




$UsernamecheckResult = $Usernamecheck->get_result();

if ($UsernamecheckResult->num_rows == 0 || $UsernamecheckResult->num_rows > 1) {
    echo "Sorry Email does not exist<br>";
    header("location:../PasswordReset.php");
}else {

    $ifexist = $mysqli->prepare("SELECT ID_Reset FROM passwordreset WHERE Email = ?");
    $ifexist->bind_param('s', $email);
    $ifexist->execute();
    $ifexistResult = $ifexist->get_result();
    if ($ifexistResult->num_rows >= 1) {
        echo "Sorry already send a email<br>";
        header("location:../PasswordReset.php");
    }else{

        $Usernamecheck->close();
        $userdata = $mysqli->prepare("SELECT ID_User, Username,Firstname,Lastname FROM user WHERE Email = ?");
        $userdata->bind_param('s', $email);
        $userdata->execute();
        $userdata->bind_result($ID_User, $Username, $Firstname, $Lastname);
        $userdata->fetch();
        $userdata->store_result();
        $userdata->close();

    $key = sha1(mt_rand(10000, 99999) . time() . $email);
    $expFormat = mktime(
        date("H"), date("i"), date("s"), date("m"), date("d") + 1, date("Y")
    );
    $expDate = date("Y-m-d H:i:s", $expFormat);

    $addLink = $mysqli->prepare("INSERT INTO `passwordreset` (`ID_Reset`,`Token`, `ID_User`, `Email`, Exp_date) VALUES (NULL, ?, ?, ?, ?)");
    $addLink->bind_param('siss', $key, $ID_User, $email, $expDate);
    if ($addLink->execute()) {


        $mail = new PHPMailer(true);

        try {
            $body = '
        <html>
        <head><title>Title</title></head>
        <body>
        http://localhost/Github/D11-Socal-Video-Site/PasswordConfirm.php?token=' . $key . '
        </body>
        </html>';

            $mail->SMTPDebug = 1;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   //Enable SMTP authentication
            $mail->Username = 'twotchemail@gmail.com';                     //SMTP username
            $mail->Password = 'twotchemail123';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('twotchemail@gmail.com', 'Mailer');
            $mail->addAddress($email);     //Add a recipient


            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Password reset';
            $mail->Body = $body;
            $mail->AltBody = $body;

            $mail->send();
            echo 'Message has been sent';
            header("location:../index.php");
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else
        echo $addLink->error;
    }
}



