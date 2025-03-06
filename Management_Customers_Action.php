<?php

	require 'Connection.php';
	$CustomerID = $_GET["ID"];
	
	$sql = "DELETE FROM `tbl_customers` WHERE CustomerID = " . $CustomerID;
	$res = mysqli_query($conn,$sql);
	if($res)
	{
		echo '<script>window.open("Management_Customers.php","_self",null,true)</script>';
	} else {
		echo '<script>
				window.alert("Cannot be deleted because this user is currently placing an order.");
				window.open("Management_Customers.php","_self",null,true);
			</script>';
	}
?>