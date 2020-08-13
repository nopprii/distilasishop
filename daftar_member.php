<?php 
$koneksi = new mysqli("localhost","root","","shop");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Daftar Member</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">

</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel-default">
					<div class="panel panel-heading">
						<h3 class="panel-title"><center>Daftar Pelanggan</center></h3>
					</div>
					<div class="panel panel-body">
						<form method="post" class="form-horizontal">
							<div class="form-group">
								<label class="control-label col-md-3">Nama</label>
								<div class="col-md-7">
									<input type="text" class="form-control" name="nama">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Email</label>
								<div class="col-md-7">
									<input type="email" class="form-control" name="email">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Password</label>
								<div class="col-md-7">
									<input type="password" class="form-control" name="password">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Nomor Hp</label>
								<div class="col-md-7">
									<input type="text" class="form-control" name="hp">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-7 col-md-offset-3">
									<button class="btn btn-primary" name="daftar">Daftar</button>
								</div>
							</div>
						</form>
						<?php 
						if (isset($_POST["daftar"])) 
						{
							$nama=$_POST["nama"];
							$email=$_POST["email"];
							$password=$_POST["password"];
							$telepon=$_POST["hp"];

							$ambil = $koneksi->query("SELECT * FROM pelanggan
								WHERE email_pelanggan='$email'");
							$yangcocok=$ambil->num_rows;
							if ($yangcocok==1) {
								echo "<script>alert('email sudah digunakan'>;</script>";
								echo "<script>location='daftar_member.php';</script>";
							}
							else
								{
									$koneksi->query("INSERT INTO pelanggan
										(email_pelanggan,password_pelanggan,nama_pelanggan,nomor_pelanggan)
										VALUES('$email','$password','$nama','$telepon')");

									echo "<script>alert('Pendaftaran Berhasil'>;</script>";
									echo "<script>location='login.php';</script>";
							}
								}
						
						 ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>