<?php
  // retrieve playlist, 10 songs by random
  $songQuery = mysqli_query($con, "SELECT id FROM Songs ORDER BY RAND() LIMIT 10");
  // declaring an empty array
  $resultArray = array();
  // converting the result of the query above to the array,
  while($row = mysqli_fetch_array($songQuery)) {
    // push every item (song) into the array
    array_push($resultArray, $row['id']);
  }
  // converting resultArray(php) into json, because when a page loads, the php runs first. json_encode is a built in funciton, pass in the php array.
  $jsonArray = json_encode($resultArray)
?>

<script>

  $(document).ready(function() {
    currentPlaylist = <?php echo $jsonArray; ?>;
    audioElement = new Audio();
    setTrack(currentPlaylist[0], currentPlaylist, false);
  });

  function setTrack(trackId, newPlaylist, play) {
    // audioElement.setTrack('assets/music/bensound-anewbeginning.mp3');

    // ajax call, a way of executing php, w/o reloading the page when accessing the db
    // retrieve song from table with id (url, data to send, do this with the result)
    $.post("includes/handlers/ajax/getSongJson.php", { songId: trackId }, function(data) {

      var track = JSON.parse(data);
      // console.log(track);
      audioElement.setTrack(track.path);
      audioElement.play();
    })

    if(play == true) {
      audioElement.play();
    }
  }

  function playSong() {
  	$('.controlButton.play').hide();
  	$('.controlButton.pause').show();
  	audioElement.play();
  }

  function pauseSong() {
  	$('.controlButton.play').show();
  	$('.controlButton.pause').hide();
  	audioElement.pause();
  }

</script>

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
          <button class="controlButton play" title="Play button" type="button" onclick="playSong()">
              <img src="assets/images/icons/play.png" alt="Play">
            </button>
          <button class="controlButton pause" title="Pause button" style="display: none;" type="button" onclick="pauseSong()">
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
