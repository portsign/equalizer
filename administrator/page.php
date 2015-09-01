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
            Page
        </div>
        <div class="panel-body">
            <?php 
                if (isset($_GET['type'])) {
                    if ($_GET['type']=='editPage') {
                    $getIDP = $_GET['id'];
                    $tampilPAGES = mysqli_query($connecDB, "SELECT * FROM page WHERE idPage = '$getIDP' ")or die(mysql_error());
                    $G = mysqli_fetch_array($tampilPAGES);
            ?>   
                <div style="background-color:#eaeaea; padding:10px">         
                <form action="<?php echo $baseUrl; ?>record" method="POST">
                    <input type="hidden" name="id" value="<?php echo $G['idPage']; ?>" />
                    Judul Halaman :
                    <input type="text" name="judul" value="<?php echo $G['judul']; ?>" class="form-control" />
                    Url :
                    <input type="text" name="url" value="<?php echo $G['url']; ?>" class="form-control" placeholder="ex: dmca.html / privacy-policy.html" />
                    Konten :
                    <textarea class="form-control" name="isi" id="editor1" rows="10" cols="80"><?php echo $G['isi']; ?></textarea><br />
                    <input type="submit" name="editPage" class="btn btn-info" value="Update" />
                </form>
                <script>
                        CKEDITOR.replace( 'editor1' );
                </script>
                </div>
            <?php
                    }
                } else {
            ?>
                <form action="<?php echo $baseUrl; ?>record" method="POST">
                    Judul Halaman :
                    <input type="text" name="judul" class="form-control" />
                    Url :
                    <input type="text" name="url" class="form-control" placeholder="ex: dmca.html / privacy-policy.html" />
                    Konten :
                    <textarea class="form-control" name="isi" id="editor1" rows="10" cols="80"></textarea><br />
                    <input type="submit" name="postPage" class="btn btn-success" value="Post" />
                </form>
                <script>
                        CKEDITOR.replace( 'editor1' );
                </script>
            <?php } ?>
            <br /><br />


            <table class="table" style="border:1px solid #dfdfdf">
                <thead>
                    <th>No</th>
                    <th>Judul</th>
                    <th>URL</th>
                    <th>Isi</th>
                    <th>Tgl Post</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php 
                        $tampilP = mysqli_query($connecDB, "SELECT * FROM page ORDER BY idPage DESC")or die(mysql_error());
                        $no = 1;
                        while($p = mysqli_fetch_array($tampilP)) {
                    ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $p['judul']; ?></td>
                            <td><?php echo $p['url']; ?></td>
                            <td>
                                <?php 
                                    $string = strip_tags($p['isi']);
                                    if (strlen($string) > 180) {
                                        // truncate string
                                        $stringCut = substr($string, 0, 80);
                                        // make sure it ends in a word so assassinate doesn't become ass...
                                        $string = substr($stringCut, 0, strrpos($stringCut, ' ')).''; 
                                    }
                                    echo $string;
                                ?>
                            </td>
                            <td><?php echo $p['date']; ?></td>
                            <td><a href="<?php echo $baseUrl; ?>page/?type=editPage&id=<?php echo $p['idPage']; ?>" class="btn btn-info"><i class="glyphicon glyphicon-edit"></i> Edit</a> 
                                <a href="<?php echo $baseUrl; ?>record/?type=deletePage&id=<?php echo $p['idPage']; ?>" onclick="return confirm('Apakah Anda Yakin?')" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Delete</a></td>
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