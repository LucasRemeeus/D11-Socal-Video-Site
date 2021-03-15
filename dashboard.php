<?php
session_start();
if ( $_SESSION['Loggedin'] !== true) {
    header("location:index.php");
    die();
}
require 'php/config.php';
$GetUserData = $mysqli->prepare("SELECT * FROM user WHERE ID_User = ?");
$GetUserData->bind_param('i', $_SESSION['ID_User']);
$GetUserData->execute();
$GetUserDataResult = $GetUserData->get_result();
    while ($UserRow = $GetUserDataResult->fetch_assoc()) {

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
        integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
        crossorigin="anonymous"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="css/dashboard.css">

    <!-- De font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

    <!-- Jquery link -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <!-- Ajax -->
    <script src="js/ajax.js"></script>
</head>

<body onload="DashboardVids()">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg nav">
        <a class="navbar-brand" href="index.php">
            <img class="logo" src="img/TwotchLogo.png" alt="TwotchLogo">
        </a>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link link active" href="channel.php">Back</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                    <?php if($_SESSION['Loggedin'] == true ) 
        { ?>
                    <img class="logo" id="preview" src="upload/profilepicture/<?php echo $UserRow['ProfilePicture'] ?>"
                        alt="Profile Logo"></a>
                <?php } 
        else 
        { ?> <a class="navbar-brand" href="#"><img class="logo" src="img/TwotchLogo.png" alt="Twotch Logo"> <?php } ?>
                </a>
            </li>
        </ul>
    </nav>
    <!-- Sidebar -->
    <?php
    include "include/sidebar.php";
  ?>

    <!-- Main content -->
    <div class="container-fluid col-10 mt-3 container">
        <h1>Uploads</h1>

        <div id="resultaat"></div>
    </div>

</body>

</html>
<?php
    }
    ?>