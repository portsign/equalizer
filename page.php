<?php 
require_once "header.php"; 
require_once "navbar.php";
?>
<style>
    h2 {
        font-size: 22px;
    }
    img {
        width:100%;
    }
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
        
        
            if (isset($_GET['url'])) {
                
        ?>
        <?php 
 


            $pieces = explode('/', $link);
            $getUrl = $pieces[4];
            $getSeg = end($segments);
            $getModul = "page/".$getSeg;
            $tampilPost = mysqli_query($connecDB, "SELECT * FROM post WHERE modul = '$getModul' AND seourl = '$getUrl'");
            $x = mysqli_fetch_array($tampilPost);   

            //echo $x['modul'];
            $getIDPOST = $x['idPost'];
            $ples = $x['viewer']+1;
            mysqli_query($connecDB, "UPDATE post SET viewer='$ples' WHERE idPost = '$getIDPOST'")or die(mysqli_error());

        if (empty($x['isi'])) {
                echo 'TIDAK ADA POSTINGAN PADA MENU INI';
            }

        ?>
        
        
        <h1 style="font-size:28px;"><?php echo $x['judul']; ?></h1>
        <?php echo $x['tglPost']; ?><br /><hr />
        <?php 
            echo $x['isi'];
            
        ?>
        <br />
        <a href="#" class="btn btn-default btn-xs disabled"><i class="glyphicon glyphicon-tag"></i></a>
        <?php 
            $getUID = $x['idPost'];
            $SHOW_TAGS = mysqli_query($connecDB, "SELECT * FROM tags WHERE idPost = '$getUID'");
            while($J = mysqli_fetch_array($SHOW_TAGS)) {
        ?>
        <a href="<?php echo $baseUrl; ?>tags/<?php echo $J['tagSlug']; ?>" class="btn btn-default btn-xs"><?php echo $J['namaTags']; ?></a>
        <?php } ?>
        <br />
        <?php 
            $prevNext = mysqli_query($connecDB, "SELECT * FROM post ORDER by rand()");
            $n = mysqli_fetch_array($prevNext);
        ?>
        <?php 
            $prevNext2 = mysqli_query($connecDB, "SELECT * FROM post ORDER by rand()");
            $n2 = mysqli_fetch_array($prevNext2);
        ?>
        <br />
        <center>
            <a href="<?php echo $baseUrl.$n['seourl'].'/'.$n['modul']; ?>" class="btn btn-success"><i class="glyphicon glyphicon-menu-left"></i> <?php echo $n['judul']; ?></a>
            <a href="<?php echo $baseUrl.$n2['seourl'].'/'.$n2['modul']; ?>" class="btn btn-success"><?php echo $n2['judul']; ?> <i class="glyphicon glyphicon-menu-right"></i></a>
        </center>
        <hr />
        <h3>Random Post</h3>
        <?php 


                $recent = mysqli_query($connecDB, "SELECT * FROM post WHERE status = 'posted' ORDER by rand() LIMIT 6");
                while($x = mysqli_fetch_array($recent)){
                    
                    
            ?>

              <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                  <img src="<?php if($x['feature']==''){ echo $baseUrl.'images/defaultImagePost.jpg'; } else { ?> <?php echo $x['feature']; ?> <?php } ?>" style="width:100%; height:160px" alt="...">

                  <div class="caption">
                    <marquee><h4><strong><?php echo $x['judul']; ?></strong></h4></marquee>
                    <?php 
                        $string = strip_tags($x['isi']);

                        if (strlen($string) > 100) {

                            // truncate string
                            $stringCut = substr($string, 0, 100);

                            // make sure it ends in a word so assassinate doesn't become ass...
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
        <?php } else { ?>
        
            <?php  
                    $p      = new PagingPagePost;
                    $batas  = 21;
                    $posisi = $p->cariPosisi($batas);

                    $getlast = "page/".end($segments);
                    $tampilListPost = mysqli_query($connecDB, "SELECT * FROM post WHERE modul = '$getlast' AND status = 'posted' ORDER BY idPost DESC LIMIT $posisi,$batas");
                    while($h = mysqli_fetch_array($tampilListPost)) {

            ?>
            
                    <div class="col-sm-6 col-md-4">
                    <div class="thumbnail" style="padding:0px; border:none;">
                      <img src="<?php if($h['feature']==''){ echo $baseUrl.'images/defaultImagePost.jpg'; } else { ?> <?php echo $h['feature']; ?> <?php } ?>" style="width:100%; height:160px" alt="<?php echo $h['judul']; ?>" title="<?php echo $h['judul']; ?>">
                      <div class="caption">
                        <marquee><h4><strong><?php echo $h['judul']; ?></strong></h4></marquee>
                        <?php 
                            $string = strip_tags($h['isi']);

                            if (strlen($string) > 300) {

                                // truncate string
                                $stringCut = substr($string, 0, 300);

                                // make sure it ends in a word so assassinate doesn't become ass...
                                $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'...';

                            }
                            //echo $string;

                        ?>  

                        <p><?php echo $string; ?></p>
                        <p><a href="<?php echo $baseUrl.$h['seourl']."/".$h['modul']; ?>" class="btn btn-primary btn-xs" role="button">Read More</a></p>
                      </div>
                    </div>
                  </div>  
        
            <?php } ?>
        <?php 
                        $jmldata = mysqli_num_rows(mysqli_query($connecDB, "SELECT * FROM post WHERE modul = '$getlast'"));
                        $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
                        $linkHalaman = $p->navHalaman($_GET['page'], $jmlhalaman);

                        echo "<div class='col-md-12' style='border:none;'><div id=paging><font size='3'><a class='btn btn-success'><<</a> $linkHalaman</font></div><br /></div>";
                    ?>
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
</div>
<?php require_once "footer.php"; ?>