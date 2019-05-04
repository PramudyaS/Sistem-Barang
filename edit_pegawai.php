<?php 

$id = $_GET['id'];
$data = $statement->select_field("table_user","kd_user",$id);
$leveling = $statement->data_table("table_user");
if(isset($_POST['simpan'])){
	$kd_user = $_POST['kd_user'];
	$nama = $_POST['nama'];
	$username = $_POST['username'];
	$l_password = $_POST['l_password'];
	$n_password = $_POST['n_password'];
	$level = $_POST['level'];
	if(empty($n_password)){
	$values = "kd_user='$kd_user',nama_user='$nama',username='$username',password='$l_password'";
	$statement->update("table_user",$values,"kd_user",$id,"manager=kelola_pegawai");
	}
	else{
	$value = "kd_user='$kd_user',nama_user='$nama',username='$username',password='$n_password'";
	$statement->update("table_user",$value,"kd_user",$id,"manager=kelola_pegawai");
	}
}


 ?>

<form action="" method="post">
<div class="col-md-12">
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading main-color-bg">
				<h4>Edit Pegawai <span class="fa fa-users"></span></h4>
			</div>
			<div class="panel-body">
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Kode User</label>
						<input type="text" name="kd_user" value="<?= $data['kd_user'] ?>" placeholder="" class="form-control" readonly="" required>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Nama</label>
						<input type="text" name="nama" value="<?= $data['nama_user'] ?>" placeholder="" class="form-control" required>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Username</label>
						<input type="text" name="username" value="<?= $data['username'] ?>" placeholder="" class="form-control" required readonly>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Last Password</label>
						<input type="text" name="l_password" value="<?= $data['password'] ?>" placeholder="" class="form-control" required readonly="">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">New Password</label>
						<input type="password" name="n_password" value="" placeholder="" class="form-control">
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<select name="level" id="" class="form-control">
								<option value="<?= $data['level'] ?>"><?= $data['level'] ?></option>
								<?php foreach ($leveling as $key): ?>
									<?php if ($data['level'] != $key['level']): ?>
										<?php if ($key['level'] != "Manager"): ?>
									<option value="<?= $key['level'] ?>"><?= $key['level'] ?></option>
										<?php endif ?>
									<?php endif ?>
								<?php endforeach ?>
						</select>
					</div>
				</div>
				<button type="submit" class="btn btn-success" name="simpan" style="margin-left:2%">Save Changes <span class="fa fa-save"></span></button>
				<a href="?manager=kelola_pegawai" class="btn btn-warning">Cancel <span class="fa fa-close"></span></a>
			</div>
		</div>
	</div>
</div>
</form>