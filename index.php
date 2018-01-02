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
    <title></title>
  </head>
  <body>
    hello there
  </body>
</html>
