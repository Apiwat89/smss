<?php
	require 'Connection.php';
	$ID = $_GET["id"];
	$sql1 = "Delete from tbl_payments where OrderID = $ID";
	$sql2 = "Delete from tbl_orders where OrderID = $ID";
	$res1 = mysqli_query($conn,$sql1);
	$res2 = mysqli_query($conn,$sql2);
	if($res1 && $res2){
		echo '<script>window.location.href = "Management_Orders.php";</script>';
	}
?>