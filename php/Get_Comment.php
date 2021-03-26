<?php
require 'config.php';
session_start();


$getComment = $mysqli -> prepare("SELECT * FROM comment WHERE ID_Video = ?");
$getComment -> bind_param("i", $_POST['VideoID']);
$getComment -> execute();

$getCommentResult = $getComment -> get_result();

while ($Comment = $getCommentResult -> fetch_assoc()){
    $getdata = $mysqli -> prepare("SELECT Username, ProfilePicture FROM user where ID_User =?");
    $getdata -> bind_param('i', $Comment['ID_User']);
    $getdata -> execute();
    $getdata -> bind_result($CommentUsername, $ProfilePicture);
    $getdata -> fetch();
    $getdata -> store_result();
    $getdata -> close();


    ?>
    <div class="CommentOutput">
        <img src="upload/profilepicture/<?php echo $ProfilePicture ?>" class="PFPhoto">
        <?php echo "<div class='CommentUser'>" . $CommentUsername . "</div>" ?>
        <?php echo "<div class='CommentDate'>" . $Comment['Date'] . "</div>" ?>
        <?php echo "<hr class='lijntje'>" ?>
        <?php echo "<div class='CommentContent'> <div class='comment'>"  . $Comment['Comment'] . "</div>" ?>
        <?php
        if($_SESSION['ID_User'] == $Comment['ID_User']){
            ?>
            <button class="DeleteKnop" onclick="DeleteComment(<?php echo $Comment['ID_Comment'] ?>)">Delete</button>
            <?php
        }
        echo "</div>";
        ?>
    </div>

    <?php
}
?>