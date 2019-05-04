<?php 
$date = date("Y-m-d");
$id = $_GET['id'];
$datas = $statement->select_field("table_pretransaksi","kd_transaksi",$id);
$sum = $statement->sum_where("sub_total","jumlah","table_pretransaksi","kd_transaksi",$id);
$nama_kasir = $statement->select_field("table_user","username",$_SESSION['username']);
$jumlah_beli = $statement->sum_where("jumlah","jumlah","table_pretransaksi","kd_transaksi",$id);
if(isset($_POST['simpan'])){
	$kd_transaksi = $_POST['kd_transaksi'];
	$total = $_POST['total'];
	$bayar = $_POST['bayar'];
	$kembali = $_POST['kembali'];
	if($total > $bayar){
		echo "<script>alert('Uang Kurang!')</script>";
	}
	elseif(empty($bayar)){
		echo "<script>alert('Bayar Terlebih Dahulu!')</script>";
	}
	elseif(empty($kd_transaksi) || empty($total)){
		echo "<script>alert('Data Harus Lengkap');</script>";
	}
	else{
	$values = "'$id','$nama_kasir[kd_user]','$jumlah_beli[jumlah]','$total','$date','$bayar','$kembali'";
	$statement->insert("table_transaksi",$values,"kasir=struck_transaksi&id=$id");
	}
}
 ?>


<form action="" method="post">
<div class="col-md-8 col-md-offset-2">
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading main-color-bg">
				<h4 class="text-center">Bayar</h4>
			</div>
			<div class="panel-body">
				<div class="col-md-12">
					<div class="form-group">
					<label for="">Kode Transaksi</label>
					<input type="text" name="kd_transaksi" value="<?= $id ?>" placeholder="" class="form-control text-center" readonly="">
					</div>
				</div>
				<div class="col-md-12">
					<label for="">Total Harga</label>
					<input type="text" name="total" id="total_harga" value="<?= $sum['jumlah'] ?>" placeholder="" class="form-control text-center" readonly="">
				</div>
				<div class="col-md-12">
					<label for="">Bayar</label>
					<input type="number" name="bayar" id="bayaran" min="1" value="" placeholder="" class="form-control text-center" required="" autocomplete="off">
				</div>
				<div class="col-md-12">
					<label for="">Kembalian</label>
					<input type="number" name="kembali" id="kembalian" value="" placeholder="" class="form-control text-center" readonly="">
					<br>
				</div>
				<div class="col-md-8">
					<button type="submit" class="btn btn-primary btn-block" name="simpan">Selesai</button>
				</div>
				<div class="col-md-4">
					<a href="?kasir=kelola_transaksi" class="btn btn-danger btn-block">Kembali</a>
				</div>
			</div>

		</div>
	</div>
</div>
</form>