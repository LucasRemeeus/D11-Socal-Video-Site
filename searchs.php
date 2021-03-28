<?php
session_start();

require "php/config.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
            integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
            crossorigin="anonymous"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">

    <!-- De font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

    <!-- Jquery link -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <!-- Ajax -->
    <script src="js/ajax.js"></script>
</head>

<body onload="getVideo(`*`,`Random`), getVideo(`*`,`Result`)">
<!-- Navbar -->
<?php
include "include/nav.php";
?>
<!-- Sidebar -->
<?php
include "include/sidebar.php";

$search = "%{$_POST['search']}%";

$Getsearch = $mysqli -> prepare("Select * FROM video WHERE Title LIKE ?");
$Getsearch->bind_param("s", $search);
$Getsearch->execute();
$Getsearchresult = $Getsearch->get_result();
if(mysqli_num_rows($Getsearchresult)){
    echo '<table>';
    while ($row = $Getsearchresult->fetch_assoc()){
        ?>
        <tr>
        <td><?php echo $row['Title'] ?></td>
            <td><a href="watch.php?watch=<?php echo $row['ID_Video'] ?>"><button class="btn">Watch</button></a></td>
        </tr>
<?php
    }
    echo "</table>";
}else{
    echo 'Geen video gevonden';
}
?>

<!-- Main content -->





</body>

</html>