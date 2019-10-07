<?php
require 'function/function.php';
	if (isset($_POST["register"])) {
		
		if (registrasi($_POST) > 0) {
		echo "<script>
			alert('User baru berhasil ditambahkan')
			</script>";
			
			
}else{
echo mysqli_error($conn);
}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title></title>
		<link rel="stylesheet" type="text/css" href="css/style-login.css">
		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	</head>
	<body>
		<div class="wrapper fadeInDown">
			<div id="formContent">
				<!-- Tabs Titles -->
				<!-- Icon -->
				<div class="fadeIn first pt-2 pb-1">
					<h1>Registrasi</h1>
				</div>
				<!-- Login Form -->
				<form action="" method="post">
				<div class="form-group">
					<div class="form-row">
						<div class="form-group col">
							<label for="username">Username :</label>
							<input type="text" class="form-control" name="username" id="username">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="form-row">
						<div class="form-group col">
							<label for="password">Password :</label>
							<input type="password"  class="form-control" name="password" id="password">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="form-row">
						<div class="form-group col">
							<label for="password2">Konfirmasi Password :</label>
							<input type="password"  class="form-control" name="password2" id="password2">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="form-row">
						<div class="form-group col">
							<button type="submit" class="btn btn-secondary" name="register">Register!</button>
						</div>
					</div>
				</div>
			</form>
				<!-- Remind Passowrd -->
				<div id="formFooter">
					
					&copy; 2019<br><i style="color:#56baec;">https://bootsnipp.com/Raj78</i>
				</div>
			</div>
		</div>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
	</body>
</html>