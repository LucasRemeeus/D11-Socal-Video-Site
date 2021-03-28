<?php

require "config.php";

$Catagory = $_POST['Catagory'];

if ($Catagory == "*")
{
    $getVideo = $mysqli -> prepare("SELECT * FROM video WHERE Catagory ORDER BY RAND() LIMIT 10");
    $getVideo -> execute();
} else if($Catagory == 0){
    $getVideo = $mysqli -> prepare("SELECT * FROM video ORDER BY Views DESC LIMIT 10");
    $getVideo -> execute();
}else {
    $getVideo = $mysqli -> prepare("SELECT * FROM video WHERE Catagory = ? ORDER BY RAND() LIMIT 10");
    $getVideo -> bind_param("i", $Catagory);
    $getVideo -> execute();
}

$getVideoResult = $getVideo -> get_result();


while ($Video = $getVideoResult -> fetch_assoc())
{
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
    ?>
<ul>
    <li class="booking-card"
        style="background-image: url(https://images.unsplash.com/photo-1578944032637-f09897c5233d?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=400&fit=max&ixid=eyJhcHBfaWQiOjE0NTg5fQ)">
        <div class="book-container">
            <div class="content">
                <a href="watch.php?watch=<?php echo $Video['ID_Video'] ?>"><button class="btn">Watch</button></a>
            </div>
        </div>
        <div class="informations-container">
            <h2 class="title"><?php echo $Video['Title'] ?></h2>
            <p class="sub-title"><?php echo $Video['ID_User'] ?></p>
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



?>