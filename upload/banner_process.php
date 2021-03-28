<?php
require '../php/config.php';
session_start();
function resizeImage($resourceType,$image_width,$image_height) {
    $resizeWidth = 1800;
    $resizeHeight = 400;
    $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
    imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
    return $imageLayer;
}

$getdata = $mysqli -> prepare("SELECT Banner, Username FROM user where ID_User =?");
$getdata -> bind_param('i', $_SESSION['ID_User']);
if($getdata -> execute()){
    $getdata -> bind_result($DataProfilePicture, $DataUserName);
    $getdata -> fetch();
    $getdata -> close();

    if(isset($_POST["banner_submit"])) {
        $imageProcess = 0;
        if(is_array($_FILES)) {
            $fileName = $_FILES['upload_banner']['tmp_name'];
            $sourceProperties = getimagesize($fileName);
            $resizeFileName = $DataUserName.time();
            $uploadPath = "banner/";
            $fileExt = pathinfo($_FILES['upload_banner']['name'], PATHINFO_EXTENSION);
            $uploadImageType = $sourceProperties[2];
            $sourceImageWidth = $sourceProperties[0];
            $sourceImageHeight = $sourceProperties[1];
            switch ($uploadImageType) {
                case IMAGETYPE_JPEG:
                    $resourceType = imagecreatefromjpeg($fileName);
                    $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                    imagejpeg($imageLayer,$uploadPath.$resizeFileName.'.'. $fileExt);
                    break;

                case IMAGETYPE_PNG:
                    $resourceType = imagecreatefrompng($fileName);
                    $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                    imagepng($imageLayer,$uploadPath.$resizeFileName.'.'. $fileExt);
                    break;

                default:
                    $imageProcess = 0;
                    break;
            }

            if($fileName !== "" && $DataProfilePicture !== "wauw.png"){
                if (file_exists($uploadPath.$DataProfilePicture)) {
                    unlink($uploadPath.$DataProfilePicture);
                }
            }

            if (file_exists($uploadPath.$DataProfilePicture) && $DataProfilePicture !== "wauw.png") {
                unlink($uploadPath.$DataProfilePicture);
            }

            if(move_uploaded_file($imageLayer, $uploadPath. $resizeFileName. ".". $fileExt)){
                $imageProcess = 1;
            }else{
                echo "file not moved";
                $imageProcess = 1;
            }

        }
        if($_FILES['upload_banner']['tmp_name'] == ""){
            $imageProcess = 0;
        }
        if($imageProcess == 1){

            $databasename = $resizeFileName.".".$fileExt;

            Echo $databasename;
            echo $_SESSION['ID_User'];

            $DatabaseUpdate = $mysqli -> prepare("UPDATE `user` SET `Banner` = ? WHERE `user`.`ID_User` = ?");
            $DatabaseUpdate -> bind_param('si', $databasename, $_SESSION['ID_User']);

            if($DatabaseUpdate -> execute()){
                header('location:../channel_info.php');
            }
        }else{

        }
        $imageProcess = 0;
    }
}
?>