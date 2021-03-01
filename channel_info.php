<?php
session_start();
if ( $_SESSION['Loggedin'] ===! true) {
    header("location:index.php");
    die();
}
require 'php/config.php';
$GetUserData = $mysqli->prepare("SELECT * FROM user WHERE ID_User = ?");
$GetUserData->bind_param('i', $_SESSION['ID_User']);
$GetUserData->execute();
$GetUserDataResult = $GetUserData->get_result();
while ($UserRow = $GetUserDataResult->fetch_assoc()) {
 
    ?>

    <!DOCTYPE html>

    <head>
        <title>dashboard</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
            integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
            integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
            crossorigin="anonymous"></script>

        <!-- CSS -->
        <link rel="stylesheet" href="css/channelinfo.css">

        <!-- De font -->
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

        <!-- Jquery link -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <!-- JS link -->
        <script src="js/ajax.js"></script>
    </head>

    

    <body>
  <nav class="navbar navbar-expand-lg nav">
    <a class="navbar-brand" href="index.php">
      <img class="logo" src="img/TwotchLogo.png" alt="TwotchLogo">
    </a>
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link link active" href="index.php">Browse</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <?php if($_SESSION['Loggedin'] == true ) 
        { ?>
          <a class="nav-link button-link button-login" href="php/logout.php">&nbsp Log out &nbsp</a>
          <a class="nav-link button-link button-signup" href="upload/index.php">&nbsp Add Video &nbsp</a> <?php } 
        else 
        { ?> <a class="nav-link button-link button-login" href="login.php">&nbsp Log in &nbsp</a> <?php } ?>
      </li>
      <li class="nav-item">
        <?php if($_SESSION['Loggedin'] == !true ) 
      { ?><a class="nav-link button-link button-signup" href="register.php">Sign up</a><?php } ?>
      </li>
      <li class="nav-item">
        <a class="navbar-brand" href="channel.php">
          <img class="logo" src="img/TwotchLogo.png" alt="Profile Logo">
        </a>
      </li>
    </ul>
  </nav>

  <!-- Page Content -->
  <aside class="col-12 col-md-2 p-0 flex-shrink-1">
    <nav class="navbar navbar-expand flex-row align-items-start py-2 sidebar">
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

 

   

    <div class="container-fluid mt-5 col-10 container">

         <h1>Change Your Info</h1> <br>
        <div class="form1">
            <br>
        <form action="php/Channel_Edit.php" method="post" class="info-form">
            <label for="Username" class="label">Username </label>
            <input name="Username" type="text" value="<?php echo $UserRow['Username'] ?>" class="input"><br><br><hr>

            <label for="Email" class="label">Email: </label>
            <input name="Email" type="email" value="<?php echo $UserRow['Email'] ?>" class="input"><br><br><hr>

            <label for="Displayname" class="label">Display Name: </label>
            <input name="Displayname" type="text" value="<?php echo $UserRow['Displayname'] ?>" class="input"><br><br><hr>

            <label for="Description" class="label">Description: </label>
            <input name="Description" type="text" value="<?php echo $UserRow['Description'] ?>" class="input"><br><br><hr>

            <label for="Firstname" class="label">First name: </label>
            <input name="Firstname" type="text" value="<?php echo $UserRow['Firstname'] ?>" class="input"><br><br><hr>

            <label for="Lastname" class="label">Last name: </label>
            <input name="Lastname" type="text" value="<?php echo $UserRow['Lastname'] ?>" class="input"><br><br><hr>

            <input type="submit" name="submit" value="Save" class="save">
        </form>
        </div>


        <h1>Change Your Profile Photo</h1> <br>
    <div class="form1">
    <form action="upload/profilepicture_process.php" method="post" enctype="multipart/form-data" runat="server" class="photo-form">
        <img style="height: 200px; width: 200px;" id="preview" src="upload/profilepicture/<?php echo $UserRow['ProfilePicture'] ?>"><br>

        <input type="file" accept="image/png, image/jpeg," required id="imgInp" name="upload_image"><br>

        <input type="submit" value="Save" name="form_submit"><br>

        <script>
            function readpfp(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }

            $("#imgInp").change(function() {
                readpfp(this);
            });
        </script>

    </form>
    </div>

    
    <h1>Change Your Banner</h1> <br>
    <div class="form1">
    <form action="upload/banner_process.php" method="post" enctype="multipart/form-data" runat="server" class="photo-form">
        <img style="height: 400px; width: 1550px;" id="previewbanner" src="upload/banner/<?php echo $UserRow['Banner'] ?>"><br>

        <input type="file" accept="image/png, image/jpeg," required id="bannerInp" name="upload_banner"><br>

        <input type="submit" value="Save" name="banner_submit"><br>

        <script>
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#previewbanner').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }

            $("#bannerInp").change(function() {
                readURL(this);
            });
        </script>

    </form>
    </div>

     
    </div>

  


</body>
    </html>
    <?php
}

