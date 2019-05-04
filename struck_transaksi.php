<?php 

$date = date("Y-m-d");
$id = $_GET['id'];
$nama_kasir = $statement->select_field("table_user","username",$_SESSION['username']);
$datas = $statement->select_fields("table_pretransaksi","kd_transaksi",$id);
$nama_brng = $statement->data_table("table_barang");
$total = $statement->select_field("table_transaksi","kd_transaksi",$id);
 ?>
<style>
 	@media print{
 		#header{
 			display: none !important;
 		}
 		.list-group{
 			display: none !important;
 		}
 		#footer{
 			display: none !important;
 		}
 		#a{
 			display: none;
 		}
 		#garis1{
 			margin-top:20%;
 		}

 		#kasir{
 			margin-bottom:3.5%;
 			margin-right:-30%
 		}
 		#tgl{
 			margin-bottom:-5%;

 		}
 		.huru{
 			margin-top:1.5%;`
 		}
 		.panel{
 			width:50%;
 		}
 }
 </style>

<div class="col-md-8 col-md-offset-2">
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="col-md-12">
				<a href="" class="btn btn-primary" id="a" onclick="window.print()">Print <span class="fa fa-print"></span></a>
				<br>
				<p style="font-size:10px">PT. PSinventory Indonesia - 16730</p>
				<h4 class="text-center" style="margin-bottosm:-2%">Struck Pembelian</h4>
				<hr id="garis2">
				<p style="font-size:12px;margin-bottom:-3%" id="tgl">Tanggal Cetak : <?= $date ?></p>
				<div class="huru">
				<p style="font-size:12px;margin-left:70%;" id="kasir">Nama Kasir : <?= $nama_kasir['nama_user'] ?></p>
				</div>
				<hr style="margin-top:-2%" id="garis1">
				<table class="table table-bordered table-striped">
					<thead>
						<th class="text-center">Nama Barang</th>
						<th class="text-center">Harga</th>
						<th class="text-center">Jumlah</th>
						<th class="text-center">Sub-Total</th>
					</thead>
					<tbody>
						<?php foreach ($datas as $data): ?>
						<tr>
						<?php foreach ($nama_brng as $brng): ?>
							<?php if ($brng['kd_barang'] == $data['kd_barang']): ?>
						<td class="text-center"><?= $brng['nama_barang'] ?></td>
						<td class="text-center">Rp.<?= number_format($brng['harga_barang']) ?>,00-</td>
						<?php endif ?>
						<?php endforeach ?>
						<td class="text-center"><?= $data['jumlah'] ?></td>
						<td class="text-center">Rp.<?= number_format($data['sub_total']) ?>,00-</td>
						</tr>
						<?php endforeach ?>
						<tr>
							<td colspan="3" class="text-center">Grand Total</td>
							<td class="text-center">Rp.<?= number_format($total['total_harga']) ?>,00-</td>
						</tr>
						<tr>
							<td colspan="3" class="text-center">Bayar</td>
							<td class="text-center">Rp.<?= number_format($total['bayar']) ?>,00-</td>
						</tr>
						<tr>
							<td colspan="3" class="text-center">Kembalian</td>
							<?php if ($total['kembalian'] == 0): ?>
							<td class="text-center">Rp.<?= number_format($total['kembalian']) ?></td>
							<?php else: ?>
							<td class="text-center">Rp.<?= number_format($total['kembalian']) ?>,00-</td>
							<?php endif ?>
						</tr>
					</tbody>
				</table>
				<p>Tanggal Beli : <?= $total['tanggal_beli'] ?></p>
				</div>
			</div>
		</div>
	</div>
</div>