<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
   echo '<section class="panel important">';
   echo "<h2>Laporan Order Transaksi</h2>
          <input type=button value='Laporan Hari Ini' 
          onclick=\"window.location.href='modul/mod_laporan/pdf_toko_sekarang.php';\" style='margin-left:1%;'>

          <form method=POST action='modul/mod_laporan/pdf_toko.php'>
          <tr><td colspan=2><b>Laporan Per Periode</b></td></tr><br/><br/>
          <tr><td>Dari Tanggal</td><td> : ";        
          combotgl(1,31,'tgl_mulai',$tgl_skrg);
          combonamabln(1,12,'bln_mulai',$bln_sekarang);
          combothn(2000,$thn_sekarang,'thn_mulai',$thn_sekarang);

    echo "</td></tr>
          <tr><td>sampai dengan tanggal</td><td> : ";
          combotgl(1,31,'tgl_selesai',$tgl_skrg);
          combonamabln(1,12,'bln_selesai',$bln_sekarang);
          combothn(2000,$thn_sekarang,'thn_selesai',$thn_sekarang);

    echo "</td></tr>
          <tr><td colspan=2><input type=submit value=Proses></td></tr>
          </form>";
           echo '</section>';
}
?>
