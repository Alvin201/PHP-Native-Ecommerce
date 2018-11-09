<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus Kategori
if ($module=='kategori' AND $act=='hapus'){
  mysql_query("DELETE FROM genre WHERE id_genre='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input kategori
elseif ($module=='kategori' AND $act=='input'){
  mysql_query("INSERT INTO genre(nama_genre) VALUES('$_POST[nama_genre]')");
  header('location:../../media.php?module='.$module);
}

// Update kategori
elseif ($module=='kategori' AND $act=='update'){
  mysql_query("UPDATE genre SET nama_genre = '$_POST[nama_genre]' WHERE id_genre = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
}
?>
