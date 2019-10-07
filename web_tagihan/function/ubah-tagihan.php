<?php
	require 'koneksi.php';
	if (isset($_POST['ubah-tagihan'])) {

		$nota = $_POST['no_tagihan'];
		$nim = htmlspecialchars($_POST['nim']);
		$tanggal = htmlspecialchars($_POST['tanggal']);
		$keterangan = htmlspecialchars($_POST["keterangan"]);

		$kode_jenis = null;
		$nilai = null;

		if (isset($_POST["kode_jenis"])) {
			$kode_jenis = $_POST["kode_jenis"];
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
		$query = "UPDATE dev_tagihan_m SET
		nim='$nim',
		tanggal='$tanggal',
		keterangan='$keterangan',
		periode='$date'
		WHERE no_tagihan=$nota";
		$hasil = mysqli_query($conn, $query);
		


	if (null !== $kode_jenis && null !== $nilai) {
			//delete data kemudian insert kembali
			$query = "DELETE FROM dev_tagihan_d WHERE no_tagihan='$nota'";
			$hasil = mysqli_query($conn, $query);  	
		for ($i=0;$i<count($kode_jenis);$i++)
		  {
			$query = "INSERT INTO dev_tagihan_d VALUES (
				'$nota',
				'',
				'$kode_jenis[$i]',
				'$nilai[$i]'
				)";
			$hasil = mysqli_query($conn, $query);  	
		}
	}else{
		$query = "DELETE FROM dev_tagihan_d WHERE no_tagihan='$nota'";
			$hasil = mysqli_query($conn, $query);  	
	}



		$result = mysqli_query($conn, "SELECT * FROM dev_tagihan_m");
		$tagihan = '';
		while($row=mysqli_fetch_array($result)){
		$tagihan .='
		<tr>
				<td>'.$row['no_tagihan'].'</td>
				<td>'.$row['nim'].'</td>
				<td>'.$row['tanggal'].'</td>
				<td>'.$row['keterangan'].'</td>
				<td class="aksi">
						<a href="javascript:void(0);" class="badge badge-primary float" id="btn_ubah_tagihan" data-id="'.$row['no_tagihan'].'">Ubah</a>
					<a href="javascript:void(0);" style="color:white;" class="badge badge-danger float btn-hapus-tagihan" data-id="'.$row['no_tagihan'].'" >Hapus</a>
				</td>
			</tr>
		';
		}




	echo $tagihan;
	}else{
		echo "gagal";
	}
?>