<?php

  include('includes/classes/Account.php');
  include('includes/classes/Constants.php');
  // creating new account & constants instance
  $account = new Account();
  $contstants = new Constants();

  include('includes/handlers/register-handler.php');
  include('includes/handlers/login-handler.php');

  function getInputValue($name) {
    if(isset($_POST[$name])) {
      echo $_POST[$name];
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Welcome to Cytosine Flop</title>
  </head>
  <body>
    <!-- LOGIN ACCOUNT -->
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

      <!-- REGISTER ACCOUNT -->
      <form id="registerForm" action="register.php" method="post">
        <h2>Create your free account</h2>
        <p>
          <?php echo $account->getError(Constants::$usernameCharacters); ?>
          <label for="username">Username</label>
          <input id="username" type="text" name="username" placeholder="e.g. BobDoe" value="<?php getInputValue('username') ?>" required>
        </p>

        <p>
          <?php echo $account->getError(Constants::$firstNameCharacters); ?>
          <label for="firstName">First Name</label>
          <input id="firstName" type="text" name="firstName" placeholder="e.g. Bob" value="<?php getInputValue('firstName') ?>" required>
        </p>

        <p>
          <?php echo $account->getError(Constants::$lastNameCharacters); ?>
          <label for="lastName">Last Name</label>
          <input id="lastName" type="text" name="lastName" placeholder="e.g. Doe" value="<?php getInputValue('lastName') ?>" required>
        </p>

        <p>
          <?php echo $account->getError(Constants::$emailDoNotMatch); ?>
          <?php echo $account->getError(Constants::$emailInvalid); ?>
          <label for="email">Email</label>
          <input id="email" type="email" name="email" placeholder="e.g. bdoe@email.com" value="<?php getInputValue('email') ?>" required>
        </p>

        <p>
          <label for="emailConfirmation">Confirm Email</label>
          <input id="emailConfirmation" type="email" name="emailConfirmation" placeholder="e.g. bdoe@email.com" value="<?php getInputValue('emailConfirmation') ?>" required>
        </p>

        <p>
          <?php echo $account->getError(Constants::$passwordsDoNotMatch); ?>
          <?php echo $account->getError(Constants::$emailInvalid); ?>
          <?php echo $account->getError(Constants::$passwordsCharacters); ?>
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
