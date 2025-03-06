<?php
	$Host = "localhost";
	$Username = "root";
	$Password = "";
	$Db = "shoe_store";
	
	$conn = mysqli_connect($Host,$Username,$Password,$Db);

	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	mysqli_set_charset($conn, "utf8");
?>