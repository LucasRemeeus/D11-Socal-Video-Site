<?php

require "config.php";

$ID = $_POST['ID'];


    $getVideo = $mysqli -> prepare("SELECT * FROM video WHERE ID_User = ?");
    $getVideo -> bind_param("i", $ID);
    $getVideo -> execute();


$getVideoResult = $getVideo -> get_result();

while ($Video = $getVideoResult -> fetch_assoc())
{
    ?>
    <a href="watch.php?watch=<?php echo $Video['ID_Video'] ?>"><div class="col-md vid">
            <h2><?php echo $Video['Title'] ?></h2>
            <video width="140%" src="upload/<?php echo $Video['Video']?>" ></video>
        </div></a>
    <?php
}
echo "oof";

$getVideo-> close();
?>