<?php 
require 'koneksi.php';
function list_siswa(){
	global $conn;
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

function opsi_kode_jenis(){
	global $conn;
	$result = mysqli_query($conn, "SELECT * FROM dev_jenis");
	$jenis = '';
	while($row=mysqli_fetch_array($result)){
	$jenis .= '
	<option value="' .$row['kode_jenis'].'">'.$row['kode_jenis'].' - '.$row['nama'].'</option>
	';}
	echo $jenis;		
}

function registrasi($data){
	global $conn;

	$username = strtolower(stripslashes($data["username"]));
	$password = mysqli_real_escape_string($conn,$data["password"]);
	$password2 = mysqli_real_escape_string($conn,$data["password2"]);

	// cek username sudah ada atau belum
	$result = mysqli_query($conn,"SELECT username FROM dev_admin WHERE username='$username'");
	if (mysqli_fetch_assoc($result)) {
		echo "<script>
			alert('Username telah terdaftar!')
		</script>";
		return false;
	}


	// cek konfirmasi password
	if ($password !== $password2) {
		echo "<script>
			alert('Password tidak sesuai!')
		</script>";
		return false;
	}

	// enkripsi password
	$password = password_hash($password,PASSWORD_DEFAULT);
	//$password = md5($password);
	
	mysqli_query($conn, "INSERT INTO dev_admin VALUES('','$username','$password')");

	return mysqli_affected_rows($conn);
	
}

function jumlah_tagihan(){
	global $conn;
	$result = mysqli_query($conn, "SELECT * FROM dev_tagihan_m");
	$jumlah = mysqli_num_rows($result);
	echo $jumlah;
}

function jumlah_pembayaran(){
	global $conn;
	$result = mysqli_query($conn, "SELECT * FROM dev_bayar_m");
	$jumlah = mysqli_num_rows($result);
	echo $jumlah;
}

function list_tagihan(){
	global $conn;
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
}

function list_pembayaran(){
	global $conn;
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
}

function opsi_siswa(){
	global $conn;
	$result = mysqli_query($conn, "SELECT * FROM dev_siswa ORDER BY nim");
	$jurusan = '';
	while($row=mysqli_fetch_array($result)){
	$jurusan .= '
	<option value="' .$row['nim'].'">'.$row['nim'].' - '.$row['nama'].'</option>
	';}
	echo $jurusan;
}

function jumlah_siswa(){
	global $conn;
	$query = mysqli_query($conn, "SELECT * FROM dev_siswa ");
	$jumlah = mysqli_num_rows($query);
	echo $jumlah;
}

if (isset($_GET['delete'])) {
	global $conn;
	$id=$_GET['id'];
	mysqli_query($conn, "DELETE FROM dev_siswa WHERE nim='$id'");

	exit();
}



if (isset($_POST['tambah'])) {
	global $conn;
	$nim = htmlspecialchars($_POST['nim']);
	$nama = htmlspecialchars($_POST['nama']);
	$jurusan = htmlspecialchars($_POST['jurusan']);

	if ($nim=='') {
		echo 'nim-failed';
		exit;
	}
	if ($nama=='') {
		echo 'nama-failed';
		exit;
	}
	if ($jurusan=='') {
		echo 'kode-failed';
		exit;
	}

	//DISINI BELUM DIKASIH LOKASI

	$query = "INSERT INTO dev_siswa VALUES (
			'$nim',
			'',
			'$nama',
			'$jurusan'
			)";
	$hasil = mysqli_query($conn, $query);
	$savedData = '
	<tr>
			<td>'.$nim.'</td>
			<td>'.$nama.'</td>
			<td>'.$jurusan.'</td>
  			<td class="aksi">
  				<a href="javascript:void(0);" class="badge badge-primary float tampilModalUbah" data-toggle="modal" data-target="#formModal" data-role="updatelah" data-id="'.$nim.'">Ubah</a>
			<a href="javascript:void(0);" style="color:white;" class="badge badge-danger float btnHapus" data-id="'.$nim.'" >Hapus</a>
			</td>
		</tr>
	';
	echo $savedData;
}
 ?>