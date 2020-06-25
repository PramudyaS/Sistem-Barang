<?php
date_default_timezone_set('Asia/Jakarta');
$waktu = date('Y-m-d H:i:s');
$waktu;

$mer = $statement->data_table("table_merek");
$dist = $statement->data_table("table_distributor");
$kode = $statement->autokode("table_barang","kd_barang","KDB");

if(isset($_POST['simpan'])){
	$kodebar = $_POST['kode_barang'];
	$komer = $_POST['kd_merek'];
	$kodeds = $_POST['kd_distributor'];
	$nabar = $_POST['nama_barang'];
	$habar = $_POST['harga_barang'];
	$stok = $_POST['stok'];
	$ket = $_POST['keterangan'];
	
		    $nama_file = $_FILES['image']['name'];
       	$tmp_file = $_FILES['image']['tmp_name'];
       	$ukuran_file = $_FILES['image']['size'];

       	$folder = 'image/';
       	$ektensi = ['jpg','png','jpeg'];
       	$ekstensi_gambar = explode('.',$nama_file);
       	$ekstensi_gambar = strtolower(end($ekstensi_gambar));
       	if(file_exists("image/".$nama_file)){
       		echo "<script>alert('Foto Sudah Ada/Nama File Sama')</script>";
       	}
       	else{
       		if (in_array($ekstensi_gambar,$ektensi) == true) {
       			if ($ukuran_file < 1500000) {
       				move_uploaded_file($tmp_file,$folder.$nama_file);
       				$value = "'$kodebar','$nabar','$komer','$kodeds','$waktu','$habar','$stok','$nama_file','$ket'";
					$statement->insert("table_barang",$value,"menus=menu_barang");
       			}
       			else{
       				echo "<script>alert('Ukuran Terlalu Besar')</script>";
       			}
       		}
       		else{
       			echo "<script>alert('Ekstensi Tidak Di Perbolehkan')</script>";
       		}
       	}
	
}



?>
 <form action="" method="post" enctype="multipart/form-data">
  <div class="panel panel-default">
    <div class="panel-heading main-color-bg">
        <p class="panel-title text-center">Barang Masuk</p>
    </div>

    <div class="panel-body">
      <div class="col-md-4">
      <div class="form-group">
        <label for="">Kode Barang</label>
        <input type="text" name="kode_barang" value="<?= $kode ?>" placeholder="" class="form-control" readonly="">
      </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label for="">Nama Merek</label>
          <select name="kd_merek" id="" class="form-control">
          	<option value="">Pilih Kode Merek</option>
            <?php foreach ($mer as $data): ?> 
          	<option value="<?= $data['kd_merek'] ?>"><?= $data['merek'] ?></option>
          	<?php endforeach ?>
          </select>
        </div>  
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label for="">Nama Distributor</label>
          <select name="kd_distributor" id="" class="form-control" required="">
          	<option value="">Pilih Kode Distributor</option>
            <?php foreach ($dist as $data): ?>
          	<option value="<?= $data['kd_distributor'] ?>"><?= $data['nama_distributor'] ?></option>
          	<?php endforeach ?>
          </select>
        </div>
      </div>

    <div class="col-md-12">
      <hr class="main-color-bg">
      <div class="col-md-6">
        <div class="row"> 
      <input type="text" name="nama_barang" value="" autocomplete="off" placeholder="Nama Barang" class="form-control" required="">
      </div>
      </div>

      <div class="col-md-6">
        <input type="text" name="harga_barang" autocomplete="off" value="" placeholder="Harga Barang" class="form-control" required="">
      </div>
      </div>
      <div class="col-md-12">
        <br>
        <div class="col-md-6">
        <div class="row">
          <div class="form-group">
        <input type="text" name="stok" value="" autocomplete="off" placeholder="StockBarang" class="form-control" required="">
          </div>
      </div>
      </div>
      <div class="col-md-6">
          <div class="form-group">
            <input type="file" name="image" value="" placeholder="" class="form-control" required="">
        </div>
      </div>
      </div>
      

      <div class="col-md-12">
          <div class="form-group">
            <label for="">Keterangan :</label>
            <textarea name="keterangan" autocomplete="off" class="form-control" required=""></textarea>
          </div>
          <button type="submit" class="btn btn-primary" name="simpan">Simpan <span class="fa fa-save"></span></button>
      </div>


  </div>
</form>     