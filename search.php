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
        
        <form action="<?php echo $baseUrl; ?>search/<?php echo $_POST['s']; ?>" class="navbar-form" role="search">
              <div class="input-group">
                  <input type="text" name="s" class="form-control" placeholder="Search" name="q">
                  <div class="input-group-btn">
                      <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                  </div>
              </div>
        </form>

        <?php 
            if (isset($_GET['s'])) {
                $getKey = $_GET['s'];
                //echo $getKey;
        ?>
            <?php 

                
                $recent = mysqli_query($connecDB, "SELECT * FROM post WHERE judul LIKE '%$getKey%' ORDER by idPost DESC LIMIT 20");
                while($x = mysqli_fetch_array($recent)){
                    
                    
            ?>

              <div class="col-sm-6 col-md-4">
                <div class="thumbnail">

                  <img src="<?php if($x['feature']==''){ echo $baseUrl.'images/defaultImagePost.jpg'; } else { ?> <?php echo $x['feature']; ?> <?php } ?>" alt="<?php echo $x['judul']; ?>" title="<?php echo $x['judul']; ?>" style="width:100%; height:150px" >

                  <div class="caption">
                    <marquee><h4><strong><?php echo $x['judul']; ?></strong></h4></marquee>
                    <?php 
                        $string = strip_tags($x['isi']);

                        if (strlen($string) > 200) {

                            // truncate string
                            $stringCut = substr($string, 0, 200);

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

            <hr />

            <div class="col-md-12">
            <h3>Random Post</h3>
            <?php 

                $showLIMIT = mysqli_query($connecDB, "SELECT * FROM theme")or die(mysql_error());
                $L = mysqli_fetch_array($showLIMIT);
                $limit = $L['readPost'];
                $recent2 = mysqli_query($connecDB, "SELECT * FROM post ORDER by idPost DESC LIMIT $limit");
                while($x2 = mysqli_fetch_array($recent2)){
                    
                    
            ?>
            
              <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                  <img src="<?php if($x2['feature']==''){ echo $baseUrl.'images/defaultImagePost.jpg'; } else { ?> <?php echo $x2['feature']; ?> <?php } ?>" alt="<?php echo $x2['judul']; ?>" title="<?php echo $x2['judul']; ?>" style="width:100%; height:150px" >

                  <div class="caption">
                    <marquee><h4><strong><?php echo $x2['judul']; ?></strong></h4></marquee>
                    <?php 
                        $string2 = strip_tags($x2['isi']);

                        if (strlen($string2) > 200) {

                            // truncate string
                            $stringCut2 = substr($string2, 0, 200);

                            // make sure it ends in a word so assassinate doesn't become ass...
                            $string2 = substr($stringCut2, 0, strrpos($stringCut2, ' ')).'...';
                            
                        }
                        //echo $string;
                    ?>  
                      
                    <p><?php echo $string2; ?></p>

                    <p><a href="<?php echo $baseUrl.$x2['seourl']."/".$x2['modul']; ?>" class="btn btn-primary btn-xs" role="button">Read More</a></p>
                  </div>
                </div>
              </div>  
          
            <?php } ?> 

        </div>
        <?php
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