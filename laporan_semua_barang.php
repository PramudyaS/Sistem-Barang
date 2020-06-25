<?php
$datas = $statement->data_table("table_barang");
$merek = $statement->data_table("table_merek");
$dist = $statement->data_table("table_distributor");

  ?>
<div class="col-md-12">
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading main-color-bg">
				<h4>Data Semua Barang Keluar</h4>
			</div>
			<div class="panel-body table-responsive">
				<a href="v_semuaBarang.php" target="_blank" class="btn btn-primary">Print Data <span class="fa fa-file-text-o"></span></a>
				<a href="export_excel.php" target="_blank" class="btn btn-success">Export Excel <span class="fa fa-file-excel-o"></span></a>
				<hr>
				<table class="table table-bordered" id="example">
					<thead>
						<th>No</th>
						<th>Nama Barang</th>
						<th>Merek</th>
						<th>Distributor</th>
						<th>Harga</th>
						<th>Jumlah</th>
						<th>Tanggal Keluar</th>
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
						<td><?= $data['harga_barang'] ?></td>
						<td><?= $data['stok_barang'] ?></td>
						<td><?= $data['tanggal_masuk'] ?></td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>