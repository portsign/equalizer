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
            Dashboard
        </div>
        <div class="panel-body">
            
            <?php 
                if (isset($_GET['type'])) {
                    if ($_GET['type']=='addimages') { ?>
            
                <div class="col-md-6">
                    <form action="<?php echo $baseUrl."record" ?>" method="post" enctype="multipart/form-data">
                        <input type="file" name="gambar" />
                        Judul Gambar :
                        <input type="text" name="title" class="form-control" placeholder="title image" /><br />
                        Alt text :
                        <input type="text" name="alt" class="form-control" placeholder="alt text" /><br />
                        <input type="submit" name="addImage" class="btn btn-success" value="Simpan" />
                        <a href="<?php echo $baseUrl."media/"; ?>" class="btn btn-info">Batal</a>
                    </form>
                </div>
                
            <?php
                    }
                    if ($_GET['type']=='embed') {
                        ?>
                      <div class="modal-lg">
                        <div class="">
                            <div style="padding:20px;">
                        <h3><i class="glyphicon glyphicon-facetime-video"></i> Embed Video</h3>
                        <form action="<?php echo $baseUrl; ?>record" method="POST">
                        Judul Video :
                        <input type="text" name="judul" class="form-control" required />
                        Youtube ID :
                        <input type="text" name="youtubeLink" class="form-control" placeholder="hanya Youtube" required /><br />
                        <textarea name="keterangan" class="form-control" placeholder="Keterangan Video"></textarea>	
                        <br />
                        <input type="submit" name="submitVideo" class="btn btn-success" value="Post" />
                        <a href="<?php echo $baseUrl; ?>media/" type="button" class="btn btn-default" data-dismiss="modal">Batal</a>
                        <br />	
                        </form>


                        </div>	
                        </div>
                      </div>
             
            <?php
                    }
                    if ($_GET['type']=='play') {
                        $getIDV = $_GET['idvideo'];
                        $tampilIDY = mysqli_query($connecDB, "SELECT * FROM videoGallery WHERE idVideoGallery = '$getIDV'");
                        $u = mysqli_fetch_array($tampilIDY);
                ?>
            
                    <div class="embed-responsive embed-responsive-16by9">
                      <iframe class="embed-responsive-item" src="http://www.youtube.com/embed/<?php echo $u['urlVideo']; ?>?autoplay=1&cc_load_policy=1" autoplay="true"></iframe>
                    </div>
                    <br />
                    <a href="<?php echo $baseUrl; ?>media/?type=editvideo&idvideo=<?php echo $u['idVideoGallery']; ?>" class="btn btn-info">Edit</a>
                    <a href="<?php echo $baseUrl; ?>media/" class="btn btn-warning">Back</a>
            <?php
                    }
                    if ($_GET['type']=='editvideo') {
                        $getIDV = $_GET['idvideo'];
                        $tampilIDY = mysqli_query($connecDB, "SELECT * FROM videoGallery WHERE idVideoGallery = '$getIDV'");
                        $u = mysqli_fetch_array($tampilIDY);
                ?>
                
                    <div class="modal-lg">
                        <div class="">
                            <div style="padding:20px;">
                        <h3><i class="glyphicon glyphicon-facetime-video"></i> Edit Embed Video</h3>
                            <hr />
                        <form action="<?php echo $baseUrl; ?>record" method="POST">
                        <input type="hidden" name="id" value="<?php echo $u['idVideoGallery']; ?>" />
                        Judul Video :
                        <input type="text" name="judul" class="form-control" value="<?php echo $u['judul']; ?>" required />
                        Youtube ID :
                        <input type="text" name="youtubeLink" class="form-control" value="https://www.youtube.com/watch?v=<?php echo $u['urlVideo']; ?>" placeholder="hanya Youtube" required /><br />
                        <textarea name="keterangan" class="form-control" placeholder="Keterangan Video"><?php echo $u['keterangan']; ?></textarea>	
                        <br />
                        <input type="submit" name="editVideo" class="btn btn-success" value="Post" />
                        <a href="<?php echo $baseUrl; ?>media/" type="button" class="btn btn-default" data-dismiss="modal">Batal</a>
                        <br />	
                        </form>


                        </div>	
                        </div>
                      </div>
            
            <?php
                    }
                } else {
            ?>
            
                <a href="?type=addimages" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Upload Image</a>
                <a href="?type=embed" class="btn btn-danger"><i class="glyphicon glyphicon-plus"></i> Youtube Embed</a>
            
                <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1default" data-toggle="tab">Image Gallery</a></li>
                            <li><a href="#tab2default" data-toggle="tab">Video Gallery</a></li>
                        </ul>
                </div>
            
                            <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab1default">
                        
                        <?php 
                            $tampilGall=mysqli_query($connecDB, "SELECT * FROM gallery ORDER BY idGallery DESC");
                            while($a = mysqli_fetch_array($tampilGall)) {
                        ?>    
                            
                            <div class="col-xs-6 col-md-3">
                                <a href="#" class="thumbnail">
                                  <img src="<?php echo $baseUrl; ?>../images/uploads/images/<?php echo $a['gambar']; ?>" style="height: 180px; width: 100%; display: block;" alt="<?php echo $a['alt']; ?>" title="<?php echo $a['title']; ?>">
                                  <a href="<?php echo $baseUrl."record/?type=deleteGambar&id=".$a['idGallery']; ?>" onclick="return confirm('Apakah Anda Yakin?')" class="btn btn-warning"><i class="glyphicon glyphicon-trash"></i> Delete Permanently</a>
                                </a>
                            </div>
                            
                        <?php } ?>    
                            
                            
                        <?php 
                            $tampilJumGall=mysqli_query($connecDB, "SELECT count(*) as jumGall FROM gallery");
                            $s = mysqli_fetch_array($tampilJumGall);  
                        ?>    
                            
                        <?php 
                    
                            if ($s['jumGall']<1) {
                    
                        ?>    
                            <div class="col-xs-6 col-md-3">
                                <a href="#" class="thumbnail">
                                  <img src="<?php echo $baseUrl; ?>images/noimage.gif" style="height: 180px; width: 100%; display: block;" alt="100%x180">
                                </a>
                            </div>
                        <?php 
                            } else { echo ''; }
                        ?>   
                            
                            
                        
                        </div>
                        <div class="tab-pane fade" id="tab2default">
                        
                        <h3>Video Gallery</h3>
                         
            <?php 
                $tampilVideo = mysqli_query($connecDB, "SELECT * FROM videoGallery ORDER BY idVideoGallery DESC");
                while($b = mysqli_fetch_array($tampilVideo)) {
            ?>
            <div class="well well-sm">
                <div class="row">
                    
                    
                    <div class="col-xs-2 col-md-2 text-center">
                        <img src="http://img.youtube.com/vi/<?php echo $b['urlVideo']; ?>/0.jpg" alt="bootsnipp"
                         width="160"    />
                    </div>

                    <div class="col-xs-9 col-md-9 section-box">
                        <h4>
                            <a href="<?php echo $baseUrl; ?>media/?type=play&idvideo=<?php echo $b['idVideoGallery']; ?>"><?php echo $b['judul']; ?></a> <a href="<?php echo $baseUrl; ?>media/?type=play&idvideo=<?php echo $b['idVideoGallery']; ?>"><span class="glyphicon glyphicon-play">
                            </span></a>
                        </h4>
                        <p>
                            <?php echo $b['keterangan']; ?>    
                        </p>
                        <hr />
                        <div class="row rating-desc">
                            <div class="col-md-12">
                                <a href="<?php echo $baseUrl; ?>media/?type=play&idvideo=<?php echo $b['idVideoGallery']; ?>"><span class="glyphicon glyphicon-play"></span> Play </a>&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo $baseUrl; ?>media/?type=editvideo&idvideo=<?php echo $b['idVideoGallery']; ?>"><span class="glyphicon glyphicon-edit"></span> Edit </a>&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo $baseUrl; ?>record/?type=deleteembed&idvideo=<?php echo $b['idVideoGallery']; ?>" onclick="return confirm('Apakah Anda Yakin?')"><span class="glyphicon glyphicon-trash"></span> Hapus </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                            
  
            <?php } ?>            
                        
                        </div>
                    </div>
                </div>
            
            <?php 
                }
            ?>
            
        </div>
    </div>
    </div>    
    <!-- END OF CONTENT HOME ADMIN -->
    
</div>
    
<?php 
    require_once "footer.php"; 
    }
?>