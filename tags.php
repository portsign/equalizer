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
        $p = new PagingCategoryPost;
        $batas  = 21;
        $posisi = $p->cariPosisi($batas);

        $getSLUG = $_GET['slug'];
        $tampilSLUG = mysqli_query($connecDB, "SELECT * FROM tags WHERE tagSlug = '$getSLUG' ")or die(mysql_error());
        $C = mysqli_fetch_array($tampilSLUG);
        $getIDSLUG = $C['idTags'];
      ?>
                <h3><b><?php echo $C['namaTags']; ?></b> Tag</h3>
        <?php
          $recent = mysqli_query($connecDB, "SELECT p.*, t.* FROM post p JOIN tags t ON p.idPost=t.idPost WHERE t.tagSlug = '$getSLUG' and p.status = 'posted' LIMIT $posisi,$batas");
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
            $jmldata = mysqli_num_rows(mysqli_query($connecDB, "SELECT * FROM category"));
            $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
            $linkHalaman = $p->navHalaman($_GET['page'], $jmlhalaman);
            echo "<div class='col-md-12' style='border:none;'><div id=paging><font size='3'><a class='btn btn-success'><<</a> $linkHalaman</font></div><br /></div>";
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