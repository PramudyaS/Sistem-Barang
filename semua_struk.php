<?php 


$datas = $statement->data_table("table_transaksi");
$nama_kasir = $statement->data_table("table_user");


 ?>

<div class="col-md-12">
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading main-color-bg">
				<h4>Semua Transaksi</h4>
			</div>
			<div class="panel-body">
				<table class="table table-bordered table-striped" id="example">
					<thead>
						<th class="text-center">Kode Transaksi</th>
						<th class="text-center">Nama Kasir</th>
						<th class="text-center">Jumlah Beli</th>
						<th class="text-center">Total Harga</th>
						<th class="text-center">Tanggal Beli</th>
					</thead>
					<tbody>
						<?php foreach ($datas as $data): ?>
						<tr>
							<td class="text-center"><a href="?kasir=renew_transaksi&id=<?= $data['kd_transaksi'] ?>"><?= $data['kd_transaksi'] ?></a></td>
							<?php foreach ($nama_kasir as $kasir): ?>
								<?php if ($data['kd_user'] == $kasir['kd_user']): ?>
							<td class="text-center"><?= $kasir['nama_user'] ?></td>
								<?php endif ?>
							<?php endforeach ?>
							<td class="text-center"><?= $data['jumlah_beli'] ?></td>
							<td class="text-center">Rp.<?= number_format($data['total_harga']) ?>,00-</td>
							<td class="text-center"><?= $data['tanggal_beli'] ?></td>
						</tr>	
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>