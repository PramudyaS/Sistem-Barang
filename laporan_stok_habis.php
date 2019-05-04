<?php 

$date = date("Y-m-d");
$datas = $statement->select_fields("table_barang","stok_barang","0");
$merek = $statement->data_table("table_merek");
$dist = $statement->data_table("table_distributor");
$jumlah = count($datas);


 ?>
 <style>
 	@media print{
 		.navbar.navbar-default{
 			display: none !important;
 		}
 		#header{
 			display: none !important;
 		}
 		.list-group{
 			display: none !important;
 		}
 		#footer{
 			display: none !important;
 		}
 		.panel.panel-default{
 			border: none !important;
 		
 		}
 		hr{
 			display: none;
 		}
 		#a{
 			display: none;
 		}
 	}
 </style>
<div class="col-md-12">
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-body">
				<h3>Laporan Barang yang Habis</h3>
				<p>Tanggal Cetak : <?= $date ?></p>
				<a href="" id="a" onclick="window.print()" class="btn btn-success">Print <span class="fa fa-print"></span></a>
				<hr>
				<table class="table table-bordered table-striped">
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
						<td><?= $data['nama_barang'] ?></td>
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
						<td class="text-center">Rp.<?= number_format($data['harga_barang']) ?>,000</td>
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
	</div>
</div>