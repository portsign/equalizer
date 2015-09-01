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
 <style type="text/css">


.range {
    display: table;
    position: relative;
    height: 25px;
    margin-top: 20px;
    background-color: rgb(245, 245, 245);
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
    cursor: pointer;
}

.range input[type="range"] {
    -webkit-appearance: none !important;
    -moz-appearance: none !important;
    -ms-appearance: none !important;
    -o-appearance: none !important;
    appearance: none !important;

    display: table-cell;
    width: 100%;
    background-color: transparent;
    height: 25px;
    cursor: pointer;
}
.range input[type="range"]::-webkit-slider-thumb {
    -webkit-appearance: none !important;
    -moz-appearance: none !important;
    -ms-appearance: none !important;
    -o-appearance: none !important;
    appearance: none !important;

    width: 11px;
    height: 25px;
    color: rgb(255, 255, 255);
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: 0px;
    background-color: rgb(153, 153, 153);
}

.range input[type="range"]::-moz-slider-thumb {
    -webkit-appearance: none !important;
    -moz-appearance: none !important;
    -ms-appearance: none !important;
    -o-appearance: none !important;
    appearance: none !important;
    
    width: 11px;
    height: 25px;
    color: rgb(255, 255, 255);
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: 0px;
    background-color: rgb(153, 153, 153);
}

.range output {
    display: table-cell;
    padding: 3px 5px 2px;
    min-width: 40px;
    color: rgb(255, 255, 255);
    background-color: rgb(153, 153, 153);
    text-align: center;
    text-decoration: none;
    border-radius: 4px;
    border-bottom-left-radius: 0;
    border-top-left-radius: 0;
    width: 1%;
    white-space: nowrap;
    vertical-align: middle;

    -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    -ms-transition: all 0.5s ease;
    transition: all 0.5s ease;

    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: -moz-none;
    -o-user-select: none;
    user-select: none;
}
.range input[type="range"] {
    outline: none;
}

.range.range-primary input[type="range"]::-webkit-slider-thumb {
    background-color: rgb(66, 139, 202);
}
.range.range-primary input[type="range"]::-moz-slider-thumb {
    background-color: rgb(66, 139, 202);
}
.range.range-primary output {
    background-color: rgb(66, 139, 202);
}
.range.range-primary input[type="range"] {
    outline-color: rgb(66, 139, 202);
}

.range.range-success input[type="range"]::-webkit-slider-thumb {
    background-color: rgb(92, 184, 92);
}
.range.range-success input[type="range"]::-moz-slider-thumb {
    background-color: rgb(92, 184, 92);
}
.range.range-success output {
    background-color: rgb(92, 184, 92);
}
.range.range-success input[type="range"] {
    outline-color: rgb(92, 184, 92);
}

.range.range-info input[type="range"]::-webkit-slider-thumb {
    background-color: rgb(91, 192, 222);
}
.range.range-info input[type="range"]::-moz-slider-thumb {
    background-color: rgb(91, 192, 222);
}
.range.range-info output {
    background-color: rgb(91, 192, 222);
}
.range.range-info input[type="range"] {
    outline-color: rgb(91, 192, 222);
}

.range.range-warning input[type="range"]::-webkit-slider-thumb {
    background-color: rgb(240, 173, 78);
}
.range.range-warning input[type="range"]::-moz-slider-thumb {
    background-color: rgb(240, 173, 78);
}
.range.range-warning output {
    background-color: rgb(240, 173, 78);
}
.range.range-warning input[type="range"] {
    outline-color: rgb(240, 173, 78);
}

.range.range-danger input[type="range"]::-webkit-slider-thumb {
    background-color: rgb(217, 83, 79);
}
.range.range-danger input[type="range"]::-moz-slider-thumb {
    background-color: rgb(217, 83, 79);
}
.range.range-danger output {
    background-color: rgb(217, 83, 79);
}
.range.range-danger input[type="range"] {
    outline-color: rgb(217, 83, 79);
}
 </style>
<div class="container-fluid main-container">  		
    <?php require_once "sidebar.php"; ?>
    <script type="text/javascript" src="<?php echo $baseUrl; ?>js/jscolor/jscolor.js"></script>
    <!-- CONTENT HOME ADMIN -->
    <div class="col-md-10 content">
        <div class="panel panel-default">
        <div class="panel-heading">
            Setting Themes
        </div>
        <div class="panel-body">
            <h3>Theme Config</h3>
            <?php 
                $tampilData = mysqli_query($connecDB, "SELECT * FROM theme")or die(mysqli_error());
                $z = mysqli_fetch_array($tampilData);
            ?>
            <form action="<?php echo $baseUrl; ?>record" method="POST" enctype="multipart/form-data">
                Select Theme
                <input type="hidden" name="theme" value="<?php echo $z['namatema']; ?>" /> 
                <select name="pathBootstrap" class="form-control" style="width:200px">
                    <?php 
                        $tampilThemes = mysqli_query($connecDB, "SELECT * FROM custombootstrap ORDER BY idbootstrap ASC")or die(mysqli_error());
                        while($t = mysqli_fetch_array($tampilThemes)){
                    
                            $getPath = $t['pathBootstrap'];
                            $tam = mysqli_query($connecDB, "SELECT * FROM theme WHERE pathBootstrap = '$getPath'");
                            $r = mysqli_fetch_array($tam);
                            echo '<option value="'.$t["pathBootstrap"].'" '; if ($t["pathBootstrap"]==$r["pathBootstrap"]) { echo 'selected'; } echo '>'.$t["namaTheme"].'</option>';
                    
                        } 
                     ?>
                </select><br />
                <div style="background-color:#eaeaea; padding:10px;">
                    <br />
                    Background <b>Color</b> / Background <b>Image</b> <br /><i>(note: Background Image min seize 1024 x 768 pixel)</i>:
                    <input type="text" name="backgroundColor" class="color form-control" style="width:300px" value="<?php echo $z['backgroundColor']; ?>" placeholder="Example/: #FFFFFF" />
                    <?php 
                        if (empty($z['backgroundImage'])) {

                            echo '';

                        } else {
                            echo '<input type="hidden" name="backgroundImage" value="'.$z["backgroundImage"].'" />';
                        }
                    ?>
                    
                    <input type="file" name="backgroundImage" />
                    <br />
                </div>
             
                Container Color (hex):
                <input type="text" name="containerColor" class="color form-control" style="width:110px" value="<?php echo $z['containerColor']; ?>" />
                Container Size :
                
                <div class="row">
                    <div class="col-xs-6">
                      <div class="range range-primary">
                        <input type="range" name="containerSize" min="800" max="1300" value="<?php echo $z['ukuranLayout']; ?>" onchange="rangePrimary.value=value">
                        <output id="rangePrimary"><?php echo $z['ukuranLayout']; ?></output>
                      </div>
                    </div>
                </div>

                Nama Situs :
                <input type="text" name="siteName" class="form-control" style="width:300px" value="<?php echo $z['siteName']; ?>" placeholder="Nama Situs" />
                Title :
                <input type="text" name="titleSite" class="form-control" style="width:300px" value="<?php echo $z['titleSite']; ?>" placeholder="Title" />                
                Copyright Footer :
                <input type="text" name="copyright" class="form-control" style="width:300px" value="<?php echo $z['copyright']; ?>" placeholder="Example/: 2015 - 2020 sitename.com" />
                Read Post :
                <input type="number" name="readPost" class="form-control" value="<?php echo $z['readPost']; ?>" style="width:70px" />
                <hr />
                <b>Navbar Position :</b><br />

                <input type="radio" <?php if ($z['navbarPosition']=='atas') { echo 'checked'; } ?> name="navbarPosition" value="atas" /> Atas &nbsp;&nbsp;&nbsp;
                <input type="radio" <?php if ($z['navbarPosition']=='tengah') { echo 'checked'; } ?> name="navbarPosition" value="tengah" /> Tengah

                <br /><br />
                <b>Sidebar Position :</b><br />

                <input type="radio" name="sidebarPosition" <?php if ($z['sidebarPosition']=='kiri') { echo 'checked'; } ?> value="kiri" /> Kiri &nbsp;&nbsp;&nbsp;
                <input type="radio" name="sidebarPosition" <?php if ($z['sidebarPosition']=='kanan') { echo 'checked'; } ?> value="kanan" /> Kanan

                <br /><br />
                Favicon :
                <input type="file" name="favicon" />
                <img src="<?php echo $baseUrl."../".$z['favicon']; ?>" width="50" />
                <br /><br />

                <input type="checkbox" <?php if ($z['navbarFixedTop']=='yes') { echo 'checked="yes"'; } ?> name="navbarFixedTop" value="yes" /> Navbar Fixed Top<br />
                <input type="checkbox" <?php if ($z['slider']=='yes') { echo 'checked="yes"'; } ?> name="slider" value="yes" /> Use Slider
                <br /><hr />
                <h4>Additional Features :</h4>
                Facebook Profile Link 
                <input type="text" name="facebook" class="form-control" value="<?php echo $z['facebookLink']; ?>" placeholder="" />
                <br /><br />
                Twitter Profile Link :
                <input type="text" name="twitter" class="form-control" value="<?php echo $z['twitterLink']; ?>" placeholder="" />
                <br /><br />
                Google+ Profile Link :
                <input type="text" name="googleplus" class="form-control" value="<?php echo $z['googleplusLink']; ?>" placeholder="" />
                <br /><br />
                <textarea class="form-control" name="metaTag" style="height:200px" placeholder="Tambahan Tag Meta Untuk Di Header"><?php echo $z['metaTag']; ?></textarea><br />
                
                <input type="submit" name="configTheme" value="Save" class="btn btn-success" />
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