<?php session_start(); ?>
<?php 
$koneksi = new mysqli("localhost","root","","shop");
?>
<?php 
$id_produk=$_GET['id'];
$ambil=$koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
$detail=$ambil->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
	<title>Distilasi Shop</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>


	<!--navbar-->
	 <nav class="site-header sticky-top py-1">
  <div class="container d-flex flex-column flex-md-row justify-content-between">
    <a class="py-2" href="#" aria-label="Product">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="d-block mx-auto" role="img" viewBox="0 0 24 24" focusable="false"><title>Product</title><circle cx="12" cy="12" r="10"/><path d="M14.31 8l5.74 9.94M9.69 8h11.48M7.38 12l5.74-9.94M9.69 16L3.95 6.06M14.31 16H2.83m13.79-4l-5.74 9.94"/></svg>
    </a>
    <a class="py-2 d-none d-md-inline-block" href="#">Tour</a>
    <a class="py-2 d-none d-md-inline-block" href="#">Product</a>
    <a class="py-2 d-none d-md-inline-block" href="#">Features</a>
    <a class="py-2 d-none d-md-inline-block" href="#">Enterprise</a>
    <a class="py-2 d-none d-md-inline-block" href="#">Support</a>
    <a class="py-2 d-none d-md-inline-block" href="#">Pricing</a>
    <a class="py-2 d-none d-md-inline-block" href="#">Cart</a>
  </div>
</nav>

	<div class="konten">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<img src="foto_produk/<?php echo $detail["foto_produk"] ?>" style="width: 500px; height: 500px;"  alt="" >
				</div>
				<div class="col-sm-6">
					<h2><?php echo $detail["nama_produk"]; ?></h2>
					<h4>Rp.<?php echo number_format($detail["harga_produk"]); ?>,-</h4>
					<form method="post">
						<div class="form-group">
							<div class="input-group">
								<label>Jumlah = </label>
								<input type="number" name="jumlah" min="1" class="from-control">
								<div class="input-group-btn">
									<button class="btn btn-primary" name="beli">Beli</button>
								</div>
							</div>
						</div>
					</form>
					<?php 
					if (isset($_POST["beli"])) {
						$jumlah=$_POST["jumlah"];
						$_SESSION["keranjang"][$id_produk]= $jumlah;
						echo "<script>alert('Produk Ditambah kan Ke Keranjang');</script>";
					}
					?>
					<p><?php echo $detail["depkrisi_produk"]; ?></p>
				</div>
			</div>
		</div>
	</div>