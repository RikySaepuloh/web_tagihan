<?php 
	require 'koneksi.php';
if (isset($_GET['delete-pembayaran'])) {
	$no_bayar=$_GET['no_bayar'];
	mysqli_query($conn, "DELETE FROM dev_bayar_m WHERE no_bayar='$no_bayar'");
	exit();
}
 ?>