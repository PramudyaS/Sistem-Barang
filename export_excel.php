<?php 
$date = date("Y-m-d");
header("Content-type:application/vnd-ms-excel");
header("Content-Disposition:attachment;filename='$date'-SemuaBarang.xls");
include "v_semuaBarang.php";
 ?>