<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
        integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
        crossorigin="anonymous"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="css/video.css">

    <!-- De font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

    <!-- Jquery link -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Navbar -->
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

    <!-- Main content -->
    <div class="container-fluid col-10 mt-3 container">
        <br>
        <iframe src="https://www.youtube.com/embed/NKHlTiV-Oug" title="Video iframe"></iframe>

        <h3>Title van video</h3>
        <div class="col-3 row likes">
            <div class="col-sm">
                Datum
            </div>
            <div class="col-sm">
                1 like
            </div>
            <div class="col-sm">
                0 dislike
            </div>
        </div>
        <hr>
        <div class="channelinfo">
            <div class="channelpf">
                <img src="img/TwotchLogo.png">
            </div>
            <div class="channelname">
                <h4>Channel name</h4>
                <h5>1,79K Subscribes</h5>
            </div>
            <a href="#">
                <div class="subscribeButton">
                    <h2>Subscribe</h2>
                </div>
            </a>
        </div>
    </div>


    <!-- <?php if(SESSION['ID_User']) { ?><button name="Logout"></button> <?php } else { ?> <button name="Login"></button> <?php } ?>  -->
    <!-- Sidebar -->
    <aside class="col-6 col-md-1 p-0 flex-shrink-1 sidebar">
        <nav class="navbar navbar-expand flex-row align-items-start py-2">
            <div class="collapse navbar-collapse ">
                <ul class="flex-md-column flex-row navbar-nav w-100 justify-content-between">
                    <p>Followed Channels</p>
                    <li class="nav-item">
                        <a class="nav-link pl-0 text-nowrap" href="#"><span class="d-none d-md-inline">|| PHP
                                ||</span></a>
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
</body>

</html>