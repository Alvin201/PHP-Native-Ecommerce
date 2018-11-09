<?php
$aksi="modul/mod_profil/aksi_profil.php";
switch($_GET[act]){
  // Tampil Profil
  default:
    $sql  = mysql_query("SELECT * FROM modul_setting WHERE id_modul='1'");
    $r    = mysql_fetch_array($sql);

    echo "<h2>Profil Toko</h2>
          <form method=POST enctype='multipart/form-data' action=$aksi?module=profil&act=update>
          <input type=hidden name=id value=$r[id_modul]>
          <table>
          <tr><td>Logo</td><td> : <img src=../foto_banner/$r[gambar]></td></tr>
         <tr><td>Ganti Logo</td><td> : <input type=file size=30 name=fupload></td></tr>
         <tr><td>Tentang Toko</td><td><textarea name='isi' style='width: 860px; height: 250px;'>$r[static_content]</textarea></td></tr>
         <tr><td colspan=2><input type=submit value=Update>
                           <input type=button value=Batal onclick=self.history.back()></td></tr>
         </form></table>";
    break;  
}
?>
