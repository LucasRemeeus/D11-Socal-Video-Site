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
        <video width="30%" src="upload/<?php echo $row['Video']?>"></video>
        <button type="button" class="btn btn-secondary" onclick="RenameVideo(ID_Video = <?php echo $row['ID_Video']?>)"
            data-toggle="modal" data-target="#rename">
            Rename Video</button>
        <button type="button" class="btn btn-secondary"
            onclick="DeleteVideo(ID_Video = <?php echo $row['ID_Video']?>)">Delete Video</button>
    </div>
    <div class="modal fade" id="rename" tabindex="-1" role="dialog" aria-labelledby="renameLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="renameLabel">Rename your title here.</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="">
                        <div class="col">
                            <input type="text" class="form-control" name="Title" placeholder="Title*" id="Title" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-secondary" onclick="RenameVideo(ID_Video = 
                                    <?php echo $row['ID_Video']?>, Title = 
                                   $(" #Title").val();)">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
