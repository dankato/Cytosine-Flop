<?php
  include('includes/config.php');
  include('includes/classes/Artist.php');
  include('includes/classes/Album.php');
  include('includes/classes/Song.php');
  // log out manual
  // session_destroy();

  if(isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = $_SESSION['userLoggedIn'];
    echo "<script>userLoggedIn = '$userLoggedIn';</script>";
  } else {
    header("Location: register.php");
  }
?>

<html>

<head>
  <meta charset="utf-8">
  <title>Welcome to Cytosine Flow</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="assets/js/script.js"></script>
</head>

<body>

  <div id="mainContainer">
    <div id="topContainer">
      <?php include("includes/navbarContainer.php"); ?>
      <div id="mainViewContainer">
        <div id="mainContent">
