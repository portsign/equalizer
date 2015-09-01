<?php 
if (isset($_POST['installEqualizer'])) {
	include("config/connection.php");
	$blogTitle = $_POST['blogTitle'];
	$email = $_POST['email'];
	$allowSearchEngine = $_POST['allowSearchEngine'];

	mysqli_query($connecDB, "INSERT INTO informations (blogTitle, email, allowSearch, dateGenerate) 
							 VALUES ('$blogTitle', '$email', '$allowSearchEngine', NOW())")or die(mysql_error());
	mysqli_query($connecDB, "UPDATE theme SET siteName = '$blogTitle'")or die(mysql_error());
	header('Location: installation/3');
}
?>