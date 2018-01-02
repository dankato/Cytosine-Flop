<?php
// turning on output buffering, when a php page loads it will send data to the server in pieces, waiting for all the data before sending it to the server
ob_start();

// enabling user sessions
session_start();

$timezone = date_default_timezone_set('America/Los_Angeles');

// server name, username, password, db name
$con = mysqli_connect('localhost', 'root', '', 'Cytosine-Flop');
if(mysqli_connect_errno()) {
  echo 'Failed to connect: ' . mysqli_connect_errno();
}
?>
