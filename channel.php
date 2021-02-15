<?php
session_start();

require "php/config.php";

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
</head>

<body>
  <nav class="navbar navbar-expand-lg nav">
    <a class="navbar-brand" href="index.php">
      <img class="logo" src="img/TwotchLogo.png" alt="TwotchLogo">
    </a>
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link link active" href="#">Browse</a>
      </li>
      <li class="nav-item">
        <a class="nav-link link" href="#">Following</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <?php if($_SESSION['Loggedin'] == true ) 
        { ?><a class="nav-link button-link button-login" href="php/logout.php">&nbsp Log out &nbsp</a> <?php } 
        else 
        { ?> <a class="nav-link button-link button-login" href="login.php">&nbsp Log in &nbsp</a> <?php } ?>
      </li>
      <li class="nav-item">
        <?php if($_SESSION['Loggedin'] == !true ) 
      { ?><a class="nav-link button-link button-signup" href="register.php">Sign up</a><?php } ?>
      </li>
      <li class="nav-item">
        <a class="navbar-brand" href="#">
          <img class="logo" src="img/TwotchLogo.png" alt="Profile Logo">
        </a>
      </li>
    </ul>
  </nav>

  <!-- Page Content -->
  <aside class="col-12 col-md-2 p-0 flex-shrink-1">
    <nav class="navbar navbar-expand flex-row align-items-start py-2 sidebar">
      <div class="collapse navbar-collapse ">
        <ul class="flex-md-column flex-row navbar-nav w-100 justify-content-between">
          <p>Followed Channels</p>
          <li class="nav-item">
            <a class="nav-link pl-0 text-nowrap" href="#"><span class="d-none d-md-inline">|| PHP ||</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link pl-0" href="#"><span class="d-none d-md-inline">|| PHP ||</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link pl-0" href="#"><span class="d-none d-md-inline">|| PHP ||</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link pl-0" href="#"><span class="d-none d-md-inline">|| PHP ||</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link pl-0" href="#"><span class="d-none d-md-inline">|| PHP ||</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link pl-0" href="#"><span class="d-none d-md-inline">|| PHP ||</span></a>
          </li>
        </ul>
      </div>
    </nav>
  </aside>

 

   

    <div class="container-fluid mt-5 col-10 container">

      <div class="banner">
        <img class="bannerphoto" src="img/wauw.png">
      </div>

        <div class="ChannelInfo">
          
        <div class="channelpf">
                <img src="img/TwotchLogo.png">
            </div>


      

        <div class="ChannelName">
          <h1>/Channel Name\</h1>
          <h2>/Sub count\</h2>
        </div>

        <a href="#">
                <div class="subscribeButton">
                    <h2>Subscribe</h2>
                </div>
            </a>

      </div>

      <div class="vids">

        <div class="container-fluid container-vid">
          <div class="row">
            <div class="col-md vid">
              &nbsp
            </div>
            <div class="col-md vid">
              &nbsp
            </div>
            <div class="col-md vid">
              &nbsp
            </div>
            <div class="col-md vid">
              &nbsp
            </div>
            <div class="col-md vid">
              &nbsp
            </div>
            <div class="col-md vid">
              &nbsp
            </div>
          </div>
        </div>

        <div class="container-fluid container-vid">
          <div class="row">
            <div class="col-md vid">
              &nbsp
            </div>
            <div class="col-md vid">
              &nbsp
            </div>
            <div class="col-md vid">
              &nbsp
            </div>
            <div class="col-md vid">
              &nbsp
            </div>
            <div class="col-md vid">
              &nbsp
            </div>
            <div class="col-md vid">
              &nbsp
            </div>
          </div>
        </div>


      </div>
    </div>

  


</body>

</html>