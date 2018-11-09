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

// Hapus user
if ($module=='user' AND $act=='hapus'){
  mysql_query("DELETE FROM admin WHERE id_user='$_GET[id_user]'");
  header('location:../../media.php?module='.$module);
}

// Input user
elseif ($module=='user' AND $act=='input'){

$username=$_POST['username'];
$password=md5($_POST['password']);	
$nama_lengkap=$_POST['nama_lengkap'];
$email=$_POST['email'];
$no_telp=$_POST['no_telp'];


mysql_query("INSERT INTO admin (id_user,
                               username,
                               password,
                               nama_lengkap,
                               email,
                               no_telp,
                               level,
                               blokir
                                   ) 
                                    VALUES ('','$username','$password','$nama_lengkap','$email','$no_telp','user','N')");

 

  header('location:../../media.php?module='.$module);
  
  /*echo "<pre>";
  var_dump($_POST);
  echo "</pre>";*/
}

// Update user
elseif ($module=='user' AND $act=='update'){
$password=md5($_POST[password]);
  
  mysql_query("UPDATE admin SET 
                                username = '$_POST[username]', 
                                password = '$password', 
                                nama_lengkap = '$_POST[nama_lengkap]', 
                                email = '$_POST[email]',
                                no_telp = '$_POST[no_telp]',
                                level = '$_POST[level]' 
                            WHERE id_user = '$_POST[id_user]'");
  header('location:../../media.php?module='.$module);
}
}
?>
