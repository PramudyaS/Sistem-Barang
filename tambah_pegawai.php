<?php 
$kode = $statement->autokode("table_user","kd_user","USR");

if(isset($_POST['simpan'])){
	$kd_user = $_POST['kd_user'];
	$nama = $_POST['nama'];
	$username = $_POST['username'];
	$pass1 = $_POST['pass1'];
	$pass2 = $_POST['pass2'];
	$level = $_POST['level'];

	$values = "'$kd_user','$nama','$username','$pass2','$level'";
	if($pass1 != $pass2){
			echo "<script>alert('Password Berbeda !')</script>";
	}
	if(empty($kd_user) || empty($nama) || empty($username) || empty($pass1) || empty($pass2) || empty($level)){
		echo "<script>alert('Lengkapi Data !')</script>";
	}
	else{
		$statement->insert("table_user",$values,"manager=tambah_pegawai");
	}
}

 ?>
 <form action="" method="post">
<div class="col-md-12">
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading main-color-bg">
				<h4>Tambah Pegawai <span class="fa fa-user-circle"></span></h4>
			</div>
			<div class="panel-body">
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Kode User</label>
						<input type="text" name="kd_user" value="<?= $kode ?>" placeholder="" class="form-control" readonly required> 
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Nama User</label>
						<input type="text" name="nama" value="" placeholder="" class="form-control" required="" autocomplete="off">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Username</label>
						<input type="text" name="username" value="" placeholder="" class="form-control" required="" autocomplete="off">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Password</label>
						<input type="password" name="pass1" value="" placeholder="" class="form-control" autocomplete="off" required="">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Re-Type Password</label>
						<input type="password" name="pass2" value="" placeholder="" class="form-control" autocomplete="off" required="">
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					<label for="">Level</label>
					<select name="level" id="" class="form-control" required="">
						<option value="">Pilih Level</option>
						<option value="Admin">Admin</option>
						<option value="Kasir">Kasir</option>
					</select>
					</div>
				</div>
				<button type="submit" class="btn main-color-bg" name="simpan" style="margin-left:2%">Simpan <span class="fa fa-save"></span></button>
			</div>
		</div>
	</div>
</div>
</form>