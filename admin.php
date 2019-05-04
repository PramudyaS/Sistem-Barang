<?php 

session_start();
include "library/controller.php";

$statement = new oop();

if($statement->check_session() == "false"){
	header("location:Login.php");
}



 ?>



<h1>Ini Form Admin</h1>