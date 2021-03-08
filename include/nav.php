<!-- Navbar -->
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
            <a class="nav-link button-link button-signup" href="upload/index.php">&nbsp Add Video &nbsp</a>
            <?php } 
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