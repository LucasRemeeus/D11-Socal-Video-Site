<?php
require 'php/config.php';
$vid = "%{$_POST['Search']}%";
$vidsearch = $mysqli -> prepare("SELECT DISTINCT `Title` FROM video WHERE `Title` LIKE ?");
$vidsearch->bind_param("s", $vid);
$vidsearch->execute();
$vidsearchresult = $vidsearch->get_result();
if(mysqli_num_rows($vidsearchresult)){
    echo '<table>';
    while ($row2 = $vidsearchresult->fetch_assoc()){
        echo "<tr>";
        echo "<td>".$row2['Title']. '</td>';
        echo "</tr>";
    }
    echo "</table>";
}else{
    echo 'Geen video gevonden';
}