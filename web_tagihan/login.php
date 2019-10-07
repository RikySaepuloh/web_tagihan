<?php
session_start();
// dipanggil disini
require 'function/login-function.php';
//cek cookie

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title></title>
		<link rel="stylesheet" type="text/css" href="css/style-login.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	</head>
	<body>
		<div class="wrapper fadeInDown">
			<div id="formContent">
				
				<!-- Tabs Titles -->
				<h2 class="pt-2">Login</h2>
				<!-- Icon -->
				
				<!-- itu kenapa mbak? -->

				<!-- Login Form --> 
				<form method="post">
					<div class="form-group">
						<div class="form-row mt-3">
							<div class="form-group col">
								<label for="username">Username :</label>
								<input type="text" class="form-control" name="username" id="username">
							</div>
						</div>
						<div class="form-group">
							<div class="form-row">
								<div class="form-group col">
									<div class="form-group">
										<label for="password">Password :</label>
										<input type="password" class="form-control" name="password" id="password">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="form-row">
								<div class="form-group col">
									<input type="checkbox" name="remember" id="remember">
									<label for="remember">Remember Me!</label>
									<br>
									<button type="submit" class="btn btn-secondary" name="login">Login</button>
									<?php if (isset($error)) :?>
									<p style="color:red;">
										Username/Password Salah
									</p>
									<?php endif; ?>
								</div>
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
	</body>
</html>