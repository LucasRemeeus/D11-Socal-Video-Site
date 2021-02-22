<?php

require "config.php";

$Catagory = $_POST['Catagory'];

if ($Catagory == "*")
{
    $getVideo = $mysqli -> prepare("SELECT * FROM video WHERE Catagory LIMIT 10");
    $getVideo -> execute();
} else 
{
    $getVideo = $mysqli -> prepare("SELECT * FROM video WHERE Catagory = ? LIMIT 10");
    $getVideo -> bind_param("i", $Catagory);
    $getVideo -> execute();
}

$getVideoResult = $getVideo -> get_result();

while ($Video = $getVideoResult -> fetch_assoc())
{
    ?> 
    <h1><?php echo $Video['Title'] ?></h1>
    <?php
}



?>