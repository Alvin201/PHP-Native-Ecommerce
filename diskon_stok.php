<?php
    // diskon  
    $harga     = format_rupiah($r[harga]);
    $disc      = ($r[diskon]/100)*$r[harga];
    $hargadisc = number_format(($r[harga]-$disc),0,",",".");

    $d=$r['diskon'];
    $hargatetap  = "<span class='price'>
                    <span style=\"color:#ff6600;font-size:12px;\"> Rp. <b>$hargadisc,-</b></span>";
    $hargadiskon = "<span style='text-decoration:line-through;font-size:12px;' class='price'><br/>Rp. $harga <br /></span>
					<div style='text-align=center;font-size:11px;'>&nbsp;diskon $d%</div> 
                    <span style=\"color:#ff6600;font-size:14px;\"> Rp. <b>$hargadisc,-</b></span>";
    if ($d!=0){
      $divharga=$hargadiskon;
    }else{
      $divharga=$hargatetap;
    } 

    // tombol stok habis kalau stoknya 0
    $stok        = $r['stok'];
    $tombolbeli  = "<a href=\"aksi.php?module=keranjang&act=tambah&id=$r[id_album]\" class='addtocart'></a>";
    $tombolhabis = "<div class='prod_cart_habis'>habis</div>";
    if ($stok!=0){
      $tombol=$tombolbeli;
    }else{
      $tombol=$tombolhabis;
    } 
?>
