<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_ongkoskirim/aksi_ongkoskirim.php";
switch($_GET[act]){
  // Tampil Ongkos Kirim
  default:
    echo "<h2>Ongkos Kirim</h2>
          <input type=button value='Tambah Ongkos Kirim' 
          onclick=\"window.location.href='?module=ongkoskirim&act=tambahongkoskirim';\" style='margin-left:1%;'>
          <table>
          <tr><th>no</th><th>nama kota</th><th>ongkos kirim</th><th>aksi</th></tr>"; 
    $tampil=mysql_query("SELECT * FROM kota ORDER BY id_kota DESC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       $ongkos = format_rupiah($r[ongkos_kirim]);
       echo "<tr><td>$no</td>
             <td>$r[nama_kota]</td>
             <td>$ongkos</td>
             <td><a href=?module=ongkoskirim&act=editongkoskirim&id=$r[id_kota]>Edit</a> | 
	               <a href=$aksi?module=ongkoskirim&act=hapus&id=$r[id_kota]>Hapus</a>
             </td></tr>";
      $no++;
    }
    echo "</table>";
    break;
  
  // Form Tambah Ongkos Kirim
  case "tambahongkoskirim":
   echo '<section class="panel important">';
    echo "<h2>Tambah Ongkos Kirim</h2>
          <form method=POST action='$aksi?module=ongkoskirim&act=input'>
          <tr><td>Nama Kota</td><td> : <input type=text name='nama_kota' placeholder='Nama Kota' style='height:5%;'></td></tr>
          <tr><td>Ongkos Kirim</td><td> : <input type=text name='ongkos_kirim' size=7 placeholder='Ongkos Kirim' style='height:5%;'></td></tr>
          <tr><td colspan=2><input type=submit name=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </form>";
           echo '</section>';
     break;
  
  // Form Edit Ongkos Kirim
  case "editongkoskirim":
    $edit=mysql_query("SELECT * FROM kota WHERE id_kota='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Edit Ongkos Kirim</h2>
          <form method=POST action=$aksi?module=ongkoskirim&act=update>
          <input type=hidden name=id value='$r[id_kota]'>
          <tr><td>Nama Kota</td><td> : <input type=text name='nama_kota' value='$r[nama_kota]' placeholder='Nama Kota' style='height:5%;'></td></tr>
          <tr><td>Ongkos Kirim</td><td> : <input type=text name='ongkos_kirim' value='$r[ongkos_kirim]' size=7 placeholder='Ongkos Kirim' style='height:5%;'></td></tr>
          <tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </form>";
    break;  
}
}
?>
