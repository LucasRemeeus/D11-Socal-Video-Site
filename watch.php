<?php
session_start();

if (!isset($_GET['watch'])){
    header('Location:index.php');
}


require "php/config.php";

    $getVideo = $mysqli -> prepare("SELECT * FROM video WHERE ID_Video = ?");
    $getVideo -> bind_param("i", $_GET['watch']);
    $getVideo -> execute();




$getVideoResult = $getVideo -> get_result();

while ($Video = $getVideoResult -> fetch_assoc()){

    $getdata = $mysqli -> prepare("SELECT ID_User, Username, ProfilePicture FROM user where ID_User =?");
    $getdata -> bind_param('i', $Video['ID_User']);
    $getdata -> execute();
    $getdata -> bind_result($DataUserID,$DataUserName, $DataProfilePicture);
    $getdata -> fetch();
    $getdata -> store_result();
    $getdata -> close();

    $getlikes = $mysqli -> prepare("SELECT COUNT(`ID_Subscribe`) FROM `subscribe` where ID_User = ?");
    $getlikes -> bind_param('i', $DataUserID);
    $getlikes -> execute();
    $getlikes -> bind_result($Subscribers);
    $getlikes -> fetch();
    $getlikes -> store_result();
    $getlikes -> close();


function Updateviews($mysqli){
    
    $Updateviews = $mysqli -> prepare("UPDATE `video` SET `Views` = `Views` +1 WHERE ID_Video = ?");
    $Updateviews -> bind_param("i", $_GET['watch']);
    $Updateviews -> execute();
}

Updateviews($mysqli);

$Getviews = $mysqli -> prepare("SELECT `Views` FROM `video` WHERE ID_Video = ?");
$Getviews -> bind_param("i", $_GET['watch']);
$Getviews -> execute();
$Getviews -> bind_result($Views);
$Getviews -> fetch();
$Getviews -> store_result();
$Getviews -> close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Watch</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
        integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
        crossorigin="anonymous"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="css/watch.css">

    <!-- De font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

    <!-- Jquery link -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="js/ajax.js">   </script>
</head>

<body onload="GetLike(<?php echo $_GET['watch']; ?>), GetSub(<?php echo $DataUserID; ?>), GetComment(<?php echo $_GET['watch']; ?>)">
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
                <a class="navbar-brand" href="index.php">
                    <img class="logo" src="img/TwotchLogo.png" alt="Profile Logo">
                </a>
            </li>
        </ul>
    </nav>

    <!-- Main content -->
    <div class="container-fluid col-10 mt-3 container">
        <br>
        <video width="100%"   title="Video iframe" controls>
        <source src="upload/<?php echo $Video['Video'] ?>" type="video/mp4">
        </video>

        <h3><?php echo $Video['Title'] ?></h3>
        <div class="col-3 row likes">
            <div class="col-sm">
                <?php echo "Views: " . $Views; ?>
            </div>
        <div id="likes"></div>
        </div>
        <hr>
        <div class="channelinfo">
            <div class="channelpf">
                <img src="upload/profilepicture/<?php echo $DataProfilePicture; ?>">
            </div>
            <div class="channelname">
                <a href="channel.php?ID=<?php echo $DataUserID;?>"><h4><?php echo $DataUserName;?> </h4></a>
                <h5><?php echo $Subscribers;?> subscribers</h5>
            </div>
            <?php
            if($DataUserID !== $_SESSION['ID_User']){
            ?>
            <a onclick="Subscribe(<?php echo $DataUserID ?>)">
                <div id="subscribeButton" class="subscribeButton">

                </div>
            </a>
            <?php
            }
            ?>
        </div>
        <?php
        if($_SESSION['Loggedin'] == true){
        ?>
        <div>
            <form method="post" onsubmit="return Comment();">
                <input type="number" name="ID_Video" id="ID_Video" value="<?php echo $_GET['watch'] ?>" hidden>
                <input type="text" name="comment" value="" id="comment">
                <input type="submit" value="submit">
            </form>
        </div>
            <?php
        }
        ?>
        <div id="Comments">

        </div>

        </div>





    <?php
    }
    ?>
    <!-- Sidebar -->
    <aside class="col-6 col-md-1 p-0 flex-shrink-1 sidebar">
        <nav class="navbar navbar-expand flex-row align-items-start py-2">
            <div class="collapse navbar-collapse ">
                <ul class="flex-md-column flex-row navbar-nav w-100 justify-content-between">
                    <p>Followed Channels</p>
                    <?php
                        $follow = $mysqli -> prepare("SELECT * FROM subscribe WHERE ID_Subscriber = ? LIMIT 10");
                        $follow -> bind_param("i", $_SESSION['ID_User']);
                        $follow -> execute();

                        $followResult = $follow -> get_result();

                    while ($followlist= $followResult -> fetch_assoc())
                        {

                            $getfollow = $mysqli -> prepare("SELECT ID_User, Username, ProfilePicture FROM user where ID_User =?");
                            $getfollow -> bind_param('i', $followlist['ID_User']);
                            $getfollow -> execute();
                            $getfollow -> bind_result($FollowUserID,$FollowUserName, $FollowProfilePicture);
                            $getfollow -> fetch();
                            $getfollow -> store_result();
                            $getfollow -> close();



                    ?>
                    <li class="nav-item">
                        <a class="nav-link pl-0 text-nowrap" href="channel.php?ID=<?php echo $FollowUserID ?>"><img width="30px" src="upload/profilepicture/<?php echo $FollowProfilePicture ?>"><span class="d-none d-md-inline"><?php echo $FollowUserName ?></span></a>
                    </li>
                    <?php
                        }
                    ?>
                </ul>
            </div>
        </nav>
    </aside>
</body>

</html>