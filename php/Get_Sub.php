<?php

session_start();
require 'config.php';
$ChannelID = $_POST['ChannelID'];

$alreadySub = $mysqli -> prepare("SELECT `ID_Subscribe` FROM `subscribe` where ID_Subscriber = ? AND ID_User = ?");
$alreadySub -> bind_param('ii',$_SESSION['ID_User'] ,$ChannelID);
$alreadySub -> execute();
$alreadySubResult = $alreadySub->get_result();

if ($alreadySubResult->num_rows >= 1) {
    echo "<h2>Unsubscribe</h2>";
}else{
    echo "<h2>Subscribe</h2>";
}