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
            if (isset($_GET['page'])) {
                $getUrl = $_GET['page'];
                $tampilPAGEPOST = mysqli_query($connecDB, "SELECT * FROM page WHERE url='$getUrl'")or die(mysqli_error());
                $U = mysqli_fetch_array($tampilPAGEPOST);
                if ($_GET['page']=='sitemap' || $_GET['page']=='sitemap.xml') {
                  echo '<script>window.location.replace("'.$baseUrl.'sitemap_index.xml");</script>';
                }
                if ($_GET['page']=='profile') {
                  echo 'Profile Mimin';
                }
        ?>
                <h1><?php echo $U['judul']; ?></h1>
                <?php echo $U['isi']; ?>
            <?php    
            } else {}
        ?>
    </div>
    
<?php 
    $showPOS2 = mysqli_query($connecDB, "SELECT * FROM theme")or die(mysqli_error());
    $R2 = mysqli_fetch_array($showPOS2);
      if ($R2['sidebarPosition']=='kanan') {
        require_once "sidebar.php";
      } else {
    }
?>        
</div>
<?php require_once "footer.php"; ?>