<?php 
	require 'koneksi.php';
	$no_tagihan = htmlspecialchars($_POST['modal-nota']);
	$keterangan = htmlspecialchars($_POST['modal-keterangan']);
	$nilai_tagihan = htmlspecialchars($_POST['modal-nt']);
	$nilai = htmlspecialchars($_POST["modal-nilai"]);

	// NILAI KEMBALI DAN PENGECEKAN KODE JENIS

	$apa = '
		<td>'.$no_tagihan.'<input name="no_tagihan[]" type="hidden" value="'.$no_tagihan.'"></td>
		<td>'.$keterangan.'</td>
		<td>'.$nilai_tagihan.'<input name="nilai_tagihan[]" type="hidden" value="'.$nilai_tagihan.'"></td>
		<td>'.$nilai.'<input name="nilai[]" type="hidden" value="'.$nilai.'"></td>
  			<td class="aksi">
  				<a href="javascript:void(0);" class="badge badge-primary float" id="btn_ubah_trans" data-id="'.$no_tagihan.'">Ubah</a>
		</td>
	';
	echo $apa;
 ?>