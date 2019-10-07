<?php 
	require 'koneksi.php';
  	$nim = $_POST['nim'];
	$result = mysqli_query($conn, "SELECT dtm.no_tagihan, dtm.keterangan, sum(dtd.nilai) as nilai_tagihan, dbd.nilai
from dev_tagihan_m dtm INNER JOIN dev_tagihan_d dtd ON dtm.no_tagihan=dtd.no_tagihan LEFT JOIN dev_bayar_d dbd ON dbd.no_tagihan=dtm.no_tagihan
WHERE dtm.nim=$nim GROUP BY dtm.no_tagihan");
	$lihat_tagihan = '';
	$i=1;
	while($row=mysqli_fetch_array($result)){
		$lihat_tagihan .='
		<tr class="input-row">
		<td>'.$row['no_tagihan'].'<input name="no_tagihan[]" type="hidden" value="'.$row['no_tagihan'].'"></td>
		<td>'.$row['keterangan'].'<input name="keterangan[]" type="hidden" value="'.$row['keterangan'].'"></td>
		<td>'.$row['nilai_tagihan'].'<input name="nilai_tagihan[]" type="hidden" value="'.$row['nilai_tagihan'].'"></td>

		<td>'.
		$row['nilai']
		.'<input name="nilai[]" type="hidden" value="'.
		$row['nilai']
		.'"></td>
  			<td class="aksi">
  				<a href="javascript:void(0);" class="badge badge-primary float" id="btn_ubah_bayar" data-id="'.$row['no_tagihan'].'">Bayar</a>
			
			</td>
		</tr>	
		';
		$i++;
	}
	echo $lihat_tagihan;
?>