<?php
	session_start();
	$_SESSION["Username"] = null;
	$_SESSION["Password"] = null;
	$_SESSION["Admin"] = null;
	echo "<script>window.open('index.php','_self',null,true)</script>";
?>