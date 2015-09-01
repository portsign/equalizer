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
            Member List
        </div>
        <div class="panel-body">
            
            <table class="table">
                <thead>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Profile Picture</th>
                    <th>Tangga Daftar</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    <?php
                        $tampilMember = mysqli_query($connecDB, "SELECT * FROM usermember ORDER BY idMember DESC");
                        $no = 1;
                        while($x = mysqli_fetch_array($tampilMember)) {
                    ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $x['fullName']; ?></td>
                            <td><?php echo $x['email']; ?></td>
                            <td><?php echo $x['status']; ?></td>
                            <td><img src="<?php echo $baseUrl."../".$x['profilePic']; ?>" width="100" /></td>
                            <td><?php echo $x['dateReg']; ?></td>
                            <td><a href="<?php echo $baseUrl; ?>record/?type=deletemember&id=<?php echo $x['idMember']; ?>" onclick="return confirm('Apakah Anda Yakin?')" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Delete</a></td>
                        </tr>
                    <?php    
                        $no++; }
                    ?>
                    
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