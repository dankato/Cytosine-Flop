<?php
if(isset($_POST['loginButton'])) {
  // echo "login button was pressed";
  $username = $_POST['loginUsername'];
  $password = $_POST['loginPassword'];
  // Login function
  $result = $account->login($username, $password);
  if($result == true) {
    header('Location: index.php');
  }
}
?>
