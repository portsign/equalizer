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
            Produk
        </div>
        <div class="panel-body">
            
            <?php 
            if (isset($_GET['type'])) {
                if ($_GET['type']=='addproduk') {
            ?>
            
                <h4>Produk <?php echo $site_name; ?></h4>
                <form action="<?php echo $baseUrl; ?>record" method="POST" enctype="multipart/form-data">
                    <input type="file" name="gambarproduk" required />
                    Nama Lengkap Motor :
                    <input type="text" name="namaproduk" class="form-control" />
                    <br />
                    Kategori
                    <select name="category">
                    <?php
                        $tampilCAT = mysqli_query($connecDB, "SELECT * FROM category ORDER BY idCategory DESC");
                        while($w = mysqli_fetch_array($tampilCAT)) {
                    ?>  
                        <option value="<?php echo $w['idCategory']; ?>"><?php echo $w['category']; ?></option>
                    <?php } ?>
                    </select>
                    <br />
                    <br />
                    Merek :
                    <input type="text" name="merek" class="form-control" />
                    Warna :
                    <input type="text" name="warna" class="form-control" />
                    Harga :
                    <input type="text" name="harga" class="form-control" />
                    Stok :
                    <input type="number" name="stok" class="form-control" style="width:100px" />
                    Spesifikasi :
                    <textarea class="form-control" name="spesifikasi"></textarea>
                    <br />
                    <input type="submit" name="postProduk" class="btn btn-success" value="Post" />
                </form>
            
            <?php
                }
                if ($_GET['type']=='editproduk') {
                    $getIdProduk = $_GET['id'];
                    $tampilEditProduk = mysqli_query($connecDB, "SELECT * FROM produk WHERE idProduk = '$getIdProduk'");
                    $o = mysqli_fetch_array($tampilEditProduk);
            ?>        
                <h4>Edit Produk</h4>
                <hr />
                <form action="<?php echo $baseUrl; ?>record" method="POST" enctype="multipart/form-data">
                    Curent Image :<br />
                    <img src="<?php echo $baseUrl; ?>../images/uploads/images/<?php echo $o['gambar']; ?>" width="200" /><br /><br />
                    <input type="hidden" name="id" value="<?php echo $o['idProduk']; ?>" />
                    <input type="file" name="gambarproduk" />
                    Nama Lengkap Motor :
                    <input type="text" name="namaproduk" value="<?php echo $o['namaProduk']; ?>" class="form-control" />
                    <br />
                    Kategori
                    <select name="category">
                    <?php
                        $tampilCAT = mysqli_query($connecDB, "SELECT * FROM category ORDER BY idCategory DESC");
                        while($w = mysqli_fetch_array($tampilCAT)) {
                    ?>  
                        <option value="<?php echo $w['idCategory']; ?>" <?php if ($w['idCategory']==$o['idCategory']) { echo 'selected'; } ?> ><?php echo $w['category']; ?></option>
                    <?php } ?>
                    </select>
                    <br />
                    <br />
                    Merek :
                    <input type="text" name="merek" value="<?php echo $o['merek']; ?>" class="form-control" />
                    Warna :
                    <input type="text" name="warna" value="<?php echo $o['warna']; ?>" class="form-control" />
                    Harga :
                    <input type="text" name="harga" value="<?php echo $o['harga']; ?>" class="form-control" />
                    Stok :
                    <input type="number" name="stok" value="<?php echo $o['stok']; ?>" class="form-control" style="width:100px" />
                    Spesifikasi :
                    <textarea class="form-control" name="spesifikasi"><?php echo $o['spesifikasi']; ?></textarea>
                    <br />
                    <input type="submit" name="editProduk" class="btn btn-success" value="Update" />
                    <a href="<?php echo $baseUrl; ?>./produkpost/" class="btn btn-warning">Batal</a>
                </form>
            <?php
                }
            } else {
            ?>
            <a href="?type=addproduk" class="btn btn-info"><i class="glyphicon glyphicon-plus"></i> Add produk</a>
            <a href="../category/?type=addCategory" class="btn btn-warning"><i class="glyphicon glyphicon-plus"></i> Add Category</a>
            <style>
            .custom-search-form{
                margin-top:5px;
            }
            </style>
        <div class="col-lg-3">
            <div class="input-group custom-search-form">
              <input type="text" class="form-control">
              <span class="input-group-btn">
              <button class="btn btn-default" type="button">
              <span class="glyphicon glyphicon-search"></span>
             </button>
             </span>
             </div><!-- /input-group -->
        </div>            <table class="table">
                <thead>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Merek</th>
                    <th>Warna</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Gambar</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    
                    <?php 
                        $tampilProduk = mysqli_query($connecDB, "SELECT * FROM produk ORDER BY idProduk DESC");
                        $no = 1;
                        while($x = mysqli_fetch_array($tampilProduk)) {
                    
                        $getIDC = $x['idCategory'];        
                        $tampilKategori = mysqli_query($connecDB, "SELECT * FROM category WHERE idCategory = '$getIDC'");
                        $r = mysqli_fetch_array($tampilKategori);
                            
                    ?>    
                    <tr>    
                        <td><?php echo $no; ?></td>
                        <td><?php echo $x['namaProduk']; ?></td>
                        <td><?php echo $r['category']; ?></td>
                        <td><?php echo $x['merek']; ?></td>
                        <td><?php echo $x['warna']; ?></td>
                        <td><?php echo "Rp".format_rupiah($x['harga']).",-"; ?></td>
                        <td><?php echo $x['stok']; ?></td>
                        <td><img src="<?php echo $baseUrl."../images/uploads/images/".$x['gambar']; ?>" width="100" /></td>
                        <td><a href="?type=editproduk&id=<?php echo $x['idProduk']; ?>" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> <a href="<?php echo $baseUrl; ?>record/?type=deleteproduk&id=<?php echo $x['idProduk']; ?>" onclick="return confirm('Apakah Anda Yakin?')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a></td>
                    </tr>
                    <?php $no++; } ?>
                    
                </tbody>
            </table>
            
            <?php } ?>
        </div>
    </div>
    </div>    
    <!-- END OF CONTENT HOME ADMIN -->
    
</div>
    
<?php 
    require_once "footer.php"; 
    }
?>