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
            Menu
        </div>
        <div class="panel-body">
            
            <?php 
                if ($_GET['act']) {
                    if ($_GET['act']=='tambahmenu') { ?>
                        
                        <h3>Tambah Menu</h3>
                        <form action="<?php echo $baseUrl; ?>record" method="post">
                            <input type="text" name="namaMenu" class="form-control" style="width:300px;" placeholder="Nama Menu" required />
                            <input type="text" name="modul" class="form-control" style="width:300px;" placeholder="Modul" required />
                            <textarea class="form-control" name="keterangan" style="width:50%;" placeholder="Keterangan"></textarea>
                            <br />
                            <input type="submit" name="tambahMenu" class="btn btn-success" value="Simpan" /><a href="<?php echo $baseUrl."menu/"; ?>" class="btn btn-info">Batal</a>
                        </form>
                        
                    <?php
                    }
                    if ($_GET['act']=='submenu') { ?>
            
                        <h3>Tambah Sub Menu</h3>
                        <form action="<?php echo $baseUrl.'record'; ?>" method="post">
                            
                            <select name="idMenu" class="form-control" style="width:200px;" required>
                                <?php 
                                    $tampilMenus = mysqli_query($connecDB, "SELECT * FROM menu ORDER BY idMenu DESC");
                                    while($q = mysqli_fetch_array($tampilMenus)) {
                                    
                                ?>
                                
                                    <option value="<?php echo $q['idMenu']; ?>"><?php echo $q['NamaMenu']; ?></option>
                                    
                                <?php } ?>
                            </select>
                            <input type="text" name="namaSubMenu" placeholder="Nama Sub Menu" class="form-control" style="width:300px" required />
                            <input type="text" name="modul" placeholder="Modul" class="form-control" style="width:300px" required />
                            <textarea class="form-control" style="width:50%" name="keterangan" placeholder="Keterangan"></textarea>
                            <br />
                            <input type="submit" name="tambahSubMenu" class="btn btn-success" value="Simpan" />
                            <a href="<?php echo $baseUrl.'./menu/'; ?>" class="btn btn-default" >Batal</a>
                        </form>
            
                    <?php
                    } 
                    if ($_GET['act']=='edit') { ?>
                        <h3>Edit Menu</h3>
                        <?php 
                            $getID = $_GET['id'];
                            $tampilEdit = mysqli_query($connecDB, "SELECT * FROM menu WHERE idMenu = '$getID'");
                            $r = mysqli_fetch_array($tampilEdit);
                        ?>
                        <form action="<?php echo $baseUrl; ?>record" method="post">
                            <input type="hidden" name="id" value="<?php echo $r['idMenu']; ?>" />
                            <input type="text" name="namaMenu" value="<?php echo $r['NamaMenu']; ?>" class="form-control" style="width:300px;" required placeholder="Nama Menu" />
                            <input type="text" name="modul" value="<?php echo $r['modul']; ?>" class="form-control" style="width:300px;" required placeholder="Modul" />
                            <textarea class="form-control" name="keterangan" style="width:50%;" placeholder="Keterangan"><?php echo $r['keterangan']; ?></textarea>
                            <br />
                            <input type="submit" name="editMenu" class="btn btn-success" value="Simpan" /><a href="<?php echo $baseUrl."menu/"; ?>" class="btn btn-info">Batal</a>
                        </form>
                    <?php 
                        }
                    if ($_GET['act']=='editSubMenu') {
                        $getIdSub = $_GET['id'];
                        $getId = $_GET['idMenu'];
                        $tampilSubMenus = mysqli_query($connecDB, "SELECT * FROM submenu WHERE idSubmenu='$getIdSub'");
                        $y = mysqli_fetch_array($tampilSubMenus);
                        $tampilMenus = mysqli_query($connecDB, "SELECT * FROM menu WHERE idMenu='$getId'");
                        $o = mysqli_fetch_array($tampilMenus);
                        //echo $getIdSub; ?>
                        <div style="border-left:4px solid #dfdfdf; padding:10px;">
                        <h3>Edit Sub Menu <i><font color="gray">from</font></i> <?php echo $o['NamaMenu']; ?></h3>
                        <form action="<?php echo $baseUrl.'record'; ?>" method="post">
                            
                            <select name="idMenu" class="form-control" style="width:200px;" required>
                                <?php 
                                    $tampilMenus = mysqli_query($connecDB, "SELECT * FROM menu");
                                    while($q = mysqli_fetch_array($tampilMenus)) {
                                ?>
                                
                                <option value="<?php echo $q['idMenu']; ?>"><?php echo $q['NamaMenu']; ?></option>
                                    
                                <?php } ?>
                            </select>
                            
                            <input type="hidden" name="id" value="<?php echo $y['idSubmenu']; ?>" />
                            <input type="text" name="namaSubMenu" placeholder="Nama Sub Menu" value="<?php echo $y['namaSubMenu']; ?>" class="form-control" style="width:300px" required />
                            <input type="text" name="modul" placeholder="Modul" class="form-control" value="<?php echo $y['modul']; ?>" style="width:300px" required />
                            <textarea class="form-control" style="width:50%" name="keterangan" placeholder="Keterangan"><?php echo $y['keterangan']; ?></textarea>
                            <br />
                            <input type="submit" name="editSubMenu" class="btn btn-success" value="Simpan" />
                            <a href="<?php echo $baseUrl.'./menu/'; ?>" class="btn btn-default" >Batal</a>
                        </form>
                        </div>
            
                    <?php 
                    }
                    } else {
            ?>
            
            
            <a href="?act=tambahmenu" class="btn btn-default"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Menu</a>
            <a href="?act=submenu" class="btn btn-default"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Sub Menu</a>
            <hr />
            <table class="table table-list-search">
                <thead>
                    <th>No</th>
                    <th>Nama Menu & Sub Menu</th>
                    <th>Modul</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    
                    <?php 
                        $showMenu = mysqli_query($connecDB, "SELECT * FROM menu ORDER BY idMenu DESC LIMIT 10");
                        $no=1;
                        while($x = mysqli_fetch_array($showMenu)) {
                        
                    ?>
                    
                    <tr style="border-left:6px solid #dfdfdf;">
                        <td><?php echo $no; ?></td>
                        <td><?php echo $x['NamaMenu']; ?></td>
                        <td><?php echo $x['modul']; ?></td>
                        <td><?php echo $x['keterangan']; ?></td>
                        <td><a href="?act=edit&id=<?php echo $x['idMenu']; ?>" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> <a href="<?php echo $baseUrl."record/?type=delete&id=".$x['idMenu']; ?>" onclick="return confirm('Apakah Anda Yakin?')" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>
                        </td>

                    <?php 
                        $getIdMenu = $x['idMenu'];
                        $showSubMenu = mysqli_query($connecDB, "SELECT * FROM submenu WHERE idMenu = '$getIdMenu'"); 
                        while($g = mysqli_fetch_array($showSubMenu)) {
                    ?>    
                        
                        <tr>
                            <td></td>
                            <td><li><font color="blue"><?php echo $g['namaSubMenu']; ?></font></li></td>
                            <td><font color="blue"><?php echo $g['modul']; ?></font></td>
                            <td><font color="blue"><?php echo $g['keterangan']; ?></font></td>
                            <td><font color="blue"><a href="?act=editSubMenu&id=<?php echo $g['idSubmenu']; ?>&idMenu=<?php echo $x['idMenu']; ?>" class="btn btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> <a href="<?php echo $baseUrl."record/?type=deleteSubMenu&id=".$g['idSubmenu']; ?>" onclick="return confirm('Apakah Anda Yakin?')" class="btn btn-xs"><i class="glyphicon glyphicon-remove"></i> Delete</a></font></td>
                        </tr>
                    
                    <?php } ?>
                    
                    </tr>
                    
                    <?php 
                        $no++;
                        } 
                    ?>
                    
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