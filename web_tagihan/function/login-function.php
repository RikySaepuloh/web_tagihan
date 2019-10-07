<?php 
	require 'koneksi.php';
	// Cek cookie apakah sudah terisi
	if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
		$id=$_COOKIE['id'];
		$key=$_COOKIE['key'];
		// ambil username berdasarkan id
		$result = mysqli_query($conn, "SELECT username FROM dev_admin WHERE id=$id");
		$row = mysqli_fetch_assoc($result);
		//cek cookie dan username
		if ($key === hash('sha256', $row['username'])) {
			$_SESSION['login'] = true;
		}
	}

	// Cek Session login sudah terisi atau belum
	if (isset($_SESSION["login"])) {
		header("Location:index.php");
		exit;
	}

	if (isset($_POST["login"])) {
		$username = $_POST["username"];
		$password = $_POST["password"];
		$result = mysqli_query($conn, "SELECT * FROM dev_admin WHERE username='$username'" );

		if (mysqli_num_rows($result) === 1) {
			
			// cek password
			$row = mysqli_fetch_assoc($result);
			if (password_verify($password, $row["password"])) { 
				
				//set session
				$_SESSION["login"]=true;
				//set session lokasi juga
				// cek remember me
				if (isset($_POST['remember'])) {
					//buat cookie
					setcookie('id',$row['id'],time()+60);
					setcookie('key',hash('sha256',	$row['username']), time()+60);
				}
				header("Location: index.php");
				exit;
			}
		}
		$error = true;
	}

	
 ?>