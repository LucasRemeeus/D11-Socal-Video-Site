<?php

require 'config.php';
session_start();


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

if($_SESSION['Loggedin'] == true ){
?>


<div class="col-sm">
    <button class="like" onclick="Like(1, <?php echo $_POST['ID_Video']; ?>)"><?php echo $Likes; ?> Like</button>
</div>
<div class="col-sm">
    <button class="like" onclick="Like(0, <?php echo $_POST['ID_Video']; ?>)"><?php echo $Dislikes; ?> Dislike</button>
</div>
    <?php
}else{
?>
    <div class="col-sm">
        <button class="like"><?php echo $Likes; ?> Like</button>
    </div>
    <div class="col-sm">
        <button class="like"><?php echo $Dislikes; ?> Dislike</button>
    </div>
    <?php
}
?>