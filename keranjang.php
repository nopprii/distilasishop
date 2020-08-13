<?php
session_start();
$koneksi = new mysqli("localhost","root","","shop");

?>
<?php include 'header.php'; ?>
<?php include 'navbar.php'; ?>

	<section class="konten">
		<div class="container">
			<h1>Keranjang Belanja</h1>
			<hr>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>No</th>
						<th>Produk</th>
						<th>Harga</th>
						<th>Jumlah Barang</th>
						<th>Total</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $totalbelanja=0; ?>
					<?php $nomor=1 ?>
					<?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah):  ?>
						<?php 
						$ambil = $koneksi->query("SELECT * FROM produk
							WHERE id_produk='$id_produk'");
						$pecah =$ambil->fetch_assoc();
						$total=$jumlah*$pecah['harga_produk']
						?>
						<tr>
							<td><?php echo $nomor ?></td>
							<td><?php echo $pecah["nama_produk"]; ?></td>
							<td><?php echo number_format($pecah["harga_produk"]); ?></td>
							<td><?php echo $jumlah; ?></td>
							<td><?php echo number_format($total); ?></td>
							<td><a href="hapus.php?id=<?php echo $id_produk ?>" class="btn btn-danger">Hapus</a></td>
						</tr>
						<?php $nomor++; ?>
						<?php $totalbelanja+=$total;?>
					<?php endforeach ?>			
				</tbody>
				<tfoot>
					<tr>
						<th colspan="4">Total Belanja</th>
						<th>Rp. <?php echo number_format($totalbelanja); ?></th>
					</tr>
				</tfoot>
			</table>
			<a href="index.php" class="btn btn-default">Lanjut Belanja</a>
			<a href="checkout.php" class="btn btn-primary">Checkout</a>
		</div>	
	</section>