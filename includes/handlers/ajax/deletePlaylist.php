<?php
  include("../../config.php");

  // query into db
  if(isset($_POST['playlistId'])) {
    $playlistId = $_POST['playlistId'];
    $playlistQuery = mysqli_query($con, "DELETE FROM playlists WHERE id='$playlistId'");
    $songQuery = mysqli_query($con, "DELETE FROM playlistSongs WHERE playlistId='$playlistId'");
    } else {
    echo "PlaylistId was not passed into deletePlaylist.php.";
    exit();
  }
?>
