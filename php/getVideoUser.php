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
   <a href="watch.php?watch=<?php echo $Video['ID_Video'] ?>">
            <div class="col-md vid">
                <div class="titelText">
                    <h2><?php echo $Video['Title'] ?></h2><br>
                </div>
                <video width="100%" src="upload/<?php echo $Video['Video']?>"></video>
            </div>
        </a>
    <?php
}


$getVideo-> close();
?>