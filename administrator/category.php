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
                <img class="profile-img" src="images/photo.jpg" alt="" />
                <form action="<?php echo $baseUrl."record"; ?>" method="post" class="form-signin">
                    <input type="text" name="username" class="form-control" placeholder="Username" required autofocus />
                    <input type="password" name="password" class="form-control" placeholder="Password" required />
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
            Category
        </div>
        <div class="panel-body">

        <?php  
            if (isset($_GET['type'])) {
            if ($_GET['type']=='addCategory') {
        ?>
		<div class="col-md-6">
        <form action="<?php echo $baseUrl."record"; ?>" method="post">
            Nama Kategori :
            <input type="text" name="category" class="form-control" required autofocus />
            <i>The Name is how it Appears on  your site</i><br /><br />
            Slug
            <input type="text" name="slug" class="form-control" required />
            <i>THe "slug" is the URL-Friendly version of the name. 
                it is usually all lowercase and contains only letters, 
                number, and hyphens.</i><br />
            <textarea class="form-control" name="description"></textarea><br />
            <input type="submit" name="tambahCategory" class="btn btn-success" value="Simpan" />
        </form>    
        </div>    
        
        <div class="col-md-12">

        <?php
                } else {
                    
                }
            } else {
        ?>    
            
        <a href="?type=addCategory" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Add Category</a>            
        <div class="table-responsive">    
                
              <table id="mytable" class="table table-bordred table-striped">
                <thead>
                     <th>No.</th>
                     <th>Nama Kategori</th>
                     <th>Slug</th>
                     <th>Jumlah Post</th>
                     <th>Edit</th> 
                     <th>Delete</th>
                </thead>
             <tbody>

    <?php 

            $p      = new PagingCategory;
            $batas  = 10;
            $posisi = $p->cariPosisi($batas);

    ?>
         
    <?php 
        $tampilKategori = mysqli_query($connecDB, "SELECT * FROM category ORDER BY idCategory DESC LIMIT $posisi,$batas");
        $numb = 1;
        while($u = mysqli_fetch_array($tampilKategori)) {
        
    ?>    
        
    <tr>
        <td><?php echo $numb; ?></td>
        <td><?php echo $u['category']; ?></td>
        <td><?php echo $u['slug']; ?></td>
        <td>3</td>
        <td><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit<?php echo $u['idCategory']; ?>" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>
        <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete<?php echo $u['idCategory']; ?>" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
    </tr>

    <div class="modal fade" id="edit<?php echo $u['idCategory']; ?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Edit Your <strong><?php echo $u['category']; ?></strong> Category</h4>
      </div>
        <div class="modal-body">
        <div class="form-group">
        <form action="<?php echo $baseUrl; ?>record.php" method="POST">
        Nama Kategori :
        <input type="hidden" name="id" value="<?php echo $u['idCategory']; ?>"> 
        <input class="form-control" type="text" name="category" value="<?php echo $u['category']; ?>" placeholder="Nama Kategori">
        </div>
        <div class="form-group">
        Slug 
        <input class="form-control" type="text" name="slug" value="<?php echo $u['slug']; ?>" placeholder="Slug">
        </div>
        <div class="form-group">
        Keterangan :
        <textarea rows="2" class="form-control" name="keterangan" placeholder="Keterangan Kategori"><?php echo $u['description']; ?></textarea>
    
        
        </div>
      </div>
          <div class="modal-footer ">
        <button type="submit" class="btn btn-warning btn-lg" name="editCategory" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
      
      </form>
      </div>
        </div>
    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog --> 
    </div>
    
    
    
    <div class="modal fade" id="delete<?php echo $u['idCategory']; ?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Delete <b><?php echo $u['category']; ?></b> category</h4>
      </div>
    <div class="modal-body">
       
       <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Record?</div>
       
      </div>
      <div class="modal-footer ">
        <a href="<?php echo $baseUrl; ?>record.php?type=deleteCategory&id=<?php echo $u['idCategory']; ?>" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</a>
        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
      </div>
    </div>
    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog --> 
    </div>

    <?php $numb++; } ?>    
        
    </tbody>
</table>

<?php 
                        $jmldata = mysqli_num_rows(mysqli_query($connecDB, "SELECT * FROM category"));
                        $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
                        $linkHalaman = $p->navHalaman($_GET['page'], $jmlhalaman);

                        echo "<div class='col-md-12' style='border:none;'><div id=paging><font size='3'><a class='btn btn-success'><<</a> $linkHalaman</font></div><br /></div>";
                    ?>
                
            </div>
            
        <?php } ?>
            
        </div>



            
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
    </div>
    </div>    
    <!-- END OF CONTENT HOME ADMIN -->
    
</div>
    
<?php 
    require_once "footer.php"; 
    }
?>