<?php 
$koneksi = new mysqli("localhost","root","","shop");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Nota</title>
</head>
<body>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
</head>
<body>


	<?php include 'header.php'; ?>
	<?php include 'navbar.php'; ?>

	<?php 
	$ambil = $koneksi->query("SELECT *FROM pembelian JOIN pelanggan
		ON pembelian.id_pelanggan=pelanggan.id_pelanggan
		WHERE pembelian.id_pembelian='$_GET[id]'");
	$detail=$ambil->fetch_assoc(); 
	?>
	<div class="container">
		<div class="col-md-4">
			<h3>Pembelian</h3>
			<strong>NO.Pembelian : <?php echo $detail['id_pembelian']; ?></strong><br>
			<p>
				Tanggal : <?php echo $detail['tanggal_pembelian']; ?><br>
				Tarif : Rp.<?php echo number_format($detail['tarif']); ?>
			</p>
			<p>
				Total Pembelian : Rp.<?php echo number_format($detail['total_pembelian']); ?>
			</p>
		</div>
		<div class="col-md-4">
			<h3>Pelanggan</h3>
			<strong>Nama :<?php echo $detail['nama_pelanggan']; ?></strong><br>
			<p>
				Nomor Hp :<?php echo $detail['nomor_pelanggan']; ?><br>
				Email :<?php echo $detail['email_pelanggan']; ?>
			</p>
		</div>
		<div class="col-md-4">
			<h3>Pengiriman</h3>
			<strong><?php echo $detail['nama_kota']; ?></strong><br>
			<p>
				<?php echo $detail['ekspedisi']; ?><br>
				Alamat :<?php echo $detail['alamat']; ?><br>	
				Kode Pos :<?php echo $detail['kode_pos']; ?><br>
				Catatan :<?php echo $detail['catatan']; ?>
			</p>
		</div>
	</div>

	<div class="container">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama Produk</th>
					<th>Harga Produk</th>
					<th>Jumlah Produk</th>
					<th>Subtotal</th>
				</tr>
			</thead>
			<tbody>
				<?php $nomor=1 ; ?>
				<?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk JOIN produk ON pembelian_produk.id_produk=produk.id_produk
				WHERE pembelian_produk.id_pembelian='$_GET[id]'"); ?>
				<?php while ($pecah=$ambil->fetch_assoc()) 	{ ?>
					<tr>
						<td><?php echo $nomor; ?></td>
						<td><?php echo $pecah['nama_produk']; ?></td>
						<td><?php echo $pecah['harga_produk']; ?></td>
						<td><?php echo $pecah['jumlah']; ?></td>
						<td><?php echo $pecah['harga_produk']*$pecah['jumlah']; ?></td>
					</tr>
					<?php $nomor++; ?>
				<?php } ?>
			</tbody>
		</table>
		<div class="row">
			<div class="col-md-7">
				<div class="alert alert-info">
					<p>Silahkan bayar KeBank <?php echo $detail['bank'];?></p>
					<p><?php echo $detail['no_rek']; ?> Distilasi Shop</p>
				</div>
			</div>
		</div>
	</div>
</body>
</html>