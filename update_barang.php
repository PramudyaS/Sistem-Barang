<?php 

$datas = $statement->data_table('table_barang');
$mer = $statement->data_table("table_merek");
$dist = $statement->data_table("table_distributor");


if(isset($_GET['delete'])){
  $table ="table_barang";
  $where = "kd_barang";
  $id = $_GET['id'];
  $form = "menus=menu_barang";
  $statement->delete($table,$where,$id,$form);
}


 ?>
 
<form action="" method="post">
<div class="col-md-12">
  <div class="row">
  <div class="panel panel-primary">
    <div class="panel-heading"><a href="?menus=tambah_barang" class="btn btn-success">Add Barang</a></div>
  </div>  
<div class="panel panel-default">
  <div class="panel-body">
<table id="example" class="table table-bordered">
  <thead class="main-color-bg">
    <tr>
    <th>Kode Barang</th>
    <th>Nama Barang</th>
    <th>Tanggal Masuk</th>
    <th>Harga Barang</th>
    <th>Stok Barang</th>
    <th>Keterangan</th>
    <th class="text-center">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
   foreach ($datas as $field): ?>
   <tr>
    <td><?= $field['kd_barang'] ?></td>
    <td><?= $field['nama_barang'] ?></td>
    <td><?= $field['tanggal_masuk'] ?></td>
    <td>Rp.<?= number_format($field['harga_barang']) ?>,00-</td>
    <td><?= $field['stok_barang'] ?></td>
    <td><?= $field['keterangan'] ?></td>
    <td>
      
      <a href="?menus=menu_barang&delete&id=<?= $field['kd_barang'] ?>" class="btn btn-danger" style="margin-bottom:5%;" onclick="return confirm('Anda Ingin Menghapus Data Ini?')"><span class="fa fa-trash"></span></a>
      <a href="?menus=edit_barang&id=<?= $field['kd_barang'] ?>" class="btn btn-success"><span class="fa fa-pencil"></span></a>
     <a href="#dataModal<?= $field['kd_barang'] ?>" class="btn btn-info" id="kd_barang" data-toggle="modal" data-id="<?= $field['kd_barang'] ?>"><span class="fa fa-search"></span></a>
    
    </td>
    </tr>
  </tbody>


 <div class="modal fade" id="dataModal<?= $field['kd_barang'] ?>" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b><?= $field['nama_barang'] ?></b></h4>
        </div>
        <div class="modal-body" id="detail_barang">
          <div class="table-responsive">
           <div class="col-md-4">
             <h4>Merek</h4>
             <h4>Distributor</h4>
             <h4>Tanggal Masuk</h4>
             <h4>Harga Barang</h4>
             <h4>Stok Barang</h4>
             <h4>Gambar</h4>
             <h4>Keterangan</h4>
           </div>
           <div class="col-md-1">
             <h4>:</h4>
             <h4>:</h4>
             <h4>:</h4>
             <h4>:</h4>
             <h4>:</h4>
             <h4>:</h4>
             <h4>:</h4>
           </div>
           <div class="col-md-4">
            <?php foreach ($mer as $key): ?>
              <?php if ($field['kd_merek'] == $key['kd_merek']): ?>
             <h4 id="kd_merek"><?= $key['merek'] ?></h4>
             <?php endif ?>
            <?php endforeach ?>
            <?php foreach ($dist as $key): ?>
                <?php if ($field['kd_distributor'] == $key['kd_distributor']): ?>
             <h4 id="kd_distributor"><?= $key['nama_distributor'] ?></h4>
            <?php endif ?>
            <?php endforeach ?> 
             <h4 id="tgl_masuk"><?= $field['tanggal_masuk'] ?></h4>
             <h4 id="harga">Rp.<?= number_format($field['harga_barang']) ?>,00-</h4>
             <h4 id="stok"><?= $field['stok_barang'] ?></h4>
             <h4 id="gambar"><?= $field['gambar'] ?></h4>
             <h4 id="keterangan"><?= $field['keterangan'] ?></h4>
           </div>
           <div class="col-md-3">
             <img src="image/<?= $field['gambar'] ?>" alt="" style="width:80%;margin-top:20%;height:80%">   
           </div>
          </div>
        </div>
          
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach ?>
</div>
</table>
</div>
</div>

<script type="text/javascript">
  $(document).ready(function(){
    var kd_barang = $('#data')
  });
</script>



 




