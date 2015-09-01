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
            All Post
        </div>
        <div class="panel-body" style="border-bottom:1px solid #eaeaea;">
            <div class="col-lg-2">
            <a href="<?php echo $baseUrl."post/"; ?>" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Add New Post</a>    
            
            </div>

		<div class="col-lg-6">
            <div class="input-group custom-search-form">
              <input type="text" class="form-control" placeholder="filter">
              <span class="input-group-btn">
              <button class="btn btn-default" type="button">
              <span class="glyphicon glyphicon-search"></span>
             </button>
             </span>
             </div><!-- /input-group -->
        </div>
	    </div>

        <div class="panel-body">
        <div class="col-md-12">

            
            
            
        <h4>All Post </h4>
           
        
            
                <div class="table-responsive">
                <form action="<?php echo $baseUrl; ?>record" method="POST">
                <table id="mytable" class="table table-bordred table-striped">
                <thead>
                    <th><input type="checkbox" name="checkbox[]" id="checkall" /></th>
                    <th>No.</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Page</th>
                    <th>Artikel</th>
                    <th>Status</th>
                    <th>Viewer</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </thead>
                <tbody>

                <?php 

                    $p      = new PagingAllpost;
                    $batas  = 10;
                    $posisi = $p->cariPosisi($batas);

                ?>

                <?php 
                    header('Content-Type: text/plain');

                    function antiinjection($data){
                      $filter_sql = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES,'UTF-8'))));
                      return $filter_sql;
                    }
                    $tampilPost = mysqli_query($connecDB, "SELECT * FROM post ORDER BY idPost DESC LIMIT $posisi,$batas")or die(mysqli_error());    
                    $numbpost = 1;
                    while($o=mysqli_fetch_array($tampilPost)) {
                ?>    

                <tr>
                    <td><input type="checkbox" name="deleteCustom[]" class="checkthis" value="<?php echo $o['idPost']; ?>" /></td>
                    <td><?php echo $numbpost; ?></td>
                    <td><a href="#"><?php echo $o['judul']; ?></a></td>
                    <td>
                      <?php 

                          $getIDCAT = $o['idCategory'];
                          $tampilCAT = mysqli_query($connecDB, "SELECT * FROM category WHERE idCategory = '$getIDCAT'");
                          $gg = mysqli_fetch_array($tampilCAT); 
                          echo $gg['category']; 

                      ?>
                    </td>
                    <td><?php echo $o['modul']; ?></td>
                    <td><?php 

                        $string = strip_tags($o['isi']);

                        if (strlen($string) > 180) {

                            // truncate string
                            $stringCut = substr($string, 0, 80);

                            // make sure it ends in a word so assassinate doesn't become ass...
                            $string = substr($stringCut, 0, strrpos($stringCut, ' ')).''; 
                        }
                        echo $string;

                        ?>


                    </td>
                    <td><?php echo "<b>".$o['status']."</b>"; ?></td>
                    <td><?php echo $o['viewer']; ?></td>
                    <td><p data-placement="top" data-toggle="tooltip" title="Edit"><a href="<?php echo $baseUrl."post/?type=editPost&idPost=".$o['idPost']; ?>" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></a></p></td>
                    <td><p data-placement="top" data-toggle="tooltip" title="Delete"><a href="" class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete<?php echo $o['idPost']; ?>" ><span class="glyphicon glyphicon-trash"></span></a></p></td>
                </tr>

                

                <div class="modal fade" id="delete<?php echo $o['idPost']; ?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                  <div class="modal-dialog">
                <div class="modal-content">
                      <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Heading">Delete post <?php echo $o['idPost']; ?></h4>
                  </div>
                      <div class="modal-body">

                   <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Apakah anda yakin ingin menghapus postingan ini?</div>

                  </div>
                    <div class="modal-footer ">
                        <a href="<?php echo $baseUrl."record/?type=deletePost&idPost=".$o['idPost']; ?>" type="button" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                  </div>
                    </div>
                <!-- /.modal-content --> 
              </div>
                  <!-- /.modal-dialog --> 
                </div>
                <?php $numbpost++; } ?>    
                <div class="input-group">
                  <span class="input-group-btn">
                    <select name="type" class="form-control" style="width:150px">
                        <option value="NULL">-Bulk Options-</option>    
                        <option value="postall">Post All</option>    
                        <option value="delete">Delete Permanently</option>    
                    </select> 
                  </span>
                  <input type="submit" name="bulkDelete" onclick="return confirm('Apakah Anda Yakin?')" class="btn btn-info" value="Apply">
                </div><!-- /input-group -->
                </tbody>

            </table>
            </form>
            <?php 
                        $jmldata = mysqli_num_rows(mysqli_query($connecDB, "SELECT * FROM post"));
                        $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
                        $linkHalaman = $p->navHalaman($_GET['page'], $jmlhalaman);

                        echo "<div class='col-md-12'><div id=paging><font size='3'><a class='btn btn-success'><<</a> $linkHalaman</font></div><br /></div>";
                    ?>

        </div>
            
        </div>


<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Edit Your Detail</h4>
      </div>
          <div class="modal-body">
          <div class="form-group">
        <input class="form-control " type="text" placeholder="Mohsin">
        </div>
        <div class="form-group">
        
        <input class="form-control " type="text" placeholder="Irshad">
        </div>
        <div class="form-group">
        <textarea rows="2" class="form-control" placeholder="CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan"></textarea>
    
        
        </div>
      </div>
          <div class="modal-footer ">
        <button type="button" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
      </div>
        </div>
    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog --> 
    </div>
    
    
    
    
        </div>
    </div>
    </div>    
    <!-- END OF CONTENT HOME ADMIN -->
    <script>
    $(document).ready(function(){
$("#mytable #checkall").click(function () {
        if ($("#mytable #checkall").is(':checked')) {
            $("#mytable input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });

        } else {
            $("#mytable input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
    
    $("[data-toggle=tooltip]").tooltip();
});
    </script>
</div>
    
<?php 
    require_once "footer.php"; 
    }
?>