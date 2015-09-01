<div class="col-md-4"><br />
            
<?php 
  $tampilWIDGET = mysqli_query($connecDB, "SELECT * FROM widget WHERE inUse='yes'")or die(mysql_error());
  while($Q = mysqli_fetch_array($tampilWIDGET)) {
?>
            <?php if ($Q['idWidget']=='1') { ?>
            <!-- CATEGORY -->
            <div class="panel panel-default" style="border:none;">
              <div class="panel-heading" style="border-radius:0px; border:none;">
                <h3 class="panel-title"><?php echo $Q['namaWidget']; ?></h3>
              </div>
              <ul class="list-group">
              <?php 
                
                $tampilKategori = mysqli_query($connecDB, "SELECT * FROM category ORDER BY idCategory DESC LIMIT 10");
                while($x = mysqli_fetch_array($tampilKategori)) {    
              ?>    
                <li class="list-group-item"><a href="<?php echo $baseUrl; ?>category/<?php echo $x['slug']; ?>/"><?php echo $x['category']; ?></a></li>
              <?php } ?>
              <a href="<?php echo $baseUrl; ?>more/category/" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i> More Category</a>
              </ul>
                
            </div>
            <!-- END OF CATEGORY -->
            <?php } ?>

            <?php if ($Q['idWidget']=='3') { ?>
            <!-- GALLERY FOTO -->
            <div class="panel panel-default" style="border:none;">
              <div class="panel-heading" style="border-radius:0px; border:none;">
                <h3 class="panel-title"><?php echo $Q['namaWidget']; ?></h3>
              </div>
              <div class="panel-body">
                <?php 
                    $tampilGallery = mysqli_query($connecDB, "SELECT * FROM gallery ORDER BY idGallery DESC LIMIT 6");
                    while($y = mysqli_fetch_array($tampilGallery)) {
                ?>  
                  
                    <div class="col-xs-6">
                        <a href="#" class="thumbnail">
                          <img src="<?php echo $baseUrl; ?>images/uploads/images/<?php echo $y['gambar']; ?>" alt="<?php echo $y['alt']; ?>" title="<?php echo $y['title']; ?>" style="height:80px;">
                        </a>
                    </div>
                
                <?php } ?>  
                  
              </div>
                <a href="<?php echo $baseUrl; ?>more/image/" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i> More Pictures</a>
            </div>
            <!-- END OF GALLERY FOTO -->
            <?php } ?>

            <?php if ($Q['idWidget']=='2') { ?>
            <!-- PAGE -->
            <div class="panel panel-default" style="border:none;">
              <div class="panel-heading" style="border-radius:0px; border:none;">
                <h3 class="panel-title"><?php echo $Q['namaWidget']; ?></h3>
              </div>
              <ul class="list-group">
               <?php 
                  $tampilPG = mysqli_query($connecDB, "SELECT * FROM page ORDER BY idPage DESC");
                  while($PG = mysqli_fetch_array($tampilPG)) {
               ?>
                  <li class="list-group-item"><a href="<?php echo $baseUrl; ?>p/<?php echo $PG['url']; ?>"><?php echo $PG['judul']; ?></a></li>
               <?php } ?>
              </ul>
            </div>
            <!-- END OF PAGE -->
            <?php } ?>

            <?php if ($Q['idWidget']=='4') { ?>
            <!-- GALLERY VIDEOS -->
              <div class="panel panel-default" style="border:none;">
              <div class="panel-heading" style="border-radius:0px; border:none;">
                <h3 class="panel-title"><?php echo $Q['namaWidget']; ?></h3>
              </div>
              <div class="panel-body">
                <?php 
                    $tampilVideoGallery = mysqli_query($connecDB, "SELECT * FROM videogallery ORDER BY idVideoGallery DESC LIMIT 6");
                    while($v = mysqli_fetch_array($tampilVideoGallery)) {
                ?>  
                  
                    <div class="col-xs-6">
                        <a href="<?php echo $baseUrl."more/video/".$v['idVideoGallery']; ?>" class="thumbnail">
                          <img src="http://img.youtube.com/vi/<?php echo $v['urlVideo']; ?>/0.jpg" alt="<?php echo $v['judul']; ?>" title="<?php echo $v['judul']; ?>"
                         width="170"    />
                        <?php echo $v['judul']; ?>
                        </a>
                    </div>
                
                <?php } ?>  
                  
              </div>
                <a href="<?php echo $baseUrl; ?>more/video" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i> More Video</a>
            </div>
            <!-- END OF GALLERY VIDEOS -->
            <?php } ?>

            <?php if ($Q['idWidget']=='5') { ?>
            <!-- RECENT POST -->
              <div class="panel panel-default" style="border:none;">
                <div class="panel-heading" style="border-radius:0px; border:none;">
                  <h3 class="panel-title"><?php echo $Q['namaWidget']; ?></h3>
                </div>
                <div class="panel-body">
                  <ul class="list-group">
                  <?php 
                      $tampilRECENT = mysqli_query($connecDB, "SELECT * FROM post WHERE status = 'posted' ORDER BY idPost DESC LIMIT 6");
                      while($P = mysqli_fetch_array($tampilRECENT)) {
                  ?>  
                      

                    <div class="media">
                      <div class="media-left media-middle">
                        <a href="#">
                          <img class="media-object" src="<?php if($P['feature']==''){ echo $baseUrl.'images/defaultImagePost.jpg'; } else { ?> <?php echo $P['feature']; ?> <?php } ?>" alt="<?php echo $P['judul']; ?>" title="<?php echo $P['judul']; ?>" style="width:70px">
                        </a>
                      </div>
                      <div class="media-body">
                        <a href="<?php echo $baseUrl.$P['seourl']."/".$P['modul']; ?>"><?php echo $P['judul']; ?></a>
                      </div>
                    </div>
                  
                  <?php } ?>  
                  </ul>
                </div>
              </div>
            <!-- END OF RECENT POST -->
            <?php } ?>

            <?php if ($Q['idWidget']=='6') { ?>
            <!-- POPULAR POST -->
              <div class="panel panel-default" style="border:none;">
                <div class="panel-heading" style="border-radius:0px; border:none;">
                  <h3 class="panel-title"><?php echo $Q['namaWidget']; ?></h3>
                </div>
                <div class="panel-body">
                  <ul class="list-group">
                  <?php 
                      $tampilPOPULAR = mysqli_query($connecDB, "SELECT *, max(viewer) FROM post WHERE status = 'posted' GROUP BY idPost ORDER BY max(viewer) DESC LIMIT 6");
                      while($O = mysqli_fetch_array($tampilPOPULAR)) {
                  ?>  
                      

                    <div class="media">
                      <div class="media-left media-middle">
                        <a href="#">
                          <img class="media-object" src="<?php if($O['feature']==''){ echo $baseUrl.'images/defaultImagePost.jpg'; } else { ?> <?php echo $O['feature']; ?> <?php } ?>" alt="<?php echo $O['judul']; ?>" title="<?php echo $O['judul']; ?>" style="width:70px">
                        </a>
                      </div>
                      <div class="media-body">
                        <a href="<?php echo $baseUrl.$O['seourl']."/".$O['modul']; ?>"><?php echo $O['judul']; ?></a>
                      </div>
                    </div>
                  
                  <?php } ?>  
                  </ul>
                </div>
              </div>
            <!-- END OF POPULAR POST -->
            <?php } ?>

            <?php if ($Q['idWidget']=='7') { ?>
            <!-- ABOUT AUTHOR -->

            <style type="text/css">
            .profile {
              margin: 20px 0;
            }

            /* Profile sidebar */
            .profile-sidebar {
              padding: 20px 0 10px 0;
              background: #fff;
            }

            .profile-userpic img {
              float: none;
              margin: 0 auto;
              width: 50%;
              height: 50%;
              -webkit-border-radius: 50% !important;
              -moz-border-radius: 50% !important;
              border-radius: 50% !important;
            }

            .profile-usertitle {
              text-align: center;
              margin-top: 20px;
            }

            .profile-usertitle-name {
              color: #5a7391;
              font-size: 16px;
              font-weight: 600;
              margin-bottom: 7px;
            }

            .profile-usertitle-job {
              text-transform: uppercase;
              color: #5b9bd1;
              font-size: 12px;
              font-weight: 600;
              margin-bottom: 15px;
            }

            .profile-userbuttons {
              text-align: center;
              margin-top: 10px;
            }

            .profile-userbuttons .btn {
              text-transform: uppercase;
              font-size: 11px;
              font-weight: 600;
              padding: 6px 15px;
              margin-right: 5px;
            }

            .profile-userbuttons .btn:last-child {
              margin-right: 0px;
            }
                
            .profile-usermenu {
              margin-top: 30px;
            }

            .profile-usermenu ul li {
              border-bottom: 1px solid #f0f4f7;
            }

            .profile-usermenu ul li:last-child {
              border-bottom: none;
            }

            .profile-usermenu ul li a {
              color: #93a3b5;
              font-size: 14px;
              font-weight: 400;
            }

            .profile-usermenu ul li a i {
              margin-right: 8px;
              font-size: 14px;
            }

            .profile-usermenu ul li a:hover {
              background-color: #fafcfd;
              color: #5b9bd1;
            }

            .profile-usermenu ul li.active {
              border-bottom: none;
            }

            .profile-usermenu ul li.active a {
              color: #5b9bd1;
              background-color: #f6f9fb;
              border-left: 2px solid #5b9bd1;
              margin-left: -2px;
            }

            /* Profile Content */
            .profile-content {
              padding: 20px;
              background: #fff;
              min-height: 460px;
            }
            </style>
            <?php 
                    $tampilProfile = mysqli_query($connecDB, "SELECT * FROM administrator")or die(mysql_error());
                    $M = mysqli_fetch_array($tampilProfile);
                  ?>
              <div class="profile-sidebar">
                  <!-- SIDEBAR USERPIC -->
                  <div class="profile-userpic">
                    <img src="<?php echo $baseUrl; ?>images/default_profile.jpg" class="img-responsive" alt="">
                  </div>
                  <!-- END SIDEBAR USERPIC -->
                  <!-- SIDEBAR USER TITLE -->
                  <div class="profile-usertitle">
                    <div class="profile-usertitle-name">
                      <?php echo $M['namaAuthor']; ?>
                    </div>
                    <div class="profile-usertitle-job">
                      <?php echo $M['profesi']; ?>
                    </div>
                  </div>
                  <!-- END SIDEBAR USER TITLE -->
                  <!-- SIDEBAR BUTTONS -->

                  <div class="profile-userbuttons">
                    <a href="<?php echo $baseUrl; ?>p/profile" class="btn btn-success btn-sm">More About</a>
                    <a href="<?php echo $baseUrl; ?>contact/" class="btn btn-danger btn-sm">Message</a>
                  </div>
                  <!-- END SIDEBAR BUTTONS -->
                  
            </div>
            <!-- END OF ABOUT AUTHOR -->
            <?php } ?>
<?php } ?>

<?php 
  $tampilWIDGET_ADDTEXT = mysqli_query($connecDB, "SELECT * FROM textwidget ORDER BY idText DESC")or die(mysql_error());
  while($F = mysqli_fetch_array($tampilWIDGET_ADDTEXT)) {
?>
<br />
  <div class="panel panel-default" style="border:none;">
                <div class="panel-heading" style="border-radius:0px; border:none;">
                  <h3 class="panel-title"><?php echo $F['namaWidget']; ?></h3>
                </div>
                <div class="panel-body">
                  <?php echo $F['textCode']; ?>
                </div>
              </div>
<?php } ?>

</div>