<?php
	ini_set('max_execution_time', 300);
	/*INI BAGIAN GENERATE KONEKSI------------------------------------------------------------------------------------------------*/
	$myfile = fopen("config/connection.php", "w") or die("Unable to open file!");
	$txt = "<?php
		".$_POST['db_username']." = '".$_POST['dbusername']."';
	    ".$_POST['db_password']." = '".$_POST['dbpassword']."';
	    ".$_POST['db_name']."     = '".$_POST['dbname']."';
	    ".$_POST['db_host']."     = '".$_POST['dbhost']."';
	    ".$_POST['subDir']."      = '/EQUALIZER/'; //jika tidak ada dikosongkan saja
	    ".$_POST['connecdb']."    = mysqli_connect(".$_POST['db_host'].", ".$_POST['db_username'].", ".$_POST['db_password'].", ".$_POST['db_name'].")or die('cannot connect to database'); ?>";
	fwrite($myfile, $txt);
	fclose($myfile);
	/* INI BAGIAN CREATE DATABASE--------------------------------------------------------------------------------------------------*/
	$servername = $_POST['dbhost'];
	$username = $_POST['dbusername'];
	$password = $_POST['dbpassword'];
	$dbName = $_POST['dbname'];
	$conn = mysqli_connect($servername, $username, $password)or die(
		header('Location: ./installation/1/failedtoconnect')
		);
	if (!$conn) { die("Connection failed: " . mysqli_connect_error()); }
	// Create database
	$sql = "CREATE DATABASE $dbName";
	mysqli_query($conn, $sql);
	mysqli_close($conn);
	/* INI BAGIAN CREATE TABLE---------------------------------------------------------------------------------------------------*/
	$conn = mysqli_connect($servername, $username, $password, $dbName);
	// Check connection
	if (!$conn) { die("Connection failed: " . mysqli_connect_error()); }
	$sql = "CREATE TABLE administrator (
	 	idAdmin int(2) NOT NULL,
	 	namaAuthor varchar(30) NOT NULL,
	 	profesi varchar(100) NOT NULL,
	 	linkGoogle varchar(100) NOT NULL,
	 	username varchar(20) NOT NULL,
	 	password varchar(50) NOT NULL
	) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
	"; mysqli_query($conn, $sql);
	$sql = "CREATE TABLE banner (
	 	idBanner int(1) NOT NULL,
	 	gambar varchar(100) NOT NULL,
	 	caption varchar(100) NOT NULL
	) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
	"; mysqli_query($conn, $sql);
	$sql = "CREATE TABLE category (
	 	idCategory int(2) NOT NULL,
	  	category varchar(40) NOT NULL,
	  	slug varchar(50) NOT NULL,
	  	description text NOT NULL
	) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
	"; mysqli_query($conn, $sql);
	$sql = "CREATE TABLE IF NOT EXISTS contact (
		idContact int(4) NOT NULL,
	  	session_id varchar(50) NOT NULL,
	  	name varchar(50) NOT NULL,
	  	email varchar(50) NOT NULL,
	  	website varchar(50) NOT NULL,
	  	message text NOT NULL,
	  	timed date NOT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;
	"; mysqli_query($conn, $sql);
	$sql = "CREATE TABLE IF NOT EXISTS custombootstrap (
		idbootstrap int(2) NOT NULL,
	  	namaTheme varchar(15) NOT NULL,
	  	pathBootstrap varchar(30) NOT NULL
	) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
	"; mysqli_query($conn, $sql);
	$sql = "CREATE TABLE IF NOT EXISTS customcss (
		idCss int(1) NOT NULL,
	  	css longtext NOT NULL
	) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
	"; mysqli_query($conn, $sql);
	$sql = "CREATE TABLE IF NOT EXISTS gallery (
		idGallery int(11) NOT NULL,
	  	gambar varchar(200) NOT NULL,
	  	title varchar(200) NOT NULL,
	  	alt varchar(200) NOT NULL
	) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
	"; mysqli_query($conn, $sql);
	$sql = "CREATE TABLE IF NOT EXISTS menu (
		idMenu int(2) NOT NULL,
	  	NamaMenu varchar(40) NOT NULL,
	  	modul varchar(100) NOT NULL,
	  	keterangan varchar(255) NOT NULL
	) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
	"; mysqli_query($conn, $sql);
	$sql = "CREATE TABLE IF NOT EXISTS page (
		idPage int(2) NOT NULL,
	  	judul varchar(35) NOT NULL,
	  	url varchar(100) NOT NULL,
	  	isi text NOT NULL,
	  date date NOT NULL
	) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
	"; mysqli_query($conn, $sql);
	$sql = "CREATE TABLE IF NOT EXISTS post (
		idPost int(7) NOT NULL,
		judul varchar(100) NOT NULL,
		modul varchar(200) NOT NULL,
		seourl varchar(255) NOT NULL,
		isi text NOT NULL,
		feature varchar(200) NOT NULL,
		status varchar(7) NOT NULL,
		tglPost datetime NOT NULL,
		viewer int(9) NOT NULL,
		focusKeyword varchar(40) NOT NULL,
		seoTitle varchar(80) NOT NULL,
		metaDescription varchar(156) NOT NULL
		) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;
	"; mysqli_query($conn, $sql);
	$sql = "CREATE TABLE IF NOT EXISTS postcategory (
		idPostCategory int(7) NOT NULL,
		idCategory int(2) NOT NULL,
		idPost int(7) NOT NULL,
		timed datetime NOT NULL
		) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=latin1;
	"; mysqli_query($conn, $sql);
	$sql = "CREATE TABLE IF NOT EXISTS settings (
		idSettings int(3) NOT NULL,
	  	faviconUrl varchar(200) NOT NULL,
	  	sitename varchar(50) NOT NULL,
	  	metaTag varchar(200) NOT NULL,
	  	folderName varchar(50) NOT NULL,
	  	logoUrl varchar(200) NOT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;
	"; mysqli_query($conn, $sql);
	$sql = "CREATE TABLE IF NOT EXISTS submenu (
		idSubmenu int(2) NOT NULL,
	  	idMenu int(2) NOT NULL,
	  	namaSubMenu varchar(40) NOT NULL,
	  	modul varchar(100) NOT NULL,
	  	keterangan varchar(255) NOT NULL
	) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
	"; mysqli_query($conn, $sql);
	$sql = "CREATE TABLE IF NOT EXISTS tags (
		idTags int(7) NOT NULL,
		idPost int(7) NOT NULL,
		namaTags varchar(40) NOT NULL,
		tagSlug varchar(40) NOT NULL
		) ENGINE=InnoDB AUTO_INCREMENT=256 DEFAULT CHARSET=latin1;
	"; mysqli_query($conn, $sql);
	$sql = "CREATE TABLE IF NOT EXISTS textwidget (
		idText int(2) NOT NULL,
	  	namaWidget varchar(30) NOT NULL,
	  	textCode text NOT NULL
	) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
	"; mysqli_query($conn, $sql);
	$sql = "CREATE TABLE IF NOT EXISTS theme (
			idTheme int(4) NOT NULL,
			namatema varchar(20) NOT NULL,
			pathBootstrap varchar(30) NOT NULL,
			backgroundColor varchar(7) NOT NULL,
			backgroundImage varchar(100) NOT NULL,
			containerColor varchar(7) NOT NULL,
			ukuranLayout varchar(7) NOT NULL,
			siteName varchar(30) NOT NULL,
			titleSite varchar(200) NOT NULL,
			copyright varchar(50) NOT NULL,
			readPost varchar(2) NOT NULL,
			navbarPosition varchar(6) NOT NULL,
			sidebarPosition varchar(5) NOT NULL,
			navbarFixedTop varchar(8) NOT NULL,
			slider varchar(3) NOT NULL,
			metaTag text NOT NULL,
			favicon varchar(50) NOT NULL,
			facebookLink varchar(80) NOT NULL,
			twitterLink varchar(80) NOT NULL,
			googleplusLink varchar(80) NOT NULL
			) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
	"; mysqli_query($conn, $sql);
	$sql = "CREATE TABLE IF NOT EXISTS videogallery (
		idVideoGallery int(4) NOT NULL,
	  	judul varchar(100) NOT NULL,
	  	keterangan text NOT NULL,
	  	urlVideo varchar(60) NOT NULL
	) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
	"; mysqli_query($conn, $sql);
	$sql = "CREATE TABLE IF NOT EXISTS widget (
		idWidget int(2) NOT NULL,
	  	namaWidget varchar(30) NOT NULL,
	  	inUse varchar(3) NOT NULL
	) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
	"; mysqli_query($conn, $sql);
	$sql = "CREATE TABLE IF NOT EXISTS informations (
			idInformations int(1) NOT NULL,
		  	blogTitle varchar(50) NOT NULL,
		  	email varchar(50) NOT NULL,
		  	allowSearch varchar(3) NOT NULL,
		  	dateGenerate datetime NOT NULL
		) ENGINE=InnoDB DEFAULT CHARSET=latin1;
	"; mysqli_query($conn, $sql);
	//END OF CREATE TABLE
	/* INSERTING TABLE */
	$sql = "INSERT INTO custombootstrap (idbootstrap, namaTheme, pathBootstrap) VALUES
	(1, 'Cerulean', 'css/cssTheme/cerulean.css'),
	(2, 'Cosmo', 'css/cssTheme/cosmo.css'),
	(3, 'Cyborg', 'css/cssTheme/cyborg.css'),
	(4, 'Darkly', 'css/cssTheme/darkly.css'),
	(5, 'Default', 'css/cssTheme/default.css'),
	(6, 'Flatly', 'css/cssTheme/flatly.css'),
	(7, 'Journal', 'css/cssTheme/journal.css'),
	(8, 'Lumen', 'css/cssTheme/lumen.css'),
	(9, 'Paper', 'css/cssTheme/paper.css'),
	(10, 'Readable', 'css/cssTheme/readable.css'),
	(11, 'Simplex', 'css/cssTheme/simplex.css'),
	(12, 'Slate', 'css/cssTheme/slate.css'),
	(13, 'Spacelab', 'css/cssTheme/spacelab.css'),
	(14, 'Standstone', 'css/cssTheme/standstone.css'),
	(15, 'Superhero', 'css/cssTheme/superhero.css'),
	(16, 'United', 'css/cssTheme/united.css'),
	(17, 'Yeti', 'css/cssTheme/yeti.css');
	"; $conn->query($sql);

	$sql = "INSERT INTO customcss (idCss, css) VALUES
	(1, '/*!\r\n * ghanix v3.3.4+1\r\n * Homepage: http://indocreator.com\r\n * Copyright 2015-2016 Ghani Nafiansyah\r\n * Licensed under MIT\r\n * Based on Bootstrap\r\n*/\r\n/*! normalize.css v3.0.2 | MIT License | git.io/normalize */\r\n');";
	$conn->query($sql);

	$sql = "INSERT INTO theme (idTheme, namatema, pathBootstrap, backgroundColor, backgroundImage, containerColor, ukuranLayout, siteName, titleSite, copyright, readPost, navbarPosition, sidebarPosition, navbarFixedTop, slider, metaTag, favicon) VALUES
	(1, 'Cerulean', 'css/cssTheme/standstone.css', '#000000', '', '#EAEAEA', '1270', '', 'apartments for rent in chicago Â» www.Healthqu.com - www.Healthqu.com', 'Copyright - SMA Rantau Prapat 08', '6', 'atas', 'kanan', 'yes', '', '', 'images/favicon/2.jpeg');";
	$conn->query($sql);

	$sql = "INSERT INTO widget (idWidget, namaWidget, inUse) VALUES
	(1, 'category', 'yes'),
	(2, 'page', 'yes'),
	(3, 'Gallery Images', 'yes'),
	(4, 'Gallery Videos', 'yes'),
	(5, 'Recent Post', 'yes'),
	(6, 'Popular Post', 'yes'),
	(7, 'About Author', 'yes');";
	$conn->query($sql);
/* PRIMARY KEY VALUES -----------------------------------------------------------------------------------------------------*/
	$sql = "ALTER TABLE administrator
	 ADD PRIMARY KEY (idAdmin);"; mysqli_query($conn, $sql);
	$sql = "ALTER TABLE banner
	 ADD PRIMARY KEY (idBanner);"; mysqli_query($conn, $sql);
	$sql = "ALTER TABLE category
	 ADD PRIMARY KEY (idCategory);"; mysqli_query($conn, $sql);
	$sql = "ALTER TABLE contact
	 ADD PRIMARY KEY (idContact);"; mysqli_query($conn, $sql);
	$sql = "ALTER TABLE custombootstrap
	 ADD PRIMARY KEY (idbootstrap);"; mysqli_query($conn, $sql);
	$sql = "ALTER TABLE customcss
	 ADD PRIMARY KEY (idCss);"; mysqli_query($conn, $sql);
	$sql = "ALTER TABLE gallery
	 ADD PRIMARY KEY (idGallery);"; mysqli_query($conn, $sql);
	$sql = "ALTER TABLE menu
	 ADD PRIMARY KEY (idMenu);"; mysqli_query($conn, $sql);
	$sql = "ALTER TABLE page
	 ADD PRIMARY KEY (idPage);"; mysqli_query($conn, $sql);
	$sql = "ALTER TABLE post
	 ADD PRIMARY KEY (idPost);"; mysqli_query($conn, $sql);
	$sql = "ALTER TABLE settings
	 ADD PRIMARY KEY (idSettings);"; mysqli_query($conn, $sql);
	$sql = "ALTER TABLE submenu
	 ADD PRIMARY KEY (idSubmenu);"; mysqli_query($conn, $sql);
	$sql = "ALTER TABLE textwidget
	 ADD PRIMARY KEY (idText);"; mysqli_query($conn, $sql);
	$sql = "ALTER TABLE theme
	 ADD PRIMARY KEY (idTheme);"; mysqli_query($conn, $sql);
	$sql = "ALTER TABLE videogallery
	 ADD PRIMARY KEY (idVideoGallery);"; mysqli_query($conn, $sql);
	$sql = "ALTER TABLE widget
	 ADD PRIMARY KEY (idWidget);"; mysqli_query($conn, $sql);
	$sql = "ALTER TABLE informations
	 ADD PRIMARY KEY (idInformations);"; mysqli_query($conn, $sql);
/* AUTO INCREMENT VALUES-------------------------------------------------------------------------------------------------------- */
	$sql = "ALTER TABLE administrator
	MODIFY idAdmin int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;"; mysqli_query($conn, $sql);
	$sql = "ALTER TABLE banner
	MODIFY idBanner int(1) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;"; mysqli_query($conn, $sql);
	$sql = "ALTER TABLE category
	MODIFY idCategory int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;"; mysqli_query($conn, $sql);
	$sql = "ALTER TABLE contact
	MODIFY idContact int(4) NOT NULL AUTO_INCREMENT;"; mysqli_query($conn, $sql);
	$sql = "ALTER TABLE custombootstrap
	MODIFY idbootstrap int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;"; mysqli_query($conn, $sql);
	$sql = "ALTER TABLE customcss
	MODIFY idCss int(1) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;"; mysqli_query($conn, $sql);
	$sql = "ALTER TABLE gallery
	MODIFY idGallery int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;"; mysqli_query($conn, $sql);
	$sql = "ALTER TABLE menu
	MODIFY idMenu int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;"; mysqli_query($conn, $sql);
	$sql = "ALTER TABLE page
	MODIFY idPage int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;"; mysqli_query($conn, $sql);
	$sql = "ALTER TABLE post
	MODIFY idPost int(7) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;"; mysqli_query($conn, $sql);
	$sql = "ALTER TABLE settings
	MODIFY idSettings int(3) NOT NULL AUTO_INCREMENT;"; mysqli_query($conn, $sql);
	$sql = "ALTER TABLE submenu
	MODIFY idSubmenu int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;"; mysqli_query($conn, $sql);
	$sql = "ALTER TABLE textwidget
	MODIFY idText int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;"; mysqli_query($conn, $sql);
	$sql = "ALTER TABLE theme
	MODIFY idTheme int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;"; mysqli_query($conn, $sql);
	$sql = "ALTER TABLE videogallery
	MODIFY idVideoGallery int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;"; mysqli_query($conn, $sql);
	$sql = "ALTER TABLE widget
	MODIFY idWidget int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;"; mysqli_query($conn, $sql);
	$sql = "ALTER TABLE informations
	MODIFY idInformations int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;"; mysqli_query($conn, $sql);
	/* END OF AUTO INCREMENT VALUES-----------------------------------------------------------------------------------------------*/
	header('Location: installation/2'); ?>