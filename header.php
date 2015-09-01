<?php
$filename = 'statusInstallation.txt';
if (file_exists($filename)) {
    header('Location: installation/1');
} else {
    include("baseUrl.php"); 
}
include("config/connection.php"); 
$SHOW_CONFIG = mysqli_query($connecDB, "SELECT * FROM theme")or die(mysql_error());
$X = mysqli_fetch_array($SHOW_CONFIG); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>
    <?php 
    	
    function seoUrl($string) {
	    $string = strtolower($string);
	    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
	    $string = preg_replace("/[\s-]+/", " ", $string);
	    $string = preg_replace("/[\s_]/", " ", $string);
	    $string = preg_replace("/.html/", " ", $string);
	return $string;
	}	
    if (isset($_GET['url'])){
    $GETSEOURL2 = $_GET['url'];
    $SHOW_META_POST2 = mysqli_query($connecDB, "SELECT * FROM post WHERE seourl = '$GETSEOURL2'");
    $I2 = mysqli_fetch_array($SHOW_META_POST2);
    echo $I2['seoTitle']." - ".$_SERVER['SERVER_NAME']; } 
    elseif (isset($_GET['id'])) { 
    echo $_GET['id']." - ".$X['titleSite']; } 
    elseif (isset($_GET['searchWord'])) {
    echo $X['titleSite'];
    } else { 
    echo $X['titleSite']; 
    } 
    ?>
    </title>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?php  
    	if (isset($_GET['url'])) {
    		$GETSEOURL = $_GET['url'];
    		$SHOW_META_POST = mysqli_query($connecDB, "SELECT * FROM post WHERE seourl = '$GETSEOURL'");
    		$I = mysqli_fetch_array($SHOW_META_POST);
    		?>
    		<meta name="description" content="<?php echo $I['focusKeyword']; ?>" />
    		<meta name="description" content="<?php echo $I['metaDescription']; ?>" />
    		<?php
    	} else {
		    $SHOW_META_D = mysqli_query($connecDB, "SELECT * FROM post ORDER BY idPost DESC LIMIT 1")or die(mysql_error());
			$ZD = mysqli_fetch_array($SHOW_META_D); 
		?>
		<meta name="description" content="<?php echo $ZD['focusKeyword']; ?>" />
    	<meta name="description" content="<?php echo $ZD['metaDescription']; ?>" />
		<?php 
		}
	 ?>
    <?php if (isset($_GET['page'])) { ?>   
    <meta name='robots' content='noindex,nofollow' />
	<?php } else { ?>
	<meta name='robots' content='index,follow' />
	<?php } ?>
    <?php echo $X['metaTag']; ?><br />
    <link rel="icon" href="<?php echo $X['favicon']; ?>" type="image/gif" sizes="16x16" /> 
	<link rel="stylesheet" href="<?php echo $baseUrl.$X['pathBootstrap']; ?>" />
	<link rel="stylesheet" href="<?php echo $baseUrl; ?>css/style.css" />
	<?php 
	$SHOW_META = mysqli_query($connecDB, "SELECT * FROM post ORDER BY idPost DESC LIMIT 1")or die(mysql_error());
	$Z = mysqli_fetch_array($SHOW_META); 
	?>
	<!-- This site is optimized with the Yoast WordPress SEO plugin v2.2.1 - https://yoast.com/wordpress/plugins/seo/ -->
	<link rel="canonical" href="<?php echo $baseUrl.$Z['seourl']."/".$Z['modul']; ?>" />
	<meta property="og:locale" content="en_US" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="<?php echo $Z['judul']; ?> &raquo; <?php echo $_SERVER['SERVER_NAME']; ?>" />
	<meta property="og:url" content="<?php echo $baseUrl.$Z['seourl']."/".$Z['modul']; ?>" />
	<meta property="og:site_name" content="<?php echo $baseUrl; ?>" />
	<?php $ARTICLE_TAG = mysqli_query($connecDB, "SELECT * FROM post ORDER BY idPost DESC LIMIT 5")or die(mysql_error());
	while($A = mysqli_fetch_array($ARTICLE_TAG)) { ?>
	<meta property="article:tag" content="<?php echo $A['judul']; ?>" />
	<?php } ?>
	<?php $SHOW_CATEGORY = mysqli_query($connecDB, "SELECT * FROM category ORDER BY rand() LIMIT 1")or die(mysql_error());
	$C = mysqli_fetch_array($SHOW_CATEGORY); ?>
	<?php $SHOW_ARTICLE = mysqli_query($connecDB, "SELECT * FROM post ORDER BY rand() LIMIT 1")or die(mysql_error());
	$D = mysqli_fetch_array($SHOW_ARTICLE); ?>
	<meta property="article:section" content="<?php echo $C['category']; ?>" />
	<meta property="article:published_time" content="<?php echo $A['tglPost']; ?>" />
	<meta property="article:modified_time" content="<?php echo $A['tglPost']; ?>" />
	<meta property="og:updated_time" content="<?php echo $A['tglPost']; ?>" />
	<meta property="og:image" content="<?php  echo $_SERVER['SERVER_NAME'].$D['feature']; ?>" />
	<meta name="twitter:card" content="gallery"/>
	<meta name="twitter:title" content="<?php echo $Z['judul']; ?> &raquo; <?php echo $_SERVER['SERVER_NAME']; ?>" />
	<meta name="twitter:domain" content="<?php echo $_SERVER['SERVER_NAME']; ?>" />
	<?php $TWITTER_IMAGE = mysqli_query($connecDB, "SELECT * FROM post ORDER BY idPost DESC LIMIT 5")or die(mysql_error());
	$no = 0;
	while($T = mysqli_fetch_array($TWITTER_IMAGE)) { ?>
	<meta name="twitter:image<?php echo $no; ?>" content="<?php  echo $_SERVER['SERVER_NAME'].$T['feature']; ?>" />
	<?php $no++; } ?>
	<!-- / Yoast WordPress SEO plugin. -->
    <script src="<?php echo $baseUrl; ?>js/jquery.min.js"></script>
	<script src="<?php echo $baseUrl; ?>js/bootstrap.min.js"></script>
	<?php 
		$SHOW_CUSTOMCSS = mysqli_query($connecDB, "SELECT * FROM customcss")or die(mysql_error());
		$CSS = mysqli_fetch_array($SHOW_CUSTOMCSS);
	?>
	<style type="text/css">
		<?php echo $CSS['css']; ?>
	</style>
</head>
<?php 
	if ($X['backgroundColor']=='') {
		echo '<body style="background-image: url(images/background/'.$X["backgroundImage"].');">';
	} else {
		echo '<body style="background-color:'.$X["backgroundColor"].'">';
	}
?>
<style>
@media (min-width: 992px) {
  .container {
    width: <?php echo $X['ukuranLayout']; ?>px;
  }
}
.col-md-12 {
	background-color: <?php echo $X['containerColor']; ?>;
	border:1px solid #dfdfdf;
}
</style>
<div class="container">