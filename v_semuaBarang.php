<?php
include "library/controller.php";

$statement = new oop();
$date = date("Y-m-d");
$datas = $statement->data_table("table_barang");
$merek = $statement->data_table("table_merek");
$dist = $statement->data_table("table_distributor");
$jumlah = $statement->count("kd_barang","jumlah","table_barang");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>PSinvent || Report</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="/js/jquery-3.2.1.min.js" type="text/javascript"></script>
</head>
<body>
<div class="col-md-12">
	<div class="row">
<div class="col-md-12">
	<h3>Semua Data Barang</h3>
	<p>Tanggal Pembuatan : <?= $date ?></p>
<table class="table table-bordered table-striped" style="width:100%" border="1px" cellspacing="10" cellpadding="0">
					<thead>
						<th class="text-center">No</th>
						<th class="text-center">Nama Barang</th>
						<th class="text-center">Merek</th>
						<th class="text-center">Distributor</th>
						<th class="text-center">Harga</th>
						<th class="text-center">Stok</th>
						<th class="text-center">Tanggal Masuk</th>
					</thead>
					<tbody>
						<?php
						 $no = 1;
						 foreach ($datas as $data): ?>
						<tr>
						<td class="text-center"><?= $no++ ?></td>
						<td class="text-center"><?= $data['nama_barang'] ?></td>
						<?php foreach ($merek as $mereks): ?>
							<?php if ($data['kd_merek'] == $mereks['kd_merek']): ?>
						<td class="text-center"><?= $mereks['merek'] ?></td>
							<?php endif ?>
						<?php endforeach ?>
						<?php foreach ($dist as $distri): ?>
							<?php if ($data['kd_distributor'] == $distri['kd_distributor']): ?>
						<td class="text-center"><?= $distri['nama_distributor'] ?></td>
							<?php endif ?>
					    <?php endforeach ?>
						<td class="text-center">Rp.<?= number_format($data['harga_barang']) ?>,00-</td>
						<td class="text-center"><?= $data['stok_barang'] ?></td>
						<td class="text-center"><?= $data['tanggal_masuk'] ?></td>
						</tr>
						<?php endforeach ?>
						<tr>
							<td class="text-center" colspan="6">Total Barang</td>
							<td class="text-center"><?= $jumlah['jumlah'] ?></td>
						</tr>
					</tbody>
				</table>
				<p>PT. PSinventory Indonesia - 16370</p>
</div>
</div>
</div>
</body>
</html>
<script>
	window.print();
</script>