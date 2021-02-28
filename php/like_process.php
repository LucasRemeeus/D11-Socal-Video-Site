<?php
 require 'config.php';
 session_start();
$like = $_POST['like'];
$ID_Video = $_POST['ID_Video'];

if ($_SESSION['Loggedin'] == true && isset($_SESSION['ID_User'])){



if ($like == 1 || $like == 0){

    $Checklikes = $mysqli -> prepare("SELECT ID_Like,likes FROM `like` where ID_Video = ? and ID_User = ?");
    $Checklikes -> bind_param('ii', $ID_Video,$_SESSION['ID_User']);
    $Checklikes -> execute();
    $Checklikes -> bind_result($ID_like, $alreadyliked);
    $Checklikes -> fetch();
    $Checklikes -> store_result();
    $Checklikes ->close();

    if (!isset($alreadyliked)){
        $addLike = $mysqli->prepare("INSERT INTO `like` (`ID_Like`,`ID_User`, `ID_Video`, `likes`) VALUES (NULL, ?, ?, ?)");
        $addLike -> bind_param('iii',$_SESSION['ID_User'], $ID_Video, $like);
        $addLike -> execute();

    }else if($alreadyliked == 1 && $like == 0 || $alreadyliked == 0 && $like == 1){
        $ChangeLike = $mysqli->prepare("UPDATE `like` SET likes=? WHERE ID_User = ? AND ID_Like = ?");
        $ChangeLike -> bind_param('iii',$like,$_SESSION['ID_User'] , $ID_like);
        $ChangeLike -> execute();
    }else if($alreadyliked == 0 && $like == 0 || $alreadyliked == 1 && $like == 1){
        $ChangeLike = $mysqli->prepare("DELETE FROM `like` WHERE ID_Like = ? AND ID_User = ?");
        $ChangeLike -> bind_param('ii',$ID_like, $_SESSION['ID_User']);
        $ChangeLike -> execute();
    }

}
}