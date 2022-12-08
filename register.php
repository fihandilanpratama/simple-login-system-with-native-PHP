<?php 
session_start();
require 'functions.php';

// cek apakah ada session (user yg login)
if( isset($_SESSION["username"]) ) {
	header("Location: index.php");
	exit;
}

// cek apakah tombol signup sudah ditekan atau belum
if (isset($_POST['signup'])) {
   $username = $_POST['username'];
   $email = $_POST['email'];
   $password = md5($_POST['password']);
   $konfirmasi_password = md5($_POST['konfirmasi_password']);

   if ($password == $konfirmasi_password) {
       $sql = "SELECT * FROM user WHERE email='$email'";
       $result = mysqli_query($conn, $sql);
       if (!$result->num_rows > 0) {
           $sql = "INSERT INTO user (username, email, password)
                   VALUES ('$username', '$email', '$password')";
           $result = mysqli_query($conn, $sql);
           if ($result) {
               $username = "";
               $email = "";
               $_POST['password'] = "";
               $_POST['konfirmasi_password'] = "";
					$_SESSION['berhasil_regsiter'] = true;
					header("Location: login.php");
           } else {
               echo "<script>alert('Woops! Terjadi kesalahan.')</script>";
           }
       } else {
           echo "<script>alert('Woops! Email Sudah Terdaftar.')</script>";
       }
   } else {
       echo "<script>alert('Password Tidak Sesuai')</script>";
   }
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<style>
		body {
			background-image: url("img/wallpaperflare.com_wallpaper.jpg");
			background-repeat: no-repeat;
			background-attachment: fixed;
			background-size: cover;
		}
		.card {
			opacity: 0.9;
		}
	</style>
</head>
<body>
	<div class="container" style="margin-top: 45px;">
		<div class="row justify-content-center">
			<div class="col-4">
				<div class="card shadow-lg py-3" style="border-radius: 23px;">
					<div class="card-body">
						<h2 class="text-center my-2 mb-4">SIGN UP</h2>
						<form action="" method="post">

							<div class="form-floating mb-3">
								<input type="text" class="form-control" id="floatingInput" name="username" placeholder="name@example.com" required autocomplete="off">
								<label for="floatingInput">Username</label>
							</div>

                     <div class="form-floating mb-3">
								<input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com" required autocomplete="off">
								<label for="floatingInput">Email address</label>
							</div>

							<div class="form-floating mb-3">
								<input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password" required>
								<label for="floatingPassword">Password</label>
							</div>

							<div class="form-floating">
								<input type="password" class="form-control" id="floatingPassword" name="konfirmasi_password" placeholder="Confirm Password" required>
								<label for="floatingPassword">Confirm Password</label>
							</div>

							<div class="mt-4 mb-3 text-center">
								<button type="submit" name="signup" class="btn btn-info rounded-pill py-2 px-4 text-white shadow">SIGN UP</button>
							</div>

							<div class="mt-5 text-center">
								<p class="m-0 mt-5">Already have an account?</p>
								<a class="text-primary text-decoration-none" href="login.php">LOGIN</a>
							</div>
						</form>
				</div>
			</div>
		</div>
	</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>