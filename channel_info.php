<?php
session_start();
if ( $_SESSION['Loggedin'] ===! true) {
    header("location:index.php");
    die();
}
require 'php/config.php';
$GetUserData = $mysqli->prepare("SELECT * FROM user WHERE ID_User = ?");
$GetUserData->bind_param('i', $_SESSION['ID_User']);
$GetUserData->execute();
$GetUserDataResult = $GetUserData->get_result();
while ($UserRow = $GetUserDataResult->fetch_assoc()) {
 echo $_SESSION['ID_User'];
    ?>

    <!DOCTYPE html>

    <head>
        <title>dashboard</title>

        <!-- Jquery link -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"
                integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

        <!-- JS link -->
        <script src="js/ajax.js"></script>
    </head>

    <form action="php/Channel_Edit.php" method="post">
        <label for="Username">Username: </label>
        <input name="Username" type="text" value="<?php echo $UserRow['Username'] ?>"><br><br>

        <label for="Email">Email: </label>
        <input name="Email" type="email" value="<?php echo $UserRow['Email'] ?>"><br><br>

        <label for="Displayname">Display Name: </label>
        <input name="Displayname" type="text" value="<?php echo $UserRow['Displayname'] ?>"><br><br>

        <label for="Description">Description: </label>
        <input name="Description" type="text" value="<?php echo $UserRow['Description'] ?>"><br><br>

        <label for="Firstname">First name: </label>
        <input name="Firstname" type="text" value="<?php echo $UserRow['Firstname'] ?>"><br><br>

        <label for="Lastname">Last name: </label>
        <input name="Lastname" type="text" value="<?php echo $UserRow['Lastname'] ?>"><br><br>

        <input type="submit" name="submit" value="Save">
    </form>

    <form action="upload/profilepicture_process.php" method="post" enctype="multipart/form-data">
        <img style="height: 200px; width: 200px;" src="upload/profilepicture/<?php echo $UserRow['ProfilePicture'] ?>">

        <input type="file" accept="image/png, image/jpeg," required name="upload_image"><br>

        <input type="submit" value="Save" name="form_submit">
    </form>

    </body>
    </html>
    <?php
}

