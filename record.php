<?php 

include("baseUrl.php"); 
if (isset($_POST['registerAccount'])) {
    
    header('Content-Type: text/plain');
    
    function antiinjection($data){
      $filter_sql = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES,'UTF-8'))));
      return $filter_sql;
    }
    
    $fullname = antiinjection($_POST['fullname']);
    $email    = antiinjection($_POST['email']);
    $password = antiinjection($_POST['password']);
    $salt = '~!@#$%^&*(COOLSALT)_+?';
    $pass = sha1(md5($salt.$password));
    $tokenemail = sha1(md5($email));
    
    session_start();
    $_SESSION['userNameMuncul'] = $email;
    $_SESSION['passwordMuncul'] = $pass;
    setcookie("cooknameMuncul", $_SESSION['userNameMuncul'], time() + 9999999);
    
    mysqli_query($connecDB, "INSERT INTO usermember (fullName, email, tokenEmail, password, status, profilePic, dateReg) 
                             VALUES ('$fullname', '$email', '$tokenemail', '$pass', 'inactive', 'images/default_profile.jpg', NOW()) ") or die(mysqli_error());
    
    header('Location: ./profile/');
    
}
if (isset($_POST['login'])) {
    
    header('Content-Type: text/plain');
    
    function antiinjection($data){
      $filter_sql = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES,'UTF-8'))));
      return $filter_sql;
    }
    
    $email    = antiinjection($_POST['email']);
    $password = antiinjection($_POST['password']);
    $salt = '~!@#$%^&*(COOLSALT)_+?';
    $pass = sha1(md5($salt.$password));
    
    $login=mysqli_query($connecDB, "SELECT * FROM usermember WHERE email='$email' AND password='$pass'");
    $ketemu=mysqli_num_rows($login);
    $r=mysqli_fetch_array($login);

        if ($ketemu > 0) {
            
            session_start();
            $_SESSION['userNameMuncul']  = $r['email'];
            $_SESSION['passwordMuncul']  = $r['password'];
            
            setcookie("cooknameMuncul", $_SESSION['userNameMuncul'], time() + 9999999);
            header('location: ./profile/');
            } else {
            header('location: ./login/?login=false');
        }

}
if (isset($_POST['editProfile'])) {
    
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $nohp = $_POST['nohp'];
    
    $tampilGS = mysqli_query($connecDB, "SELECT * FROM usermember WHERE idMember = '$id'");
    $y = mysqli_fetch_array($tampilGS);
    if ($_FILES["fotoProfile"]["name"]=='') {    
        $pp = $y['profilePic'];
    } else {
        $pp = "images/uploads/profilePic/".$_FILES["fotoProfile"]["name"]; 
        //unlink($y["profilePic"]);
    }
    
    $target_dir = "images/uploads/profilePic/";
    $target_file = $target_dir . basename($_FILES["fotoProfile"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fotoProfile"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["fotoProfile"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fotoProfile"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["fotoProfile"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    
    
    
    
    mysqli_query($connecDB, "UPDATE usermember SET fullName = '$nama',
                                                   email = '$email',
                                                   nohp = '$nohp',
                                                   profilePic = '$pp' WHERE idMember = '$id'");
    session_start();
    $_SESSION['userNameMuncul'] = $email;
    header('Location: ./profile/');
}
if (isset($_POST['gantipassword'])) {
    $id = $_POST['id'];
    $salt = '~!@#$%^&*(COOLSALT)_+?';
    
    $oldpassword = sha1(md5($salt.$_POST['oldpassword']));
    
    $newpassword = sha1(md5($salt.$_POST['newpassword']));
    $confirmnewpassword = sha1(md5($salt.$_POST['confirmnewpassword']));
    
    $tampilPass = mysqli_query($connecDB, "SELECT * FROM usermember WHERE idMember = '$id'");
    $u = mysqli_fetch_array($tampilPass);
    
    if ($oldpassword!==$u['password']) {
        header('Location: ./profile/?type=wrongoldpass');
    } 
    else if ($newpassword!==$confirmnewpassword) {
        header('Location: ./profile/?type=wrongconfirm');
    } else {
        
        mysqli_query($connecDB, "UPDATE usermember SET password = '$newpassword' WHERE idMember = '$id'");
        session_start();
        $_SESSION['passwordMuncul'] = $newpassword;
        header('Location: ./profile/?type=successchangepass');
    }
    
}
if (isset($_GET['idproduk'])) {
            session_start();
    
            $jum = 1;
            $getEmail = $_SESSION['userNameMuncul'];
            $tampilUID = mysqli_query($connecDB, "SELECT * FROM usermember WHERE email = '$getEmail'");
            $x = mysqli_fetch_array($tampilUID);
            $getID = $_GET['idproduk'];
            $getIUD = $x['idMember'];
    
            $currentDay = date("l");
            $currentDate = date("d");
            $currentMonth = date("F");
            $currentYear = date("Y");

            $tampilB = mysqli_query($connecDB, "SELECT * FROM boking WHERE idProduk = '$getID'");
            $x = mysqli_fetch_array($tampilB);
    
            if ($x['jumlah']>=1) {
                $setJum = $x['jumlah']+1;
                mysqli_query($connecDB, "UPDATE boking SET jumlah = '$setJum' WHERE idProduk = '$getID'");
                header('Location: ../profile/?type=ordersuccess');
            } else {
                mysqli_query($connecDB, "INSERT INTO boking (idMember, idProduk, status, jumlah, hari, tanggal, bulan, tahun) 
                                     VALUES ('$getIUD', '$getID', 'Pending', '$jum', '$currentDay', '$currentDate', '$currentMonth', '$currentYear')");
                header('Location: ../profile/?type=ordersuccess');    
            }
    
            //die();           
}
if (isset($_GET['type'])) {
    if ($_GET['type']=='batalboking') {
        $getidP = $_GET['idproduk'];
        mysqli_query($connecDB, "DELETE FROM boking WHERE idProduk = '$getidP'");
        header('Location: ../profile/?type=ordersuccess');
    }
}

if (isset($_POST['submitComment'])) {
    
    $sessionID = $_POST['sessionID'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $website = $_POST['website'];
    $message = $_POST['message'];

    $tampilSESS = mysqli_query($connecDB, "SELECT count(session_id) as jumlahSESS FROM contact WHERE session_id='$sessionID' ")or die(mysql_error());
    $I = mysqli_fetch_array($tampilSESS);

    if ($I['jumlahSESS']>1) {
        header('Location: ./contact/warning');
    } else {
        mysqli_query($connecDB, "INSERT INTO contact (session_id, name, email, website, message, timed) 
        VALUES ('$sessionID', '$name', '$email', '$website', '$message', NOW())")or die(mysql_error());
        header('Location: ./contact');
    }

}
?>