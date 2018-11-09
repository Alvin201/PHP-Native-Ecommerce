
<?php
$aksi="modul/mod_user/aksi_user.php";
switch($_GET[act]){
  // Tampil User
  default:
    echo "<h2>Data Login Admin</h2>
          <input type=button value='Tambah User' style='margin-left:1%;'
          onclick=\"window.location.href='?module=user&act=tambahuser';\">
          <table >
          <tr>
          <th>no</th>
          <th>id user</th>
          <th>username</th>
          <th>nama lengkap</th>
          <th>email</th>
          <th>level</th>
          <th>aksi</th></tr>"; 
    $tampil=mysql_query("SELECT * FROM admin ORDER BY id_user ASC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr><td>$no</td>
             <td>$r[id_user]</td>
             <td>$r[username]</td>
             <td>$r[nama_lengkap]</td>
             <td>$r[email]</td>
             <td>$r[level]</td>
             <td><a href=?module=user&act=edituser&id_user=$r[id_user]>Edit</a> | 
	               <a href=$aksi?module=user&act=hapus&id_user=$r[id_user]>Hapus</a>
             </td></tr>";
      $no++;
    }
    echo "</table>";
    break;
  
  // Form Tambah User
  case "tambahuser":
  echo '<section class="panel important">';
    echo "<h2>Tambah Login Admin</h2>
          <form method=POST action='$aksi?module=user&act=input'>
          <input type='hidden' name='id_user'>
          
          <tr><td>Username</td> : <input type=text name='username' placeholder='Username' style='height:5%;'></td></tr>
          
          <tr><td>Password</td><td> : <input type=password name='password' placeholder='Password'  style='height:5%;'></td></tr>
          
          <tr><td>Nama Lengkap</td><td> : <input type=text name='nama_lengkap' placeholder='Nama Lengkap'  style='height:5%;'></td></tr>
          
          <tr><td>Email</td><td> : <input type=text name='email' placeholder='Email'  style='height:5%;'></td></tr>
          
          <tr><td>Telpon</td><td> : <input type=text name='no_telp' placeholder='No. Telp'  style='height:5%;'></td></tr>
          <input type=hidden name='level' >
          <input type=hidden name='blokir'>
          <tr><td colspan=2><input type=submit name=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </form>";
          echo '</section>';
     break;

  
  // Form Edit User 
  case "edituser":
    $edit=mysql_query("SELECT * FROM admin WHERE id_user='$_GET[id_user]'");
    $r=mysql_fetch_array($edit);

    /*Level Pilihan*/
    if ($r[level]=='admin'){
        $pilihan_status = array('admin', 'user');
    }
    else{
        $pilihan_status = array('admin', 'user');    
    }

    $pilihan_level = '';
    foreach ($pilihan_status as $level) {
     $pilihan_level .= "<option value=$level";
     if ($level == $r[level]) {
        $pilihan_level .= " selected";
     }
     $pilihan_level .= ">$level</option>\r\n";
    }
    /*End Level Pilihan*/


    echo "<h2>Edit Login Admin</h2>
          <form method=POST action=$aksi?module=user&act=update>
          <input type=hidden name='id_user' value='$r[id_user]'>
          
          <tr><td>Username</td><td> : <input type=text name='username' value='$r[username]' readonly style='height:5%;'></td></tr>

          <tr><td>Password</td><td> : <input type=password name='password' placeholder='isi kembali password jika data diubah'style='height:5%;'></td></tr>
          
          <tr><td>Nama Lengkap</td><td> : <input type=text name='nama_lengkap'  value='$r[nama_lengkap]' placeholder='Nama Lengkap'  style='height:5%;'></td></tr>
          
          <tr><td>Email</td><td> : <input type=text name='email'  value='$r[email]' placeholder='Email'  style='height:5%;'></td></tr>
          
          <tr><td>Telpon</td><td> : <input type=text name='no_telp'  value='$r[no_telp]' placeholder='Telpon'  style='height:5%;'></td></tr>
          
          <tr><td>Level</td><td> :  
          
          <select name='level'>$pilihan_level</select> 
          </td></tr>

          <tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </form>";
    break;  
}
?>
