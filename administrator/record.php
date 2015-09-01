<?php 
include("baseUrl.php"); 

if (isset($_POST['login'])) {
    
    //LOGIN ---------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    header('Content-Type: text/plain');

    function antiinjection($data){
      $filter_sql = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES,'UTF-8'))));
      return $filter_sql;
    }

    $username  = antiinjection($_POST['username']);
    $password  = antiinjection($_POST['password']);
    $salt = '~!@#$%^&*(1111)_+ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = sha1(md5($salt.$password));
    
        $login=mysqli_query($connecDB, "SELECT * FROM administrator WHERE username='$username' AND password='$pass'");
        $ketemu=mysqli_num_rows($login);
        $r=mysqli_fetch_array($login);

        if ($ketemu > 0) {
            
            session_start();
            $_SESSION['usernameAdmin'] = $r['username'];
            $_SESSION['passwordAdmin'] = $r['password'];
            $_SESSION['KCFINDER'] = array();
            $_SESSION['KCFINDER']['disabled'] = false;
            $_SESSION['KCFINDER']['uploadURL'] = "../../images/uploads/";
            $_SESSION['KCFINDER']['uploadDir'] = "";
            setcookie("cookname", $_SESSION['usernameAdmin'], time() + 9999999);
            header('location: ./');
            } else {
            header('location: ./?login=false');
        }
} 
if (isset($_POST['tambahMenu'])) {
    
    header('Content-Type: text/plain');

    function antiinjection($data){
      $filter_sql = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES,'UTF-8'))));
      return $filter_sql;
    }
    
    $namaMenu   = antiinjection($_POST['namaMenu']);
    $modul      = antiinjection($_POST['modul']);
    $keterangan = antiinjection($_POST['keterangan']);
    
    mysqli_query($connecDB, "INSERT INTO menu (NamaMenu, modul, keterangan) VALUES ('$namaMenu', '$modul', '$keterangan')");
    header('Location: ./menu/');
}

if (isset($_GET['type'])) {
    if ($_GET['type']=='delete') {
        $id = $_GET['id'];
        mysqli_query($connecDB, "DELETE FROM menu WHERE idMenu='$id'");
        mysqli_query($connecDB, "DELETE FROM submenu WHERE idMenu='$id'");
        header('Location: ../menu/');
    }
    if ($_GET['type']=='deleteSubMenu') {
        $id = $_GET['id'];
        mysqli_query($connecDB, "DELETE FROM submenu WHERE idSubmenu='$id'");
        header('Location: ../menu/');
    }
    if ($_GET['type']=='deleteBanner') {
        $id = $_GET['id'];
        $tampilF = mysqli_query($connecDB, "SELECT * FROM banner WHERE idBanner = '$id'");
        $m = mysqli_fetch_array($tampilF);
        mysqli_query($connecDB, "DELETE FROM banner WHERE idBanner='$id'");
        unlink('../images/'.$m['gambar'].'');
        header('Location: ../banner/');
    }
    if ($_GET['type']) {
        if ($_GET['type']=='deletePost') {
            $id = $_GET['idPost'];
            mysqli_query($connecDB, "DELETE FROM post WHERE idPost='$id'");
            mysqli_query($connecDB, "DELETE FROM postcategory WHERE idPost='$id'");
            mysqli_query($connecDB, "DELETE FROM tags WHERE idPost='$id'");
            header('Location: ../allpost/');
        }
    }
    if ($_GET['type']=='deleteGambar') {
        $id = $_GET['id'];
        $tampilG = mysqli_query($connecDB, "SELECT * FROM gallery WHERE idGallery = '$id'");
        $m = mysqli_fetch_array($tampilG);
        mysqli_query($connecDB, "DELETE FROM gallery WHERE idGallery='$id'");
        unlink('../images/uploads/images/'.$m['gambar'].'');
        header('Location: ../media/');
    }
    if ($_GET['type']=='deleteproduk') {
        $id = $_GET['id'];
        $tampilP = mysqli_query($connecDB, "SELECT * FROM produk WHERE idProduk = '$id'");
        $n = mysqli_fetch_array($tampilP);
        mysqli_query($connecDB, "DELETE FROM produk WHERE idProduk='$id'");
        unlink('../images/uploads/images/'.$n['gambar'].'');
        header('Location: ../produkpost/');
    }
    if ($_GET['type']=='deletemember') {
        $id = $_GET['id'];
        mysqli_query($connecDB, "DELETE FROM usermember WHERE idMember='$id'");
        header('Location: ../memberlist/');
    }
    if ($_GET['type']=='changestatus') {
        $id = $_GET['idboking'];
        mysqli_query($connecDB, "UPDATE boking SET status = 'Accept' WHERE idBoking = '$id'");
        header('Location: ../boking/');
    }
    if ($_GET['type']=='deleteboking') {
        $id = $_GET['idboking'];
        mysqli_query($connecDB, "DELETE FROM boking WHERE idBoking = '$id'");
        header('Location: ../boking/');
    }
    if ($_GET['type']=='deleteembed') {
        $id = $_GET['idvideo'];
        mysqli_query($connecDB, "DELETE FROM videoGallery WHERE idVideoGallery = '$id'");
        header('Location: ../media/');
    }
    if ($_GET['type']=='deleteCategory') {
        $id = $_GET['id'];
        mysqli_query($connecDB, "DELETE FROM category WHERE idCategory = '$id'");
        header('Location: ./category/');
    }
    if ($_GET['type']=='deleteWidget') {
        $id = $_GET['id'];
        mysqli_query($connecDB, "UPDATE widget SET inUse = 'no' WHERE idWidget = '$id'");
        header('Location: ../widget/');
    }
    if ($_GET['type']=='deleteWidgetText') {
        $id = $_GET['id'];
        mysqli_query($connecDB, "DELETE FROM textwidget WHERE idText = '$id'");
        header('Location: ../widget/');
    }
    if ($_GET['type']=='deletePage') {
        $id = $_GET['id'];
        mysqli_query($connecDB, "DELETE FROM page WHERE idPage = '$id'");
        header('Location: ../page/');
    }
    if ($_GET['type']=='deleteContact') {
        $id = $_GET['id'];
        mysqli_query($connecDB, "DELETE FROM contact WHERE idContact = '$id'");
        header('Location: ./contact/');
    }
}

if (isset($_POST['editMenu'])) {
    
    header('Content-Type: text/plain');
    
    function antiinjection($data){
      $filter_sql = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES,'UTF-8'))));
      return $filter_sql;
    }
    
    $id         = antiinjection($_POST['id']);
    $namaMenu   = antiinjection($_POST['namaMenu']);
    $modul      = antiinjection($_POST['modul']);
    $keterangan = antiinjection($_POST['keterangan']);
    
    mysqli_query($connecDB, "UPDATE menu SET NamaMenu = '$namaMenu',
                                             modul = '$modul',
                                             keterangan = '$keterangan' WHERE idMenu = '$id' ");
    header('Location: ./menu/');    
}

if (isset($_POST['tambahSubMenu'])) {
    
    header('Content-Type: text/plain');
    
    function antiinjection($data){
      $filter_sql = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES,'UTF-8'))));
      return $filter_sql;
    }
    
    $idMenu      = antiinjection($_POST['idMenu']);
    $namaSubMenu = antiinjection($_POST['namaSubMenu']);
    $modul       = antiinjection($_POST['modul']);
    $keterangan  = antiinjection($_POST['keterangan']);
    
    mysqli_query($connecDB, "INSERT INTO submenu (idMenu, namaSubMenu, modul, keterangan) 
                             VALUES ('$idMenu', '$namaSubMenu', '$modul', '$keterangan')");
    
    header('Location: ./menu/');
}

if (isset($_POST['editSubMenu'])) {
    
    header('Content-Type: text/plain');
    
    function antiinjection($data){
      $filter_sql = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES,'UTF-8'))));
      return $filter_sql;
    }
    
    $id          = antiinjection($_POST['id']);
    $idMenu      = antiinjection($_POST['idMenu']);
    $namaSubMenu = antiinjection($_POST['namaSubMenu']);
    $modul       = antiinjection($_POST['modul']);
    $keterangan  = antiinjection($_POST['keterangan']);
    
    mysqli_query($connecDB, "UPDATE submenu SET idMenu = '$idMenu',
                                                namaSubMenu = '$namaSubMenu',
                                                modul = '$modul',
                                                keterangan = '$keterangan' WHERE idSubmenu = '$id'");
    header('Location: ./menu/');
}

if (isset($_POST['bannerAdd'])) {
    $target_dir = "../images/";
    $target_file = $target_dir . basename($_FILES["banner"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["banner"]["tmp_name"]);
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
    if ($_FILES["fileToUpload"]["size"] > 500000) {
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
        if (move_uploaded_file($_FILES["banner"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["banner"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    
    $banner = $_FILES["banner"]["name"];
    $caption = $_POST['caption'];
    
    mysqli_query($connecDB, "INSERT INTO banner (gambar, caption) VALUES ('$banner','$caption')");
    header('Location: ./banner/');
}

if (isset($_POST['changeCaption'])) {
    $caption = $_POST['caption'];
    $id = $_POST['idBanner'];
    //echo $caption;
    mysqli_query($connecDB, "UPDATE banner SET caption = '$caption' WHERE idBanner = '$id'");
    header('Location: ./banner/');
}

if (isset($_POST['posting'])) {
    
    $judul = $_POST['judul'];
    $modul = $_POST['modul'];
    $idCat = $_POST['idcategory'];

    if ($_POST['isi']=="") {
    
        $isi   = "&nbsp;";
        
    } else {
        
        $isi = $_POST['isi'];
        
    }
    
    function seoUrl($string) {
        
        $string = strtolower($string);
        $string = preg_replace("/[^a-z0-9_\s-]/", " ", $string);
        $string = preg_replace("/[\s-]+/", " ", $string);
        $string = preg_replace("/[\s_]/", "-", $string);
        return $string;
                
    }
    
    $random = rand(5, 1123);
    
    $seourl = seoUrl($judul)."-".$random;
    $doc=new DOMDocument();
    $doc->loadHTML($isi);
    $xml=simplexml_import_dom($doc); // just to make xpath more simple
    $images=$xml->xpath('//img');
    foreach ($images as $img) {
        //echo $img['src'] . ' ' . $img['alt'] . ' ' . $img['title'];
        $thumb = $img['src'] . ' ' . $img['alt'] . ' ' . $img['title'];
        //break;
    }
    $focusKeyword = $_POST['focusKeyword'];
    $seoTitle = $_POST['seoTitle'];
    $metaDescription = $_POST['metaDescription'];

    mysqli_query($connecDB, "INSERT INTO post (judul, modul, seourl, isi, feature, status, tglPost, viewer, focusKeyword, seoTitle, metaDescription) 
                             VALUES ('$judul', '$modul', '$seourl', '$isi', '$thumb', 'posted', NOW(), 0, '$focusKeyword', '$seoTitle', '$metaDescription')")or die(mysql_error());


    //TAGS
    //get id post terbaru
    $tampilIDPost = mysqli_query($connecDB, "SELECT * FROM post ORDER BY idPost DESC LIMIT 1")or die(mysql_error());
    $V=mysqli_fetch_array($tampilIDPost);
    $idPost = $V['idPost'];
    
    //CATEGORY
    //$piecesCAT = explode(',', $_POST['category']);
    foreach($_POST['category'] as $partCAT) {
            $tampilIDPost2 = mysqli_query($connecDB, "SELECT * FROM post ORDER BY idPost DESC LIMIT 1")or die(mysql_error());
            $V2=mysqli_fetch_array($tampilIDPost2);
            $idPost2 = $V2['idPost'];
            $cats = $partCAT;
            mysqli_query($connecDB, "INSERT INTO postcategory (idCategory, idPost, timed) VALUES 
                        ('$partCAT','$idPost2', NOW())")or die(mysql_error());
            //print($partCAT.'<br />');
            //die();
    }
    //END OF CATEGORY


        foreach($_POST['tags'] as $part) {
            $tagz = ltrim($part);
            $tagSlug = seoUrl($tagz);

            //echo $part;


            mysqli_query($connecDB, "INSERT INTO tags (idPost, namaTags, tagSlug) VALUES 
                        ('$idPost','$part', '$tagSlug')");
            //print($part.'<br />');
    }
    //END of TAGS
    //die();


    header('Location: ./allpost/');
}

if (isset($_POST['newfromdraft'])) {
    
    $judul = $_POST['judul'];
    $modul = $_POST['modul'];
    $idCat = $_POST['idcategory'];

    if ($_POST['isi']=="") {
    
        $isi   = "&nbsp;";
        
    } else {
        
        $isi = $_POST['isi'];
        
    }
    
    function seoUrl($string) {
        
        $string = strtolower($string);
        $string = preg_replace("/[^a-z0-9_\s-]/", " ", $string);
        $string = preg_replace("/[\s-]+/", " ", $string);
        $string = preg_replace("/[\s_]/", "-", $string);
        return $string;
                
    }
    
    $random = rand(5, 1123);
    
    $seourl = seoUrl($judul)."-".$random;
    $doc=new DOMDocument();
    $doc->loadHTML($isi);
    $xml=simplexml_import_dom($doc); // just to make xpath more simple
    $images=$xml->xpath('//img');
    foreach ($images as $img) {
        //echo $img['src'] . ' ' . $img['alt'] . ' ' . $img['title'];
        $thumb = $img['src'] . ' ' . $img['alt'] . ' ' . $img['title'];
        //break;
    }
    
    $focusKeyword = $_POST['focusKeyword'];
    $seoTitle = $_POST['seoTitle'];
    $metaDescription = $_POST['metaDescription'];

    mysqli_query($connecDB, "INSERT INTO post (judul, modul, seourl, isi, feature, status, tglPost, viewer, focusKeyword, seoTitle, metaDescription) 
                             VALUES ('$judul', '$modul', '$seourl', '$isi', '$thumb', 'draft', NOW(), 0, '$focusKeyword', '$seoTitle', '$metaDescription')")or die(mysql_error());


    //TAGS
    //get id post terbaru
    $tampilIDPost = mysqli_query($connecDB, "SELECT * FROM post ORDER BY idPost DESC LIMIT 1")or die(mysql_error());
    $V=mysqli_fetch_array($tampilIDPost);
    $idPost = $V['idPost'];
    
    //CATEGORY
    //$piecesCAT = explode(',', $_POST['category']);
    foreach($_POST['category'] as $partCAT) {
            $tampilIDPost2 = mysqli_query($connecDB, "SELECT * FROM post ORDER BY idPost DESC LIMIT 1")or die(mysql_error());
            $V2=mysqli_fetch_array($tampilIDPost2);
            $idPost2 = $V2['idPost'];
            $cats = $partCAT;
            mysqli_query($connecDB, "INSERT INTO postcategory (idCategory, idPost, timed) VALUES 
                        ('$partCAT','$idPost2', NOW())")or die(mysql_error());
            //print($partCAT.'<br />');
            //die();
    }
    //END OF CATEGORY


        foreach($_POST['tags'] as $part) {
            $tagz = ltrim($part);
            $tagSlug = seoUrl($tagz);

            //echo $part;


            mysqli_query($connecDB, "INSERT INTO tags (idPost, namaTags, tagSlug) VALUES 
                        ('$idPost','$part', '$tagSlug')");
            //print($part.'<br />');
    }
    //END of TAGS
    //die();


    header('Location: ./post/?type=editPost&idPost='.$idPost.'');
}


if (isset($_POST['draftopost'])) {
    $id    = $_POST['id'];
    $judul = $_POST['judul'];
    $modul = $_POST['modul'];
    $idCat = $_POST['idcategory'];
    $isi   = $_POST['isi'];
    
    function seoUrl($string) {
        
        $string = strtolower($string);
        $string = preg_replace("/[^a-z0-9_\s-]/", " ", $string);
        $string = preg_replace("/[\s-]+/", " ", $string);
        $string = preg_replace("/[\s_]/", "-", $string);
        return $string;
                
    }

    $doc=new DOMDocument();
    $doc->loadHTML($isi);
    $xml=simplexml_import_dom($doc); // just to make xpath more simple
    $images=$xml->xpath('//img');
    foreach ($images as $img) {
        $thumb = $img['src'] . ' ' . $img['alt'] . ' ' . $img['title'];
        break;
    }
    //die();
    $focusKeyword = $_POST['focusKeyword'];
    $seoTitle = $_POST['seoTitle'];
    $metaDescription = $_POST['metaDescription'];

    mysqli_query($connecDB, "UPDATE post SET judul = '$judul',
                                             modul = '$modul',
                                             isi = '$isi',
                                             feature = '$thumb',
                                             status = 'posted',
                                             tglPost = NOW(), 
                                             viewer = 0,
                                             focusKeyword = '$focusKeyword',
                                             seoTitle = '$seoTitle',
                                             metaDescription = '$metaDescription'
                                             WHERE idPost = '$id'");


    mysqli_query($connecDB, "DELETE FROM postcategory WHERE idPost = '$id'")or die(mysql_error());
    mysqli_query($connecDB, "DELETE FROM tags WHERE idPost = '$id'")or die(mysql_error());
    
  

    //TAGS
    //get id post terbaru
    
    //CATEGORY
    $piecesCAT = $_POST["category"];
    foreach($piecesCAT as $partCAT) {
            
            //$cats = $partCAT;
            mysqli_query($connecDB, "INSERT INTO postcategory (idCategory, idPost, timed) VALUES 
                        ('$partCAT','$id', NOW())")or die(mysql_error());
            //print($partCAT.'<br />');
            //die();
    }
    //END OF CATEGORY

    foreach($_POST['tags'] as $part) {
            $tagz = ltrim($part);
            $tagSlug = seoUrl($tagz);

            //echo $part;


            mysqli_query($connecDB, "INSERT INTO tags (idPost, namaTags, tagSlug) VALUES 
                        ('$id','$part', '$tagSlug')");
            //print($part.'<br />');
    }
    //END of TAGS

    header('Location: ./allpost/');
}

if (isset($_POST['draftopostfromedit'])) {
    $id    = $_POST['id'];
    $judul = $_POST['judul'];
    $modul = $_POST['modul'];
    $idCat = $_POST['idcategory'];
    $isi   = $_POST['isi'];
    
    function seoUrl($string) {
        
        $string = strtolower($string);
        $string = preg_replace("/[^a-z0-9_\s-]/", " ", $string);
        $string = preg_replace("/[\s-]+/", " ", $string);
        $string = preg_replace("/[\s_]/", "-", $string);
        return $string;
                
    }

    $doc=new DOMDocument();
    $doc->loadHTML($isi);
    $xml=simplexml_import_dom($doc); // just to make xpath more simple
    $images=$xml->xpath('//img');
    foreach ($images as $img) {
        $thumb = $img['src'] . ' ' . $img['alt'] . ' ' . $img['title'];
        break;
    }
    //die();
    
    $focusKeyword = $_POST['focusKeyword'];
    $seoTitle = $_POST['seoTitle'];
    $metaDescription = $_POST['metaDescription'];

    mysqli_query($connecDB, "UPDATE post SET judul = '$judul',
                                             modul = '$modul',
                                             isi = '$isi',
                                             feature = '$thumb',
                                             status = 'posted',
                                             tglPost = NOW(), 
                                             viewer = 0,
                                             focusKeyword = '$focusKeyword',
                                             seoTitle = '$seoTitle',
                                             metaDescription = '$metaDescription'
                                             WHERE idPost = '$id'");


    mysqli_query($connecDB, "DELETE FROM postcategory WHERE idPost = '$id'")or die(mysql_error());
    mysqli_query($connecDB, "DELETE FROM tags WHERE idPost = '$id'")or die(mysql_error());
    
  

    //TAGS
    //get id post terbaru
    
    //CATEGORY
    $piecesCAT = $_POST["category"];
    foreach($piecesCAT as $partCAT) {
            
            //$cats = $partCAT;
            mysqli_query($connecDB, "INSERT INTO postcategory (idCategory, idPost, timed) VALUES 
                        ('$partCAT','$id', NOW())")or die(mysql_error());
            //print($partCAT.'<br />');
            //die();
    }
    //END OF CATEGORY

    foreach($_POST['tags'] as $part) {
            $tagz = ltrim($part);
            $tagSlug = seoUrl($tagz);

            //echo $part;


            mysqli_query($connecDB, "INSERT INTO tags (idPost, namaTags, tagSlug) VALUES 
                        ('$id','$part', '$tagSlug')");
            //print($part.'<br />');
    }
    //END of TAGS

    header('Location: ./post/?type=editPost&idPost='.$id.'');
}

if (isset($_POST['tambahCategory'])) {
    
    $namaCategory = $_POST['category'];
    $slug         = $_POST['slug'];
    $description  = $_POST['description'];
    
    mysqli_query($connecDB, "INSERT INTO category (category, slug, description) 
                             VALUES ('$namaCategory', '$slug', '$description')");
    header('Location: ./category/');
}

if (isset($_POST['addImage'])) {
    
    $title = $_POST['title'];
    $alt = $_POST['alt'];
    
    $target_dir = "../images/uploads/images/";
    $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["gambar"]["tmp_name"]);
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
    if ($_FILES["gambar"]["size"] > 500000) {
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
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["gambar"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    
    
    $gambar = $_FILES["gambar"]["name"];
    mysqli_query($connecDB, "INSERT INTO gallery (gambar, title, alt) VALUES ('$gambar', '$title', '$alt')");
    header('Location: ./media/');
}
if (isset($_POST['postProduk'])) {
    
    $namaproduk = $_POST['namaproduk'];
    $idcategory = $_POST['category'];
    $merek = $_POST['merek'];
    $warna = $_POST['warna'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $spesifikasi = $_POST['spesifikasi'];
    $gambar = $_FILES["gambarproduk"]["name"];
    
    $target_dir = "../images/uploads/images/";
    $target_file = $target_dir . basename($_FILES["gambarproduk"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["gambarproduk"]["tmp_name"]);
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
    if ($_FILES["gambarproduk"]["size"] > 500000) {
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
        if (move_uploaded_file($_FILES["gambarproduk"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["gambarproduk"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    
    mysqli_query($connecDB, "INSERT INTO produk (namaProduk, idCategory, merek, warna, harga, spesifikasi, stok, gambar) 
                                         VALUES ('$namaproduk', '$idcategory', '$merek', '$warna', '$harga', '$spesifikasi', '$stok', '$gambar')");
    header('Location: ./produkpost/');
    
}
if (isset($_POST['editProduk'])) {
    
    $id = $_POST['id'];
    $namaproduk = $_POST['namaproduk'];
    $idcategory = $_POST['category'];
    $merek = $_POST['merek'];
    $warna = $_POST['warna'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $spesifikasi = $_POST['spesifikasi'];
    
    $tampilGambar = mysqli_query($connecDB, "SELECT * FROM produk WHERE idProduk = '$id'");
    $x = mysqli_fetch_array($tampilGambar);
    
    if ($_FILES["gambarproduk"]["name"]=='') {
        $gambar = $x['gambar'];    
    } else {
        $gambar = $_FILES["gambarproduk"]["name"];
        unlink('../images/uploads/images/'.$x['gambar'].'');
        $target_dir = "../images/uploads/images/";
        
        $target_file = $target_dir . basename($_FILES["gambarproduk"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["gambarproduk"]["tmp_name"]);
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
        if ($_FILES["gambarproduk"]["size"] > 500000) {
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
            if (move_uploaded_file($_FILES["gambarproduk"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["gambarproduk"]["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            } 
        }
    }
    
    mysqli_query($connecDB, "UPDATE produk SET namaProduk = '$namaproduk', 
                                               idCategory = '$idcategory',
                                               merek = '$merek',
                                               warna = '$warna',
                                               harga = '$harga',
                                               spesifikasi = '$spesifikasi',
                                               stok = '$stok',
                                               gambar = '$gambar' WHERE idProduk = '$id'");
    header('Location: ./produkpost/');
}
if (isset($_POST['submitVideo'])) {
    
    $r = $_POST['youtubeLink']; 
	$r = explode('=', $r);
	$r = array_filter($r);
	$r = array_merge($r, array()); 
	$r = preg_replace('/\?.*/', '', $r);

	$endofurl = $r[1];
	//echo $endofurl;
	$judulVideo  = $_POST['judul'];
	$keterangan = $_POST['keterangan'];
	
	mysqli_query($connecDB, "INSERT INTO videoGallery (judul, keterangan, urlVideo) VALUES 
		    ('$judulVideo','$keterangan','$endofurl')");
	header('Location: ./media/');
    
}
if (isset($_POST['editVideo'])) {
    
	$r = $_POST['youtubeLink']; 
	$r = explode('=', $r);
	$r = array_filter($r);
	$r = array_merge($r, array()); 
	$r = preg_replace('/\?.*/', '', $r);

	$endofurl = $r[1];
	//echo $endofurl;
	$judulVideo  = $_POST['judul'];
	$keterangan = $_POST['keterangan'];
	$id = $_POST['id'];
	mysqli_query($connecDB, "UPDATE videoGallery SET judul = '$judulVideo',
					keterangan = '$keterangan',
					urlVideo = '$endofurl' WHERE idVideoGallery = '$id'");
    header('Location: ./media/');

} 

if (isset($_POST['editCategory'])) {

    $id = $_POST['id'];
    $category = $_POST['category'];
    $slug = $_POST['slug'];
    $keterangan = $_POST['keterangan'];

    mysqli_query($connecDB, "UPDATE category SET category = '$category', 
                                                 slug = '$slug',
                                                 description = '$keterangan' WHERE idcategory = '$id'")or die(mysqli_error());
    header('Location: ./category/');

}

if (isset($_POST['configTheme'])) {

    $theme = $_POST['theme'];
    $pathBootstrap = $_POST['pathBootstrap'];

        if ($backgroundColor=='') {

            $backgroundColor = '#FFF'; //background Color Default PUTIH
            
        } 
        if ($backgroundColor!=='') {
                
            $backgroundColor = "#".$_POST['backgroundColor'];

        }

        if (empty($_FILES["backgroundImage"]["name"])) {
            
            $backgroundImage = '';
        
        } else {
            
            $target_dir2 = "../images/background/";
            $target_file2 = $target_dir2 . basename($_FILES["backgroundImage"]["name"]);
            $uploadOk2 = 1;
            $imageFileType2 = pathinfo($target_file2,PATHINFO_EXTENSION);
            // Check if image file is a actual image or fake image
            if(isset($_POST["submit"])) {
                $check2 = getimagesize($_FILES["backgroundImage"]["tmp_name"]);
                if($check2 !== false) {
                    echo "File is an image - " . $check2["mime"] . ".";
                    $uploadOk2 = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk2 = 0;
                }
            }
            // Check if file already exists
            if (file_exists($target_file2)) {
                echo "Sorry, file already exists.";
                $uploadOk2 = 0;
            }
            // Check file size
            if ($_FILES["backgroundImage"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk2 = 0;
            }
            // Allow certain file formats
            if($imageFileType2 != "jpg" && $imageFileType2 != "png" && $imageFileType2 != "jpeg"
            && $imageFileType2 != "gif" ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk2 = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk2 == 0) {
                echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["backgroundImage"]["tmp_name"], $target_file2)) {
                    echo "The file ". basename( $_FILES["backgroundImage"]["name"]). " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
            $backgroundImage = $_FILES["backgroundImage"]["name"];
            $backgroundColor = '';
        }

    $containerColor  = "#".$_POST['containerColor'];
    $containerSize   = $_POST['containerSize'];
    $siteName        = $_POST['siteName'];
    $titleSite       = $_POST['titleSite'];
    $copyright       = $_POST['copyright'];
    $readPost        = $_POST['readPost'];
    $navbarPosition  = $_POST['navbarPosition'];
    $sidebarPosition = $_POST['sidebarPosition'];

        $currentFavicon = mysqli_query($connecDB, "SELECT * FROM theme")or die(mysqli_error());
        $fav = mysqli_fetch_array($currentFavicon);
    
        if ($_FILES['favicon']['name']=='') {
            
            $favicon = $fav['favicon'];
        
        } else {
            
            $target_dir = "../images/favicon/";
            $target_file = $target_dir . basename($_FILES["favicon"]["name"]);
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            // Check if image file is a actual image or fake image
            if(isset($_POST["submit"])) {
                $check = getimagesize($_FILES["favicon"]["tmp_name"]);
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
            if ($_FILES["favicon"]["size"] > 500000) {
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
                if (move_uploaded_file($_FILES["favicon"]["tmp_name"], $target_file)) {
                    echo "The file ". basename( $_FILES["favicon"]["name"]). " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
            $favicon = "images/favicon/".$_FILES["favicon"]["name"];
        }
        
    $navbarFixedTop = $_POST['navbarFixedTop'];
    $slider = $_POST['slider'];
    $metaTag = $_POST['metaTag'];
    $facebook = $_POST['facebook'];
    $twitter = $_POST['twitter'];
    $googleplus = $_POST['googleplus'];

    mysqli_query($connecDB, "UPDATE theme SET namatema = '$theme',
                                              pathBootstrap = '$pathBootstrap',
                                              backgroundColor = '$backgroundColor',
                                              backgroundImage = '$backgroundImage',
                                              containerColor = '$containerColor',
                                              ukuranLayout = '$containerSize',
                                              siteName = '$siteName',
                                              titleSite = '$titleSite',
                                              copyright = '$copyright', 
                                              readPost = '$readPost',
                                              navbarPosition = '$navbarPosition',
                                              sidebarPosition = '$sidebarPosition',
                                              navbarFixedTop = '$navbarFixedTop',
                                              slider = '$slider',
                                              metaTag = '$metaTag',
                                              favicon = '$favicon',
                                              facebookLink = '$facebook',
                                              twitterLink = '$twitter',
                                              googleplusLink = '$googleplus' ")or die(mysqli_error());
    header('Location: ./themes/');
}
if (isset($_POST['widgetSetting'])) {
   
    $id = $_POST['widget'];

    mysqli_query($connecDB, "UPDATE widget SET inUse = 'yes' WHERE idWidget='$id'")or die(mysqli_error());
    header('Location: ./widget/');

}
if (isset($_POST['addText'])) {
    header('Content-Type: text/plain');
    $namaWidget = $_POST['namaWidget'];
    $text = $_POST['textWidget'];
    mysqli_query($connecDB, "INSERT INTO textwidget (namaWidget, textCode) VALUES ('$namaWidget', '$text')")or die(mysql_error());
    header('Location: ./widget/');
}
if (isset($_POST['postPage'])) {

    $judul = $_POST['judul'];
    $url = $_POST['url'];
    $isi = $_POST['isi'];

    mysqli_query($connecDB, "INSERT INTO page (judul, url, isi, date) VALUES ('$judul', '$url', '$isi', NOW())")or die(mysql_error());
    header('Location: ./page/');
}
if (isset($_POST['editPage'])) {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $url = $_POST['url'];
    $isi = $_POST['isi'];

    mysqli_query($connecDB, "UPDATE page SET judul = '$judul',
                                             url = '$url',
                                             isi = '$isi' WHERE idPage='$id'")or die(mysql_error());
    header('Location: ./page/');
}
if (isset($_POST['author'])) {
    $namaAuthor = $_POST['namaAuthor'];
    $profesi = $_POST['profesi'];
    $linkGoogle = $_POST['linkGoogle'];

    mysqli_query($connecDB, "UPDATE administrator SET namaAuthor = '$namaAuthor',
                                                      profesi = '$profesi',
                                                      linkGoogle = '$linkGoogle'")or die(mysqli_error());
    header('Location: ./profile/');
}
if (isset($_POST['customCSS'])) {
    $code = $_POST['customCss'];

    mysqli_query($connecDB, "UPDATE customcss SET css = '$code' ")or die(mysql_error());
    header('Location: ./customcss/');
}

if (isset($_POST['gantipassword'])) {
    
    session_start();
    error_reporting(0);
    $getUsername = $_SESSION['usernameAdmin'];
    
    $oldpassword = $_POST['oldpassword'];
    $newpassword = $_POST['newpassword'];
    $renewpassword = $_POST['renewpassword'];
    
    $salt = '~!@#$%^&*(1111)_+ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $oldpass = sha1(md5($salt.$oldpassword));
    $pass = sha1(md5($salt.$newpassword));
    $repass = sha1(md5($salt.$renewpassword));
    
    $tampilPassword = mysqli_query($connecDB, "SELECT * FROM administrator WHERE username='$getUsername' ")or die(mysqli_error());
    $x=mysqli_fetch_array($tampilPassword);
    
    if ($x['password']!==$oldpass) {
        header('Location: ./password/?action=wrongoldpass');
    } else if ($pass!==$repass) {
        header('Location: ./password/?action=wrongconfirm');
    } else {
        mysqli_query($connecDB, "UPDATE administrator SET password = '$pass' WHERE username = '$getUsername'")or die(mysqli_error());
        $_SESSION['passwordAdmin'] = $pass;
        header('Location: ./password/?action=success');
    }
       
}
if (isset($_POST['forgotPassword'])) {
    require 'PHPMailer-master/PHPMailerAutoload.php';
 
    $emailReq = $_POST['email'];

    $mail = new PHPMailer();

    $mail->IsSMTP();  // telling the class to use SMTP
    $mail->Mailer = "smtp";
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->SMTPAuth = true; // turn on SMTP authentication
    $mail->Username = "electromailart@gmail.com"; // SMTP username
    $mail->Password = "crygan@dev"; // SMTP password 
            
    $mail->AddAddress("electromailart@gmail.com","Ghani Developer");
    $mail->SetFrom($emailReq, 'EQUALIZER');
    $mail->AddReplyTo($emailReq, 'EQUALIZER');

    $mail->Subject  = "Reset Password";
    $mail->Body     = "Ini pesaannya";
    $mail->WordWrap = 50;  

    if(!$mail->Send()) {
        echo 'Message was not sent.';
        echo 'Mailer error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent.';
    }
}

if (isset($_POST['bulkDelete'])) {

    if (isset($_POST['type'])) {

        if ($_POST['type']=='NULL') {

            header('Location: ./allpost/');

        }
        else if ($_POST['type']=='postall') {

            foreach($_POST['deleteCustom'] as $part) {

                mysqli_query($connecDB, "UPDATE post SET status = 'posted' WHERE idPost = '$part' ")or die(mysql_error());

            }

        } else if ($_POST['type']=='delete') {

            foreach($_POST['deleteCustom'] as $part) {
                mysqli_query($connecDB, "DELETE FROM post WHERE idPost = '$part'")or die(mysql_error());
                mysqli_query($connecDB, "DELETE FROM postcategory WHERE idPost = '$part'")or die(mysql_error());
                mysqli_query($connecDB, "DELETE FROM tags WHERE idPost = '$part'")or die(mysql_error());
            }

        }

    }
    header('Location: ./allpost/');

    //die();
}

?>