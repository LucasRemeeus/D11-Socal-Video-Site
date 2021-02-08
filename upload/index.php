<!DOCTYPE html>

<?php
session_start();
if ( $_SESSION['loggedin'] !== true) {
    header("location:../index.php");
    die();
}

?>

<head>
    <title></title>
</head>

<body>

<form action="upload_process.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload"><br><br>
    tittle:
    <input type="text" name="title"><br><br>
    <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>
