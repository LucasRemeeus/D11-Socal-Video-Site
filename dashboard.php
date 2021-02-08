<!DOCTYPE html>

<head>
    <title>dashboard</title>
    <script src="js/ajax.js"></script>
</head>

<body>

<?php
session_start();
require 'php/config.php';

$statement = $mysqli -> prepare("SELECT * FROM `video` WHERE ID_User = ?");
$statement->bind_param("s", $_SESSION['ID_User']);
$statement -> execute();
$result = $statement->get_result();

while ($row = $result->fetch_assoc()) { ?>
    <div style="margin: 5%">
        <video width="30%" src="upload/<?php echo $row['Video']?>" ></video>
        <button onclick="DeleteVideo(ID_Video = <?php echo $row['ID_Video']?>)">Delete Video</button>
    </div>
<?php } ?>

</body>
</html>
