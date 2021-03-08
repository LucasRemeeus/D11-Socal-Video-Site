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

  <!-- Main content -->
  <div class="container-fluid col-10 mt-3 container">
    <h1>Browse</h1>
    <ul class="row">
      <li class="nav-item">
        <a class="nav-link button-link button-browse" onclick="getVideo(1,`Result`)">Speedrunners</a>
      </li>
      <li class="nav-item">
        <a class="nav-link button-link button-browse" onclick="getVideo(2,`Result`)">Gameplay</a>
      </li>
      <li class="nav-item">
        <a class="nav-link button-link button-browse" onclick="getVideo(3,`Result`)">Tutorials</a>
      </li>
      <li class="nav-item">
        <a class="nav-link button-link button-browse" onclick="getVideo(4,`Result`)">Ragequits</a>
      </li>
      <li class="nav-item">
        <a class="nav-link button-link button-browse" onclick="getVideo(0,`Result`)">Most Watched</a>
      </li>



      <ul class="row">
        <li class="nav-item">
          <a class="nav-link button-link button-videos" href="#">Videos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link button-link button-livechannels" href="#">Live Channels</a>
        </li>
      </ul>



      <div>
        <div class="container-fluid container-vid">
          <div class="row">
            <h3>Selected</h3>
            <div id="Result"></div>
          </div><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        </div>

        <div class="container-fluid container-vid">
          <div class="row">
            <h3>Random</h3>
            <div id="Random"></div>
          </div><br><br><br><br><br><br><br><br><br><br><br><br><br>
        </div>
        <div class="container-fluid container-vid">
          <div class="row">
            <h3>Followed</h3>
            <div id="Followed">
              <?php

                          $getVideoFollow = $mysqli -> prepare("SELECT * FROM video WHERE ID_User IN (SELECT subscribe.ID_User FROM subscribe WHERE subscribe.ID_Subscriber = ?) ORDER BY RAND() LIMIT 10");
                          $getVideoFollow -> bind_param("i", $_SESSION['ID_User']);
                          $getVideoFollow -> execute();

                            $getVideoFollowResult = $getVideoFollow -> get_result();

                            while ($Followed = $getVideoFollowResult -> fetch_assoc())
                      {
                          ?>
              <a href="watch.php?watch=<?php echo $Followed['ID_Video'] ?>">
                <div class="col-md vid">
                  <div class="titelText">
                    <h2><?php echo $Followed['Title'] ?></h2><br>
                  </div>
                  <video width="100%" src="upload/<?php echo $Followed['Video']?>"></video>
                </div>
              </a>
              <?php
                      }
                      ?>
            </div>
          </div><br><br><br><br><br><br><br><br><br><br><br><br><br>
        </div>
        <div class="container-fluid container-vid">
          <div class="row">
            <h3>Recent</h3>
            <div id="Followed">
              <?php

                      $getVideoFollow = $mysqli -> prepare("SELECT * FROM video ORDER BY ID_Video DESC LIMIT 10");

                      $getVideoFollow -> execute();

                      $getVideoFollowResult = $getVideoFollow -> get_result();

                      while ($Followed = $getVideoFollowResult -> fetch_assoc())
                      {
                          ?>
              <a href="watch.php?watch=<?php echo $Followed['ID_Video'] ?>">
                <div class="col-md vid">
                  <div class="titelText">
                    <h2><?php echo $Followed['Title'] ?></h2><br>
                  </div>
                  <video width="100%" src="upload/<?php echo $Followed['Video']?>"></video>
                </div>
              </a>
              <?php
                      }
                      ?>
            </div>
          </div>
        </div>

      </div>
  </div>



  <!-- Sidebar -->
  <?php
    include "include/sidebar.php";
  ?>
</body>

</html>