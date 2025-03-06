<?php
	session_start();
	$ProductAction = $_GET["ProductAction"];
	
	require 'Connection.php';

	if($ProductAction == "Add")
	{
		$_ProductName = mysqli_real_escape_string($conn, $_POST["ProductName"]);
		$_ProductBrand = mysqli_real_escape_string($conn, $_POST["ProductBrand"]);
		$_ProductSize = mysqli_real_escape_string($conn, $_POST["ProductSize"]);
		$_ProductColor = mysqli_real_escape_string($conn, $_POST["ProductColor"]);
		$_ProductCategory = mysqli_real_escape_string($conn, $_POST["ProductCategory"]);
		$_ProductPrice = mysqli_real_escape_string($conn, $_POST["ProductPrice"]);

		if ($_FILES['ProductImage']['error'] == 0) {
			$imageTmpName = $_FILES['ProductImage']['tmp_name'];
			$imageName = $_FILES['ProductImage']['name'];
			$imageExt = pathinfo($imageName, PATHINFO_EXTENSION);

			$newImageName = uniqid() . '.' . $imageExt;
			$targetDir = "img/"; 
			$targetFilePath = $targetDir . $newImageName;

			if (move_uploaded_file($imageTmpName, $targetFilePath)) {
				$sql = "INSERT INTO `tbl_products`(`Productname`, `ProductBrand`, `ProductSize`, `ProductColor`, `ProductPrice`, `ProductCategory`, `ProductImageName`)" . 
					   "VALUES ('$_ProductName','$_ProductBrand','$_ProductSize','$_ProductColor','$_ProductPrice','$_ProductCategory','$newImageName')";
				$res = mysqli_query($conn, $sql);
				if($res) {
					echo '<script>window.open("Management_ProductsList.php","_self",null,true);</script>';
				} else {
					echo '<script>alert("FAILED!")</script>';
				}
			} else {
				echo "Sorry, there was an error uploading your file.";
			}
		} else {
			echo "No file uploaded or error occurred.";
		}
	} 
	else if($ProductAction == "Edit")
	{
		$_ProductName = $_POST["ProductName"];
		$_ProductBrand = $_POST["ProductBrand"];
		$_ProductSize = $_POST["ProductSize"];
		$_ProductColor = $_POST["ProductColor"];
		$_ProductCategory = $_POST["ProductCategory"];
		$_ProductPrice = $_POST["ProductPrice"];
	
		$_ProductID = $_GET["ProdID"];
	
		if (empty($_FILES['ProductImage']['tmp_name'])) {
			$sql = "UPDATE `tbl_products` SET `Productname`='$_ProductName',`ProductBrand`='$_ProductBrand',`ProductSize`='$_ProductSize'," .
				   "`ProductColor`='$_ProductColor',`ProductPrice`='$_ProductPrice',`ProductCategory`='$_ProductCategory' WHERE `ProductID` = $_ProductID";
		} else {
			$imageTmpName = $_FILES['ProductImage']['tmp_name'];
			$imageName = $_FILES['ProductImage']['name'];
			$imageExt = pathinfo($imageName, PATHINFO_EXTENSION);

			$newImageName = uniqid() . '.' . $imageExt;
			$targetDir = "img/"; 
			$targetFilePath = $targetDir . $newImageName;

			if (move_uploaded_file($imageTmpName, $targetFilePath)) {
				$sql = "UPDATE `tbl_products` SET `Productname`='$_ProductName',`ProductBrand`='$_ProductBrand',`ProductSize`='$_ProductSize'," .
					   "`ProductColor`='$_ProductColor',`ProductPrice`='$_ProductPrice',`ProductCategory`='$_ProductCategory'," .
					   "`ProductImageName`='$newImageName' WHERE `ProductID` = $_ProductID";
			} else {
				echo "Sorry, there was an error uploading your file.";
			}
		}
	
		$res = mysqli_query($conn, $sql);
		if ($res) {
			echo '<script>window.alert("Product has been successfully updated!"); window.open("Management_ProductsList.php","_self",null,true)</script>';
		}
	} 
	else if($ProductAction == "Delete")
	{
		$_ProductID = $_GET["ProdID"];
		$sql = "DELETE from `tbl_products` where `ProductID` = $_ProductID";
		$res = mysqli_query($conn, $sql);
		if ($res) {
			echo '<script>window.alert("Product has been successfully deleted!"); window.open("Management_ProductsList.php","_self",null,true)</script>';
		}
	}
?>