<?php
  include("includes/includedFiles.php");

  if(isset($_GET['term'])) {
    $term = urldecode($_GET['term']);
    // echo $term;
  } else {
    $term = "";
  }
?>

<div class="searchContainer">
  <h4>Search Cytosine Flop</h4>
  <input type="text" class="searchInput" value="<?php echo $term; ?>" placeholder="Start typing..." onfocus="var val=this.value; this.value=''; this.value= val;"
</div>

<script>

  $(function() {
    var timer;
    $(".searchInput").keyup(function() {
      // while typing, cancel out existing timer
      clearTimeout(timer);
      // after canceled, create a brand new timer of 2 secs
      timer = setTimeout(function() {
        var value = $(".searchInput").val();
        openPage("search.php?term=" + value);
      }, 1500);
    })
    $(".searchInput").focus();
  })
</script>

<div class="trackListContainer borderBottom">
  <h3>Songs</h3>
  <ul class="trackList">
    <?php
      $songsQuery = mysqli_query($con, "SELECT id FROM Songs WHERE title Like '$term%' LIMIT 10");

      if(mysqli_num_rows($songsQuery) == 0) {
        echo "<span class='noResults'>No songs found matching " . $term . "</span>";
      }

      $songIdArray = array();

      $i = 1;
      while ($row = mysqli_fetch_array($songsQuery)) {
        if($i > 15) {
          break;
        }

        array_push($songIdArray, $row['id']);

        $albumSong = new Song($con, $row['id']);
          $albumArtist = $albumSong->getArtist();

          echo "<li class='trackListRow'>
            <div class='trackCount'>
            <img class='play' src='assets/images/icons/play-white.png' onClick='setTrack(\"" . $albumSong->getId() . "\", tempPlaylist, true)'/>
              <span class='trackNumber'>$i</span>
            </div>

            <div class='trackInfo'>
              <span class='trackName'>" . $albumSong->getTitle() . "</span>
              <span class='artistName'>" . $albumArtist->getName() . "</span>
            </div>

            <div class='trackOptions'>
              <img class='optionsButton' src='assets/images/icons/more.png' />
            </div>

            <div class='trackDuration'>
              <span class='duration'>" . $albumSong->getDuration() . "</span>
            </div>
          </li>";
          $i++;
      }
    ?>

    <script>
      var tempSongIds = '<?php echo json_encode($songIdArray); ?>';
      tempPlaylist = JSON.parse(tempSongIds);
      // console.log(tempPlaylist);
    </script>
  </ul>
</div>

<div class="artistContainer borderBottom">
  <h2>Artists</h2>
  <?php
    $artistQuery = mysqli_query($con, "SELECT id FROM artists WHERE name LIKE '$term%' LIMIT 10");

    if(mysqli_num_rows($artistQuery) == 0) {
      echo "<span class='noResults'>No artists found matching " . $term . "</span>";
    }

    while($row = mysqli_fetch_array($artistQuery)) {
      $artistFound = new Artist($con, $row['id']);
      echo "<div class='searchResultRow'>
        <div class='artistName'>
          <span row='link' tabindex='0' onClick='openPage(\"artist.php?id=".  $artistFound->getId() ."\")'>". $artistFound->getName() . "</span>
        </div>
      </div>";
    }
  ?>
</div>
