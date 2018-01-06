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
