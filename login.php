<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
        integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
        crossorigin="anonymous"></script>
    <script src="js/ajax.js"></script>
</head>
<body>
    <form method="post" onsubmit="return Login();">
        <input type="text" name="username" id="username" placeholder="Username">
        <br>
        <input type="password" name="password" id="password" placeholder="Password">
        <br>
        <input type="submit" name="login" value="Loggin" id="login_button">
    </form>
    <div id="result"></div>

    <?php
        if ( $_SESSION['loggedin'] == true) {
            header("location:../index.php");
        }
    ?>
</body>
</html>