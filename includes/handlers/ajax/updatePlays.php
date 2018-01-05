<?php

  include('../../config.php');
  // sql call
  if(isset($_POST['songId'])) {
    $songId = $_POST['songId'];
    $query = mysqli_query($con, "UPDATE Songs SET plays = plays + 1 WHERE id='$songId'");

  }

?>
