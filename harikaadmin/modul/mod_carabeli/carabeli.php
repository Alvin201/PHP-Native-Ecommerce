<?php
$aksi="modul/mod_carabeli/aksi_carabeli.php";
switch($_GET[act]){
  // Tampil carabeli
  default:
    $sql  = mysql_query("SELECT * FROM modul_setting WHERE id_modul='2'");
    $r    = mysql_fetch_array($sql);

    echo "<h2>Cara Belanja Di Harika Music</h2>
          <form method=POST enctype='multipart/form-data' action=$aksi?module=carabeli&act=update>
          <input type=hidden name=id value=$r[id_modul]>
          <table>
         <tr><td>Isi carabelanja </td><td><textarea name='isi' style='width: 860px; height: 250px;'>$r[static_content]</textarea></td></tr>
         <tr><td colspan=2><input type=submit value=Update>
                           <input type=button value=Batal onclick=self.history.back()></td></tr>
         </form></table>";
    break;  
}
?>
