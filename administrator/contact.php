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
            Contact
        </div>
        <div class="panel-body">
            
            <h3>Contact List</h3>
            <table class="table">
                <thead>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Website</th>
                    <th>Message</th>    
                    <th>time</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php 
                        $SHOW_CONTACT = mysqli_query($connecDB, "SELECT * FROM contact ORDER BY idContact DESC")or die(mysql_error());
                        $no = 1;
                        while($S = mysqli_fetch_array($SHOW_CONTACT)) {
                    ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $S['name']; ?></td>
                        <td><a href="mailto:<?php echo $S['email']; ?>"><?php echo $S['email']; ?></a></td>
                        <td><a target="_blank" href="//<?php echo $S['website']; ?>"><?php echo $S['website']; ?></a></td>
                        <td><?php echo $S['message']; ?></td>
                        <td><?php echo $S['timed']; ?></td>
                        <td><a href="<?php echo $baseUrl; ?>record.php?type=deleteContact&id=<?php echo $S['idContact']; ?>" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Delete Message</a></td>
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