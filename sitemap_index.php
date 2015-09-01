<?php 
	include('baseUrl.php');
?>
<link rel="stylesheet" href="css/bootstrap.css" />
<style type="text/css">
.custab{
    border: 1px solid #ccc;
    padding: 5px;
    margin: 1% 0;
    box-shadow: 3px 3px 2px #ccc;
    transition: 0.5s;
    }
.custab:hover{
    box-shadow: 3px 3px 0px transparent;
    transition: 0.5s;
    }
.table-striped > tbody > tr:nth-of-type(odd) {
  background-color: #eaeaea;
}
</style>
<div class='container'>
<?php 
	echo "
			
			<h1>XML Sitemap</h1><br />
			Generated by <a href='http://www.nafiansyah.com/'>Ghani Fingerstyle</a> SEO plugin, this is an XML Sitemap, meant for consumption by search engines.
			You can find more information about XML sitemaps on <a href='http://indocreator.com'>indocreator.com</a>.
			<br /><br />
			This XML Sitemap Index file contains 7 sitemaps. 
		
			";
?>	
	<?php 
	$tampilLAST_POST = mysqli_query($connecDB, "SELECT * FROM post ORDER BY idPost DESC LIMIT 1")or die(mysql_error());
	$T = mysqli_fetch_array($tampilLAST_POST);
	$tampilLAST_PAGE = mysqli_query($connecDB, "SELECT * FROM page ORDER BY idPage DESC LIMIT 1")or die(mysql_error());
	$P = mysqli_fetch_array($tampilLAST_PAGE);
	?>
	<table class="table table-striped custab">
		<thead>
			<th>Sitemap</th>
			<th>Last Modified</th>
		</thead>
		<tbody>
			<tr>
				<td><a href="<?php echo $baseUrl."post-sitemap.xml"; ?>"><?php echo "http://".$_SERVER['HTTP_HOST']."/post-sitemap.xml"; ?></a></td>
				<td><?php echo $T['tglPost']; ?></td>
			</tr>
			<tr>
				<td><a href="<?php echo $baseUrl."page-sitemap.xml"; ?>"><?php echo "http://".$_SERVER['HTTP_HOST']."/page-sitemap.xml"; ?></a></td>
				<td><?php echo $P['date']; ?></td>
			</tr>
			<tr>
				<td><a href="<?php echo $baseUrl."category-sitemap.xml"; ?>"><?php echo "http://".$_SERVER['HTTP_HOST']."/category-sitemap.xml"; ?></a></td>
				<td><?php echo $T['tglPost']; ?></td>
			</tr>
		</tbody>	
	</table>
</div>