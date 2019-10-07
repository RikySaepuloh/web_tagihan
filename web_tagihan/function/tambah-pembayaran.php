<?php 
	require 'koneksi.php';	
	$nim = htmlspecialchars($_POST['nim']);
	$keterangan = htmlspecialchars($_POST["keterangan1"]);
	$tanggal = htmlspecialchars($_POST['tanggal']);

	$no_tagihan = null;
	$nilai = null;

	if (isset($_POST["no_tagihan"])) {
		$no_tagihan = $_POST["no_tagihan"];
	}
	if (isset($_POST["nilai"])) {
		$nilai = $_POST["nilai"];
	}

	if($nim==""){
	  echo 'nim-failed';
	  exit;
	}

	if (($timestamp = strtotime($tanggal)) !== false)
	{
	  $php_date = getdate($timestamp);
	  $date = date("Y/m", $timestamp); 
	}
	else
	{
	  echo 'date-failed';
	  exit;
	}



	// query insert data
	$query = "INSERT INTO dev_bayar_m VALUES (
			'',
			'',
			'$nim',
			'$tanggal',
			'$keterangan',
			'$date'
			)";
	$hasil = mysqli_query($conn, $query);
	$noba = mysqli_insert_id($conn);

	if (null !== $no_tagihan && null !== $nilai) {
		
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