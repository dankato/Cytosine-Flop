<?php
  include("../../config.php");

  // query into db
  if(isset($_POST['name']) && isset($_POST['username'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $date = date("Y-m-d");
    $query = mysqli_query($con, "INSERT INTO playlists VALUES('', '$name', '$username', '$date')");
  } else {
    echo "Name or username paramenters not passed into the file";
    exit();
  }
?>
