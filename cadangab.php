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
			<form method="post">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label>Nama Pelanggan</label>
							<input class="form-control form-control-lg"  type="text" readonly value="<?php echo $_SESSION["pelanggan"]['nama_pelanggan']; ?>">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Nomor Pelanggan</label>
							<input class="form-control form-control-lg"  type="text" readonly value="<?php echo $_SESSION["pelanggan"]['nomor_pelanggan'] ?>">
						</div>
					</div>
					<div class="col-md-4">
						<label>Ekpedisi</label>
						<select class=" form-control form-control-lg" name="id_ongkir">
							
							<option value="">Pilih Jenis Ekspedisi </option>
							<?php 
							$ambil=$koneksi->query("SELECT * FROM ongkir");
							while ($perongkir=$ambil->fetch_assoc()) {
								?>
								<option value="<?php echo $perongkir["id_ongkir"] ?>"> 
									<?php echo $perongkir['ekspedisi'] ?>-
									Rp.<?php echo number_format($perongkir['tarif']) ?>
								</option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label>Kota Tujuan</label>
							<input type="text" name="kota" class="form-control">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Kode Pos</label>
							<input type="text" name="kode_pos" class="form-control">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Alamat</label>
							<input type="text" name="alamat" class="form-control">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Catatan</label>
							<input type="text" class="form-control" name="catatan">
						</div>
					</div>
					<div class="col-md-6">
						<label>Pembayaran</label>
						<select class=" form-control form-control-lg" name="id_pembayaran">
							
							<option value="">Pilih Jenis Pembayaran </option>
							<?php 
							$ambil=$koneksi->query("SELECT * FROM pembayaran");
							while ($perbayar=$ambil->fetch_assoc()) {
								?>
								<option value="<?php echo $perbayar["id_pembayaran"] ?>"> 
									<?php echo $perbayar['bank'] ?>-
									<?php echo $perbayar['no_rek'] ?>
								</option>
							<?php } ?>
						</select>
					</div>
				</div>
				<button class="btn btn-primary" name="checkout">Checkout</button>
			</div>
		</form>