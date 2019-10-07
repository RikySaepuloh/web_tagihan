<?php 

	require 'koneksi.php';
	$no_tagihan = htmlspecialchars($_POST['no_tagihan']);
	$kode_jenis = htmlspecialchars($_POST['modal-kode']);
	$nilai = htmlspecialchars($_POST["modal-nilai"]);

	if ($kode_jenis=="") {
		echo 'kode-failed';
		exit;
	}
	if ($nilai==""){
		echo 'nilai-failed';
		exit;
	}
	
	// NILAI KEMBALI DAN PENGECEKAN KODE JENIS

	$result = mysqli_query($conn, "SELECT * FROM dev_jenis");

	while ($row=mysqli_fetch_array($result)) {
		if ($row['kode_jenis']==$kode_jenis) {
			$nama_jenis=$row['nama'];
		}
	}

	$apa = '
		<td></td>
		<td>'.$kode_jenis.'<input name="kode_jenis[]" type="hidden" value="'.$kode_jenis.'"></td>
		<td>'.$nama_jenis.'</td>
		<td>'.$nilai.'<input name="nilai[]" type="hidden" value="'.$nilai.'"></td>
  			<td class="aksi">
  				<a href="javascript:void(0);" class="badge badge-primary float" id="btn_ubah_trans" data-id="'.$no_tagihan.'">Ubah</a>
			<a href="javascript:void(0);" style="color:white;" class="badge badge-danger float btn_hapus_trans" data-id="'.$no_tagihan.'" >Hapus</a>
		</td>
	';
	echo $apa;
 ?>