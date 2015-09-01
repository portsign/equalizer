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
          session_start();
        ?>
        <?php 
          if (isset($_GET['warning'])) {
            echo '<div class="alert alert-warning" role="alert">
                    <a href="#" class="alert-link">You may only send a message 2 times</a>
                  </div>';
          }
        ?>
        <h3>Contact Us</h3>
        <form action="<?php echo $baseUrl; ?>record.php" method="POST">
          <input type="hidden" name="sessionID" value="<?php echo session_id(); ?>" />
          Name :
          <input type="text" name="name" class="form-control" required />
          Email :
          <input type="email" name="email" class="form-control" required />
          Website :
          <input type="text" name="website" class="form-control" />
          Message :
          <textarea class="form-control" name="message" required></textarea>
          <br />
          <input type="submit" name="submitComment" class="btn btn-success" value="Submit Comment" />
        </form>

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