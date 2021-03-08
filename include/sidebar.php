<!-- Sidebar -->
<aside class="col-6 col-md-1 p-0 flex-shrink-1 sidebar">
      <nav class="navbar navbar-expand flex-row align-items-start py-2">
          <div class="collapse navbar-collapse ">
              <ul class="flex-md-column flex-row navbar-nav w-100 justify-content-between">
                  <p>Followed Channels</p>
                  <?php
                  $follow = $mysqli -> prepare("SELECT * FROM subscribe WHERE ID_Subscriber = ? LIMIT 10");
                  $follow -> bind_param("i", $_SESSION['ID_User']);
                  $follow -> execute();

                  $followResult = $follow -> get_result();

                  while ($followlist= $followResult -> fetch_assoc())
                  {

                      $getfollow = $mysqli -> prepare("SELECT ID_User, Username, ProfilePicture FROM user where ID_User =?");
                      $getfollow -> bind_param('i', $followlist['ID_User']);
                      $getfollow -> execute();
                      $getfollow -> bind_result($FollowUserID,$FollowUserName, $FollowProfilePicture);
                      $getfollow -> fetch();
                      $getfollow -> store_result();
                      $getfollow -> close();



                      ?>
                      <li class="nav-item">
                          <a class="nav-link pl-0 text-nowrap" href="channel.php?ID=<?php echo $FollowUserID ?>"><img width="30px" src="upload/profilepicture/<?php echo $FollowProfilePicture ?>"> <span class="d-none d-md-inline"><?php echo $FollowUserName ?> </span></a>
                      </li>
                      <?php
                  }
                  ?>
              </ul>
          </div>
      </nav>
  </aside>