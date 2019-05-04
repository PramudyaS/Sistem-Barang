<?php 
$date = date("Y-m-d");
$datas = $statement->select_fields("table_user","level","Admin");
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
 		.panel-heading{
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
			<div class="panel-heading main-color-bg">
				<h4>Data Admin</h4>
			</div>
			<div class="panel-body">
				<a href="" id="a" class="btn btn-primary" onclick="window.print()">Print Data <span class="fa fa-save"></span></a>
				<hr>
				<p>Tanggal Cetak : <?= $date ?></p>
				<table class="table table-bordered table-striped">
				<thead>
					<th class="text-center">No</th>
					<th class="text-center">Nama User</th>
					<th class="text-center">Username</th>
					<th class="text-center">Level</th>
				</thead>
				<tbody>
					<?php
					 $no = 1;
					 foreach ($datas as $key): ?>
					<tr>
					<td class="text-center"><?= $no++ ?></td>
					<td class="text-center"><?= $key['nama_user'] ?></td>
					<td class="text-center"><?= $key['username'] ?></td>
					<td class="text-center"><?= $key['level'] ?></td>
					</tr>
					<?php endforeach ?>
					<tr>
						<td colspan="3" class="text-center">Total Pegawai</td>
						<td class="text-center"><?= $jumlah ?></td>
					</tr>
				</tbody>
			</table>
			<p>PT. PSinventory Indonesia - 16730</p>
			</div>
		</div>
	</div>
</div>