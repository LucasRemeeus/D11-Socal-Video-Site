<?php
session_start();
?>

<form action="register_process.php" method="post">
    <label for="Username">Username:</label>
    <input type="text" name="Username" id="Username"><br>
    <label for="Password">Password:</label>
    <input type="password" name="Password" id="Password"><br>
    <label for="Password">Email:</label>
    <input type="email" name="Email" id="Email"><br>
    <input type="submit">
</form>

