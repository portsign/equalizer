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
            Profile
        </div>
        <div class="panel-body">
            <?php 
                $tampilProfile = mysqli_query($connecDB, "SELECT * FROM administrator")or die(mysql_error());
                $a = mysqli_fetch_array($tampilProfile);
            ?>
            
            <form action="<?php echo $baseUrl; ?>record.php" method="POST">
                Author Name :
                <input type="text" name="namaAuthor" class="form-control" value="<?php echo $a['namaAuthor']; ?>" placeholder="Nama Author" />
                Profesi :
                <input type="text" name="profesi" class="form-control" value="<?php echo $a['profesi']; ?>" placeholder="Profesi" />
                Google+ Link :
                <input type="text" name="linkGoogle" class="form-control" value="<?php echo $a['linkGoogle']; ?>" placeholder="Link Google+" />
                <br />
                <input type="submit" name="author" class="btn btn-success" value="Simpan" />
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