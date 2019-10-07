<?php 
	require 'koneksi.php';
	$noba = $_POST['no_bayar'];
	$nim = htmlspecialchars($_POST['nim']);
	$tanggal = htmlspecialchars($_POST['tanggal']);
	$keterangan = htmlspecialchars($_POST["keterangan1"]);

	$no_tagihan = null;
	$nilai = null;

	if (isset($_POST["no_tagihan"])) {
		$no_tagihan = $_POST["no_tagihan"];
	}
	if (isset($_POST["nilai"])) {
		$nilai = $_POST["nilai"];
	}

	if (($timestamp = strtotime($tanggal)) !== false)
	{
	  $php_date = getdate($timestamp);
	  // or if you want to output a date in year/month/day format:
	  $date = date("Y/m", $timestamp); // see the date manual page for format options      
	}
	else
	{
	  echo 'invalid timestamp!';
	}

	// query update data
	$query = "UPDATE dev_bayar_m SET
	nim='$nim',
	tanggal='$tanggal',
	keterangan='$keterangan',
	periode='$date'
	WHERE no_bayar=$noba";
	$hasil = mysqli_query($conn, $query);
	


if (null !== $no_tagihan && null !== $nilai) {
		//delete data kemudian insert kembali
		$query = "DELETE FROM dev_bayar_d WHERE no_bayar='$noba'";
		$hasil = mysqli_query($conn, $query);  	
	for ($i=0;$i<count($no_tagihan);$i++)
	  {
		$query = "INSERT INTO dev_bayar_d VALUES (
			'$noba',
			'',
			'$no_tagihan[$i]',
			'$nilai[$i]'
			)";
		$hasil = mysqli_query($conn, $query);  	
	}
}



	$result = mysqli_query($conn, "SELECT * FROM dev_bayar_m");
	$tagihan = '';
	while($row=mysqli_fetch_array($result)){
	$tagihan .='
	<tr>
			<td>'.$row['no_bayar'].'</td>
			<td>'.$row['tanggal'].'</td>
			<td>'.$row['nim'].'</td>
			<td>'.$row['keterangan'].'</td>
			<td>'.$row['periode'].'</td>
			<td class="aksi">
					<a href="javascript:void(0);" class="badge badge-primary float" id="btn_ubah_pembayaran" data-id="'.$row['no_bayar'].'">Ubah</a>
				<a href="javascript:void(0);" style="color:white;" class="badge badge-danger float btn-hapus-pembayaran" data-id="'.$row['no_bayar'].'" >Hapus</a>
			</td>
		</tr>
	';
	}	
	echo $tagihan;
 ?>