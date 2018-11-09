<?php
  session_start();
  session_destroy();
  echo "<script>alert('Anda telah keluar dari Halaman Administrator'); window.location = '../harikaadmin/index.php'</script>";
?>
