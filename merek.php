<?php
$table = "table_merek";
$autokode = $statement->autokode($table,"kd_merek","KDM");

if(isset($_POST['simpan'])){
$kd_merek = $_POST['kd_merek'];
$Nama = $_POST['merek'];
$values = "'$kd_merek','$Nama'";
$statement->insert($table,$values,"merek_barang");
}

if(isset($_GET['edit'])){
  $values = $_GET['id'];
  $edit = $statement->edit("table_merek","kd_merek",$values);
  $autokode = $_GET['id'];
}
if(isset($_GET['delete'])){
  $data = $_GET['id'];
  $form = "merek_barang";
  $statement->delete("table_merek","kd_merek",$data,$form);
}
if (isset($_POST['update'])) {
  $Nama = $_POST['merek'];
  $form = "merek_barang";
  $field = "merek = '$Nama'";
  $id = $_GET['id'];
  $statement->update($table,$field,"kd_merek",$id,$form);
}

$data = $statement->data_table($table);


 ?>
 <form action="" method="post">
 <div class="col-md-12">
            
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Merek Barang</h3>
              </div>
              <div class="panel-body">
                <div class="col-md-5">
                  <div class="form-group">
                  	<label for="">Kode Merek</label>
                  	<input type="text" name="kd_merek" value="<?= $autokode ?>" placeholder="" class="form-control" readonly="" required="" autocomplete="off">
                  </div>
                </div>
                <div class="col-md-6 col-md-offset-1">	
					<div class="form-group">
                  	<label for="">Nama Merek</label>
                  	<input type="text" name="merek" autocomplete="off" value="<?= @$edit['merek'] ?>" placeholder="" class="form-control" required="">
                  </div>     
				</div>
				<div class="form-group">
          <?php if (!isset($_GET['edit'])){ ?>
            <button type="submit" name="simpan" class="btn btn-primary" style=" margin-left:2%;"  >Simpan <span class="fa fa-save"></span></button>
          <?php }else{ ?>
             <button type="submit" name="update" class="btn btn-success" style=" margin-left:2%;"  >Update <span class="fa fa-"></span></button>
             <a href="?menus=merek_barang" class="btn btn-warning">Cancel <span class="fa fa-close"></span></a>
           <?php }; ?>
					
				</div>
				<hr class="main-color-bg">	
				 <div class="col-md-12" style="margin-top:5%;">
				 	<div class="row">
                	<table id="example" class="table table-bordered" style="width:100%;" >
                		<thead>
                      <tr>
                			<th>Kode Merek</th>
                			<th>Nama Merek</th>
                      <th class="text-center">Action</th>
                      </tr>
                		</thead>
                		<tbody>
                      <?php foreach ($data as $datas): ?>
                      <tr>
                			<td><?= $datas['kd_merek'] ?></td>
                			<td><?= $datas['merek']?></td>
                      <td>
                        <a href="?menus=merek_barang&delete&id=<?= $datas['kd_merek'] ?>" class="btn btn-danger">Delete <span class="fa fa-trash"></span></a>
                        <a href="?menus=merek_barang&edit&id=<?= $datas['kd_merek'] ?>" class="btn btn-info">Edit <span class="fa fa-pencil"></span></a>
                      </td>
                			</tr>
                        <?php endforeach ?>
                		</tbody>
                  
                		
                	</table>
                	</div>
                </div>
                </form>	


</div>
</div>
