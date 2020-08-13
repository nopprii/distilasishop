<?php 
session_start();
$koneksi = new mysqli("localhost","root","","shop");

 if (mysqli_connect_errno()){
        echo "Koneksi database gagal : " . mysqli_connect_error();
    }
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Login</title>
 		<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">

 </head>
 <body>
 	<div class="container">
 		<div class="row">
 			<div class="col-md-4">
 				<div class="panel panel-default">
 					<div class="panel-body">
 						<h3 class="panel-title">Login Pelanggan</h3>
 					</div>
 					<div class="panel-body">
 						<form method="post">
 							<div class="form-group">
 								<label>Email</label>
 								<input type="text" name="email" class="form-control">
 							</div>
 							<div class="form-group">
 								<label>Password</label>
 								<input type="password" name="password" class="form-control">
 							</div>
 							<button class="btn btn-primary" name="login">Login</button>
 							<div>
 								<h5>Belum Punya Akun?</h5>
 							<a href="daftar_member.php" class="btn btn-info">Daftar</a>
 							</div>
 						</form>
 					</div>
 				</div>
 			</div>
 		</div>
 	</div>
 	<?php 
		if (isset($_POST["login"])) 
		{
			$email=$_POST["email"];
			$password=$_POST["password"];
			$ambil=$koneksi->query("SELECT * FROM  `pelanggan`
				WHERE email_pelanggan='$email' AND password_pelanggan='$password'");
			$akunyangcocok = $ambil->num_rows;
			if ($akunyangcocok==1) 
			{
				$akun=$ambil->fetch_assoc();
				$_SESSION["pelanggan"] = $akun;
				echo "<script>alert('Anda Berhasil');</script>";
				echo "<script>location='checkout.php';</script>";
			}
			else
			{
				echo "<script>alert('Anda Gagal Login, Periksa Kembali Akun Anda');</script>";
				echo "<script>location='login.php';</script>";
			}
		}
 	 ?>
 </body>
 </html>

