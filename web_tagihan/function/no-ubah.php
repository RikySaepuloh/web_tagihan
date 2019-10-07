<?php 
// belum set ubah
require 'koneksi.php';
if (isset($_POST['no-ubah'])) {
  	$nomor = $_POST['no-ubah'];
	$result = mysqli_query($conn, "SELECT dtm.no_tagihan, dtd.kode_jenis,dj.nama,dtd.nilai from dev_tagihan_m dtm inner JOIN dev_tagihan_d dtd ON dtm.no_tagihan=$nomor inner JOIN dev_jenis dj ON dtd.kode_jenis=dj.kode_jenis WHERE dtm.no_tagihan=dtd.no_tagihan");
	$lihat_tagihan = '';
	$i=1;
	while($row=mysqli_fetch_array($result)){
		$lihat_tagihan .='
		<tr class="input-row">
		<td></td>
		<td>'.$row['kode_jenis'].'<input name="kode_jenis[]" type="hidden" value="'.$row['kode_jenis'].'"></td>
		<td>'.$row['nama'].'</td>
		<td>'.$row['nilai'].'<input name="nilai[]" type="hidden" value="'.$row['nilai'].'"></td>
  			<td class="aksi">
  				<a href="javascript:void(0);" class="badge badge-primary float" id="btn_ubah_trans" data-id="'.$row['no_tagihan'].'">Ubah</a>
			<a href="javascript:void(0);" style="color:white;" class="badge badge-danger float btn_hapus_trans" data-id="'.$row['no_tagihan'].'" >Hapus</a>
			</td>
		</tr>	
		';
		$i++;
	}
	echo $lihat_tagihan;
  }
 ?>