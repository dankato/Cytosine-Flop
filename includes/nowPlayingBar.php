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
  // converting resultArray(php) into json, because when a page loads, the php runs first. json_encode is a built in function, pass in the php array.
  $jsonArray = json_encode($resultArray)
?>

<script>

  $(document).ready(function() {
    var newPlaylist = <?php echo $jsonArray; ?>;
    audioElement = new Audio();
    setTrack(newPlaylist[0], newPlaylist, false);
    updateVolumeProgressBar(audioElement.audio);

    $("#nowPlayingBarContainer").on("mousedown touchstart mousemove touchmove", function(e) {
      e.preventDefault();
    })

    // click drag
    $(".playbackBar .progressBar").mousedown(function() {
      console.log('mousedown')
    		mouseDown = true;
    	});

    $(".playbackBar .progressBar").mousemove(function(e) {
    	if(mouseDown == true) {
        console.log('mousemove')
    		//Set time of song, depending on position of mouse
    		timeFromOffset(e, this);
    	}
    });

    $(".playbackBar .progressBar").mouseup(function(e) {
    	timeFromOffset(e, this);
      console.log('mouseup')
    });

    // volume click drag
    $(".volumeBar .progressBar").mousedown(function() {
      mouseDown = true;
    });

    $(".volumeBar .progressBar").mousemove(function(e) {
      if(mouseDown == true) {
        var percentage = e.offsetX / $(this).width();
        if(percentage >= 0 && percentage <= 1) {
          audioElement.audio.volume = percentage;
        }
      }
    });

    $(".volumeBar .progressBar").mouseup(function(e) {
      var percentage = e.offsetX / $(this).width();
      if(percentage >= 0 && percentage <= 1) {
        audioElement.audio.volume = percentage;
      }
    });

    $(document).mouseup(function() {
      mouseDown = false;
    });

  });
  // note: this referenced below is (".playbackBar .progressBar") from above
  function timeFromOffset(mouse, progressBar) {
  	var percentage = mouse.offsetX / $(progressBar).width() * 100;
  	var seconds = audioElement.audio.duration * (percentage / 100);
  	audioElement.setTime(seconds);
  }

  function nextSong() {
    console.log('current index nextSong', currentIndex)
    if(repeat == true) {
      audioElement.setTime(0);
      playSong();
      return;
    }

    if(currentIndex == currentPlaylist.length - 1) {
      currentIndex = 0;
    } else {
      currentIndex++;
    }
    var trackToPlay = shuffle ? shufflePlaylist[currentIndex] : currentPlaylist[currentIndex];
    setTrack(trackToPlay, currentPlaylist, true);
  }

  function previousSong() {
    if(audioElement.audio.currentTime >= 3 || currentIndex == 0) {
      audioElement.setTime(0);
    } else {
      currentIndex = currentIndex - 1;
      setTrack(currentPlaylist[currentIndex], currentPlaylist, true);
    }
  }

  function setMute() {
    audioElement.audio.muted = !audioElement.audio.muted;
    var imageName = audioElement.audio.muted ? "volume-mute.png" : "volume.png";
    $(".controlButton.volume img").attr("src", "assets/images/icons/" + imageName);
  }

  function setRepeat() {
    repeat = !repeat;
    var imageName = repeat ? "repeat-active.png" : "repeat.png";
    $(".controlButton.repeat img").attr("src", "assets/images/icons/" + imageName);
  }

  function setShuffle() {
    shuffle = !shuffle;
    var imageName = shuffle ? "shuffle-active.png" : "shuffle.png";
    $(".controlButton.shuffle img").attr("src", "assets/images/icons/" + imageName);

    console.log('current playlist: ', currentPlaylist);
    console.log('shuffle playlist: ', shufflePlaylist);

    if(shuffle == true) {
      // randomize playlist
      shuffleArray(shufflePlaylist);
      currentIndex = shufflePlaylist.indexOf(audioElement.currentlyPlaying.id);
    } else {
      // shuffle deactived
      // go back to original playlist
      currentIndex = currentPlaylist.indexOf(audioElement.currentlyPlaying.id);
    }
  }

  function shuffleArray(array) {
      var j, x, i;
      for (i = array.length - 1; i > 0; i--) {
          j = Math.floor(Math.random() * (i + 1));
          x = array[i];
          array[i] = array[j];
          array[j] = x;
      }
  }

  function setTrack(trackId, newPlaylist, play) {
    if(newPlaylist != currentPlaylist) {
      currentPlaylist = newPlaylist;
      shufflePlaylist = currentPlaylist.slice();
      shuffleArray(shufflePlaylist);
    }
    if(shuffle == true) {
      currentIndex = shufflePlaylist.indexOf(trackId);
    } else {
      currentIndex = currentPlaylist.indexOf(trackId);
    }
    pauseSong();

    // audioElement.setTrack('assets/music/bensound-anewbeginning.mp3');

    // ajax call, a way of executing php, w/o reloading the page when accessing the db
    // retrieve song from table with id (url, data to send, do this with the result)
    $.post("includes/handlers/ajax/getSongJson.php", { songId: trackId }, function(data) {

      // parse the data, called it track
      var track = JSON.parse(data);
      // console.log(track);
      $(".trackName span").text(track.title);

      $.post("includes/handlers/ajax/getArtistJson.php", { artistId: track.artist }, function(data) {
        var artist = JSON.parse(data);
        // console.log(artist.name);
        $(".trackInfo .artistName span").text(artist.name);
        $(".trackInfo .artistName span").attr("onclick", "openPage('artist.php?id=" + artist.id + "')");
      });

      $.post("includes/handlers/ajax/getAlbumJson.php", { albumId: track.album }, function(data) {
        var album = JSON.parse(data);
        // console.log(artist.name);
        $(".content .albumLink img").attr("src", album.artworkPath);
        $(".content .albumLink img").attr("onclick", "openPage('album.php?id=" + album.id + "')");
        $(".trackInfo .trackName span").attr("onclick", "openPage('album.php?id=" + album.id + "')");
      });

      // console.log('track', track);
      audioElement.setTrack(track);
      if(play == true) {
        playSong();
      }

    });
  }

  function playSong() {
    if(audioElement.audio.currentTime == 0) {
      // console.log('update time')
      // console.log(audioElement.currentlyPlaying.id);
      $.post("includes/handlers/ajax/updatePlays.php", { songId: audioElement.currentlyPlaying.id });
    }
    // else {
    //   console.log('do not update time')
    // }

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
            <img role="link" tabindex="0" src="" class="albumArtwork" alt="Album Artwork">
          </span>
        <div class="trackInfo">
          <span class="trackName">
              <span role="link" tabindex="0"></span>
          </span>
          <span class="artistName">
              <span role="link" tabindex="0"></span>
          </span>
        </div>
      </div>
    </div>

    <div id="nowPlayingCenter">
      <div class="content playerControls">
        <div class="buttons">
          <button class="controlButton shuffle" title="Shuffle button" type="button" onClick="setShuffle()">
              <img src="assets/images/icons/shuffle.png" alt="Shuffle">
            </button>
          <button class="controlButton previous" title="Previous button" type="button" onClick="previousSong()">
              <img src="assets/images/icons/previous.png" alt="Previous">
            </button>
          <button class="controlButton play" title="Play button" type="button" onclick="playSong()">
              <img src="assets/images/icons/play.png" alt="Play">
            </button>
          <button class="controlButton pause" title="Pause button" style="display: none;" type="button" onclick="pauseSong()">
              <img src="assets/images/icons/pause.png" alt="Pause">
            </button>
          <button class="controlButton next" title="Next button" type="button" onclick="nextSong()">
              <img src="assets/images/icons/next.png" alt="Next">
            </button>
          <button class="controlButton repeat" title="Repeat button" type="button" onclick="setRepeat()">
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
        <button type="button" class="controlButton volume" title="Volume button">
            <img src="assets/images/icons/volume.png" alt="Volume" onClick="setMute()">
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
