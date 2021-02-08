<?php
session_start();
require '../php/config.php';
if ( $_SESSION['Loggedin'] !== true) {
    header("location:./index.php");
    die();
}

$target_dir = "video/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$title = $_POST['title'];
$catagory = $_POST['catagory'];

// Check if file video exists
if (file_exists($target_dir. $title.".".$imageFileType)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 50000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Only allow mp4 files
if($imageFileType != "mp4") {
    echo "Sorry, only mp4 files are allowed.";
    $uploadOk = 0;
}

// Check if no errors
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// Upload the video
} else {
    $uplaodfile = $target_dir. $title.".".$imageFileType;
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $uplaodfile)) {
        $VideoUpload = $mysqli->prepare("INSERT INTO `video` (`ID_Video`, `Video`, `ID_User`, `Catagory`, `Title`) VALUES (NULL, ?, ?, ?,?)");
        $VideoUpload -> bind_param('siis',$uplaodfile, $_SESSION['ID_User'],$catagory, $title );
        if($VideoUpload ->execute()){
            header("location:index.php");
        }

        echo "The file ". $title.".".$imageFileType. " has been uploaded.";

    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>