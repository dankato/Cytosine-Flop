<!DOCTYPE html>

<?php
  include('includes/config.php');

  // log out manual
  // session_destroy();

  if(isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = $_SESSION['userLoggedIn'];
  } else {
    header('Location: register.php');
  }
?>

<html>

<head>
  <meta charset="utf-8">
  <title>Welcome to Cytosine Flow</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

  <div id="mainContainer">
    <div id="topContainer">
      <?php include("includes/navbarContainer.php"); ?>
      <div id="mainViewContainer">
        <div id="mainContent">
          
        </div>
      </div>

    </div>
      <?php include("includes/nowPlayingBar.php"); ?>
  </div>
</body>

</html>
