<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script src="ajax.js"></script>
</head>
<body>
<form onsubmit="return Register();" method="post">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username"><br>
    <label for="password">Password:</label>
    <input type="password" name="password" id="password"><br>
    <label for="email">Email:</label>
    <input type="email" name="email" id="email"><br>
    <input type="submit">
</form>
<div id="result"></div>
</body>
</html>