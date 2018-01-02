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

    <div id="nowPlayingBarContainer">
      <div id="nowPlayingBar">
        <div id="nowPlayingLeft">

        </div>
        <div id="nowPlayingCenter">

        </div>
        <div id="nowPlayingRight">

        </div>
      </div>
    </div>

  </body>
</html>
