<?php  
    $showBanner = mysqli_query($connecDB, "SELECT count(*) as jumlah FROM banner");
    $e = mysqli_fetch_array($showBanner);
    //echo $e['jumlah'];
    if ($e['jumlah']=='0') { echo '
        <div style="padding:10px;"><i>No Banner Available</i></div>
    '; } else {
?>
<div id="carousel-example-generic" class="carousel slide topSlide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <?php 
            $tampilO = mysqli_query($connecDB, "SELECT * FROM banner ORDER BY idBanner DESC")or die(mysqli_error());
            $n=1;
            while($w = mysqli_fetch_array($tampilO)) {
        ?>    
        <li data-target="#carousel-example-generic" data-slide-to="0" <?php if ($n<=1) { ?>class="active" <?php } else { echo ''; } ?></l></li>
        <?php $n++; } ?>
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
          
        <?php 
            $tampilSlide = mysqli_query($connecDB, "SELECT * FROM banner ORDER BY idBanner DESC")or die(mysqli_error());
            $no=1;
            while($q = mysqli_fetch_array($tampilSlide)) {
        ?>    
        <div class="item <?php if ($no<=1) { echo 'active'; } else { echo ''; } ?>">
          <img src="<?php echo $baseUrl; ?>images/<?php echo $q['gambar']; ?>" style="width:100%" alt="...">
          <div class="carousel-caption">
            <?php echo $q['caption']; ?>
          </div>
        </div>
        <?php $no++; } ?>

      </div>

      <!-- Controls -->
      <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
<?php } ?>