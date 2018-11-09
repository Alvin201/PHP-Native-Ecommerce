<?php
$aksi="modul/mod_kategori/aksi_kategori.php";
switch($_GET[act]){
  // Tampil Kategori
  default:
    echo "<h2>Genre</h2>
          <input type=button value='Tambah Genre' 
          onclick=\"window.location.href='?module=kategori&act=tambahkategori';\" style='margin-left:1%;'>
          <table>
          <tr><th>no</th><th>nama genre</th><th>aksi</th></tr>"; 
    $tampil=mysql_query("SELECT * FROM genre ORDER BY id_genre DESC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr><td>$no</td>
             <td>$r[nama_genre]</td>
             <td><a href=?module=kategori&act=editkategori&id=$r[id_genre]>Edit</a> | 
	               <a href=$aksi?module=kategori&act=hapus&id=$r[id_genre]>Hapus</a>
             </td></tr>";
      $no++;
    }
    echo "</table>";
    break;
  
  // Form Tambah Kategori
  case "tambahkategori":
  echo '<section class="panel important">';
    echo "<h2>Tambah Genre</h2>
          <form method=POST action='$aksi?module=kategori&act=input'>
          <tr><td>Nama Genre</td><td> : <input type=text name='nama_genre' placeholder='Nama Genre' style='height:5%;'></td></tr>
          <tr><td colspan=2><input type=submit name=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </form>";
          echo '</section>';
     break;
  
  // Form Edit Kategori  
  case "editkategori":
    $edit=mysql_query("SELECT * FROM genre WHERE id_genre='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Edit Genre</h2>
          <form method=POST action=$aksi?module=kategori&act=update>
          <input type=hidden name=id value='$r[id_genre]'>
          <tr><td>Nama Genre</td><td> : <input type=text name='nama_genre' value='$r[nama_genre]' placeholder='Nama Genre' style='height:5%;'></td></tr>
          <tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </form>";
    break;  
}
?>
