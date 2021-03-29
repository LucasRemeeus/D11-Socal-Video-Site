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
    while ($Video = $Getsearchresult->fetch_assoc()){
        $getlikes = $mysqli -> prepare("SELECT COUNT(`ID_Like`) FROM `like` where ID_Video = ? and likes = 1");
        $getlikes -> bind_param('i', $Video['ID_Video']);
        $getlikes -> execute();
        $getlikes -> bind_result($Likes);
        $getlikes -> fetch();
        $getlikes -> store_result();
        $getlikes ->close();

        $getlikes = $mysqli -> prepare("SELECT COUNT(`ID_Like`) FROM `like` where ID_Video = ? and likes = 0");
        $getlikes -> bind_param('i', $Video['ID_Video']);
        $getlikes -> execute();
        $getlikes -> bind_result($Dislikes);
        $getlikes -> fetch();
        $getlikes -> store_result();
        $getlikes ->close();

        $getuser = $mysqli -> prepare("SELECT Username FROM `user` where ID_User = ?");
        $getuser -> bind_param('i', $Video['ID_User']);
        $getuser -> execute();
        $getuser -> bind_result($Username);
        $getuser -> fetch();
        $getuser -> store_result();
        $getuser ->close();

        ?>
        <ul class="CARDS">

        <li class="booking-card" style="background-image: src:upload/<?php echo $Video['Video'] ?>"  >

        <video width="100%" height="250px" src="upload/<?php echo $Video['Video']?>">

        </video>
            <div class="book-container">
                <div class="content">
                    <a href="watch.php?watch=<?php echo $Video['ID_Video'] ?>"><button class="btn">Watch</button></a>
                </div>
            </div>
            <div class="informations-container">
                <h2 class="title"><?php echo $Video['Title'] ?></h2>
                <p class="sub-title"><?php echo $Username ?></p>
                <div class="more-information">
                    <div class="info-and-date-container">
                        <div class="box info">
                            <svg class="icon" style="width:24px;height:24px" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M11,9H13V7H11M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M11,17H13V11H11V17Z" />
                            </svg>
                            <p>Views: <?php echo $Video['Views'] ?></p>
                        </div>
                        <div class="box date">
                            <p><?php echo $Likes?> Likes</p>
                            <p><?php echo $Dislikes?> Dislikes</p>
                        </div>
                    </div>
                    <p class="disclaimer"></p>
                </div>
            </div>
        </li>
        </ul>
<?php
    }
    echo "</table>";
}else{
    ?>
    <h1 class="no-video">Geen video gevonden</h1>
    <?php

}
?>

<!-- Main content -->
</body>

</html>