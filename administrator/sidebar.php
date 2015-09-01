<?php 
$link =  "//$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$url = $link;
$path = parse_url($url, PHP_URL_PATH);
$segments = explode('/', rtrim($path, '/'));
//echo end($segments);
?>
<div class="col-md-2 sidebar" style="margin-top:-18px;">
  			<div class="row">
	<!-- uncomment code for absolute positioning tweek see top comment in css -->
	<div class="absolute-wrapper"> </div>
	<!-- Menu -->
	<div class="side-menu">
		<nav class="navbar navbar-default" role="navigation">
			<!-- Main Menu -->
			<div class="side-menu-container">
				<ul class="nav navbar-nav">
					<li <?php if (end($segments)=='administrator') { ?>class="active" <?php } ?>><a href="<?php echo $baseUrl; ?>./"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
				    
                    <li class="panel panel-default" id="dropdown">
						<a data-toggle="collapse" href="#dropdown-lvl12" onclick="">
							<span class="glyphicon glyphicon-pencil"></span> Post <span class="caret"></span>
						</a>
                        
						<!-- Dropdown level 1 -->
						<div id="dropdown-lvl12" class="panel-collapse <?php if (end($segments)=='post' || end($segments)=='allpost' || end($segments)=='media' || end($segments)=='category' || end($segments)=='produkpost' || end($segments)=='page') { ?> colapse in <?php } else { echo 'collapse'; } ?> ">
							<div class="panel-body">
								<ul class="nav navbar-nav">
									<li <?php if (end($segments)=='post') { ?>class="active" <?php } ?>><a href="<?php echo $baseUrl; ?>post/">New Post</a></li>
									<li <?php if (end($segments)=='allpost') { ?>class="active" <?php } ?>><a href="<?php echo $baseUrl.'allpost/'; ?>">All Post</a></li>
									<li <?php if (end($segments)=='category') { ?>class="active" <?php } ?>><a href="<?php echo $baseUrl.'category/'; ?>">Category</a></li>
									<li <?php if (end($segments)=='media') { ?>class="active" <?php } ?>><a href="<?php echo $baseUrl.'media/'; ?>">Media</a></li>
									<li <?php if (end($segments)=='page') { ?>class="active" <?php } ?>><a href="<?php echo $baseUrl.'page/'; ?>">Page</a></li>
								</ul>
							</div>
						</div>
					</li>
                    <li <?php if (end($segments)=='menu') { ?>class="active" <?php } ?>><a href="<?php echo $baseUrl; ?>menu/"><span class="glyphicon glyphicon-indent-right"></span> Menu</a></li>
					<li <?php if (end($segments)=='banner') { ?>class="active" <?php } ?>><a href="<?php echo $baseUrl; ?>banner/"><span class="glyphicon glyphicon-blackboard"></span> Banner</a></li>
					<li <?php if (end($segments)=='widget') { ?>class="active" <?php } ?>><a href="<?php echo $baseUrl; ?>widget/"><span class="glyphicon glyphicon-gift"></span> Widget</a></li>
					<!-- Dropdown-->
					<li class="panel panel-default" id="dropdown">
						<a data-toggle="collapse" href="#dropdown-lvl1">
							<span class="glyphicon glyphicon-user"></span> Theme <span class="caret"></span>
						</a>
						<!-- Dropdown level 1 -->
						<div id="dropdown-lvl1" class="panel-collapse <?php if (end($segments)=='themes' || end($segments)=='contact' || end($segments)=='profile' || end($segments)=='customcss') { ?> colapse in <?php } else { echo 'collapse'; } ?>">
							<div class="panel-body">
								<ul class="nav navbar-nav">
									<li <?php if (end($segments)=='themes') { ?>class="active" <?php } ?>><a href="<?php echo $baseUrl; ?>themes/">Themes</a></li>
									<li <?php if (end($segments)=='contact') { ?>class="active" <?php } ?>><a href="<?php echo $baseUrl; ?>contact/">Contact</a></li>
									<li <?php if (end($segments)=='customcss') { ?>class="active" <?php } ?>><a href="<?php echo $baseUrl; ?>customcss/">Custom CSS</a></li>
									<li <?php if (end($segments)=='profile') { ?>class="active" <?php } ?>><a href="<?php echo $baseUrl; ?>profile/">Profile</a></li>
								</ul>
							</div>
						</div>
					</li>
					<li><a href="<?php echo $baseUrl; ?>logout"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</nav>
	</div>
</div>  		
</div>