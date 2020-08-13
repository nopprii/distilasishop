<?php 
session_start();
$koneksi = new mysqli("localhost","root","","shop");
?>
<?php include 'header.php'; ?>
<?php include 'navbar.php'; ?>
<section class="konten">
	<div class="container">
		<div class="d-md-flex flex-md-equal w-100 my-md-3 pl-md-3">
			<div class="bg-dark mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center text-white overflow-hidden">
				<div class="my-3 py-3"> 
					<div class="d-md-flex flex-md-equal w-100 my-md-3 pl-md-3">
						<div class="bg-dark mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center text-white overflow-hidden">

							<h1 class="display-4 font-weight-normal">Punny headline</h1>
							<p class="lead font-weight-normal">And an even wittier subheading to boot. Jumpstart your marketing efforts with this example based on Apple’s marketing pages.</p>
							<a class="btn btn-secondary" href="#">Coming soon</a>
							<div class="row">
								<?php $ambil = $koneksi->query("SELECT * FROM produk"); ?>
								<?php while ($perproduk= $ambil->fetch_assoc()) 
								{ ?>
									<div class="col-md-3">
										<div class="thumbnail">
											<img src="foto_produk/<?php echo $perproduk['foto_produk']; ?>" alt="" width="150px">
											<div class="caption">
												<h3><?php echo $perproduk['nama_produk']; ?></h3>
												<h5>Rp.<?php echo number_format($perproduk['harga_produk']); ?></h5>
												<a href="beli.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-primary">Beli</a>
												<a href="detail.php?id=<?php echo $perproduk['id_produk'] ?>" class="btn btn-info">Detail</a>
											</div>
										</div>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</section>

			<?php include 'footer.php'; ?>