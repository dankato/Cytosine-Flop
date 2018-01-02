<!DOCTYPE html>

<?php
  include('includes/config.php');

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
</head>

<body>

  <div id="mainContainer">
    <div id="topContainer">
      <div class="">

      </div>
    </div>
    <div id="nowPlayingBarContainer">
      <div id="nowPlayingBar">

        <div id="nowPlayingLeft">
          <div class="content">
            <span class="albumLink">
                <img src="https://pbs.twimg.com/profile_images/923950005928452096/iBu5RASh_400x400.jpg" class="albumArtwork" alt="Album Artwork">
              </span>
            <div class="trackInfo">
              <span class="trackName">
                  <span>Song Name</span>
              </span>
              <span class="artistName">
                  <span>Artist Name</span>
              </span>
            </div>
          </div>
        </div>

        <div id="nowPlayingCenter">
          <div class="content playerControls">
            <div class="buttons">
              <button class="controlButton shuffle" title="Shuffle button" type="button" name="button">
                  <img src="assets/images/icons/shuffle.png" alt="Shuffle">
                </button>
              <button class="controlButton previous" title="Previous button" type="button" name="button">
                  <img src="assets/images/icons/previous.png" alt="Previous">
                </button>
              <button class="controlButton play" title="Play button" type="button" name="button">
                  <img src="assets/images/icons/play.png" alt="Play">
                </button>
              <button class="controlButton pause" title="Pause button" style="display: none;" type="button" name="button">
                  <img src="assets/images/icons/pause.png" alt="Pause">
                </button>
              <button class="controlButton next" title="Next button" type="button" name="button">
                  <img src="assets/images/icons/next.png" alt="Next">
                </button>
              <button class="controlButton repeat" title="Repeat button" type="button" name="button">
                  <img src="assets/images/icons/repeat.png" alt="Repeat">
                </button>
            </div>

            <div class="playbackBar">
              <span class="progressTime current">0.00</span>
              <div class="progressBar">
                <div class="progressBarBg">
                  <div class="progress">
                  </div>
                </div>
              </div>
              <span class="progressTime remaining">0.00</span>
            </div>

          </div>
        </div>
        <div id="nowPlayingRight">
          <div class="volumeBar">
            <button type="button" class="controlButton volumn" title="Volume button">
                <img src="assets/images/icons/volume.png" alt="Volume">
              </button>
            <div class="progressBar">
              <div class="progressBarBg">
                <div class="progress">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</body>

</html>
