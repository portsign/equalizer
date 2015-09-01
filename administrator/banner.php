<?php 
require_once "header.php"; 
error_reporting(0);
session_start();
if (empty($_SESSION['usernameAdmin']) && empty($_SESSION['passwordAdmin'])) { ?>
    <!-- LOGIN -->
    <div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <br /><br /><br />
            <?php 
                if (isset($_GET['login'])) {
                    if ($_GET['login']=='false') {
                        echo '
                            <div class="alert alert-danger" role="alert"><i class="glyphicon glyphicon-alert"></i> Login Gagal, Username atau Password Salah</div>
                        ';
                    }
                }
            ?>
            <div class="account-wall">
                <img class="profile-img" src="images/photo.jpg"
                    alt="">
                <form action="<?php echo $baseUrl."record"; ?>" method="post" class="form-signin">
                <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                <input type="submit" name="login" class="btn btn-lg btn-primary btn-block" value="Sign in" />
                </form>
            </div>
        </div>
    </div>
    </div>
    <!-- END OF LOGIN -->
<?php } else {
?>
    
<?php require_once "navbar.php"; ?> 	
<div class="container-fluid main-container">  		
    <?php require_once "sidebar.php"; ?>

    <!-- CONTENT HOME ADMIN -->
    <div class="col-md-10 content">
        <div class="panel panel-default">
        <div class="panel-heading">
            Banner
        </div>
        <div class="panel-body">
        
                
                    <?php 
                        $tampilB = mysqli_query($connecDB, "SELECT * FROM banner");
                        $ho = 1;
                        while($x=mysqli_fetch_array($tampilB)){
                    ?>
                    <div class="col-md-4">
                        <img src="<?php echo $baseUrl; ?>../images/<?php echo $x['gambar']; ?>" style="width:100%" />
                        <div style="padding:20px; border:1px solid #eaeaea;">
                        <i>Caption</i> : <?php echo $x['caption']; ?>
                        
                            <div class="btn-group pull-right" role="group" aria-label="...">
                              <a href="<?php echo $baseUrl."record/?type=deleteBanner&id=".$x['idBanner']; ?>" onclick="return confirm('Apakah Anda Yakin?')" class="btn btn-default pull-right"><i class="glyphicon glyphicon-remove-circle"></i></a>
                              <a href="#" class="btn btn-default pull-right" data-toggle="modal" data-target="#exampleModal<?php echo $ho; ?>"><i class="glyphicon glyphicon-pencil"></i></a>
                            </div>
                        </div><br />
                    </div>
                    
                    <div class="modal fade" id="exampleModal<?php echo $ho; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel">Change Caption Slide <?php echo $ho; ?></h4>
                          </div>
                          <div class="modal-body">
                              <form action="<?php echo $baseUrl; ?>record.php" method="post">
                                <input type="hidden" name="idBanner" value="<?php echo $x['idBanner']; ?>" class="form-control" />  
                                <input type="text" name="caption" value="<?php echo $x['caption']; ?>" class="form-control" />  
                            
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <input type="submit" name="changeCaption" class="btn btn-primary" value="Save">
                           </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <?php $ho++; } ?>
                    
                    <form action="<?php echo $baseUrl; ?>record.php" method="post" enctype="multipart/form-data">
                    <?php  
                    
                        $tampilCount = mysqli_query($connecDB, "SELECT count(*) as jumlahBanner FROM banner");
                        $t = mysqli_fetch_array($tampilCount);
                        $jum = $t['jumlahBanner'];
                        if ($jum>=3) {
                            echo '';
                        } else {
                    ?>
                    <img src="<?php echo $baseUrl; ?>images/noimage.gif" style="width:30%" />
                    <div class="col-md-12">
                    <input type="file" name="banner" /><br />
                    <input type="text" name="caption" placeholder="Caption" class="form-control" /><br />
                    <input type="submit" name="bannerAdd" class="btn btn-success" value="Simpan" /><br />
                    </div>
                    <?php } ?>
                </form>            
        </div>
    </div>
    </div>    
    <!-- END OF CONTENT HOME ADMIN -->
    
</div>
    
<?php 
    require_once "footer.php"; 
    }
?>