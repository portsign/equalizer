<?php include("baseUrl.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Muncul Bursa Motor</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="<?php echo $baseUrl; ?>css/bootstrap.css" />
	<link rel="stylesheet" href="<?php echo $baseUrl; ?>css/style.css" />
    <script src="<?php echo $baseUrl; ?>js/jquery.min.js"></script>
	<script src="<?php echo $baseUrl; ?>js/bootstrap.min.js"></script>
    <!-- Place inside the <head> of your HTML -->
    <script src="<?php echo $baseUrl; ?>ckeditor/ckeditor.js"></script>
    <script src="<?php echo $baseUrl; ?>ckeditor/plugins/plugin.js"></script>
    <script type="text/javascript">

        //<![CDATA[

        CKEDITOR.replace( 'agenda',
        {
        fullPage : true,
        extraPlugins : 'docprops',

        filebrowserBrowseUrl : '<?php echo $baseUrl; ?>ckfinder/browse.php', 
        height:"500", width:"900",
        });

        //]]>
    </script>

</head>
<body>