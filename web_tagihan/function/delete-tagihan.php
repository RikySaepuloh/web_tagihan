<?php 
	require 'koneksi.php';
if (isset($_GET['delete-tagihan'])) {
	$no_tagihan=$_GET['no_tagihan'];
	mysqli_query($conn, "DELETE FROM dev_tagihan_m WHERE no_tagihan='$no_tagihan'");
	exit();
}
 ?>