<?php
session_start();
include "library/controller.php";
$statement = new oop();

if($statement->check_session() == "false"){
  header("location:Login.php");
}
if(isset($_GET['logout'])){
  session_unset();
  session_destroy();
  header("location:Login.php");
}
$nama_user = $statement->select_field("table_user","username",$_SESSION['username']);



  ?>   





 <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Barang | Dashboard</title>
  
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="fa/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap4.min.css">
    <style>
      #garis{
          background-color: red;
          height: 2px;

      }
    </style>

  </head>
  <body>
    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Arsen Kusuma Indonesia</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.html">Dashboard</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><?= $nama_user['nama_user'] ?></a></li>
            <li><a href="?logout">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>


    <header id="header">
      <div class="container">
        <div class="row">
         <div class="col-md-10" style="padding:2px">
            <img src="image/arsen-white.png" alt="" style="width:200px;height:60px">
          </div>
        </div>
      </div>
    </header>

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="list-group">
              <a href="#" class="list-group-item active main-color-bg">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard
              </a>
              <a href="?kasir=kelola_transaksi" class="list-group-item"><span class="fa fa-money" aria-hidden="true"></span> Kelola Transaksi <span class="badge"></span></a>
              <a href="?kasir=semua_struk" class="list-group-item"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Struk<span class="badge"></span></a>
            </div>

            
          </div>
          <div class="col-md-9">
            <!-- Isi Content -->
            <?php
            @$menu = $_GET['kasir'];
            switch ($menu) {
              case 'kelola_transaksi':
              include "kelola_transaksi.php";
              break;
              case 'tambah_pegawai':
              include "tambah_pegawai.php";
              case 'bayar_barang':
              include "bayar_transaksi.php";
              break;
              case 'struck_transaksi':
              include "struck_transaksi.php";
              break;
              case "semua_struk":
              include"semua_struk.php";
              break;
              case "renew_transaksi":
              include "renew_transaksi.php";
              break;

            }

            ?>
            
          </div>
        </div>
      </div>
    </section>

    <footer id="footer" style="margin-top: 17%">
      <p>&copy Copyright Pramudya Saputra 2018</p>
    </footer>

   
  <script>
     CKEDITOR.replace( 'editor1' );
 </script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
     <script>
     $(document).ready(function(){
    $('#example').DataTable();

    $('#jumlah').keyup(function(){
      var jumlah = $('#harga').val();
      var beli = $(this).val();
      var stok = $('#stok').val();
      var total = jumlah * beli;
      $('#total').val(total);
    });
    $('#bayaran').keyup(function(){
      var total_harga = $('#total_harga').val();
      var bayar = $(this).val();
      var kembali = bayar - total_harga;
      $('#kembalian').val(kembali);
    });
    // $('#dataModal').on('show.bs.modal',function(e){
    //   var kd_barang = $(e.relatedTarget).data('id');
    //   $.ajax({
    //     type:"post",
    //     url:"update_barang.php",
    //     data:'kd_barang='+kd_barang,
    //     success:function(data){
    //     html(data);
    //     }
    //   });
    // });
    });
  </script>
  </body>
</html>
