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

<head>
    <title>dashboard</title>

    <!-- Jquery link -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <!-- JS link -->
    <script src="js/ajax.js"></script>
</head>

<body onload="DashboardVids()">

<!--TODO: MODAL voor de rename-->


<?php echo $UserRow['Username'] ?>
<div id="resultaat"></div>
<div id="error"></div>
</body>
</html>
<?php
    }
    ?>