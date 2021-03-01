<?php
require 'config.php';
session_start();


$getComment = $mysqli -> prepare("SELECT * FROM comment WHERE ID_Video = ?");
$getComment -> bind_param("i", $_POST['VideoID']);
$getComment -> execute();

$getCommentResult = $getComment -> get_result();

while ($Comment = $getCommentResult -> fetch_assoc()){
    $getdata = $mysqli -> prepare("SELECT Username FROM user where ID_User =?");
    $getdata -> bind_param('i', $Comment['ID_User']);
    $getdata -> execute();
    $getdata -> bind_result($CommentUsername);
    $getdata -> fetch();
    $getdata -> store_result();
    $getdata -> close();


    ?>
    <div>
        <?php echo $CommentUsername?>
        <?php echo $Comment['Comment']?>
        <?php echo $Comment['Date']?>
        <?php
        if($_SESSION['ID_User'] == $Comment['ID_User']){
            ?>
            <button onclick="DeleteComment(<?php echo $Comment['ID_Comment'] ?>)">Delete</button>
            <?php
        }
        ?>
    </div>

    <?php
}
?>