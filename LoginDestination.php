<?php
	session_start();
	include('Connection.php');

	$_un = $_POST['Username'];
	$_pass = $_POST['Password'];
	
	$query = "SELECT * FROM `tbl_customers` WHERE `Username` = '".$_un."' and `Password` = '".$_pass."'";
	$res = mysqli_query($conn,$query);
	$row = mysqli_fetch_array($res,MYSQLI_ASSOC);
	if($row)
		{
			if($row['Role'] == "User")
			{
			$_SESSION["Username"] = $_un;
			$_SESSION["Password"] = $_pass;
			echo "<script>window.open('index.php','_self',null,true)</script>";
			die("Logged in");
			}
			else if($row['Role'] == "Admin")
			{	$_SESSION['Admin'] = "Admin";
				$_SESSION["Username"] = $_un;
				echo "<script>window.open('Management_Orders.php','_self',null,true)</script>";
			}
		}
	else
		{
			$_SESSION['toastlogin'] = 'Username and password are incorrect.';
			header('Location: Login.php');
			exit;
		}
?>
















