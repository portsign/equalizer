<?php 
if (isset($_POST['createAccount'])) {
	include("config/connection.php");

	header('Content-Type: text/plain');

    function antiinjection($data){
      $filter_sql = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES,'UTF-8'))));
      return $filter_sql;
    }

	
	$namaLengkap = $_POST['namaLengkap'];
	$username = $_POST['username'];
	$password  = antiinjection($_POST['password']);
	$repassword = antiinjection($_POST['repassword']);

    $salt = '~!@#$%^&*(1111)_+ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = sha1(md5($salt.$password));
    $repass = sha1(md5($salt.$repassword));

    if ($pass!==$repass) {
    	header('Location: installation/3/errorpassword');
    	die();
    } else {
    	mysqli_query($connecDB, "INSERT INTO administrator (namaAuthor, profesi, linkGoogle, username, password) 
							 VALUES ('$namaLengkap', '', '', '$username', '$pass')")or die(mysql_error());
    	rename('statusInstallation.txt', 'config/statusInstallation.txt');
		header('Location: installation/finish');
    }

	

}
?>