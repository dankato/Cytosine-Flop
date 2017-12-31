
<?php

function sanitizeFormUsername($inputText) {
  $inputText = strip_tags($inputText);
  $inputText = str_replace(' ', '', $inputText);
  return $inputText;
}

function sanitizeFormString($inputText) {
  $inputText = strip_tags($inputText);
  $inputText = str_replace(' ', '', $inputText);
  $inputText = ucfirst(strtolower($inputText));
  return $inputText;
}

function sanitizeFormPassword($inputText) {
  $inputText = strip_tags($inputText);
  return $inputText;
}


if(isset($_POST['registerButton'])) {
  // echo "register button was pressed";
  $username = sanitizeFormUsername($_POST['username']);
  $firstName = sanitizeFormString($_POST['firstName']);
  $lastName = sanitizeFormString($_POST['lastName']);
  $email = sanitizeFormString($_POST['email']);
  $emailConfirmation = sanitizeFormString($_POST['emailConfirmation']);
  $password = sanitizeFormPassword($_POST['password']);
  $passwordConfirmation = sanitizeFormPassword($_POST['passwordConfirmation']);

  $account->register($username, $firstName, $lastName, $email, $emailConfirmation, $password, $passwordConfirmation);
}

?>
