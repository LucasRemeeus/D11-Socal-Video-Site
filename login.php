<?php
session_start();
error_reporting(0);

if ( $_SESSION['Loggedin'] == true) {
    header("location:index.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>


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
   

    <form method="POST" action="" class="login-form" onsubmit="return Login();">
        <img src="img/TwotchLogo.png"><h1>Log in to Twotch</h1>
        <div class="textb">
            <p>Username</p>
            <input type="text" name="username" id="username" required>
            <br><br>
            
        </div>

        <div class="textb">
            <p>Password</p>
            <input type="password" name="password" id="password" required>
        </div>
        <a href="">Forgot Password?</a>
        


        <button class="btn fas fa-arrow-right" type="submit" name="login" >Login</button>

        <p class="register">Don't have an account, click <a href="register.php" >Here</a></p>

    </form>
    <div id="result"></div>

    
</body>
</html>