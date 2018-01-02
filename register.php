<?php
  include('includes/config.php');
  include('includes/classes/Account.php');
  include('includes/classes/Constants.php');
  // creating new account & constants instance
  $account = new Account($con);
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
    <link rel="stylesheet" type="text/css" href="assets/css/register.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="assets/js/register.js"></script>
  </head>
  <body>
    <?php
      if(isset($_POST['registerButton'])) {
        echo '
          <script>
            $(document).ready(function() {

              $("#loginForm").hide();
              $("#registerForm").show();
            });

          </script>
        ';
      } else {
        echo '
          <script>
              $(document).ready(function() {

                $("#loginForm").show();
                $("#registerForm").hide();
              });

            </script>
        ';
      }
    ?>


    <div id="background">

      <div id="loginContainer">

        <!-- LOGIN ACCOUNT -->
        <div id="inputContainer">
          <form id="loginForm" action="register.php" method="post">
            <h2>Login to your account</h2>
            <p>
              <?php echo $account->getError(Constants::$loginFailed); ?>
              <label for="loginUsername">Username</label>
              <input id="loginUsername" type="text" name="loginUsername" placeholder="e.g. Bob Doe" required>
            </p>
            <p>
              <label for="loginPassword">Password</label>
              <input id="loginPassword" type="password" name="loginPassword" placeholder="Your password" required>
            </p>
            <button type="submit" name="loginButton">Login</button>

            <div class="hasAccountText">
              <span id="hideLogin">Don't have an account? Sign up here.</span>
            </div>

          </form>

          <!-- REGISTER ACCOUNT -->
          <form id="registerForm" action="register.php" method="post">
            <h2>Create your free account</h2>
            <p>
              <?php echo $account->getError(Constants::$usernameTaken); ?>
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
              <?php echo $account->getError(Constants::$emailTaken); ?>
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

            <div class="hasAccountText">
              <span id="hideRegister">Already have an account? Sign in here.</span>
            </div>

          </form>

        </div>

        <div id="loginText">
          <h1>Looking for music?</h1>
          <h2>Starting listening now!</h2>
          <ul>
            <li>Discover music</li>
            <li>Create playlists</li>
            <li>Follow friends & artists</li>
          </ul>
        </div>

      </div>
    </div>
  </body>
</html>
