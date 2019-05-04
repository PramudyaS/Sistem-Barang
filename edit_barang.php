<?php
$id = $_GET['id']; 
$datas = $statement->select_field("table_barang","kd_barang",$id);
$mer = $statement->data_table("table_merek");
$dist = $statement->data_table("table_distributor");
$edit = $statement->edit("table_barang","kd_barang",$id);
if(isset($_POST['update'])){
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $k_mer = $_POST['kd_merek'];
    $k_dist = $_POST['kd_dist'];
    $stok = $_POST['stok'];
    $keterangan = $_POST['keterangan'];
    $gambar = $_FILES['gambar'];
    $foto = $statement->foto($gambar);
    $values = "nama_barang='$nama',kd_merek='$k_mer',kd_distributor='$k_dist',harga_barang='$harga',stok_barang='$stok',gambar='$foto',keterangan='$keterangan'";
    if ($foto == "") {
         $value = "nama_barang='$nama',kd_merek='$k_mer',kd_distributor='$k_dist',harga_barang='$harga',stok_barang='$stok',gambar='$edit[gambar]',keterangan='$keterangan'";
         $statement->update("table_barang",$value,"kd_barang",$id,"menus=menu_barang");
    }
    else{
    $statement->update("table_barang",$values,"kd_barang",$id,"menus=menu_barang");
    }
}


 ?>


<form action="" method="post" enctype="multipart/form-data">
<div class="col-md-12">
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title">Edit Barang</div>
			</div>
			<div class="panel-body">
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Nama Barang </label>
						<input type="text" name="nama" autocomplete="off" value="<?= $datas['nama_barang'] ?>" placeholder="" class="form-control" required>
					</div>
				</div>
				<div class="col-md-4">
          <div class="form-group">
          <label>Harga Barang</label>
          <input type="text" name="harga" autocomplete="off" value="<?= $datas['harga_barang'] ?>" placeholder="" class="form-control" required>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="">Kode Merek</label>
            <select name="kd_merek" id="" class="form-control" required>
              <?php $n_merek = $statement->select_field("table_merek","kd_merek",$datas['kd_merek']); ?>
              <option value="<?= $datas['kd_merek'] ?>"><?= $n_merek['merek'] ?></option>
               <?php foreach ($mer as $merek ): ?>
                <?php if ($datas['kd_merek'] != $merek['kd_merek']): ?>
              <option value="<?= $merek['kd_merek'] ?>"><?= $merek['merek'] ?></option>
                <?php endif ?>
              <?php endforeach ?>
            </select>
          </div>
        </div>
       
        <div class="col-md-4">
        <div class="form-group">
          <label>Kode Distributor</label>
          <select name="kd_dist" id="" class="form-control" required>
            <?php $n_dist = $statement->select_field("table_distributor","kd_distributor",$datas['kd_distributor']); ?>
            <option value="<?= $datas['kd_distributor'] ?>"><?= $n_dist['nama_distributor'] ?></option>
            <?php foreach ($dist as $tri): ?>
              <?php if ($datas['kd_distributor'] != $tri['kd_distributor']): ?>
            <option value="<?= $tri['kd_distributor'] ?>"><?= $tri['nama_distributor'] ?></option>
              <?php endif ?>
              <?php endforeach ?>
          </select>
        </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="">Stok</label>
            <input type="text" name="stok" autocomplete="off" value="<?= $datas['stok_barang'] ?>" placeholder="" class="form-control" required>
          </div>
        </div>
         <div class="col-md-4">
      	<div class="form-group">
      		<label for="">Pilih Gambar</label>
        	<input type="file" name="gambar" value="aa" placeholder="" class="form-control">
      	</div>
     </div>
        <div class="col-md-12">
          <div class="form-group">
            <label for="">Keterangan</label>
            <textarea name="keterangan" autocomplete="off" id="" class="form-control" required><?= $datas['keterangan'] ?></textarea>
          </div>
        </div> 
    	<button type="submit" class="btn btn-success" style="margin-left:2%" name="update">Save Changes <span class="fa fa-save"></span></button>
    	<a href="?menus=menu_barang" class="btn btn-warning">Cancel <span class="fa fa-close"></span></a>
    </div>
			</div>
		</div>
	</div>
</div>
</form>