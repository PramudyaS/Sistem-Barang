<?php 

$kd_pre = $statement->autokode("table_pretransaksi","kd_pretransaksi","PRE");
$kd_trans = $statement->autokode("table_transaksi","kd_transaksi","TRS");
$data_brng = $statement->data_table("table_barang");
$data_keranjang = $statement->select_fields("table_pretransaksi","kd_transaksi",$kd_trans);
$sum = $statement->sum_where("sub_total","jumlah","table_pretransaksi","kd_transaksi",$kd_trans);
if(isset($_GET['beli'])){
	$id = $_GET['id'];
	$datas = $statement->select_field("table_barang","kd_barang",$id);
}
if(isset($_POST['tambah'])){
	$kd_pre = $_POST['kd_pre'];
	$kd_trans = $_POST['kd_trans'];
	$kd_barang = $_GET['id'];
	$jumlah = $_POST['jumlah'];
	$subtot = $_POST['total'];
	$stok_barang = $_POST['stok'];
	if($jumlah > $stok_barang){
		echo "<script>alert('Stok Hanya ada $stok_barang')</script>";
	}
	else{
	$sql = "SELECT * FROM table_pretransaksi WHERE kd_transaksi='$kd_trans' AND kd_barang='$kd_barang'";
	$query = mysqli_query($con,$sql);
	$row = mysqli_num_rows($query);
	$data = mysqli_fetch_assoc($query);
	if($row > 0){
		$jumlah = $data['jumlah'] + $jumlah;
		$subtot = $data['sub_total'] + $subtot;
		$value = "jumlah='$jumlah',sub_total='$subtot'";
		$statement->update_where_2("table_pretransaksi",$value,"kd_barang",$kd_barang,"kd_transaksi",$kd_trans,"kasir=kelola_transaksi");
	}
	else{
	$values = "'$kd_pre','$kd_trans','$kd_barang','$jumlah','$subtot'";
	$statement->insert("table_pretransaksi",$values,"kasir=kelola_transaksi");
		}
	}
}
if(isset($_GET['delete'])){
	$id = $_GET['id'];
	$statement->delete("table_pretransaksi","kd_pretransaksi",$id,"kasir=kelola_transaksi");
}

 ?>

<form action="" method="post">
<div class="col-md-12">
	<div class="row">
		<div class="col-md-5">
			<div class="row">
				<div class="panel panel-default">
					<div class="panel-heading main-color-bg">
						<h4 class="text-center">Transaksi <span class="fa fa-money"></span></h4>
					</div>
					<div class="panel-body">
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Kode Pre-Trans</label>
								<input type="text" name="kd_pre" value="<?= $kd_pre ?>" placeholder="" class="form-control" readonly required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Kode Transaksi</label>
								<input type="text" name="kd_trans" value="<?= $kd_trans ?>" placeholder="" class="form-control" readonly="" required>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<a href="" data-target="#myModal" data-toggle="modal" class="btn main-color-bg btn-block">Pilih Barang</a>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
							<label for="">Nama Barang</label>
							<input type="text" name="nama_barang" value="<?= @$datas['nama_barang'] ?>" placeholder="" class="form-control" readonly="" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							<label for="">Harga</label>
							<input type="text" name="harga" value="<?= @$datas['harga_barang'] ?>" placeholder="" class="form-control" id="harga" readonly="" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Stok</label>
								<input type="number" name="stok" value="<?= @$datas['stok_barang'] ?>" placeholder="" class="form-control text-center" id="stok" readonly="">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="">Jumlah Beli</label>
								<input type="number" name="jumlah" min="1" id="jumlah" value="" placeholder="" class="form-control text-center" required>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="">Total</label>
								<input type="number" name="total" id="total" value="" placeholder="" class="form-control text-center" readonly="" required>
							</div>
							<button type="submit" class="btn btn-primary btn-block" name="tambah">Tambah <span class="fa fa-plus-circle"></span></button>
						</div>	
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-md-offset-1">
			<div class="row">
				<div class="panel panel-default">
					<div class="panel-heading main-color-bg">
						<h4 class="text-center">Keranjang Pembeli <span class="fa fa-shopping-cart"></span></h4>
					</div>
					<div class="panel-body">
						<table class="table table-hover">
							<thead>
								<th>Kode Pre</th>
								<th>Nama Barang</th>
								<th>Jumlah</th>
								<th>Sub Total</th>
								<th>Action</th>
							</thead>
							<tbody>
								<?php foreach ($data_keranjang as $datas): ?>
								<tr>
									<td><?= $datas['kd_pretransaksi'] ?></td>
									<?php foreach ($data_brng as $brng): ?>
										<?php if ($brng['kd_barang'] == $datas['kd_barang']): ?>
									<td><?= $brng['nama_barang'] ?></td>
									<?php endif ?>
									<?php endforeach ?>
									<td><?= $datas['jumlah'] ?></td>
									<td>Rp.<?= number_format($datas['sub_total']) ?></td>
									<td>
										<a href="?kasir=kelola_transaksi&delete&id=<?= $datas['kd_pretransaksi'] ?>" class="btn btn-danger"><span class="fa fa-trash"></span></a>
									</td>
								</tr>
									<?php endforeach ?>
								<tr>
									<td colspan="3">Grand Total</td>
									<td>Rp.<?= number_format($sum['jumlah']) ?></td>		
								</tr>
							</tbody>
						</table>
						<hr>
						<?php if ($sum['jumlah'] > 0): ?>
						<a href="?kasir=bayar_barang&id=<?= $kd_trans ?>" class="btn btn-success btn-block">Lanjutkan Pembayaran</a>
					   <?php endif ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</form>


<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Data Barang</h4>
      </div>
      <div class="modal-body">
       <div class="table-responsive">
       	<table class="table table-hover" id="example">
       		<thead>
       			<th>Kode Barang</th>
       			<th>Nama Barang</th>
       			<th>Harga Barang</th>
       			<th>Stok</th>
       			<th class="text-center">Gambar</th>
       		</thead>
       		<tbody>
       			<?php foreach ($data_brng as $brng): ?>
       				<?php if ($brng['stok_barang'] > 0): ?>
       			<tr>
       			<td><a href="?kasir=kelola_transaksi&beli&id=<?= $brng['kd_barang'] ?>"><?= $brng['kd_barang'] ?></a></td>
       			<td><?= $brng['nama_barang'] ?></td>
       			<td>Rp.<?= number_format($brng['harga_barang']) ?>,00-</td>
       			<td><?= $brng['stok_barang'] ?></td>
       			<td><img src="image/<?= $brng['gambar'] ?>" alt="" width="100" height="100"></td>
       			</tr>
       				<?php endif ?>
       			<?php endforeach ?>
       		</tbody>
       	</table>
       </div>	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>




<script>
	// $(document).ready(function(){
	// 	$('#jumlah').keyup(function(){
	// 		var jumlah = $('#harga').val();
	// 		var beli = $(this).val();
	// 		var total = jumlah * beli;
	// 		$('#total').val(total);

	// 	});
	// });
</script>