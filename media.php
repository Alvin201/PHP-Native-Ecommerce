<?php 
  error_reporting(0);
  session_start();  
  include "config/koneksi.php";
  include "config/fungsi_indotgl.php";
  include "config/fungsi_combobox.php";
  include "config/library.php";
  include "config/fungsi_autolink.php";
  include "config/fungsi_rupiah.php";
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Harika Music Online Store</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="templatemo_style.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="nivo-slider.css" type="text/css" media="screen" />

<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/ddsmoothmenu.js">

/***********************************************
* Smooth Navigational Menu- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

</script>

<script type="text/javascript">

ddsmoothmenu.init({
  mainmenuid: "top_nav", //menu DIV id
  orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
  classname: 'ddsmoothmenu', //class added to menu's outer DIV
  //customtheme: ["#1c5a80", "#18374a"],
  contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})

</script>

</head>

<body>

<div id="templatemo_body_wrapper">
<div id="templatemo_wrapper">

  <div id="templatemo_header">
      <div id="site_title"><h1><a href="#">Harika Music Online Store</a></h1></div>
        <div id="header_right">
            <p>   
              <?php include "item.php";?>
      </p>
    </div>
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_header -->
    
    <div id="templatemo_menubar">
      <div id="top_nav" class="ddsmoothmenu">
            <ul>
                <li><a href="?module=home" class="selected">Home</a></li>
                <li><a href="media.php?module=profilkami">Tentang Kami </a></li>
                <li><a href="media.php?module=carabeli">Cara Pembelian</a></li>
                <?php
                if ($_SESSION[email]=="") {
                  echo "
                  <li><a href='media.php?module=login' > Masuk </a></li>
                  <li><a href='media.php?module=register'>Daftar</a></li>
                  ";
                }
                else {
                  echo "
                  <li><a href='media.php?module=profilKustomer'>Profile Saya</a></li>
                  <li><a href='media.php?module=riwayattransaksi' >Order Saya</a></li>
                  <li><a href='logout.php'> Keluar </a></li>";                    
                }
              ?>  
            </ul>
            <br style="clear: left" />
        </div> <!-- end of ddsmoothmenu -->
        <div id="templatemo_search">
            <form method="post" action="?module=hasilcari">
              <input type="text" value=" " name="kata" id="keyword" title="keyword" onfocus="clearText(this)" onblur="clearText(this)" class="txt_field" />
              <input type="submit" name="Search" value=" " alt="Search" id="searchbutton" title="Search" class="sub_btn"  />
            </form>
        </div>
    </div> <!-- END of templatemo_menubar -->
    
    <div id="templatemo_main">
      <div id="sidebar" class="float_l">
          <div class="sidebar_box"><span class="bottom"></span>
              <h3>Genre Album</h3>   
                <div class="content"> 
                  <ul class="sidebar_list">
                      <?php
                      $genre=mysql_query("select nama_genre, genre.id_genre, 
                                              count(album.id_album) as jml 
                                              from genre left join album 
                                              on album.id_genre=genre.id_genre 
                                              group by nama_genre");
                          $no=1;
                          while($k=mysql_fetch_array($genre)){
                              echo "<li><a class='active' href=' media.php?module=detailgenre&id=$k[id_genre]'> $k[nama_genre] ($k[jml])</a></li>";
                            $no++;
                          }
                          ?>
                    </ul>
                </div>
            </div>
            <div class="sidebar_box"><span class="bottom"></span>
              <h3>Produk Banyak Dilihat </h3>   
                <div class="content"> 
                  <div class="bs_box">

                  <?php
                  $lihat=mysql_query("SELECT * FROM album WHERE dilihat != 0 ORDER BY id_album DESC LIMIT 1");
                  $no=1;
                  while($a=mysql_fetch_array($lihat)){
                    echo "
                    <img src='foto_produk/small_$a[gambar]' />
                      <h4>$a[nama_album]</h4>
                      ($a[dilihat] terakhir dilihat)
                      <h4><a href='media.php?module=detailalbum&id=$a[id_album]' class='w3-btn w3-teal'> Lihat Album</a> </h4>";
                        $no++;
                      }
                      ?>
                        <div class="cleaner"></div>
                    </div>
                   
                </div>
            </div>
        </div>

        <div id="content" class="float_r">
          <div id="slider-wrapper">
                <div id="slider" class="nivoSlider">
                    <img src="images/slider/02.jpg" alt="" />
                    <a href="#"><img src="images/slider/01.jpg" alt="" /></a>
                    <img src="images/slider/03.jpg" alt="" />
                    <img src="images/slider/04.jpg" alt="" />
                </div>
               
            </div>





            <script type="text/javascript" src="js/jquery-1.4.3.min.js"></script>
            <script type="text/javascript" src="js/jquery.nivo.slider.pack.js"></script>
            <script type="text/javascript">
            $(window).load(function() {
                $('#slider').nivoSlider();
            });
            </script>
        
           <?php include "tengah.php";?> 
         
            
            <div class="cleaner"></div>
                  
        </div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
    
    <div id="templatemo_footer">
      <p><a href="?module=home" class="selected">Home</a> | <a href="media.php?module=profilkami">Tentang Kami </a> | <a href="media.php?module=carabeli">Cara Pembelian</a> 
    </p>

      Copyright © 2017 <a href="#">Cindy @BSI</a> </div> 
    
</div> 
</div> 

</body>
</html>