<script language="javascript">
function validasi(form){
  if (form.nama.value == ""){
    alert("Anda belum mengisikan Nama.");
    form.nama.focus();
    return (false);
  }    
  if (form.alamat.value == ""){
    alert("Anda belum mengisikan Alamat.");
    form.alamat.focus();
    return (false);
  }
   if (form.rekening.value == ""){
    alert("Anda belum mengisikan Rekening.");
    form.rekening.focus();
    return (false);
  }
  if (form.telpon.value == ""){
    alert("Anda belum mengisikan Telpon.");
    form.telpon.focus();
    return (false);
  }
  if (form.email.value == ""){
    alert("Anda belum mengisikan Email.");
    form.email.focus();
    return (false);
  }
  if (form.kota.value == 0){
    alert("Anda belum mengisikan Kota.");
    form.kota.focus();
    return (false);
  }
  if (form.kode.value == ""){
    alert("Anda belum mengisikan Kode.");
    form.kode.focus();
    return (false);
  }
  return (true);
}

function validasi2(form2){
  if (form2.email.value == ""){
    alert("Anda belum mengisikan Email.");
    form2.email.focus();
    return (false);
  }
  if (form2.password.value == ""){
    alert("Anda belum mengisikan Password.");
    form2.password.focus();
    return (false);
  }
  return (true);
}

function harusangka(jumlah){
  var karakter = (jumlah.which) ? jumlah.which : event.keyCode
  if (karakter > 31 && (karakter < 48 || karakter > 57))
    return false;
  return true;
}
</script>


<?php if ($_GET[module]=='home'){ ?>
  
  <h1>Albums</h1>
   <?php 
    $sql=mysql_query("SELECT * FROM album ORDER BY id_album DESC LIMIT 7");
    while ($r=mysql_fetch_array($sql)){
    $nama_produk = htmlentities(strip_tags($r['nama_album'])); // mengabaikan tag html	
    $isi = substr($nama_produk,0,27); // ambil sebanyak 24 karakter
    $isi = substr($nama_produk,0,strrpos($isi," ")); // potong per spasi kalimat
    include "diskon_stok.php";  
    ?>
  <div class="product_box">
              <h3><?php echo $isi; ?></h3>
              <a href="media.php?module=detailalbum&id=<?php echo $r['id_album'] ?>"><img src="foto_produk/<?php echo $r['gambar'] ?>" style="width:200px;height: 150px;" /></a>
                <p class="product_price"><?php echo $divharga ?> </p>
                <?php echo $tombol ?>
                <a href="media.php?module=detailalbum&id=<?php echo $r['id_album'] ?>" class="detail"></a>
            </div>
    <?php } ?>

<?php } //End Page Home


elseif ($_GET[module]=='warning') { //Module jika user beli dan belum login harus login
    echo "<div style='margin-left:25%'><h4 style='margin-left:2%'>Untuk Melakukan Hal ini Anda Harus Login Terlebih Dahulu<a href='media.php?module=login'> disini</a></h4></div>";
    } 


// Modul detail produk
    elseif ($_GET[module]=='detailalbum'){
      // Tampilkan detail produk berdasarkan produk yang dipilih
    $detail=mysql_query("SELECT * FROM album,genre    
                      WHERE genre.id_genre=album.id_genre 
                      AND id_album='$_GET[id]'");

    //Produk sering dilihat
    $update=mysql_query("update album set dilihat=dilihat+1 where id_album='$_GET[id]' ");
    $r = mysql_fetch_array($detail);
    include "diskon_stok.php";
      echo"
              <div id='content' class='float_r'>
        	  <h1>$r[nama_album]</h1>

        	  <div class='content_half float_l'>
        	<a  rel='lightbox[portfolio]' href='foto_produk/$r[gambar]'><img src='foto_produk/$r[gambar]' style='width:300px;height:200px;' alt='image' /></a>
            </div>
            <div class='content_half float_r'>
                <table>
                    <tr>
                        <td width='160'>Price:</td>
                        <td>$divharga</td>
                    </tr>
                    </table>
                <div class='cleaner h20'></div>
               $tombol
			</div>
            <div class='cleaner h30'></div>
            
            <h5>Album Description</h5>
            <p>$r[deskripsi]</p>	            
    </div>";
           
    }

    // Modul produk per kategori
    elseif ($_GET[module]=='detailgenre'){
    
    // Tampilkan nama kategori
      $sq = mysql_query("SELECT nama_genre from genre where id_genre='$_GET[id]'");
      $n = mysql_fetch_array($sq);

    echo"
     <div id='content' class='float_r'>
        	<h1> Genre $n[nama_genre]</h1>";

    // Tampilkan daftar produk yang sesuai dengan kategori yang dipilih
    $sql = mysql_query("SELECT * FROM album WHERE id_genre='$_GET[id]' 
            ORDER BY id_genre");     
    $jumlah = mysql_num_rows($sql);

         
    // Apabila ditemukan produk dalam kategori
    if ($jumlah > 0){
      while ($r=mysql_fetch_array($sql)){ //foreach
      
    $nama_produk = htmlentities(strip_tags($r['nama_album'])); // mengabaikan tag html	
    $isi = substr($nama_produk,0,27); // ambil sebanyak 24 karakter
    $isi = substr($nama_produk,0,strrpos($isi," ")); // potong per spasi kalimat
      include "diskon_stok.php"; 	
            
    echo "        
          <div class='product_box'>
	            <h3>$isi</h3>
            	<a href='media.php?module=detailalbum&id=$r[id_album]'><img src='foto_produk/$r[gambar]' style='width:150px;height:150px;' /></a>
              <p class='product_price'>$divharga</p>
                $tombol
                <a href='media.php?module=detailalbum&id=$r[id_album]' class='detail'></a>
            </div>";        	
 
    } //end foreach
             
    echo"                 
          <div class='cleaner'></div>";
        
		 }else{
		      echo "<p align=center>Belum ada album pada kategori/genre ini.</p>";
		    }
 
       echo "</div>";
    
    } // Modul cara pembelian 

      elseif ($_GET[module]=='profilkami'){

      $profil1 = mysql_query("SELECT * FROM modul_setting WHERE id_modul='1'");
      $r1      = mysql_fetch_array($profil1); 
      
      echo "<div id='content' class='float_r'>
        <img src='foto_banner/$r1[gambar]' style='width:330px;' />


        $r1[static_content]
        <div class='cleaner h20'></div></div>";


     }elseif ($_GET[module]=='carabeli'){

    	$profilcarabeli = mysql_query("SELECT * FROM modul_setting WHERE id_modul='2'");
    	$r      = mysql_fetch_array($profilcarabeli); 
        
      echo"
        $r[static_content]
        <div class='cleaner h20'></div>";
    
    } //form login


    elseif ($_GET[module]=='login') {
      if ($_GET[act]=='aksilogin') {
          $email = $_POST['email'];
          $password = md5($_POST['password']);
          
          $sql = "SELECT * FROM customer WHERE email='$email' AND password='$password'";
          $hasil = mysql_query($sql);
          $r = mysql_fetch_array($hasil);
          
          if(mysql_num_rows($hasil) == 0){
                   echo '<div style="margin-left:25%">
                <div class="w3-row-padding w3-margin-top">';
                 echo "<p style='color:red;'>Email atau Password Anda tidak benar</p><br />";
                  echo "</div>
                   </div></br>";  
          }
          else{
          session_start();
          $_SESSION[id_customer]= $r[id_customer];
          $_SESSION[email]= $r[email];
          $_SESSION[nama_lengkap]= $r[nama_lengkap];
          $_SESSION[password]= $r[password];
           echo "<script> alert('Silahkan Berbelanja Di Harika Music');window.location='index.php'</script>\n";
           exit(0);
          }
          }
          
          echo '<div style="margin-left:25%">
          <div class="w3-row-padding w3-margin-top">';  
          
          echo "
           <h2>Form Login</h2>
           <form name=form2 action=media.php?module=login&act=aksilogin method=POST onSubmit=\"return validasi2(this)\">
           <table>
           <tr><td>Email</td><td> <input type=text name=email size=30></td></tr>
           <tr><td>Password</td><td> <input type=password name=password size=30></td></tr>
           <tr><td><input type='submit' class='button' value='Login' id='submit'></td><td align=right><a href='media.php?module=lupapassword'>Lupa Password?</a></td></tr>
           </table>
           </form>";

            echo "</div>
              </div></br>";   
    
    }// Modul lupa password
      elseif ($_GET[module]=='lupapassword'){
              
              echo '<div style="margin-left:25%">
              <div class="w3-row-padding w3-margin-top">';
              
              echo "<h2>Lupa Password</h2>";
              echo "
              <form name=form3 action=media.php?module=kirimpassword method=POST>
              <table>
              <tr><td>Masukkan Email Anda</td><td>  <input type=text name=email size=30></td></tr>
              <tr><td colspan=2><input type='submit' class='button' value='Kirim'></td></td></tr>
              </table>
              </form>";

               echo "</div>
              </div></br>";                       
    }// Modul kirim password
            elseif ($_GET[module]=='kirimpassword'){

            // Cek email kustomer di database
            $cek_email=mysql_num_rows(mysql_query("SELECT email FROM customer WHERE email='$_POST[email]'"));
            // Kalau email tidak ditemukan
            if ($cek_email == 0){
              echo "Email <b>$_POST[email]</b> tidak terdaftar di database kami.<br />
                    <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>";
            }
            else{

            $password_baru = substr(md5(uniqid(rand(),1)),3,10);

            // ganti password kustomer dengan password yang baru (reset password)
            $query=mysql_query("update customer set password=md5('$password_baru') where email='$_POST[email]'");

            // dapatkan email_pengelola dari database
            $sql2 = mysql_query("select email_pengelola from modul_setting where id_modul='43'");
            $j2   = mysql_fetch_array($sql2);

            $subjek="Password Baru";
            $pesan="Password Anda yang baru adalah <b>$password_baru</b>";
            // Kirim email dalam format HTML
            $dari = "From: $j2[email_pengelola]\r\n";
            $dari .= "Content-type: text/html\r\n";

            // Kirim password ke email kustomer
            mail($_POST[email],$subjek,$pesan,$dari);
                          
                          echo '<div style="margin-left:25%">
              <div class="w3-row-padding w3-margin-top">';
            
              echo "<h2>Password Sudah Terkirim</h2>
                     <br /><h2>Silahkan cek email Anda.</h2>";
              
              echo "</div>
                      </div></br>"; 
            } 

      }//Module Register
                elseif ($_GET[module]=='register') {
                $kar1=strstr($_POST[email], "@");
                $kar2=strstr($_POST[email], ".");
                $password=md5($_POST[password]);
                echo "<div id='info'>";
                // Cek email kustomer di database
                $cek_email=mysql_num_rows(mysql_query("SELECT email FROM customer WHERE email='$_POST[email]'"));
                // Kalau email sudah ada yang pakai
                if ($cek_email > 0){
                  echo '<div style="margin-left:25%">
                   <div class="w3-row-padding w3-margin-top">';
                  echo "Email <b>$_POST[email]</b> sudah ada yang pakai.<br />";
                   echo '</div>
                   </div>';
                }
                elseif (empty($_POST[nama]) || empty($_POST[password]) || empty($_POST[alamat]) || empty($_POST[rekening]) || empty($_POST[email]) || empty($_POST[kota]) || empty($_POST[kode])){

                  echo '<div style="margin-left:25%">
                   <div class="w3-row-padding w3-margin-top">'; 
                  echo "Isi data anda dengan lengkap<br />";
                  echo '</div>
                   </div>';
                }
                elseif (!ereg("[a-z|A-Z]","$_POST[nama]")){
                  echo '<div style="margin-left:25%">
                   <div class="w3-row-padding w3-margin-top">'; 
                  echo "Nama tidak boleh diisi dengan angka atau simbol.<br />";
                  echo '</div>
                   </div>';
                }
                elseif (strlen($kar1)==0 OR strlen($kar2)==0){
                  echo '<div style="margin-left:25%">
                   <div class="w3-row-padding w3-margin-top">'; 
                  echo "Alamat email Anda tidak valid, mungkin kurang tanda titik (.) atau tanda @.<br />";
                   echo '</div>
                   </div>';
                }
                else{
                if(!empty($_POST['kode'])){
                  if($_POST['kode']==$_SESSION['captcha_session']){

                // simpan data kustomer 
                mysql_query("INSERT INTO customer(nama_lengkap, password, alamat, rekening,email, telpon, id_kota) 
                             VALUES('$_POST[nama]','$password','$_POST[alamat]','$_POST[rekening]','$_POST[email]','$_POST[telpon]','$_POST[kota]')");
                      echo "<b>Anda berhasil Melakukan Registrasi</b><br/>
                        Silahkan anda login <a href='media.php?module=login'>disini</a>";
                  }else{
                  echo "Kode yang Anda masukkan tidak cocok<br />
                  <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>";
                  }
                  }else{
                  echo "Anda belum memasukkan kode<br />
                  <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>";
                  }

                  }
                    echo '<div style="margin-left:25%">
                   <div class="w3-row-padding w3-margin-top">';
            
                  echo "
                  <h2>Form Register</h2>
                        <form name=form action=media.php?module=register method=POST onSubmit=\"return validasi(this)\">
                        <table width='90%'>
                        <tr><td>Nama Lengkap</td><td>  <input type=text name=nama size=30></td></tr>
                        <tr><td>Password</td><td>  <input type=password name=password></td></tr>
                        <tr><td>Alamat Pengiriman</td><td> <textarea name='alamat'></textarea>
                        <br /> Alamat pengiriman harus di isi lengkap, termasuk kota/kabupaten dan kode posnya.</td></tr>
                        <tr><td>Nomor Rekening</td><td>  <input type=text name=rekening></td></tr>
                        <tr><td>Nomor Telpon</td><td>  <input type=text name=telpon></td></tr>
                        <tr><td>Email</td><td>  <input type=text name=email size=30></td></tr>
                        <tr><td valign=top>Kota Tujuan</td><td>   
                        <select name='kota'>
                        <option value=0 selected>- Pilih Kota -</option>";
                        $tampil=mysql_query("SELECT * FROM kota ORDER BY nama_kota");
                        while($r=mysql_fetch_array($tampil)){
                           echo "<option value=$r[id_kota]>$r[nama_kota]</option>";
                        }
                    echo "</select> <br /><br />*)  Apabila tidak terdapat nama kota tujuan Anda, pilih <b>Lainnya</b>
                                    <br />**) Ongkos kirim dihitung berdasarkan kota tujuan</td></tr>
                          <tr><td>&nbsp;</td><td><img src='captcha.php'></td></tr>
                          <tr><td>&nbsp;</td><td>(Masukkan 6 kode diatas)<br /><input type=text name=kode size=6 maxlength=6><br /></td></tr>
                        <tr><td colspan=2><input type='submit' class='button btn-primary' value='Daftar'></td></tr>
                        </table>
                        </form>";

                    echo "</div>
                        </div></div>";
        
        } // Modul keranjang belanja
          elseif ($_GET[module]=='keranjangbelanja'){
          // Tampilkan produk-produk yang telah dimasukkan ke keranjang belanja
          $sid = $_SESSION[email];
          $sql = mysql_query("SELECT * FROM orders_temp, album 
                              WHERE id_session='$sid' AND orders_temp.id_album=album.id_album");
          $ketemu=mysql_num_rows($sql);
          if($ketemu < 1){
            echo "<script>window.alert('Keranjang Belanjanya Masih Kosong -_- ');
                window.location=('index.php')</script>";
            }
          else{ 
            echo '<div>
                   <div class="w3-row-padding w3-margin-top">';
             
            echo "<h2>Keranjang Belanja</h2>     
                  <form method=post action=aksi.php?module=keranjang&act=update>
                  <table style='width:100%'>
                  <tbody>
                  <tr bgcolor='lightblue'>
                  <th>No</th>
                  <th>Album</th>
                  <th>Nama Album</th>
                  <th>Berat(Kg)</th>
                  <th>Qty</th>
                  <th>Harga</th>
                  <th>Sub Total</th>
                  <th>Aksi</th>
                  </tr>";  
          
              $no=1;
              while($r=mysql_fetch_array($sql)){
                $disc        = ($r[diskon]/100)*$r[harga];
                $hargadisc   = number_format(($r[harga]-$disc),0,",",".");

                $subtotal    = ($r[harga]-$disc) * $r[jumlah];
                $total       = $total + $subtotal;  
                $subtotal_rp = format_rupiah($subtotal);
                $total_rp    = format_rupiah($total);
                $harga       = format_rupiah($r[harga]);
    
                echo "<tr style='color:#000;border: 1px solid #ECECEC'><td>$no</td><input type=hidden name=id[$no] value=$r[id_orders_temp]>
                          <td align=center><br><img src='foto_produk/$r[gambar]' width=100px></td>
                          <td>$r[nama_album]</td>
                          <td align=center>$r[berat]</td>
                          <td><select name='jml[$no]' value=$r[jumlah] onChange='this.form.submit()'>";
                          for ($j=1;$j <= $r[stok];$j++){ //batas beli = stok
                              if($j == $r[jumlah]){
                               echo "<option selected>$j</option>";
                              }else{
                               echo "<option>$j</option>";
                              }
                          }
                    echo "</select></td>
                          <td>$hargadisc</td>
                          <td>$subtotal_rp</td>
                          <td style='margin-bottom:10px;position:absolute;'><a href='aksi.php?module=keranjang&act=hapus&id=$r[id_orders_temp]'>
                          Batal</a></td>
                      </tr>";
                $no++; 
                } 
 
                              echo "<tr style='color:#000'>
                    <td colspan=6 align=right><br><b>Total</b>:</td>
                    <td colspan=2><br>Rp. <b>$total_rp</b></td>
                      <td colspan=2> 
                    </tr>
                      
                      <tr>
                      <td colspan=3><br /><a href='javascript:history.go(-1)' class='w3-button w3-khaki'>Lanjutkan Belanja</a><br /></td>
                      <td colspan=5 align=right><br /><a href='media.php?module=simpantransaksimember' class='w3-button w3-purple'>Selesai Belanja</a></a><br /></td>
                      </tr>
                      </tbody>
                      </table>
                      </form><br />
                      
                     *) Total harga diatas belum termasuk ongkos kirim yang akan dihitung saat <b>Selesai Belanja</b>";
                  
                  echo "</div>
                    </div></br>";
        
                }


        } // Modul simpan transaksi member
                elseif ($_GET[module]=='simpantransaksimember'){
                echo "<div style='color:#000'>";
                $email = $_SESSION[email];
                $password = $_SESSION[password];

                $sql = "SELECT * FROM customer WHERE email='$email' AND password='$password'";
                $hasil = mysql_query($sql);
                $r = mysql_fetch_array($hasil);
                // fungsi untuk mendapatkan isi keranjang belanja
                function isi_keranjang(){
                  $isikeranjang = array();
                  $sid = $_SESSION[email];
                  $sql = mysql_query("SELECT * FROM orders_temp WHERE id_session='$sid'");
                  
                  while ($r=mysql_fetch_array($sql)) {
                    $isikeranjang[] = $r;
                  }
                  return $isikeranjang;
                }

                  $tgl_skrg = date("Ymd");
                  $jam_skrg = date("H:i:s");
                
                  $id = mysql_fetch_array(mysql_query("SELECT id_customer FROM customer WHERE email='$email' AND password='$password'"));

                  // mendapatkan nomor kustomer
                  $id_customer=$id[id_customer];
                                    
                  // simpan data pemesanan 
                  mysql_query("INSERT INTO orders(tgl_order,jam_order,id_customer,pengiriman) VALUES('$tgl_skrg','$jam_skrg','$id_customer','jne')");

  
                  // mendapatkan nomor orders
                  $id_orders=mysql_insert_id();

                  // panggil fungsi isi_keranjang dan hitung jumlah produk yang dipesan
                  $isikeranjang = isi_keranjang();
                  $jml          = count($isikeranjang);

                  // simpan data detail pemesanan  
                  for ($i = 0; $i < $jml; $i++){
                    mysql_query("INSERT INTO orders_detail(id_orders, id_album, jumlah) 
                                 VALUES('$id_orders',{$isikeranjang[$i]['id_album']}, {$isikeranjang[$i]['jumlah']})");
                  }
  
                  // setelah data pemesanan tersimpan, hapus data pemesanan di tabel pemesanan sementara (orders_temp)
                  for ($i = 0; $i < $jml; $i++) {
                    mysql_query("DELETE FROM orders_temp
                                 WHERE id_orders_temp = {$isikeranjang[$i]['id_orders_temp']}");
                  }

                   echo '<div>
                   <div class="w3-row-padding w3-margin-top">';
             
                  echo "<h2>Proses Transaksi Selesai</h2>";
                  echo "Data pemesan beserta ordernya adalah sebagai berikut: <br />
                  <table class='w3-table'>
                  <tr><td>Nama Lengkap   </td><td> : <b>$r[nama_lengkap]</b> </td></tr>
                  <tr><td>Alamat Lengkap </td><td> : $r[alamat] </td></tr>
                  <tr><td>Nomor Rekening         </td><td> : $r[telpon] </td></tr>
                  <tr><td>E-mail         </td><td> : $r[email] </td></tr></table><hr /><br />
                  
                  Nomor Order: <b>$id_orders</b><br /><br />";

                  $daftarproduk=mysql_query("SELECT * FROM orders_detail,album 
                                             WHERE orders_detail.id_album=album.id_album 
                                             AND id_orders='$id_orders'");

                echo "<table  style='width:100%'>
                    <tr bgcolor=#6da6b1>
                    <th>No</th>
                    <th>Nama Album</th>
                    <th>Berat(Kg)</th>
                    <th>Qty</th>
                    <th>Harga Satuan</th>
                    <th>Sub Total</th>
                    </tr>";
                      
                  $pesan="Terimakasih telah melakukan pemesanan online di toko online kami <br /><br />  
                        Nama: $r[nama_lengkap] <br />
                        Alamat: $r[alamat] <br/>
                        Nomor Rekening: $r[telpon] <br /><hr />
                        
                        Nomor Order: $id_orders <br />
                        Data order Anda adalah sebagai berikut: <br /><br />";
                        
                $no=1;
                while ($d=mysql_fetch_array($daftarproduk)){
                   $disc        = ($d[diskon]/100)*$d[harga];
                   $hargadisc   = number_format(($d[harga]-$disc),0,",","."); 
                   $subtotal    = ($d[harga]-$disc) * $d[jumlah];

                   $subtotalberat = $d[berat] * $d[jumlah]; // total berat per item produk 
                   $totalberat  = $totalberat + $subtotalberat; // grand total berat all produk yang dibeli

                   $total       = $total + $subtotal;
                   $subtotal_rp = format_rupiah($subtotal);    
                   $total_rp    = format_rupiah($total);    
                   $harga       = format_rupiah($d[harga]);

                   echo "<tr bgcolor=#dad0d0>
                       <td>$no</td>
                       <td>$d[nama_album]</td>
                        <td align=center>$d[berat]</td>
                        <td align=center>$d[jumlah]</td>
                          <td align=right>$harga</td><td align=right>$subtotal_rp</td></tr>";
                   $pesan.="$d[jumlah] $d[nama_album] -> Rp. $harga -> Subtotal: Rp. $subtotal_rp <br />";
                   $no++;
                }

                  $kota=$r[id_kota];

                  $ongkos=mysql_fetch_array(mysql_query("SELECT ongkos_kirim FROM kota WHERE id_kota='$kota'"));
                  $ongkoskirim1=$ongkos[ongkos_kirim];
                  $ongkoskirim = $ongkoskirim1 * $totalberat;

                  $grandtotal    = $total + $ongkoskirim; 

                  $ongkoskirim_rp = format_rupiah($ongkoskirim);
                  $ongkoskirim1_rp = format_rupiah($ongkoskirim1); 
                  $grandtotal_rp  = format_rupiah($grandtotal);  

                  // dapatkan email_pengelola dan nomor rekening dari database
                  $sql2 = mysql_query("select email_pengelola,nomor_rekening,nomor_hp from modul_setting where id_modul='43'");
                  $j2   = mysql_fetch_array($sql2);

                  $pesan.="<br /><br />Total : Rp. $total_rp 
                           <br />Ongkos Kirim untuk Tujuan Kota Anda : Rp. $ongkoskirim1_rp/Kg 
                           <br />Total Berat : $totalberat Kg
                           <br />Total Ongkos Kirim  : Rp. $ongkoskirim_rp     
                           <br />Grand Total : Rp. $grandtotal_rp 
                           <br /><br />Silahkan lakukan pembayaran sebanyak Grand Total yang tercantum, rekeningnya: $j2[nomor_rekening]
                           <br />Apabila sudah transfer, konfirmasi ke nomor: $j2[nomor_hp]";

                  $subjek="Pemesanan Online";

                  // Kirim email dalam format HTML
                  $dari = "From: $j2[email_pengelola]\r\n";
                  $dari .= "Content-type: text/html\r\n";

                  // Kirim email ke kustomer
                  mail($email,$subjek,$pesan,$dari);

                  // Kirim email ke pengelola toko online
                  mail("$j2[email_pengelola]",$subjek,$pesan,$dari);

                  echo "<tr><td colspan=5 align=right>Total : Rp. </td><td align=right><b>$total_rp</b></td></tr>
                        <tr><td colspan=5 align=right>Ongkos Kirim untuk Tujuan Kota Anda: Rp. </td><td align=right><b>$ongkoskirim1_rp</b>/Kg</td></tr>      
                        <tr><td colspan=5 align=right>Total Berat : </td><td align=right><b>$totalberat Kg</b></td></tr>
                        <tr><td colspan=5 align=right>Total Ongkos Kirim : Rp. </td><td align=right><b>$ongkoskirim_rp</b></td></tr>      
                        <tr><td colspan=5 align=right>Grand Total : Rp. </td><td align=right><b>$grandtotal_rp</b></td></tr>
                        </table>";
                  echo "<hr /><p>
                   <div style='color:black;border:1px solid lightblue;padding:10px;background:lightblue;'>
                    No Order anda adalah : <b>$id_orders</b> , Silahkan Melakukan Pembayaran Pada Rekening dibawah ini, <br/>
                    Anda dapat melakukan Konfirmasi Pembayaran Melalui SMS Ke No : <b>08255224232</b> 
                    <br/>Dengan Format : 
                    <b>#No Orders #Nominal Transfer # Bank Tujuan # Bank Pengirim</b> Contoh : 
                    <b> # $id_orders #$grandtotal_rp #Mandiri #Jakarta </b></div> <br /> <br />
                           Apabila Anda tidak melakukan pembayaran dalam 1x24 Jam, maka transaksi dianggap batal.</p><br />    ";
              $sql  = mysql_query("SELECT * FROM modul_setting WHERE id_modul='3'");
                $r    = mysql_fetch_array($sql);
                    echo "$r[static_content]";
         
                echo "</div>
                    </div></div>";

        } //Module Profil Kustomer
          elseif ($_GET[module]=='profilKustomer') {
            $sql=mysql_query("SELECT * FROM customer INNER JOIN kota on customer.id_kota=kota.id_kota WHERE email='$_SESSION[email]'");
            $p=mysql_fetch_array($sql);
            $password=md5($p['password']);
            
          echo '<div>
          <div class="w3-row-padding w3-margin-top">';
             
            echo "<h2>Profil Saya</h2>
                <table class='w3-table'>
                <tr><td>Nama Lengkap : </td><td> $p[nama_lengkap] </td></tr>
                <tr><td>Alamat Pengiriman : </td><td> $p[alamat]</textarea></td></tr>
                <tr><td>Nomor Rekening : </td><td> $p[rekening]</td></tr>
                <tr><td>Email : </td><td>  $p[email]</td></tr>
                <tr><td>Kota : </td><td>  $p[nama_kota]</td></tr>
                <tr><td colspan=2><br/><a href='media.php?module=editProfilKustomer' class='w3-button w3-purple'>Ganti Profil</a></td></tr>
                </table>";

                echo "</div>
                    </div></br>";
          }
          
          //Module editProfilKustomer
          elseif ($_GET[module]=='editProfilKustomer') {
            if ($_GET[aksi]=='edit') {
              mysql_query("UPDATE  customer SET nama_lengkap='$_POST[nama]',
                                alamat= '$_POST[alamat]',
                                rekening= '$_POST[rekening]',
                                id_kota ='$_POST[kota]'
                            WHERE email= '$_SESSION[email]'" ) ;
                
                echo '<div style="margin-left:25%">
              <div class="w3-row-padding w3-margin-top">';

              echo "Anda Berhasil Mengedit Profil Anda <a href='media.php?module=profilKustomer'>
              Lihat Disini</a>";

              echo "</div>
                  </div></br>";
          
            }
            $sql=mysql_query("SELECT * FROM customer WHERE email='$_SESSION[email]'");
            $e=mysql_fetch_array($sql);

            echo '<div>
            <div class="w3-row-padding w3-margin-top">';
            
            echo "
            <h2>Edit Your Profil</h2>
                  <form name=form action=media.php?module=editProfilKustomer&aksi=edit method=POST onSubmit=\"return validasi(this)\">
                  <table width='90%' class='w3-table-all'>
                  <tr><td>Nama Lengkap</td><td>  <input type=text name=nama size=30 value='$e[nama_lengkap]'></td></tr>
                  <tr><td>Alamat Pengiriman</td><td> <textarea name='alamat'>$e[alamat]</textarea>
                  <br /> Alamat pengiriman harus di isi lengkap, termasuk kota/kabupaten dan kode posnya.</td></tr>
                  <tr><td>Nomor Rekening</td><td>  <input type=text name=rekening value='$e[rekening]'></td></tr>
                  <tr><td></td><td>  <input type=hidden name=email size=30 value='$e[email]'></td></tr>
                  <tr><td valign=top>Kota Tujuan</td><td>   
                  <select name='kota'>
                  <option value=0 selected>- Pilih Kota -</option>";
                  $tampil=mysql_query("SELECT * FROM kota ORDER BY nama_kota");
                  while($r=mysql_fetch_array($tampil)){
                    
                    if ($r['id_kota'] == $e['id_kota']){
                                echo "<option value=\"$r[id_kota]\" selected=\"selected\">$r[nama_kota]</option>";
                                }
                                else{
                                echo "<option value=\"$r[id_kota]\">$r[nama_kota]</option>";
                                }

                  }
                echo "</select> <br /><br />*)  Apabila tidak terdapat nama kota tujuan Anda, pilih <b>Lainnya</b>
                    <br />**) Ongkos kirim dihitung berdasarkan kota tujuan</td></tr>
                    <tr><td colspan=2><input type='submit' class='w3-button w3-khaki' value='Update Profil Saya'></td></tr>
                    </table>
                    </form>";

                  echo "</div>
                    </div></br>";

            }   // Modul riwayat transaksi
            elseif ($_GET[module]=='riwayattransaksi'){
              $currentUsr= $_SESSION[id_customer];
              
              $query_mysql = mysql_query("SELECT * FROM orders  INNER JOIN customer ON  orders.id_customer = customer.id_customer JOIN kota ON  kota.id_kota = customer.id_kota WHERE customer.id_customer = '" . $currentUsr ."' ORDER BY tgl_order DESC, jam_order DESC ");  //ASC

                while ($data = mysql_fetch_array($query_mysql)) {

            echo '<div>
            <div class="w3-row-padding w3-margin-top">';

                  echo "#<a style='text-decoration: underline;' href=?module=detailorder&id_orders=$data[id_orders]> Lihat No. Order $data[id_orders]</a><br>";

               echo "Pengiriman # $data[pengiriman]<br>";

              if ($data[status_order] == Lunas)  {
                       echo "<strong style='color:blue;'>Status Order : $data[status_order]</strong>";
                }elseif ($data[status_order] == cekbukti)  {
                        echo "<strong style='color:blue;'>Status Order : $data[status_order]</strong>";

                  }else{
                                
                    echo "<strong style='color:blue;'>Status Order : $data[status_order]</strong><br/>";
                    echo "<a href='?module=konfirmasibayar&id_orders=$data[id_orders]'> Konfirmasi</a><br/>";  
 
                    }

              echo "<strong >Tgl Order : $data[tgl_order] </strong>";
              
              echo "<strong >Jam Order : $data[jam_order] </strong>";
              
               echo "</div>
                    </div></br>";
              } //End query_msql


              } //detail_oders
                elseif ($_GET[module]=='detailorder'){
                $id_orders = $_GET['id_orders']; 

                $query_mysql = mysql_query("SELECT * FROM orders  INNER JOIN customer ON  orders.id_customer = customer.id_customer JOIN kota ON  kota.id_kota = customer.id_kota JOIN konfirmasi ON konfirmasi.id_orders=orders.id_orders WHERE orders.id_orders = '" . $id_orders ."' ORDER BY tgl_order DESC, jam_order DESC ");  //ASC

                  while ($data = mysql_fetch_array($query_mysql)) {
                              
                  echo '<div>
                  <div class="w3-row-padding w3-margin-top">';
                
                 echo "No Invoice # $data[id_orders]<br>";
                 echo "Pengiriman # $data[pengiriman]<br>";

                 
              if ($data[status_bayar] == terbayar)  {
                    echo "<strong style='color:blue;'>Status Order : $data[status_bayar] & $data[status_order]</strong><br/>";

                  }else{
                                
                    echo "<strong style='color:blue;'>Status Order : $data[status_order]</strong>";
                    echo "<a href='?module=konfirmasibayar&id_orders=$data[id_orders]'> Konfirmasi</a>";  
 
                    }
               
                echo "<strong style='color:blue;'>Tgl Order : $data[tgl_order] </strong><br/>";
                echo "<strong style='color:blue;'>Jam Order : $data[jam_order] </strong><br/>";
                echo "</div>
                    </div></br>";

              } //End query_msql 
                              
                  echo '<div>
                  <div class="w3-row-padding w3-margin-top">';

                  echo "<table style='width:100%;'>
                   <thead>
                    <tr>
                    <th>Nama Album</th>
                    <th>Berat(kg)</th>
                    <th>Jumlah</th>
                    <th>Harga Satuan</th>
                    <th>Sub Total</th>
                    </tr>
                    </thead>";

               // tampilkan rincian produk yang di order
                $sql2=mysql_query("SELECT * FROM orders_detail, album 
                                   WHERE orders_detail.id_album=album.id_album 
                                   AND orders_detail.id_orders='$_GET[id_orders]'");
                            
                            while($data_c2=mysql_fetch_array($sql2)){
                            $disc        = ($data_c2[diskon]/100)*$data_c2[harga];
                            $hargadisc   = number_format(($s[harga]-$disc),0,",","."); 
                            $subtotal    = ($data_c2[harga]-$disc) * $data_c2[jumlah];

                            $total       = $total + $subtotal;
                            $subtotal_rp = format_rupiah($subtotal);    
                            $total_rp    = format_rupiah($total);    
                            $harga       = format_rupiah($data_c2[harga]);

                            $subtotalberat = $data_c2[berat] * $data_c2[jumlah]; // total berat per item produk 
                            $totalberat  = $totalberat + $subtotalberat; // grand total berat all produk yang dibeli 

                     echo "<tr>"; 
                     echo "<td>$data_c2[nama_album]</td>";
                     echo "<td>$data_c2[berat] Kg </td>";
                     echo "<td>$data_c2[jumlah] pc </td>";
                     echo "<td>Rp. $data_c2[harga] <span  style='color:red;''> (-$data_c2[diskon] %)</span></td>";
                     echo "<td> = Rp. $subtotal_rp</td>";      
                     echo "</tr>";
                     }//End query_msql2

                     $ongkos=mysql_fetch_array(mysql_query("SELECT * FROM kota,customer,orders 
                        WHERE customer.id_kota=kota.id_kota AND orders.id_customer=customer.id_customer AND id_orders='$_GET[id_orders]'"));
                    $ongkoskirim1=$ongkos[ongkos_kirim];
                    $ongkoskirim=$ongkoskirim1 * $totalberat;

                    $grandtotal    = $total + $ongkoskirim; 

                    $ongkoskirim_rp = format_rupiah($ongkoskirim);
                    $ongkoskirim1_rp = format_rupiah($ongkoskirim1); 
                    $grandtotal_rp  = format_rupiah($grandtotal);    

                  echo "<tr><td colspan=4 align=right >Total              Rp. : </td><td align=right><b>$total_rp</b></td></tr>
                        <tr><td colspan=4 align=right >Ongkos Kirim       Rp. : </td><td align=right><b>$ongkoskirim1_rp</b>/Kg</td></tr>      
                        <tr><td colspan=4 align=right >Total Berat            : </td><td align=right><b>$totalberat</b> Kg</td></tr>      
                        <tr><td colspan=4 align=right >Total Ongkos Kirim Rp. : </td><td align=right><b>$ongkoskirim_rp</b></td></tr>      
                        <tr><td colspan=4 align=right>Grand Total        Rp. : </td><td align=right><b>$grandtotal_rp</b></td></tr>";     
                 
                    echo" </table>";                      
                               
                                 echo "</div>
                    </div></br>";


            }elseif ($_GET[module]=='simpankonfirmasi') {
              date_default_timezone_set('Asia/Jakarta');
              $tanggal = date("Y-m-d H:i:s");
              $a=$_FILES['bukti_bayar']['name'];

            mysql_query("INSERT INTO konfirmasi(id_orders,bukti_bayar,status_bayar,tanggal_bayar) VALUES('$_POST[id_orders]','$a','terbayar','$tanggal')");



             mysql_query("UPDATE orders SET status_order = 'cekbukti'
                             WHERE id_orders   = '$_POST[id_orders]'");


          

             copy($_FILES['bukti_bayar']['tmp_name'],"../buktibayar/".$a);
            echo" <script language='JavaScript'>alert('Sudah konfirmasi'); document.location='../harikamusic';
                     </script> ";     
                
                       
                       }elseif ($_GET['module']=='konfirmasibayar'){
                        $a=mysql_fetch_array(mysql_query("SELECT * FROM orders 
                        WHERE id_orders='$_GET[id_orders]'"));

                   echo '<div>
                   <div class="w3-row-padding w3-margin-top">';
                          
                         
                  echo "
                  <h2>Form Konfirmasi</h2>
                        <form action=media.php?module=simpankonfirmasi method=POST enctype='multipart/form-data'>
                        <table width='90%'>
                        <tr><td>No Order </td><td>  <input type=text name=id_orders value=$a[id_orders] size=30 readonly></td></tr>
                        <tr><td>Upload </td><td>  <input type=file name=bukti_bayar size=30></td></tr>
                        <tr><td colspan=2><input type='submit' class='button btn-primary' value='Simpan'></td></tr>
                        </table>
                        </form>";

                    echo "</div>
                        </div></br>";


            }// Modul hasil pencarian produk 
              elseif ($_GET['module']=='hasilcari'){
                // menghilangkan spasi di kiri dan kanannya
                $kata = trim($_POST['kata']);
                // mencegah XSS
                $kata = htmlentities(htmlspecialchars($kata), ENT_QUOTES);

                // pisahkan kata per kalimat lalu hitung jumlah kata
                $pisah_kata = explode(" ",$kata);
                $jml_katakan = (integer)count($pisah_kata);
                $jml_kata = $jml_katakan-1;

                $cari = "SELECT * FROM album WHERE " ;
                  for ($i=0; $i<=$jml_kata; $i++){
                    $cari .= "deskripsi LIKE '%$pisah_kata[$i]%' OR nama_album LIKE '%$pisah_kata[$i]%'";
                    if ($i < $jml_kata ){
                      $cari .= " OR ";
                    }
                  }
                $cari .= " ORDER BY id_album DESC LIMIT 7";
                $hasil  = mysql_query($cari);
                $ketemu = mysql_num_rows($hasil);
                              
                 echo '<div>
                  <div class="w3-row-padding w3-margin-top">';

                echo "<h2>Hasil Pencarian</h2>";

                if ($ketemu > 0){
                echo "<div>Ditemukan <b>$ketemu</b> album dengan kata <font style='background-color:#00FFFF'><b>$kata</b></font> : </div>";
                  while($t=mysql_fetch_array($hasil)){
                    // Tampilkan hanya sebagian isi produk
                    
    $nama_produk = htmlentities(strip_tags($t['nama_album'])); // mengabaikan tag html	
    $isi = substr($nama_produk,0,27); // ambil sebanyak 24 karakter
    $isi = substr($nama_produk,0,strrpos($isi," ")); // potong per spasi kalimat

		            echo "        
		          <div class='product_box'>
			            <h3>$isi</h3>
		            	<a href='media.php?module=detailalbum&id=$t[id_album]'><img src='foto_produk/$t[gambar]' style='width:150px;height:150px;' /></a>
		              <p class='product_price'></p>
		                <a href='media.php?module=detailalbum&id=$t[id_album]' class='detail'></a>
		            </div>";        	
		 
		    } //end foreach
		             
		    echo"                 
		          <div class='cleaner'></div>";
		        
				 }else{
				      echo "<p align=center>Tidak ditemukan</p>";
				    }
		 
		       echo "</div>";
		       echo "</div>";


}?> <!-- End Module Home -->
      



