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
            Widget
        </div>
        <div class="panel-body">
            <div class="col-md-6">
                <h3>Select Widget</h3>
                <hr />
                <form action="<?php echo $baseUrl; ?>record" method="POST">
                    <select name="widget" class="form-control">
                    <?php 
                        $TW = mysqli_query($connecDB, "SELECT * FROM widget WHERE inUse = 'no' ORDER BY idWidget ASC")or die(mysql_error());
                        while($H = mysqli_fetch_array($TW)){
                    ?>
                        
                            <option value="<?php echo $H['idWidget']; ?>"><?php echo $H['namaWidget']; ?></option>
                        
                    <?php 
                        }
                    ?>
                    </select>
                    
                    <br />
                    <input type="submit" name="widgetSetting" class="btn btn-success" value="Save" /> 
                    <hr />
                </form>
                <h3>Custom Widget</h3>
                <form action="<?php echo $baseUrl; ?>record" method="POST">
                    Nama Widget
                    <input type="text" name="namaWidget" class="form-control" placeholder="Nama Widget" /><br />
                    Add Text / HTML Code
                    <textarea class="form-control" name="textWidget" placeholder="TEXT or HTML Code"></textarea><br />
                    <input type="submit" name="addText" class="btn btn-primary" value="Save" />
                </form> 
            </div>
            <div class="col-md-6">
                <h3>In Use</h3>
                <hr />
                <?php 
                    $tampilWidget = mysqli_query($connecDB, "SELECT * FROM widget WHERE inUse='yes' ")or die(mysqli_error());
                    while($W = mysqli_fetch_array($tampilWidget)){
                        echo '

                            <div class="alert alert-warning alert-dismissible" role="alert">
                              <a href="'.$baseUrl."record/?type=deleteWidget&id=".$W["idWidget"].'" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></a>
                              <strong>'.$W["namaWidget"].'
                            </div>
                        ';
                    }
                ?>
                <?php 
                    $tampilTextWidget = mysqli_query($connecDB, "SELECT * FROM textwidget")or die(mysql_error());
                    while($T = mysqli_fetch_array($tampilTextWidget)){
                        echo '
                            <div class="alert alert-danger alert-dismissible" role="alert">
                              <a href="'.$baseUrl."record/?type=deleteWidgetText&id=".$T["idText"].'" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></a>
                              <strong>'.$T["namaWidget"].'</strong> <i>(Custom Widget)</i>
                            </div>
                        ';
                    }
                ?>
            </div>
            
        </div>
    </div>
    </div>    
    <!-- END OF CONTENT HOME ADMIN -->
    
</div>
    
<?php 
    require_once "footer.php"; 
    }
?>