<?php 
require_once "header.php"; 
require_once "navbar.php";
?>
<style>
    h2 { font-size: 22px; }
    img { width:100%; }
</style>
<?php 
$link =  "//$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$url = $link;
$path = parse_url($url, PHP_URL_PATH);
$segments = explode('/', rtrim($path, '/'));
//echo end($segments);
?>
<div class="col-md-12">
        <?php 
          $showPOS = mysqli_query($connecDB, "SELECT * FROM theme")or die(mysqli_error());
          $R = mysqli_fetch_array($showPOS);
          if ($R['sidebarPosition']=='kiri') {
            require_once "sidebar.php";
          } else {}
        ?>
    <!-- ISI TENGAH -->
    <div class="col-md-8"><br />
        <?php 
            if (isset($_GET['id'])) {
                if ($_GET['id']=='category') {
                    $tampilMoreCategory = mysqli_query($connecDB, "SELECT * FROM category ORDER BY idCategory DESC");
                    while($c = mysqli_fetch_array($tampilMoreCategory)) {
                ?>
                    <a href="<?php echo $baseUrl; ?>category/<?php echo $c['slug']; ?>/" class="btn btn-default"><?php echo $c['category']; ?></a>
                <?php 
                } 
            }
            if ($_GET['id']=='image') {
                ?>    
                        <h3>More Picture</h3>
                    <?php 
                        $tampilMoreGambar = mysqli_query($connecDB, "SELECT * FROM gallery ORDER BY idGallery DESC");
                        while($g = mysqli_fetch_array($tampilMoreGambar)) {
                    ?>
                    
                    <div class="col-xs-6 col-md-3">
                        <a href="#" class="thumbnail">
                        <img src="<?php echo $baseUrl; ?>images/uploads/images/<?php echo $g['gambar']; ?>" alt="<?php echo $g['alt']; ?>" title="<?php echo $g['title']; ?>" class="thumbnail" />
                        </a>
                    </div>
                    <?php
                    } 
                }
                if ($_GET['id']=='video') {
                        if (isset($_GET['video'])) {
                            $getIDV = $_GET['video'];
                            //echo $getIDV;
                            $tampilVideo = mysqli_query($connecDB, "SELECT * FROM videoGallery WHERE idVideoGallery = '$getIDV'");
                            $k=mysqli_fetch_array($tampilVideo);
                ?>
                <h3>More Videos</h3>
                <h5><?php echo $k['judul']; ?></h5>
                        <div class="embed-responsive embed-responsive-16by9">
                          <iframe class="embed-responsive-item" src="http://www.youtube.com/embed/<?php echo $k['urlVideo']; ?>?autoplay=1&cc_load_policy=1" autoplay="true"></iframe>
                        </div>
                        <br />
                        <p>
                            <?php echo $k['keterangan']; ?>
                        </p>
                        <br />
                        <a href="<?php echo $baseUrl; ?>more/video" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Back</a>
                        <br />
                        <hr />
                        <h3>Random Post</h3>
            <?php 
                $recent = mysqli_query($connecDB, "SELECT * FROM post WHERE status = 'posted' ORDER by rand() LIMIT 6");
                while($x = mysqli_fetch_array($recent)){         
            ?>
              <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                  <img src="<?php if($x['feature']==''){ echo $baseUrl.'images/defaultImagePost.jpg'; } else { ?> <?php echo $x['feature']; ?> <?php } ?>" alt="<?php echo $x['judul']; ?>" title="<?php echo $x['judul']; ?>" style="width:100%; height:160px">

                  <div class="caption">
                    <marquee><h4><strong><?php echo $x['judul']; ?></strong></h4></marquee>
                    <?php 
                        $string = strip_tags($x['isi']);
                        if (strlen($string) > 100) {
                            $stringCut = substr($string, 0, 100);
                            $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'...';
                        }
                    ?>  
                    <p><?php echo $string; ?></p>
                    <p><a href="<?php echo $baseUrl.$x['seourl']."/".$x['modul']; ?>" class="btn btn-primary btn-xs" role="button">Read More</a></p>
                  </div>
                </div>
              </div>  
            <?php }     
            } else {
                    $tampilMoreVideo = mysqli_query($connecDB, "SELECT * FROM videoGallery ORDER BY idVideoGallery DESC");
                    while($v=mysqli_fetch_array($tampilMoreVideo)) {   
                ?>
                      <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                          <div class="embed-responsive embed-responsive-16by9">
                              <iframe class="embed-responsive-item" src="//www.youtube.com/embed/<?php echo $v['urlVideo']; ?>?rel=0" allowfullscreen=""></iframe>
                            </div>
                          <div class="caption">
                            <h5><?php echo $v['judul']; ?></h5>
                            <p><a href="<?php echo $baseUrl."more/video/".$v['idVideoGallery']; ?>" class="btn btn-primary" role="button"><i class="glyphicon glyphicon-play"></i> Play</a></p>
                          </div>
                        </div>
                      </div>
                <?php 
                    }
                }       
            }
        }
    ?>
    </div>
    <!-- END of ISI TENGAH -->
<?php 
      $showPOS2 = mysqli_query($connecDB, "SELECT * FROM theme")or die(mysqli_error());
      $R2 = mysqli_fetch_array($showPOS2);
      if ($R2['sidebarPosition']=='kanan') {
        require_once "sidebar.php";
      } else {}
    ?>
</div>
<?php require_once "footer.php"; ?>