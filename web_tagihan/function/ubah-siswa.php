<?php 
	require 'koneksi.php';	
if (isset($_POST['ubah'])) {
	$kode=$_POST["id"];
	$nim = htmlspecialchars($_POST["nim"]);
	$nama = htmlspecialchars($_POST["nama"]);
	$jurusan = htmlspecialchars($_POST["jurusan"]);

	// query update data
	$query = "UPDATE dev_siswa SET 
				nim='$nim',
				nama='$nama',
				kode_jur='$jurusan'
			  WHERE nim=$kode";
	mysqli_query($conn, $query);

	$sql = "SELECT ds.nim,ds.nama,ds.kode_jur FROM dev_siswa ds";
  	$result = mysqli_query($conn, $sql);
  	$dataLoop = '';
  	
  	while ($row = mysqli_fetch_array($result)) {
  	$dataLoop .='
  		<tr>
			<td>'.$row["nim"].'</td>
			<td>'.$row['nama'].'</td>
			<td>'.$row['kode_jur'].'</td>
  			<td class="aksi">
  				<a href="javascript:void(0);" class="badge badge-primary float tampilModalUbah" data-toggle="modal" data-target="#formModal" data-role="updatelah" data-id="'.$row['nim'].'">Ubah</a>
			<a href="javascript:void(0);" style="color:white;" class="badge badge-danger float btnHapus" data-id="'.$row['nim'].'" >Hapus</a>
			</td>
		</tr>
  	';
	}

  	echo $dataLoop;
  }
 ?>