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
            <?php 
                if (isset($_GET['action'])) {
                    if ($_GET['action']=='forgoten') {
                       ?>
                       <div class="account-wall">
                        <center><h1 style="font-size:70px"><i class="glyphicon glyphicon-equalizer"></i></h1>
                            <h1>EQUALIZER</h1>
                        </center>
                        <form action="<?php echo $baseUrl."record"; ?>" method="post" class="form-signin">
                        Please enter your <b>E-mail address</b>. You will receive a new password  vie e-mail.<br /><br />
                        <input type="email" name="email" class="form-control" placeholder="Email" required autofocus>
                        <br />
                        <input type="submit" name="forgotPassword" class="btn btn-lg btn-primary btn-block" value="Confirm" />
                        <br />
                        <a href="./">Back to Login Page</a>
                        </form>

                    </div>
                       <?php
                    }
                } else {
            ?>
            <div class="account-wall">
                <center><h1 style="font-size:70px"><i class="glyphicon glyphicon-equalizer"></i></h1>
                    <h1>EQUALIZER</h1>
                </center>
                <form action="<?php echo $baseUrl."record"; ?>" method="post" class="form-signin">
                <input pattern=".{5,10}" type="text" name="username" class="form-control" placeholder="Username" required autofocus>
                <input pattern=".{5,20}" type="password" name="password" class="form-control" placeholder="Password" required>
                <input type="submit" name="login" class="btn btn-lg btn-primary btn-block" value="Sign in" />
                <br />
                <a href="?action=forgoten">Forgot Password?</a>
                <a href="" class="pull-right">Need Helps?</a>
                </form>
            </div>

            <?php } ?>

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
            <h1><i class="glyphicon glyphicon-equalizer"></i> EQUALIZER CMS</h1>
            <h3>Welcome to<small> EQUALIZER CMS.</small></h3>
            <p>You may want to browse the <a href="">ReadMe Documentation</a> at your leisure. Otherwise, Just Fill in the Information below and you'll be on your way to using the most extendable and powerfull personal publishing platform in Yogyakarta.</p>
            <center>
                <h1 style="font-size:105px"><i class="glyphicon glyphicon-equalizer"></i></h1>
                <h1 style="font-size:65px">EQUALIZER</h1>
            </center>
        </div>
    </div>
    </div>    
    <!-- END OF CONTENT HOME ADMIN -->
    
</div>
    
<?php 
    require_once "footer.php"; 
    }
?>