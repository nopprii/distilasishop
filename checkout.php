<?php 
session_start();
$koneksi = new mysqli("localhost","root","","shop");

if (!isset($_SESSION["pelanggan"])) 
{
	echo "<script>alert('Silahkan Login Dahulu');</script>";
	echo "<script>location='login.php';</script>";
}
?>
<?php include 'header.php'; ?>
<?php include 'navbar.php'; ?>
<div class="container">
	<div class="row">
		<div class="col-md-4 order-md-2 mb-4">
			<h4 class="d-flex justify-content-between align-items-center mb-3">
				<span class="text-muted">Your cart</span>
			</h4>
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
		</div>
		<div class="col-md-8 order-md-1">
			<h4 class="mb-3">Billing address</h4>
			<form class="needs-validation" method="post">
				<div class="row">
					<div class="col-md-12 ">
						<label>Nama Pelanggan</label>
						<input class="form-control form-control-lg"  type="text" readonly value="<?php echo $_SESSION["pelanggan"]['nama_pelanggan']; ?>">
					</div>
				</div>

				<div class="mb-3">
					<label for="email">Email <span class="text-muted">(Optional)</span></label>
					<input  type="text" readonly value="<?php echo $_SESSION["pelanggan"]['email_pelanggan']; ?>" class="form-control">

				</div>

				<div class="mb-3">
					<label for="address">Nomor Pelanggan</label>
					<input type="text" readonly value="<?php echo $_SESSION["pelanggan"]['nomor_pelanggan'] ?>" class="form-control" >

				</div>

				<div class="mb-3">
					<label for="address2">Kota Tujuan  </span></label>
					<input type="text" class="form-control" name="kota" >
				</div>
				<div class="mb-3">
					<label>Kode Pos </span></label>
					<input type="text" class="form-control" name="kode_pos" >
				</div>
				<div class="mb-3">
					<label >Alamat Lengkap </span></label>
					<input type="text" class="form-control" name="alamat" >
				</div>
				<div class="row">
					<div class="col-md-5 mb-3">
						<label for="country">Ekspedisi</label>
						<select class=" custom-select d-block w-100" name="id_ongkir">
							
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
					<div class="col-md-4 mb-3">
						<label>Pembayaran</label>
						<select class=" custom-select d-block w-100" name="id_pembayaran">
							
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
					<div class="col-md-3 mb-3">
						<label >Catatan</label>
						<input type="text" class="form-control" name="catatan" placeholder="" required>

					</div>
				</div>


					<button class="btn btn-primary btn-lg btn-block" name="checkout">Continue to checkout</button>
				</form>
		<?php 
		if (isset($_POST["checkout"])) 
		{
			$id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
			$id_ongkir = $_POST["id_ongkir"];
			$tanggal_pembelian= date("Y-m-d");
			$alamat=$_POST['alamat'];
			$kota=$_POST['kota'];
			$kode_pos=$_POST['kode_pos'];
			$catatan=$_POST['catatan'];
			$ambil = $koneksi->query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
			$arrayongkir = $ambil->fetch_assoc();
			$ekspedisi=$arrayongkir['ekspedisi'];
			$tarif = $arrayongkir['tarif'];
			$id_pembayaran=$_POST['id_pembayaran'];
			$ambil1 = $koneksi->query("SELECT * FROM pembayaran WHERE id_pembayaran='$id_pembayaran'");
			$arraybayar = $ambil1->fetch_assoc();
			$bank=$arraybayar['bank'];
			$no_rek=$arraybayar['no_rek'];			

			$total_pembelian = $totalbelanja + $tarif;

			$koneksi->query("INSERT INTO pembelian(
				id_pelanggan,id_ongkir,tanggal_pembelian,
				total_pembelian,ekspedisi,tarif,alamat,nama_kota,kode_pos,catatan,id_pembayaran
				,bank,no_rek)
				VALUES ('$id_pelanggan','$id_ongkir','$tanggal_pembelian',
				'$total_pembelian','$ekspedisi','$tarif','$alamat','$kota','$kode_pos','$catatan','$id_pembayaran'
				,'$bank','$no_rek')");
			$id_pembelian_barusan=$koneksi->insert_id;

			foreach ($_SESSION['keranjang'] as $id_produk => $jumlah)
			{
				$ambil-$koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
				$perproduk = $ambil->fetch_assoc();	
				$nama = $perproduk['nama_produk'];
				$harga= $perproduk['harga_produk'];
				$berat= $perproduk['berat_produk'];
				$subberat=$perproduk['berat_produk']*$jumlah;
				$subharga=$perproduk['harga_produk']*$jumlah;
				$koneksi->query("INSERT INTO pembelian_produk (id_pembelian,id_produk,jumlah,nama,harga,berat,subberat,subharga)
					VALUES ('$id_pembelian_barusan','$id_produk','$jumlah',
					'$nama','$harga','$berat','$subberat','$subharga')")	;
			}
			unset($_SESSION['keranjang']);

			echo "<script>alert('Pembelian Berhasil');</script>";
			echo "<script>location='nota.php?id=$id_pembelian_barusan';</script>";
		}
		?>
	</div>
</div>
</div>
