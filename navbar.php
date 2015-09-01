<?php 
    error_reporting(0);
    session_start();
    $readEmailSess = $_SESSION['userNameMuncul'];
    $tampilSESS = mysqli_query($connecDB, "SELECT * FROM usermember WHERE email = '$readEmailSess'");
    $f = mysqli_fetch_array($tampilSESS);
    if ($f['status']=='inactive') {
?>
    <nav style="border:none; background-color:#2A9FD6">
      <div class="container-fluid">
        <div style="padding:15px">
          
            <span style="color:#fff;">Hai <?php echo "<i>".$readEmailSess."</i>"; ?>. Akun anda belum sepenuhnya aktif. Mohon untuk Verifikasi Akun anda terlebih dahulu. <span class="pull-right"><a href="#" style="color:#000">Ganti Password?</a></span>
            
        </div>
      </div>
    </nav>
<?php
    //echo 'Aktifkan dulu vroh';
    } else {
        echo '';
    }
?>
<?php 
  $showNFT = mysqli_query($connecDB, "SELECT * FROM theme")or die(mysqli_error());
  $N = mysqli_fetch_array($showNFT);
  if ($N['navbarFixedTop']=='yes') {
    echo '<nav class="navbar navbar-default navbar-fixed-top" style="border:none;">';
  } else {
    echo '<nav class="navbar navbar-default" style="border:none;">';
  }
?>

      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo $baseUrl; ?>"><i class="glyphicon glyphicon-education"></i> <?php echo $X['siteName']; ?></a>
        </div>
          
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="active"><a href="<?php echo $baseUrl; ?>">Home</a></li>
            
              <?php 
                $show = mysqli_query($connecDB, "SELECT * FROM menu ORDER BY idMenu ASC");
                while($x=mysqli_fetch_array($show)) {
              ?>
                <?php 
                    $idMenu = $x['idMenu'];
                    $showSub = mysqli_query($connecDB, "SELECT * FROM submenu WHERE idMenu = '$idMenu'");
                    $s = mysqli_fetch_array($showSub);
                    if ($s['idMenu']==$x['idMenu']) {
                        ?>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $x['NamaMenu']; ?> <span class="caret"></span></a>
                          <ul class="dropdown-menu" role="menu">
                            <?php 
                                $tampilSubMenu = mysqli_query($connecDB, "SELECT * FROM submenu WHERE idMenu = '".$x['idMenu']."'");
                                while($v=mysqli_fetch_array($tampilSubMenu)) {
                            ?>  
                                <li><a href="<?php echo $baseUrl.$v['modul']; ?>"><?php echo $v['namaSubMenu']; ?></a></li>
                                
                                <?php 
                                    }
                                ?>
                              
                          </ul>
                        </li> 
                        <?php
                    } else {
                ?>  
                <li><a href="<?php echo $baseUrl.$x['modul']; ?>"><?php echo $x['NamaMenu']; ?></a></li>
                
              <?php } } ?>
            </ul>
            <ul class="nav navbar-nav pull-right">
            <?php if (empty($_SESSION['userNameMuncul']) && empty($_SESSION['passwordMuncul'])) { ?>    
              <form action="<?php echo $baseUrl; ?>search/<?php echo $_POST['s']; ?>" class="navbar-form" role="search">
              <div class="input-group">
                  <input type="text" name="s" class="form-control" placeholder="Search" name="q">
                  <div class="input-group-btn">
                      <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                  </div>
              </div>
              </form>
            <?php } else { ?>
              <li><a href="<?php echo $baseUrl; ?>profile/" class="btn btn-danger" style="color:#FFF;">My Profile</a></li>    
              <li><a href="<?php echo $baseUrl; ?>logout.php" class="btn btn-warning" style="color:#FFF;">Logout</a></li>    
            <?php } ?>    
            </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>

<?php 
if ($N['navbarFixedTop']=='yes') {
  echo '<br /><br /><br />';
} else {}
?>

<!-- Login -->

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" id="exampleModalLabel">Login</h3>
        <p>Connect dengan Media Sosial</p>
        <a href="#" class="btn btn-info">F | Facebook</a> <a href="#" class="btn btn-info">t | Twitter</a>
      </div>
      <div class="modal-body" style="background-color:#eaeaea;">
        <form action="<?php echo $baseUrl; ?>record" method="POST">
          <div class="form-group">
            <label for="recipient-name" class="control-label">Email:</label>
            <input type="email" name="email" class="form-control" id="recipient-name" required>
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Password:</label>
            <input type="password" name="password" class="form-control" id="recipient-name" required>
          </div>
          <a href="#">Forgot Password?</a>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name="login" class="btn btn-primary">Login</button>
        </form>
      </div>
    </div>
  </div>
</div>        
        
<!-- End of Login -->    

<!-- REGISTER -->

<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" id="exampleModalLabel">Register</h3>
        <p>Connect dengan Media Sosial</p>
        <a href="#" class="btn btn-info">F | Facebook</a> <a href="#" class="btn btn-info">t | Twitter</a>
      </div>
      <div class="modal-body" style="background-color:#eaeaea;">
        <form action="<?php echo $baseUrl; ?>record" method="POST">
          <div class="form-group">
            <label for="recipient-name" class="control-label">Full Name:</label>
            <input type="text" name="fullname" class="form-control" id="recipient-name" autofocus required>
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Email Address:</label>
            <input type="email" name="email" class="form-control" id="recipient-name" required>
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Password:</label>
            <input type="password" name="password" class="form-control" id="recipient-name" required>
          </div>
          <!-- 
          <div class="form-group">
            <label for="message-text" class="control-label">Please enter the words below:</label><br />
            <img src="images/captcha.jpeg" class="thumbnail" />
            <input type="password" name="password" class="form-control" placeholder="Masukkan Kode Keamanan" id="recipient-name" required>
          </div>
            -->
          <a href="#">Already member?</a>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name="registerAccount" class="btn btn-primary">Register</button>
      </form>
      </div>
    </div>
  </div>
</div>        
        
<!-- End of REGISTER --> 