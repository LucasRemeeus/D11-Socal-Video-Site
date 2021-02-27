<?php

require 'config.php';

$getlikes = $mysqli -> prepare("SELECT COUNT(`ID_Like`) FROM `like` where ID_Video = ? and likes = 1");
$getlikes -> bind_param('i', $_POST['ID_Video']);
$getlikes -> execute();
$getlikes -> bind_result($Likes);
$getlikes -> fetch();
$getlikes -> store_result();
$getlikes ->close();

$getlikes = $mysqli -> prepare("SELECT COUNT(`ID_Like`) FROM `like` where ID_Video = ? and likes = 0");
$getlikes -> bind_param('i', $_POST['ID_Video']);
$getlikes -> execute();
$getlikes -> bind_result($Dislikes);
$getlikes -> fetch();
$getlikes -> store_result();
$getlikes ->close();
?>
<div class="col-sm">
    <button onclick="Like(1, <?php echo $_POST['ID_Video']; ?>)"><?php echo $Likes; ?> Like</button>
</div>
<div class="col-sm">
    <button onclick="Like(0, <?php echo $_POST['ID_Video']; ?>)"><?php echo $Dislikes; ?> Dislike</button>
</div>