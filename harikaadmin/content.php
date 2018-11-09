<?php
include "../config/koneksi.php";
include "../config/library.php";
include "../config/fungsi_indotgl.php";
include "../config/fungsi_combobox.php";
include "../config/fungsi_rupiah.php";

// Bagian Home
if ($_GET[module]=='home'){
  if ($_SESSION['leveluser']=='admin' || $_SESSION['leveluser']=='user' ){
  echo "<h2>Selamat Datang</h2>
  <ul>
          <p>Hai <b>$_SESSION[namalengkap]</b>, selamat datang di halaman Administrator.<br> Silahkan klik menu pilihan yang berada 
          di sebelah kiri untuk mengelola content website. </p>
          <p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
          <p align=right>Login : $hari_ini, ";

  date_default_timezone_set('Asia/Jakarta');
  echo tgl_indo(date("Y m d")); 
  echo " | "; 
  echo date("H:i:s");
  echo " WIB</p>";
  echo "</ul>";
  }
}

// Bagian Modul
elseif ($_GET[module]=='modul'){
  if ($_SESSION['leveluser']=='admin'  || $_SESSION['leveluser']=='user'){
    include "modul/mod_modul/modul.php";
  }
}

// Bagian User Admin
elseif ($_GET[module]=='user'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_user/user.php";
  }
  else {
  echo "<script>alert('Maaf, anda tidak memiliki akses ke halaman ini,  Segera lapor administrator')
    location.replace('../harikaadmin/media.php?module=home')</script>";
  exit;   
} 

}


// Bagian Kategori
elseif ($_GET[module]=='kategori'){
  if ($_SESSION['leveluser']=='admin' || $_SESSION['leveluser']=='user'){
    include "modul/mod_kategori/kategori.php";
  }
}

// Bagian Produk
elseif ($_GET[module]=='produk'){
  if ($_SESSION['leveluser']=='admin'  || $_SESSION['leveluser']=='user'){
    include "modul/mod_produk/produk.php";
  }
}


// Bagian Order
elseif ($_GET[module]=='order'){
  if ($_SESSION['leveluser']=='admin'  || $_SESSION['leveluser']=='user'){
    include "modul/mod_order/order.php";
  }
}

// Bagian Profil
elseif ($_GET[module]=='profil'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_profil/profil.php";
  }
  else {
  echo "<script>alert('Maaf, anda tidak memiliki akses ke halaman ini,  Segera lapor administrator')
    location.replace('../harikaadmin/media.php?module=home')</script>";
  exit;   
}
  
}


// Bagian Cara Pembelian
elseif ($_GET[module]=='carabeli'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_carabeli/carabeli.php";
  }
  else {
  echo "<script>alert('Maaf, anda tidak memiliki akses ke halaman ini,  Segera lapor administrator')
    location.replace('../harikaadmin/media.php?module=home')</script>";
  exit;   
}
  
}

// Bagian Banner
elseif ($_GET[module]=='rekening'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_rekening/rekening.php";
  }
  else {
  echo "<script>alert('Maaf, anda tidak memiliki akses ke halaman ini,  Segera lapor administrator')
    location.replace('../harikaadmin/media.php?module=home')</script>";
  exit;   
}

}

// Bagian Kota/Ongkos Kirim
elseif ($_GET[module]=='ongkoskirim'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_ongkoskirim/ongkoskirim.php";
  }
  else {
  echo "<script>alert('Maaf, anda tidak memiliki akses ke halaman ini,  Segera lapor administrator')
    location.replace('../harikaadmin/media.php?module=home')</script>";
  exit;   
}
}


// Bagian Laporan
elseif ($_GET[module]=='laporan'){
  if ($_SESSION['leveluser']=='admin'  || $_SESSION['leveluser']=='user'){
    include "modul/mod_laporan/laporan.php";
  }
}

// Apabila modul tidak ditemukan
else{
  echo "<p><b>MODUL BELUM ADA ATAU BELUM LENGKAP</b></p>";
}
?>
