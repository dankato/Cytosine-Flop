var currentPlaylist = [];
var audioElement;
var mouseDown = false;

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
