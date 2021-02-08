<!DOCTYPE html>

<?php
session_start();
require '../php/config.php';
if ( $_SESSION['Loggedin'] !== true) {
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

    <select name="catagory" id="catagory">

        <?php
        $statement = $mysqli -> prepare("SELECT ID_Catagory, Catagory FROM `catagory`");
        $statement -> execute();
        $result = $statement->get_result();
        while ($row = $result->fetch_assoc()){

            ?>
            <option value="<?php echo $row['ID_Catagory'];?>"><?php echo $row['Catagory'];?></option>
        <?php }?>
    </select>

    <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>
