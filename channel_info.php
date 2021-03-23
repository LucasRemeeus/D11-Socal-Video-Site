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
  <!-- Navbar -->
  <?php
    include "include/nav.php";
  ?>

  <!-- Sidebar -->
  <?php
    include "include/sidebar.php";
  ?>

  <div class="container-fluid mt-5 col-10 container">

    <h1>Change Your Info</h1> <br>
    <div class="formInfo">
      <br>
      <form action="php/Channel_Edit.php" method="post" class="info-form">
        <label for="Username" class="label">Username </label>
        <input name="Username" id="Username" type="text" value="<?php echo $UserRow['Username'] ?>"
          class="input"><br><br>
        <hr>

        <label for="Email" class="label">Email: </label>
        <input name="Email" id="Email" type="email" value="<?php echo $UserRow['Email'] ?>" class="input"><br><br>
        <hr>

        <label for="Description" class="label">Description: </label>
        <input name="Description" id="Description" type="text" value="<?php echo $UserRow['Description'] ?>"
          class="input"><br><br>
        <hr>

        <label for="Firstname" class="label">First name: </label>
        <input name="Firstname" id="Firstname" type="text" value="<?php echo $UserRow['Firstname'] ?>"
          class="input"><br><br>
        <hr>

        <label for="Lastname" class="label">Last name: </label>
        <input name="Lastname" id="Lastname" type="text" value="<?php echo $UserRow['Lastname'] ?>"
          class="input"><br><br>
        <hr>

        <button type="submit" class="offset saveinfo">Save</button><br><br>
      </form>
    </div>


    <h1>Change Your Profile Photo</h1> <br>
    <div class="form1">
      <form action="upload/profilepicture_process.php" method="post" enctype="multipart/form-data" runat="server"
        class="photo-form">
        <img class="preview" style="height: 200px; width: 200px;" id="preview"
          src="upload/profilepicture/<?php echo $UserRow['ProfilePicture'] ?>"><br>

        <input type="file" class="inputfile" accept="image/png, image/jpeg," required id="imgInp" name="upload_image"><br>

        <button type="submit" class="offset" name="form_submit">Save</button><br><br>

        <script>
          function readpfp(input) {
            if (input.files && input.files[0]) {
              var reader = new FileReader();

              reader.onload = function (e) {
                $('#preview').attr('src', e.target.result);
              }

              reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
          }

          $("#imgInp").change(function () {
            readpfp(this);
          });
        </script>

      </form>
    </div>


    <h1>Change Your Banner</h1> <br>
    <div class="form1 buttons">
      <form action="upload/banner_process.php" method="post" enctype="multipart/form-data" runat="server"
        class="photo-form">
        <img class="preview banner" style="height: 400px; width: 1550px;" id="previewbanner"
          src="upload/banner/<?php echo $UserRow['Banner'] ?>"><br>

        <input class="inputfile" type="file" accept="image/png, image/jpeg," required id="bannerInp" name="upload_banner"><br>

        <button type="submit" class="offset" name="banner_submit">Save</button><br><br>

        <script>
          function readURL(input) {
            if (input.files && input.files[0]) {
              var reader = new FileReader();

              reader.onload = function (e) {
                $('#previewbanner').attr('src', e.target.result);
              }

              reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
          }

          $("#bannerInp").change(function () {
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