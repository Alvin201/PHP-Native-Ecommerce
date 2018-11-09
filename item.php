<?php
	$sid = $_SESSION[email];
	$sql = mysql_query("SELECT SUM(jumlah*(harga-(diskon/100)*harga)) as total,SUM(jumlah) as totaljumlah FROM orders_temp, album 
			                WHERE id_session='$sid' AND orders_temp.id_album=album.id_album");
	
    //$disc        = ($r[diskon]/100)*$r[harga];
    //$subtotal    = ($r[harga]-$disc) * $r[jumlah];
		                
	while($r=mysql_fetch_array($sql)){

  if ($r['totaljumlah'] != ""){
    $total_rp    = format_rupiah($r['total']);
    
    echo " Shopping Cart: <strong>($r[totaljumlah]) items ||  Rp. $total_rp </strong> ( <a href='media.php?module=keranjangbelanja' style='color:red;font-size:20px;'>Show Cart</a> )";
  }
  else{
   
    echo " Shopping Cart: <strong>0 items ||  Rp.0 </strong> ( <a href='media.php?module=keranjangbelanja'  style='color:red;font-size:20px;'>Show Cart</a> )";     
  }
  }
?>

