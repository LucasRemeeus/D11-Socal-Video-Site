<?php
session_start();
require 'config.php';

$statement = $mysqli -> prepare("SELECT * FROM `video` WHERE ID_User = ? ORDER BY ID_Video DESC");
$statement->bind_param("i", $_SESSION['ID_User']);
$statement -> execute();
$result = $statement->get_result();
?>
        <table>
            <tr>
                <th>Video</th>
                <th>Titel</th>
                <th>Bewerk&nbsp;Titel</th>
                <th>Verwijder&nbsp;Video</th>
                <th>Views</th>
                <th>Comments</th>
                <th>Likes</th>
                <th>Dislikes</th>
            </tr>
            <?php
            while ($row = $result->fetch_assoc()) { 
                $getlikes = $mysqli -> prepare("SELECT COUNT(`ID_Like`) FROM `like` where ID_Video = ? and likes = 1");
                $getlikes -> bind_param('i', $row['ID_Video']);
                $getlikes -> execute();
                $getlikes -> bind_result($Likes);
                $getlikes -> fetch();
                $getlikes -> store_result();
                $getlikes ->close();

                $getlikes = $mysqli -> prepare("SELECT COUNT(`ID_Like`) FROM `like` where ID_Video = ? and likes = 0");
                $getlikes -> bind_param('i', $row['ID_Video']);
                $getlikes -> execute();
                $getlikes -> bind_result($Dislikes);
                $getlikes -> fetch();
                $getlikes -> store_result();
                $getlikes ->close();

                $getlikes = $mysqli -> prepare("SELECT COUNT(`ID_Comment`) FROM `comment` where ID_Video = ?");
                $getlikes -> bind_param('i', $row['ID_Video']);
                $getlikes -> execute();
                $getlikes -> bind_result($commentcount);
                $getlikes -> fetch();
                $getlikes -> store_result();
                $getlikes ->close();
                ?>
                
                <tr>
                    <td><video width="50%" src="upload/<?php echo $row['Video']?>"></video></td>
                    <td><a href="watch.php?watch=<?php echo $row['ID_Video'] ?>" ><?php echo $row['Title']?></a></td>
                    <td><a type="button" onclick="RenameVideo(ID_Video = <?php echo $row['ID_Video']?>, Title = '<?php echo $row['Title']?>')"><img src="img/pen.png" width="15%"></a></td>
                    <td><a type="button" onclick="DeleteVideo(ID_Video = <?php echo $row['ID_Video']?>)"><img src="img/prullenbak.png" width="15%"></a></td>
                    <td><?php echo $row['Views']?></td>
                    <td><?php echo $commentcount ?></td>
                    <td><?php echo $Likes?></td>
                    <td><?php echo $Dislikes?></td>
                </tr>
            <?php 
            } 
            ?>
    </table>