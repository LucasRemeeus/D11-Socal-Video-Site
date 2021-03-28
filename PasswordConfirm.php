<?php

require 'php/config.php';

if(isset($_GET['token'])){
    $tokencheck = $mysqli->prepare("SELECT * FROM passwordreset WHERE Token = ?");
    $tokencheck->bind_param('s', $_GET['token']);
    $tokencheck->execute();
    $tokencheckResult = $tokencheck -> get_result();
    $curDate = date("Y-m-d H:i:s");

    if ($tokencheckResult->num_rows !== 0 || $tokencheckResult->num_rows >! 1)
    {
        while ($reset = $tokencheckResult -> fetch_assoc()){
            if ($reset['Exp_date'] > $curDate){
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
        integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
        crossorigin="anonymous"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="css/login.css">

    <!-- De font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

    <!-- Jquery link -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <!-- Ajax -->
    <script src="js/ajax.js"></script>

</head>
<body>
    
<form  class="login-form" method="post" action="php/reset_process.php">
    <img src="img/TwotchLogo.png"><h1>Password Reset</h1>
    <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>" >
        <div class="textb">
            <p>New Password</p>
            <input type="password" name="password">
            <br><br>
            
        </div>
        <div class="textb">
            <p>Confirm Password</p>
            <input type="password" name="password2">
            <br><br>
            
        </div>
    
    <input  class="btn fas fa-arrow-right" type="submit" name="submit">
</form>

</body>
</html>

<?php
            }else{
                echo "your token has expired";
            }
        }
    }else{
        echo "your token is invalid";
    }
}else{
    echo "you need a token";
}