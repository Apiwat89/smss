<?php
	session_start();
	include('Connection.php');

	$ProductID = $_GET['ProductID'];
	$CustomerID = $_GET['CustomerID'];
	$ProductSize = $_POST['ProductSize'];
	$ProductColor = $_POST['ProductColor'];
	$DateOrder = date("Y/m/d");

	if ($_SESSION['Username'] == null || $_SESSION['Password'] == null) {
		echo "<script>window.open('Login.php?Role=User','_self',null,true); window.alert('Please Login to Process your order');</script>";
		exit;
	}

	$sql2 = "INSERT INTO `tbl_orders`(`ProductID`, `CustomerID`,`Size`, `Color`, `DateOrdered`) ".
			"VALUES ('$ProductID','$CustomerID','$ProductSize','$ProductColor','$DateOrder')";
	$res2 = mysqli_query($conn, $sql2);

	if ($res2) {
		$_SESSION['toast_message'] = 'Order placed successfully!';
		header('Location: index.php');
		exit;
	} 
?>
