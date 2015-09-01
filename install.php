<?php 
if (isset($_GET['status'])) {
	 
?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
	<link rel="stylesheet" href="../../css/bootstrap.css"/>
	<link rel="stylesheet" href="../../css/style.css"/>
	<script src="../../js/jquery.min.js"></script>
	<script src="../../js/bootstrap.min.js"></script>
	<style type="text/css">
	@media (min-width: 992px) {
	  .container {
	    width: 800px;
	  }
	}
	</style>

<?php } else { ?>
<!DOCTYPE html>
	<html lang="en">
	<head>
	<link rel="stylesheet" href="../css/bootstrap.css"/>
	<link rel="stylesheet" href="../css/style.css"/>
	<script src="../js/jquery.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<style type="text/css">
	@media (min-width: 992px) {
	  .container {
	    width: 800px;
	  }
	}
	</style>
<?php } ?>
</head>
<body>
	<?php  ?>
	<div class="container">
		<center>
			<h1 style="font-size:60px"><i class="glyphicon glyphicon-equalizer"></i></h1>
			<h1>EQUALIZER CMS</h1>
		</center>
			<?php 
				if (isset($_GET['tahap'])) {
					if ($_GET['tahap']=='1') {
						if (isset($_GET['status'])) {
							if ($_GET['status']=='failedtoconnect') {
								//header('Content-Type: text/plain');
								$myfile = fopen("config/connection.php", "w") or die("Unable to open file!");
								$D = '$';
									$txt = "<?php 
									".$D."db_username = '';
								    ".$D."db_passowrd = '';
								    ".$D."db_name     = '';
								    ".$D."db_host     = '';
								    ".$D."subDir      = ''; //jika tidak ada dikosongkan saja
								    ".$D."connecDB    = mysqli_connect(".$D."db_host, ".$D."db_username, ".$D."db_passowrd, ".$D."db_name)or die('cannot connect to database'); ?>";
								fwrite($myfile, $txt);
								fclose($myfile);
							}
						}
						include("config/connection.php");
						if ($db_name!=='') {
							echo '<script>window.location.href = "../installation/2";</script>';
						} else {
						?>
						<script type="text/javascript">
						var progress = setInterval(function () {
						    var $bar = $('.bar');

						    if ($bar.width() >= 770) {
						        clearInterval(progress);
						        $('.progress').removeClass('active');
						    } else {
						        $bar.width($bar.width() + 77);
						    }
						    $bar.text($bar.width() / 7.7 + "%");
						}, 3200);
						</script>
						<?php 
							if (isset($_GET['status'])) {
								if ($_GET['status']=='failedtoconnect') {
									echo '<strong><font color="red">Failed</font> to connect to database! <br />Please Check Your MYSQL username or password</strong>';
								}
							}
						?>
						<br />
							<p>Below you should enter your database connection details. if you're not sure about these, contact your host.</p>
							<hr />
							<?php 
							if (isset($_GET['status'])) {
								if ($_GET['status']=='failedtoconnect') { ?>
							<form action="../../step1.php" method="POST">
							<?php } } else { ?>
							<form action="../step1.php" method="POST">
							<?php } ?>
							<input type="hidden" name="db_username" value="$db_username" />
							<input type="hidden" name="db_password" value="$db_passowrd" />
							<input type="hidden" name="db_name" value="$db_name" />
							<input type="hidden" name="db_host" value="$db_host" />
							<input type="hidden" name="connecdb" value="$connecDB" />
							<input type="hidden" name="subDir" value="$subDir" />
							<table>
								<tr>
									<td><b>Database Name</b></td>
									<td><p style="width:100px"></p></td>
									<td><input type="text" name="dbname" class="form-control" required /></td>
									<td>&nbsp;&nbsp;</td>
									<td><i>The Name of the database you want to run EQ in.</i></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td><b>Username</b></td>
									<td><p style="width:100px"></p></td>
									<td><input type="text" name="dbusername" class="form-control" required /></td>
									<td>&nbsp;&nbsp;</td>
									<td><i>Your MYSQL Username</i></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td><b>Password</b></td>
									<td><p style="width:100px"></p></td>
									<td><input type="password" name="dbpassword" class="form-control" required /></td>
									<td>&nbsp;&nbsp;</td>
									<td><i>...and MYSQL Password</i></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td><b>Database Host</b></td>
									<td><p style="width:100px"></p></td>
									<td><input type="text" name="dbhost" class="form-control" value="localhost" required /></td>
									<td>&nbsp;&nbsp;</td>
									<td><i>99% Chance you won't need to change this value.</i></td>
								</tr>
							</table>
							<br />
							<input type="submit" name="generateDatabase" class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-lg" value="Submit" />
							</form>

							<!-- Large modal -->
							

							<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
							  <div class="modal-dialog modal-lg">
							    <div class="modal-content" style="margin-top:260px">
							      <div class="container">
							      	<br />
							      	Loading Please Wait.
								    <div class="progress progress-striped active">
								        <div class="progress-bar bar"></div>
								    </div>
								    <br />
								</div>
							    </div>
							  </div>
							</div>
							<?php } ?>

					<?php
					}
					if ($_GET['tahap']=='2') {
						include("config/connection.php");
						$SHOW_I = mysqli_query($connecDB, "SELECT * FROM informations")or die(mysql_error());
						$B = mysqli_fetch_array($SHOW_I);
						if (isset($B['blogTitle'])) {
							echo '<script>window.location.href = "../installation/3";</script>';
						} else {
						?>

						<h2>Welcome</h2>
						<hr />
						<p>Welcome to the famous five minutes Equalizer Installation process! You may want to browse the <a href="">ReadMe Documentation</a> at your leisure. Otherwise, Just Fill in the Information below and you'll be on your way to using the most extendable and powerfull personal publishing platform in Yogyakarta.</p>
						<h2>Information Needed</h2>
						<hr />
						<p>Please Provide the following information, Don't worry you can always change these settings later.</p>
						<form action="../step2.php" method="POST">
						<table>
							<tr>
								<td>Blog Title</td>
								<td><p style="width:100px"></p></td>
								<td><input type="text" name="blogTitle" class="form-control" required /></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td>Your E-mail</td>
								<td><p style="width:100px"></p></td>
								<td><input type="text" name="email" class="form-control" required />
									Double-check your email address before continuing.
								</td>
							</tr>
						</table><br />
						<input type="checkbox" name="allowSearchEngine" checked="yes" /> Allow my Website to appear in search engines like google and other.
						<br /><br />
						<input type="submit" name="installEqualizer" class="btn btn-primary" value="Install Equalizer" /> 
						</form>
						<?php
						}
					}
					if ($_GET['tahap']=='3') {
						include("config/connection.php");
						$SHOW_Y = mysqli_query($connecDB, "SELECT * FROM administrator")or die(mysql_error());
						$Y = mysqli_fetch_array($SHOW_Y);
						if (isset($Y['username'])) {
							echo '<script>window.location.href = "../installation/finish";</script>';
						} else {
						?>
						<h2>Welcome</h2>
						<hr />
						<p>Welcome to the famous five minutes Equalizer Installation process! You may want to browse the <a href="">ReadMe Documentation</a> at your leisure. Otherwise, Just Fill in the Information below and you'll be on your way to using the most extendable and powerfull personal publishing platform in Yogyakarta.</p>
						<h2>Information Needed</h2>
						<hr />
						<?php 
							if (isset($_GET['status'])) {
								if ($_GET['status']=='errorpassword') {
									echo '<strong><font color="red">Failed</font> to create your account! Wrong Confirmation Password</strong>';
								}
							}
						?>
						<p>Please Provide the following information, Don't worry you can always change these settings later.</p>
							<?php 
							if (isset($_GET['status'])) {
								if ($_GET['status']=='errorpassword') { ?>
							<form action="../../step3.php" method="POST">
							<?php } } else { ?>
							<form action="../step3.php" method="POST">
							<?php } ?>
						<table>
							<tr>
								<td><strong>Your Name</strong></td>
								<td><p style="width:100px"></p></td>
								<td><input type="text" name="namaLengkap" class="form-control" required /></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td><strong>Username</strong></td>
								<td><p style="width:100px"></p></td>
								<td><input type="text" name="username" class="form-control" required />
									Username can have only alphanumeric characters, spaces, underscores, hyphens, periods, and the @ symbol.
								</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td><strong>Password, Twice</strong><br />A password will be automaticaly generated for you if you <br />leave this blank.</td>
								<td><p style="width:100px"></p></td>
								<td><input type="password" name="password" class="form-control" required />
									<input type="password" name="repassword" class="form-control" required />
									Type your Password to admnistrator
								</td>
							</tr>
							
						</table>
						<br />
						<input type="submit" name="createAccount" class="btn btn-primary" value="Submit" />
						</form>
						<br />
						<br />
						<?php
						}
					}
					if ($_GET['tahap']=='finish') {
						include("config/connection.php");
						$SHOW_USER = mysqli_query($connecDB, "SELECT * FROM administrator")or die(mysql_error());
						$x = mysqli_fetch_array($SHOW_USER);
						?>
						<h2>Success!</h2>
						<hr />
						<p>Equalizer has been installed. were you expecting more steps? sory to disappoint.</p>
						<div style="background-color:#eaeaea; padding:10px;">
							<table class="table">
								<tr>
									<td><b>Username</b></td>
									<td>:</td>
									<td><?php echo $x['username']; ?></td>
								</tr>
								<tr>
									<td><b>Password</b></td>
									<td>:</td>
									<td><i>Your Chosen Password</i></td>
								</tr>
							</table>
						</div>
						<br />
						<a href="../administrator" class="btn btn-success">Login</a>
						<?php
					}
				}
			?>
	</div>
</body>
</html>