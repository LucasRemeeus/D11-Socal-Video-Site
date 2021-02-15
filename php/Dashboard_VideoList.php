<?php
session_start();
require 'config.php';

$statement = $mysqli -> prepare("SELECT * FROM `video` WHERE ID_User = ?");
$statement->bind_param("i", $_SESSION['ID_User']);
$statement -> execute();
$result = $statement->get_result();

while ($row = $result->fetch_assoc()) { ?>
    <div style="margin: 5%">
        <h3><?php echo $row['Title']?></h3>
        <video width="30%" src="upload/<?php echo $row['Video']?>" ></video>
        <button onclick="RenameVideo(ID_Video = <?php echo $row['ID_Video']?>)">Rename Video</button>
        <button onclick="DeleteVideo(ID_Video = <?php echo $row['ID_Video']?>)">Delete Video</button>
    </div>
<?php } ?>
