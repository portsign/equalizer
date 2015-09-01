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
            <i class="glyphicon glyphicon-cog"></i> Change Password
        </div>
        <div class="panel-body">
            <?php 
                            if (isset($_GET['action'])) {
                                if ($_GET['action']=='wrongoldpass') {
                                    echo '<div class="alert alert-warning" role="alert">Password Lama Salah</div>';
                                }
                                if ($_GET['action']=='wrongconfirm') {
                                    echo '<div class="alert alert-warning" role="alert">Password Konfirmasi Salah</div>';
                                }
                                if ($_GET['action']=='success') {
                                    echo '<div class="alert alert-info" role="alert">Password Berhasil Diganti, Session Update Automaticaly</div>';
                                }
                            }
                        ?>
                        <form action="<?php echo $baseUrl; ?>record.php" method="POST">
                            Password Lama :
                            <input type="password" name="oldpassword" class="form-control" placeholder="Password Lama" /><br />
                            Password Baru :
                            <input type="password" name="newpassword" class="form-control" placeholder="Password Baru" /><br />
                            Konfirmasi Password Baru :
                            <input type="password" name="renewpassword" class="form-control" placeholder="Konfirmasi Password Baru" /><br />
                            <input type="submit" name="gantipassword" class="btn btn-success" value="Simpan" />
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