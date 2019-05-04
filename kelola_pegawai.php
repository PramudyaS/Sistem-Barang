<?php 
$judul = "Semua Data Pegawai";
$datas = $statement->data_table("table_user");
$j_admin = $statement->count_where("kd_user","jumlah","table_user","level","Admin");
$j_kasir = $statement->count_where("kd_user","jumlah","table_user","level","Kasir");
if(isset($_GET['data_admin'])){
	$judul = "Data Admin";
	$datas = $statement->select_fields("table_user","level","Admin");
}
if(isset($_GET['data_kasir'])){
	$judul = "Data Kasir";
	$datas = $statement->select_fields("table_user","level","Kasir");
}
if(isset($_GET['delete'])){
	$id = $_GET['id'];
	$statement->delete("table_user","kd_user",$id,"manager=kelola_pegawai");
}

 ?>



<div class="col-md-12">
	<div class="row">
		<div class="well well-sm" style="background-color: white">
		<a href="?manager=kelola_pegawai" class="btn btn-primary">Semua Data Pegawai</a>
		<a href="?manager=kelola_pegawai&data_admin" class="btn btn-primary">Data Admin <span class="badge"><?= $j_admin['jumlah'] ?></span></a>
		<a href="?manager=kelola_pegawai&data_kasir" class="btn btn-primary">Data Kasir <span class="badge"><?= $j_kasir['jumlah'] ?></span></a>
		<a href="?manager=tambah_pegawai" class="btn btn-success">Tambah Pegawai <span class="fa fa-save"></span></a>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading main-color-bg">
				<h4><?= $judul ?></h4>
			</div>
			<div class="panel-body">
				<table class="table table-bordered" id="example">
					<thead>
						<td>Kode Pegawai</td>
						<td>Nama</td>
						<td>Username</td>
						<td>Password</td>
						<td>Level</td>
						<td class="text-center">Action</td>
					</thead>
					<tbody>
						<?php foreach ($datas as $data): ?>
						<tr>
						<td><?= $data['kd_user'] ?></td>
						<td><?= $data['nama_user'] ?></td>
						<td><?= $data['username'] ?></td>
						<td><?= $data['password'] ?></td>
						<td><?= $data['level'] ?></td>
						<td>
							<?php if ($data['level'] != "Manager"): ?>
							<div class="btn-group">
							<a href="?manager=edit_pegawai&id=<?= $data['kd_user'] ?>" class="btn btn-primary"><span class="fa fa-pencil"></span></a>
							<a href="?manager=kelola_pegawai&delete&id=<?= $data['kd_user'] ?>" class="btn btn-danger" onclick="return confirm('Apa Anda Yakin ?')"><span class="fa fa-trash"></span></a>
							</div>
							<?php endif ?>
							</div>
						</td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>