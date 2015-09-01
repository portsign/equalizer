<?php 
require_once "header.php";
  if ($X['slider']=='yes') { 
  if ($X['navbarPosition']=='atas') {
    require_once "navbar.php";
    require_once "slider.php";
  } else {
    require_once "slider.php";
    require_once "navbar.php";
  }
} else {
  require_once "navbar.php";
}
?>    
<div class="col-md-12">
    <?php 
    if (isset($_GET['page'])) {
        if ($_GET['page']=='sitemap' || $_GET['page']=='sitemap.xml') {
            echo '<script>window.location.replace("'.$baseUrl.'sitemap_index.xml");</script>';
        } else {}
    } else {}
      $showPOS = mysqli_query($connecDB, "SELECT * FROM theme")or die(mysqli_error());
      $R = mysqli_fetch_array($showPOS);
      if ($R['sidebarPosition']=='kiri') {
        require_once "sidebar.php";
      } else {}
    ?>
    <!-- ISI TENGAH -->
    <div class="col-md-8"><br />
        <div class="row">
            <?php 
                $p      = new PagingPostIndex;
                $showLIMIT = mysqli_query($connecDB, "SELECT * FROM theme")or die(mysql_error());
                $L = mysqli_fetch_array($showLIMIT);
                $batas = $L['readPost'];
                $posisi = $p->cariPosisi($batas);
                $recent = mysqli_query($connecDB, "SELECT * FROM post WHERE status = 'posted' ORDER by idPost DESC LIMIT $posisi,$batas");
                while($x = mysqli_fetch_array($recent)){   
            ?>
              <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                  <img src="<?php if($x['feature']==''){ echo 'images/defaultImagePost.jpg'; } else { ?> <?php echo $x['feature']; ?> <?php } ?>" alt="<?php echo $x['judul']; ?>" title="<?php echo $x['judul']; ?>" style="width:100%; height:160px;" >
                  <div class="caption">
                    <marquee><h4><strong><?php echo $x['judul']; ?></strong></h4></marquee>
                    <?php 
                        $string = strip_tags($x['isi']);
                        if (strlen($string) > 200) {
                            $stringCut = substr($string, 0, 200);
                            $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'...';
                        }
                        //echo $string;
                    ?>  
                    <p><?php echo $string; ?></p>
                    <p><a href="<?php echo $baseUrl.$x['seourl']."/".$x['modul']; ?>" class="btn btn-primary btn-xs" role="button">Read More</a></p>
                  </div>
                </div>
              </div>  
            <?php } ?>    
            </div>
            <?php 
              $jmldata = mysqli_num_rows(mysqli_query($connecDB, "SELECT * FROM post WHERE status = 'posted'"));
              $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
              $linkHalaman = $p->navHalaman($_GET['pages'], $jmlhalaman);

              echo "<div class='col-md-12' style='border:none;'><div id=paging><font size='3'><a class='btn btn-success'><<</a> $linkHalaman</font></div><br /></div>";
              $tampilVideo = mysqli_query($connecDB, "SELECT * FROM videoGallery ORDER BY idVideoGallery DESC LIMIT 1");
              while($v = mysqli_fetch_array($tampilVideo)) {
            ?>
            <div class="panel panel-default" style="border:none;">
              <div class="panel-heading" style="border-radius:0px; border:none;">
                <h3 class="panel-title"><strong>NEWEST VIDEO :</strong> <?php echo $v['judul']; ?></h3>
              </div>
              <div class="panel-body">
                <div class="embed-responsive embed-responsive-16by9">
                  <iframe class="embed-responsive-item" src="//www.youtube.com/embed/<?php echo $v['urlVideo']; ?>?rel=0" allowfullscreen=""></iframe>
                </div>
                <a href="<?php echo $baseUrl; ?>more/video" class="btn btn-info"><i class="glyphicon glyphicon-plus"></i> More Videos</a>
              </div>
            </div>
            <?php } ?>
        </div>
        <!-- END of ISI TENGAH -->
        <?php 
          $showPOS2 = mysqli_query($connecDB, "SELECT * FROM theme")or die(mysqli_error());
          $R2 = mysqli_fetch_array($showPOS2);
          if ($R2['sidebarPosition']=='kanan') {
            require_once "sidebar.php";
          } else {}
        ?>
        <?php //require_once "sidebar.php"; ?>
    </div>
<?php require_once "footer.php"; ?>