<?php

  include('includes/classes/Account.php');
  $account = new Account();

  include('includes/handlers/register-handler.php');
  include('includes/handlers/login-handler.php');

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Welcome to Cytosine Flop</title>
  </head>
  <body>
    <div id="inputContainer">
      <form id="loginForm" action="register.php" method="post">
        <h2>Login to your account</h2>
        <p>
          <label for="loginUsername">Username</label>
          <input id="loginUsername" type="text" name="loginUsername" placeholder="e.g. Bob Doe" required>
        </p>
        <p>
          <label for="loginPassword">Password</label>
          <input id="loginPassword" type="password" name="loginPassword" placeholder="Your password" required>
        </p>
        <button type="submit" name="loginButton">Login</button>
      </form>

      <form id="registerForm" action="register.php" method="post">
        <h2>Create your free account</h2>
        <p>
          <label for="username">Username</label>
          <input id="username" type="text" name="username" placeholder="e.g. BobDoe" required>
        </p>

        <p>
          <label for="firstName">First Name</label>
          <input id="firstName" type="text" name="firstName" placeholder="e.g. Bob" required>
        </p>

        <p>
          <label for="lastName">Last Name</label>
          <input id="lastName" type="text" name="lastName" placeholder="e.g. Doe" required>
        </p>

        <p>
          <label for="email">Email</label>
          <input id="email" type="email" name="email" placeholder="e.g. bdoe@email.com" required>
        </p>

        <p>
          <label for="emailConfirmation">Confirm Email</label>
          <input id="emailConfirmation" type="email" name="emailConfirmation"  placeholder="e.g. bdoe@email.com" required>
        </p>

        <p>
          <label for="password">Password</label>
          <input id="password" type="password" name="password" placeholder="Your password" required>
        </p>

        <p>
          <label for="passwordConfirmation">Confirm Password</label>
          <input id="passwordConfirmation" type="password" name="passwordConfirmation" placeholder="Your password" required>
        </p>

        <button type="submit" name="registerButton">Sign Up</button>
      </form>

    </div>
  </body>
</html>
