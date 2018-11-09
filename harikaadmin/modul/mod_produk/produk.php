<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_produk/aksi_produk.php";
switch($_GET[act]){
  // Tampil Produk
  default:
    echo "<h2>Album</h2>
          <input type=button value='Tambah Album' onclick=\"window.location.href='?module=produk&act=tambahproduk';\" style='margin-left:1%;'>
          <table>
          <tr><th>no</th><th>nama album</th><th>berat(kg)</th><th>harga</th><th>diskon(%)</th><th>stok</th><th>tgl. masuk</th><th>aksi</th></tr>";

    $tampil = mysql_query("SELECT * FROM album ORDER BY id_album DESC");
  
    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
      $tanggal=tgl_indo($r[tgl_masuk]);
      $harga=format_rupiah($r[harga]);
      echo "<tr><td>$no</td>
                <td>$r[nama_album]</td>
                <td align=center>$r[berat]</td>
                <td>$harga</td>
                <td align=center>$r[diskon]</td>
                <td align=center>$r[stok]</td>
                <td>$tanggal</td>
		            <td><a href=?module=produk&act=editproduk&id=$r[id_album]>Edit</a> | 
		                <a href='$aksi?module=produk&act=hapus&id=$r[id_album]&namafile=$r[gambar]'>Hapus</a></td>
		        </tr>";
      $no++;
    }
    echo "</table>";
 
    break;
  
  case "tambahproduk":
  echo '<section class="panel important">';
    echo "<h2>Tambah Album</h2>
          <form method=POST action='$aksi?module=produk&act=input' enctype='multipart/form-data'>
          <tr><td width=100>Nama Album</td>     <td> : <input type=text name='nama_album' size=60  placeholder='Nama Album' style='height:5%;'></td></tr>
          
          <tr><td>Genre</td>  <td> : 
          <select name='kategori'>
            <option value=0 selected>- Pilih Genre -</option>";
            $tampil=mysql_query("SELECT * FROM genre ORDER BY nama_genre");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value=$r[id_genre]>$r[nama_genre]</option>";
            }
    echo "</select></td></tr>
          <tr><td>Berat</td>     <td> : <input type=text name='berat' size=3  placeholder='Berat' style='height:5%;'> KG</td></tr>

          <tr><td>Harga</td>     <td> : <input type=text name='harga' size=10  placeholder='Harga' style='height:5%;'></td></tr>

          <tr><td>Diskon</td>     <td> : <input type=text name='diskon' size=2  placeholder='Diskon' style='height:5%;'> %</td></tr>

          <tr><td>Stok</td>     <td> : <input type=number name='stok' size=3  placeholder='Stok' style='height:5%;'></td></tr>

          <tr><td>Deskripsi</td>  <td> <textarea name='deskripsi'></textarea></td></tr>

          <tr><td>Gambar</td>      <td> : <input type=file name='fupload' size=40 style='width:20%;'> 
                                          <br>Tipe gambar harus JPG/JPEG dan ukuran lebar maks: 400 px</td></tr>
          <tr><td colspan=2><input type=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </form>";
           echo '</section>';
     break;
    
  case "editproduk":
    $edit = mysql_query("SELECT * FROM album WHERE id_album='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2>Edit Album</h2>
          <form method=POST enctype='multipart/form-data' action=$aksi?module=produk&act=update>
          <input type=hidden name=id value=$r[id_album]>
          <tr><td width=70>Nama Album</td>     <td> : <input type=text name='nama_album' size=60 value='$r[nama_album]' placeholder='Nama Album' style='height:5%;'></td></tr>
          <tr><td>Genre</td>  <td> : <select name='kategori'>";
 
          $tampil=mysql_query("SELECT * FROM genre ORDER BY nama_genre");
          if ($r[id_kategori]==0){
            echo "<option value=0 selected>- Pilih Genre -</option>";
          }   

          while($w=mysql_fetch_array($tampil)){
            if ($r[id_genre]==$w[id_genre]){
              echo "<option value=$w[id_genre] selected>$w[nama_genre]</option>";
            }
            else{
              echo "<option value=$w[id_genre]>$w[nama_genre]</option>";
            }
          }
    echo "</select></td></tr>
          <tr><td>Berat</td>     <td> : <input type=text name='berat' value=$r[berat] size=3 placeholder='Berat' style='height:5%;'></td></tr>

          <tr><td>Harga</td>     <td> : <input type=text name='harga' value=$r[harga] size=10 placeholder='Harga' style='height:5%;'></td></tr>

          <tr><td>Diskon</td>     <td> : <input type=text name='diskon' value=$r[diskon] size=2 placeholder='Diskon' style='height:5%;'></td></tr>
          
          <tr><td>Stok</td>     <td> : <input type=text name='stok' value=$r[stok] size=3 placeholder='Stok' style='height:5%;'></td></tr>

          <tr><td>Deskripsi</td>   <td> <textarea name='deskripsi'>$r[deskripsi]</textarea></td></tr>

          <tr><td>Gambar</td>       <td> :  
          <img src='../foto_produk/small_$r[gambar]'></td></tr><br/>
          <tr><td>Ganti Gbr</td>    <td> : <input type=file name='fupload' size=30  style='width:20%;'> *)</td></tr>
          <tr><td colspan=2>*) Apabila gambar tidak diubah, dikosongkan saja.</td></tr>
          <tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
         </form>";
    break;  
}
}
?>
