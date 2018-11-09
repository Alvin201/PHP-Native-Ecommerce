<?php
  error_reporting(0);

session_start();

if (empty($_SESSION[username]) AND empty($_SESSION[passuser])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=index.php><b>LOGIN</b></a></center>";
}
else{
?>

<html>
<head>
<title>Harika Music Administrator</title>
<link href="css/font-awesome.min.css" rel="stylesheet"/>
<link href="css/font-awesome.css" rel="stylesheet"/>
 <script language="javascript" type="text/javascript">
    tinyMCE_GZ.init({
    plugins : 'style,layer,table,save,advhr,advimage, ...',
		themes  : 'simple,advanced',
		languages : 'en',
		disk_cache : true,
		debug : false
});
</script>
<script language="javascript" type="text/javascript"
src="../tinymcpuk/tiny_mce_src.js"></script>
<script type="text/javascript">
tinyMCE.init({
		mode : "textareas",
		theme : "advanced",
		plugins : "table,advhr,advimage,advlink,searchreplace,paste,directionality,noneditable,contextmenu",
		theme_advanced_buttons3_add_before : "fontselect,fontsizeselect",
		theme_advanced_buttons2_add : "separator,preview,zoom,separator,forecolor,backcolor,liststyle",
		theme_advanced_buttons2_add_before: "cut,copy,paste,separator,search,replace,separator,separator,separator",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		extended_valid_elements : "hr[class|width|size|noshade]",
		file_browser_callback : "fileBrowserCallBack",
		paste_use_dialog : false,
		theme_advanced_resizing : true,
		theme_advanced_resize_horizontal : false,
		theme_advanced_link_targets : "_something=My somthing;_something2=My somthing2;_something3=My somthing3;",
		width: "1000",
		apply_source_formatting : true
});

	function fileBrowserCallBack(field_name, url, type, win) {
		var connector = "../../filemanager/browser.html?Connector=connectors/php/connector.php";
		var enableAutoTypeSelection = true;
		
		var cType;
		tinymcpuk_field = field_name;
		tinymcpuk = win;
		
		switch (type) {
			case "image":
				cType = "Image";
				break;
			case "flash":
				cType = "Flash";
				break;
			case "file":
				cType = "File";
				break;
		}
		
		if (enableAutoTypeSelection && cType) {
			connector += "&Type=" + cType;
		}
		
		window.open(connector, "tinymcpuk", "modal,width=600,height=400");
	}
</script>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>

<!--  -->
<header role="banner">
  <h1>Admin Panel<span>  <img src="../foto_banner/22_big.jpg" width="100px;"></span></h1>
  <ul class="utilities" style="padding-left: 10px;" >
    <li><a href='logout.php'><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li> 
  </ul>
</header>

<nav role="navigation">
  <ul class="main" style="padding-left: 10px;" >
    <li><a href='media.php?module=home'><i class="fa fa-dashboard" aria-hidden="true"></i> Dashboard</a>
		<li><a href='media.php?module=user'><i class="fa fa-sign-in" aria-hidden="true"></i> Login Admin</a></li>
		<li><a href='media.php?module=kategori'><i class="fa fa-bars" aria-hidden="true"></i> Kategori Album</a></li>
		<li><a href='media.php?module=produk'> <i class="fa fa-headphones" aria-hidden="true"></i> Albums</a></li>
		<li><a href='media.php?module=order'><i class="fa fa-first-order" aria-hidden="true"></i> Order Kustomer</a></li>
		<li><a href='media.php?module=ongkoskirim'><i class="fa fa-truck" aria-hidden="true"></i> Ongkos Kirim</a></li>
		<li><a href='media.php?module=profil'><i class="fa fa-home" aria-hidden="true"></i> Setting Profil Toko</a></li>
		<li><a href='media.php?module=carabeli'><i class="fa fa-cog" aria-hidden="true"></i> Setting Cara Beli</a></li>
		<li><a href='media.php?module=rekening'><i class="fa fa-snowflake-o" aria-hidden="true"></i> Info Rekening</a></li>
		<li><a href='media.php?module=laporan'><i class="fa fa-file-text-o" aria-hidden="true"></i> Laporan</a></li>
		<li><a href='../media.php?module=home'><i class="fa fa-rss" aria-hidden="true"></i> Lihat Website</a></li>
  </ul>
</nav>
<!--  -->


<main role="main">
  <section class="panel important">
    <?php include "content.php"; ?>
  </section>
</main>
	
<footer role="contentinfo">Copyright &copy; 2017 by Cindy. All rights reserved.</footer>

<script src="../themes/js/jquery.js" type="text/javascript"></script>
</body>
</html>
<?php
}
?>
