<?php
session_start();
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
          <a class="nav-link button-link button-login" href="#">&nbsp Log in &nbsp</a>
        </li>
        <li class="nav-item">
          <a class="nav-link button-link button-signup" href="#">Sign up</a>
        </li>
        <li class="nav-item">
          <a class="navbar-brand" href="index.php">
            <img class="logo" src="img/TwotchLogo.png" alt="Profile Logo">
          </a>
        </li>
      </ul>
    </nav>

    <aside class="col-12 col-md-2 p-0 flex-shrink-1">
            <nav class="navbar navbar-expand flex-md-column flex-row align-items-start py-2 sidebar">
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
            <?php if(SESSION['ID_User']) { ?><button name="Logout"></button> <?php } else { ?> <button name="Login"></button> <?php } ?> 
    </div>    


</body>
</html>