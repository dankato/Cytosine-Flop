var currentPlaylist = [];
var shufflePlaylist = [];
var tempPlaylist = [];
var audioElement;
var mouseDown = false;
var currentIndex = 0;
var repeat = false;
var shuffle = false;
var userLoggedIn;

function Audio() {
  this.currentlyPlaying;
  this.audio = document.createElement("audio");

  this.audio.addEventListener("canplay", function() {
    var duration = formatTime(this.duration);
    // update time remaining, 'this' refers to the obj that the event was called on, the audio object
    $(".progressTime.remaining").text(duration);
  });

  this.audio.addEventListener("timeupdate", function() {
    if (this.duration) {
      updateTimeProgressBar(this);
    }
  });

  this.audio.addEventListener("volumechange", function(audio) {
    updateVolumeProgressBar(this);
  });

  this.audio.addEventListener("ended", function() {
    nextSong();
  });

  this.setTrack = function(track) {
    this.currentlyPlaying = track;
    this.audio.src = track.path;
  };
  this.play = function() {
    this.audio.play();
  };
  this.pause = function() {
    this.audio.pause();
  };
  this.setTime = function(seconds) {
    this.audio.currentTime = seconds;
  };
}

function formatTime(seconds) {
  var time = Math.round(seconds);
  var minutes = Math.floor(time / 60);
  var seconds = time - minutes * 60;
  var extraZero = seconds < 10 ? "0" : "";
  return minutes + ":" + extraZero + seconds;
}

function updateVolumeProgressBar(audio) {
  var volume = audio.volume * 100;
  $(".volumeBar .progress").css("width", volume + "%");
}

function updateTimeProgressBar(audio) {
  $(".progressTime.current").text(formatTime(audio.currentTime));
  $(".progressTime.remaining").text(
    formatTime(audio.duration - audio.currentTime)
  );

  var progress = audio.currentTime / audio.duration * 100;
  $(".playbackBar .progress").css("width", progress + "%");
}

// converting unknown characters in url
function openPage(url) {
  if (url.indexOf("?") == -1) {
    url = url + "?";
  }
  var encodedUrl = encodeURI(url + "&userLoggedIn=" + userLoggedIn);
  $("#mainContent").load(encodedUrl);

  // going to new page, auto scroll to the top incase you are at the bottom
  $("body").scrollTop(0);
  // update url when switching pages/views
  history.pushState(null, null, url);
}

function playFirstSong() {
  setTrack(tempPlaylist[0], tempPlaylist, true);
}
