<?php
	session_start();
	include('Connection.php');

	$Username = $_POST['Username'];
	$Password = $_POST['Password'];
	$Firstname = $_POST['Firstname'];
	$Middlename = $_POST['Middlename'];
	$Lastname = $_POST['Lastname'];
	$Address = $_POST['Address'];
	$EmailAddress = $_POST['EmailAddress'];
	
	if(empty($Username) || empty($Password) || empty($Firstname) || empty($Middlename) || empty($Lastname) || empty($Address) || empty($EmailAddress))
	{
		echo '<script>window.alert("Cannot leave the page blank"); window.open("register.php?ActionType=Register","_self",null,true);</script>';
	}
	else
	{
		if ($_GET['ActionType'] == 'Register') {
			$sql = "INSERT INTO `tbl_customers`(`Username`,`Password`,`Role`,`Firstname`, `Middlename`, `Lastname`, `Address`, `EmailAddress`)" .
			" VALUES ('$Username','$Password','User','$Firstname','$Middlename','$Lastname','$Address','$EmailAddress')";
			$res = mysqli_query($conn,$sql);
			if(!$res) {
				echo "Failed " . mysqli_connect_error();
			} else {
				echo '<script>window.alert("Registration Completed! Please Login"); window.open("Login.php","_self",null,true);</script>'; 
			}
		} else if ($_GET['ActionType'] == "Edit") {
			$id = $_GET['ID'];
			$sql = "UPDATE `tbl_customers` SET `Username`='$Username',`Password`='$Password',`Firstname`='$Firstname'," .
			   "`Middlename`='$Middlename',`Lastname`='$Lastname',`Address`='$Address'," .
			   "`EmailAddress`='$EmailAddress' WHERE `CustomerID` = $id";
			$res = mysqli_query($conn,$sql);
			if(!$res) {
				echo "Failed " . mysqli_connect_error();
			} else {
				echo '<script>window.alert("Update Customer Completed!"); window.open("Management_Customers.php","_self",null,true);</script>'; 
			}
		}
		
	}

?>















