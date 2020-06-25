<?php
session_start();
include "library/controller.php";

$statement = new oop();
if($statement->check_session() == "true"){
	header("location:dashboard.php");
}

if(isset($_POST['login'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$level = $_POST['level'];


	$statement->login_level($username,$password,$level);
}




?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible">
	<title>Login | Sistem Barang</title>
	<link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="fa/css/font-awesome.min.css">
    <link rel="stylesheet" href="sweetalert/sweetalert.css">
    <script src="sweetalert/sweetalert.min.js"></script>
    <style>
    	#login{
    		margin-left: 40%;
    		width: 25%;
			height:40px;
    	}
    	#flogin{
    		margin-top:10%;

    	}
    </style>
</head>
<body>
	<div class="container">
		<div class="row" id="flogin">
			<div class="col-md-6 col-md-offset-3">
				<form action="" method="post">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="text-center">App Sistem IMS</h3> 
						</div>
						<div class="panel-body">
						<div class="divider"></div>
						<div class="form-group">
							<label for="">Username</label>
							<input type="text" name="username" value="" placeholder="" class="form-control" autocomplete="off">
						</div>
						<div class="form-group">
							<label for="">Password</label>
							<input type="password" name="password" value="" placeholder="" class="form-control">
						</div>
						<div class="form-group">
							<label for="">Login Sebagai :</label>
							<select name="level" id="" class="form-control" required="">
								<option value="">Pilih Level</option>
								<option value="Admin">Admin</option>
								<option value="Kasir">Kasir</option>
								<option value="Manager">Manager</option>
							</select>
						</div>
						</div>
						<div class="divider"></div>
						<div class="panel-footer">
						<button type="submit" name="login" class="btn btn-primary" id="login">Login  <i class="fa fa-sign-in"> </i></button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>	
</body>
</html>