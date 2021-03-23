<?php
session_start();

require "php/config.php";

if (!isset($_GET['ID'])){
    $pageID = $_SESSION['ID_User'];
}else{
    $pageID = $_GET['ID'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Channel</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
    integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
    crossorigin="anonymous"></script>

  <!-- CSS -->
  <link rel="stylesheet" href="css/channel.css">

  <!-- De font -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

  <!-- Jquery link -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

  <script src="js/ajax.js"></script>
</head>

<body onload="GetSub(<?php echo $pageID; ?>), getVideoUser(<?php echo $pageID; ?>)">
  <!-- Navbar -->
  <?php
    include "include/nav.php";
    ?>

  <!-- Sidebar -->
  <?php
      include "include/sidebar.php";
    ?>




  <!-- Page Content -->

  <?php

$getlikes = $mysqli -> prepare("SELECT COUNT(`ID_Subscribe`) FROM `subscribe` where ID_User = ?");
$getlikes -> bind_param('i', $pageID);
$getlikes -> execute();
$getlikes -> bind_result($Subscribers);
$getlikes -> fetch();
$getlikes -> store_result();
$getlikes -> close();



  $channel = $mysqli -> prepare("SELECT * FROM user WHERE ID_User = ?");
  $channel -> bind_param("i", $pageID);
  $channel -> execute();

  $channelResult = $channel -> get_result();

  while ($channelData= $channelResult -> fetch_assoc())
  {
  ?>
  <div class="container-fluid mt-5 col-10 container">

    <div class="banner">
      <img class="bannerphoto" src="upload/banner/<?php echo $channelData['Banner'] ?>">
    </div>

    <div class="ChannelInfo">

      
      <div class="ChannelName">
        <div class="channelpf">
          <img class="channelpf" src="upload/profilepicture/<?php echo $channelData['ProfilePicture'] ?>">
        </div>
        <div class="Name"><?php echo $channelData['Username'] ?></div>
        <hr class="lijntje">
        <div class="Subs"><?php echo $Subscribers ?></div>
      </div>
      <?php if ($_SESSION['ID_User'] !== $pageID){ ?>
      <a href="#">
        <div onclick="Subscribe(<?php echo $channelData['ID_User'] ?>)" id="subscribeButton" class="subscribeButton">
        </div>
      </a>
      <?php } ?>
      <?php if($_SESSION['ID_User'] == $pageID ) { ?>
      <button class="offset "><a href="dashboard.php">Dashboard Videos</a></button>
      <button class="offset "><a href="channel_info.php">&nbsp Edit Profile &nbsp</a></button>
      <?php } ?>
      <br>

    </div>

    <div class="vids">

      <div class="container-fluid container-vid">
        <div class="row">
          <div id="Result"></div>
        </div>
      </div>

    </div>
  </div>




</body>

</html>
<?php
  }