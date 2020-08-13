<?php include '../koneksi.php'; ?>

<?php 
$ambil= $koneksi->query("SELECT *FROM produk WHERE id_produk='$_GET[id]'");
$pecah= $ambil->fetch_assoc();
 ?>
 <form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama Produk</label>
		<input type="text"  class="form-control" name="nama" value="<?php echo $pecah ['nama_produk'] ?>">
	</div>
	<div class="form-group">
		<label>Harga</label>
		<input type="text"  class="form-control" name="harga" value="<?php echo $pecah ['harga_produk'] ?>">
	</div>	
	<div class="form-group">
		<label>Berat Produk</label>
		<input type="text"  class="form-control" name="berat" value="<?php echo $pecah ['berat_produk'] ?>">
	</div>	
	<div class="form-group">
		<label>Ganti Foto</label><br>
		<img src="../foto_produk/<?php echo $pecah['foto_produk'] ?>" width="200"><br>

		<input type="file" class="form-control" name="foto">
	</div>
	<div class="form-group">
		<label>Depkripsi Produk</label>
		<input type="text"  class="form-control" name="depkrisi" value="<?php echo $pecah ['depkrisi_produk'] ?>">
	</div>		
	<button class="btn btn-primary" name="save">Simpan</button>	
</form>
<?php 
if (isset($_POST['save'])) 
{
	$namafoto=$_FILES['foto']['name'];
	$lokasifoto=$_FILES['foto']['tmp_name'];
	//jika merubah foto
	if(!empty($lokasifoto))
	{
		move_uploaded_file($lokasifoto, "../foto_produk/$namafoto");
		$koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]',
			harga_produk='$_POST[harga]',
			berat_produk='$_POST[berat]',
			foto_produk='$namafoto',
			depkrisi_produk='$_POST[depkrisi]'
			WHERE id_produk='$_GET[id]'"); 
	}
	else
	{
		$koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]',
			harga_produk='$_POST[harga]',
			berat_produk='$_POST[berat]',
			depkrisi_produk='$_POST[depkrisi]'
			WHERE id_produk='$_GET[id]'"); 
	}
	echo "<script>alert('Produk Telah Di Rubah');</script>";
echo "<script>location='index.php?halaman=produk';</script>";
}
 ?>