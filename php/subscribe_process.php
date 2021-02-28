<?php

session_start();


if ($_SESSION['Loggedin'] == true && isset($_SESSION['ID_User'])) {

    require 'config.php';
    $ChannelID = $_POST['ChannelID'];

    $Checklikes = $mysqli -> prepare("SELECT ID_Subscribe FROM `subscribe` where ID_Subscriber = ? and ID_User = ?");
    $Checklikes -> bind_param('ii', $_SESSION['ID_User'] , $ChannelID);
    $Checklikes -> execute();
    $ChecklikesResult = $Checklikes->get_result();

    if ($ChecklikesResult->num_rows >= 1) {
        $Subscribe = $mysqli->prepare("DELETE FROM `subscribe` WHERE ID_User = ? AND ID_Subscriber = ?");
    }else{
        $Subscribe = $mysqli->prepare("INSERT INTO `subscribe` (`ID_Subscribe`,`ID_User`, `ID_Subscriber`) VALUES (NULL, ?, ?)");
    }

    $Subscribe -> bind_param('ii', $ChannelID, $_SESSION['ID_User']);
    $Subscribe -> execute();
}