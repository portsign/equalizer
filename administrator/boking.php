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
    
<?php require_once "navbar.php";

            $currentDay = date("l");
            $currentDate = date("d");
            $currentMonth = date("F");
            $currentYear = date("Y");
 ?> 	
<div class="container-fluid main-container">  		
    <?php require_once "sidebar.php"; ?>

    <!-- CONTENT HOME ADMIN -->
    <div class="col-md-10 content">
        <div class="panel panel-default">
        <div class="panel-heading">
            Boking List
        </div>
        <div class="panel-body">
            <table class="table">
                <thead>
                    <th>No</th>
                    <th>Nama Member</th>
                    <th>Contact</th>
                    <th>Nama Produk</th>
                    <th>Jumlah</th>
                    <th>Tgl Boking</th>
                    <th>Status</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php 
                        $tampilBoking = mysqli_query($connecDB, "SELECT b.*,u.fullName,u.nohp, p.* FROM boking b JOIN usermember u ON b.idMember=u.idMember JOIN produk p ON b.idProduk=p.idProduk WHERE b.hari = '$currentDay' AND b.tanggal = '$currentDate' AND b.bulan = '$currentMonth' AND b.tahun = '$currentYear' ORDER BY b.idBoking DESC")or die(mysql_error());
                        $no = 1;
                        while($x = mysqli_fetch_array($tampilBoking)) {
                    ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $x['fullName']; ?></td>
                        <td><?php echo $x['nohp']; ?></td>
                        <td><?php echo $x['namaProduk']; ?></td>
                        <td><?php echo $x['jumlah']; ?></td>
                        <td><?php 
                        
                            if ($x['hari']=='Monday') {
                                $x['hari']='Senin';
                            }
                            if ($x['hari']=='Tuesday') {
                                $x['hari']='Selasa';
                            }
                            if ($x['hari']=='Wednesday') {
                                $x['hari']='Rabu';
                            }
                            if ($x['hari']=='Thursday') {
                                $x['hari']='Kamis';
                            }
                            if ($x['hari']=='Friday') {
                                $x['hari']='Jumat';
                            }
                            if ($x['hari']=='Saturday') {
                                $x['hari']='Sabtu';
                            }
                            if ($x['hari']=='Sunday') {
                                $x['hari']='Minggu';
                            }
                            
                            echo "<strong>".$x['hari']."</strong> ".$x['tanggal']." ".$x['bulan']." ".$x['tahun']; ?></td>
                        <td>
                            <?php 
                                if ($x['status']=='Pending') { 
                            ?>
                                <a href="<?php echo $baseUrl; ?>record/?type=changestatus&idboking=<?php echo $x['idBoking']; ?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-thumbs-up"></i> Accept</a>
                            <?php } else { ?>
                                <a href="#" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-ok"></i> Accepted</a>
                            <?php } ?>
                        </td>
                        <td>
                            <a href="<?php echo $baseUrl; ?>record/?type=deleteboking&idboking=<?php echo $x['idBoking']; ?>" onclick="return confirm('Apakah Anda Yakin?')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>
                        </td>
                    </tr>
                    <?php $no++; } ?>
                </tbody>
            </table>

        </div>
    </div>
    </div>    
    <!-- END OF CONTENT HOME ADMIN -->
    
</div>
    
<?php 
    require_once "footer.php"; 
    }
?>