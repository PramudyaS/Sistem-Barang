<?php 
error_reporting(0);
if(isset($_POST['cari'])){
	$dari = $_POST['dari'];
	$sampai = $_POST['sampai'];
	$merek = $statement->data_table("table_merek");
	$dist = $statement->data_table("table_distributor");
	$datas = $statement->between("table_barang","tanggal_masuk",$dari,$sampai);
}

 ?>
<form action="" method="post">
<div class="col-md-12">
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading main-color-bg">
				<h4>Laporan Barang Per-Periode</h4>
			</div>
			<div class="panel-body">
				<div class="form-inline">
				<label for="">Dari</label>
				<input type="date" name="dari" value="" placeholder="" class="form-control" style="width:2s0%">
				<label for="">Sampai </label>
				<input type="date" name="sampai" value="" placeholder="" class="form-control" style="width:20%">
				<button type="submit" class="btn btn-primary" name="cari">Cari <span class="fa fa-search"></span></button>
				<?php if ($datas > 0): ?>
				<a href="v_barangPeriode.php?from=<?= $dari ?>&to=<?= $sampai ?>" target="_blank" class="btn btn-success">Print <span class="fa fa-print"></span></a>	
				<?php endif ?>
				</div>
				<hr class="main-color-bg">
				<div class="table-responsive">
				<table class="table table-bordered" id="example">
					<thead>
						<th>No</th>
						<th>Nama Barang</th>
						<th>Merek</th>
						<th>Distributor</th>
						<th class="text-center">Harga</th>
						<th class="text-center">Stok</th>
						<th>Tanggal Masuk</th>
					</thead>
					<tbody>
						<?php
						 $no = 1;
						 foreach ($datas as $data): ?>
						<tr>
						<td class="text-center"><?= $no++ ?></td>
						<td><?= $data['nama_barang'] ?></td>
						<?php foreach ($merek as $mereks): ?>
							<?php if ($data['kd_merek'] == $mereks['kd_merek']): ?>
						<td><?= $mereks['merek'] ?></td>
							<?php endif ?>
						<?php endforeach ?>
						<?php foreach ($dist as $distri): ?>
							<?php if ($data['kd_distributor'] == $distri['kd_distributor']): ?>
						<td><?= $distri['nama_distributor'] ?></td>
							<?php endif ?>
					    <?php endforeach ?>
						<td>Rp.<?= number_format($data['harga_barang']) ?>,00-</td>
						<td class="text-center"><?= $data['stok_barang'] ?></td>
						<td class="text-center"><?= $data['tanggal_masuk'] ?></td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
				</div>
			</div>
		</div>
	</div>
</div>
</form>