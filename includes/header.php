<?php
  include('includes/config.php');
  include('includes/classes/Artist.php');
  include('includes/classes/Album.php');
  include('includes/classes/Song.php');
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
  <script type="text/javascript" src="assets/js/script.js"></script>
</head>

<body>
  <script>
    var audioElement = new Audio();
    audioElement.setTrack('assets/music/bensound-anewbeginning.mp3');
    audioElement.audio.play();
  </script>

  <div id="mainContainer">
    <div id="topContainer">
      <?php include("includes/navbarContainer.php"); ?>
      <div id="mainViewContainer">
        <div id="mainContent">
