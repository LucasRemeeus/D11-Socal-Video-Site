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
    <title>Dashboard</title>
    <!-- Jquery link -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <!-- Bootstrap Link -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="../css/dashboard.css">

    <!-- JS link -->
    <script src="js/ajax.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</head>

<body>

    <form class="formVideo" action="upload_process.php" method="post" enctype="multipart/form-data">
        <p>Select video to upload:</p>
        <input type="file" accept="video/mp4" name="fileToUpload" id="fileToUpload"><br><br>
        <p>Title:</p>
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