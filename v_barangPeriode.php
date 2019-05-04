<?php 
include "library/controller.php";
$date = date("Y-m-d");
$statement = new oop();
$dari = $_GET['from'];
$sampai = $_GET['to'];
$merek = $statement->data_table("table_merek");
$dist = $statement->data_table("table_distributor");
$datas = $statement->between("table_barang","tanggal_masuk",$dari,$sampai);
$jumlah = count($datas);
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>PSinvent || Dashboard</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
</head>
<body>
	<div class="col-md-12">
		<div class="row">
			<h3>Data Barang <?= $dari ?> - <?= $sampai ?></h3>
			<p>Tanggal Cetak : <?= $date ?></p>
			<table class="table table-bordered table-striped" id="example">
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
						<td><?= $mereks['merek'] ?></td>
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
							<td colspan="6" class="text-center">Jumlah Barang</td>
							<td class="text-center"><?= $jumlah ?></td>
						</tr>
					</tbody>
				</table>
				<p>PT. PSinventory Indonesia - 16730</p>
		</div>
	</div>
</body>
</html>
<script>
	window.print();
</script>