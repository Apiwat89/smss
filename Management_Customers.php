<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Products</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/business-casual.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
	<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<?php
		if(empty($_SESSION['Admin'])){echo '<script>window.open("index.php","_self",null,true);</script>';}
		$Username = null;
		if (!empty($_SESSION["Username"])) {
			$Username = $_SESSION["Username"];
		}
	?>
</head>

<body>

    <div class="brand">Luxshoery</div>
    <div class="address-bar"><strong>step</strong> into style </div>

    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Luxshoery</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
					<?php include('nav.php'); ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
					<div class="table-responsive">
						<hr>
						<h4 style="text-align:center;" style="font-weight: bold;">Customers</h4>
						<hr>
						<table border="5px" class="table">
							<tr style="text-align: center; color: Black; font-weight: bold;">
								<td>Customer ID</td>
								<td>UserName</td>
								<td>Password</td>
								<td>Firstname</td>
								<td>Middlename</td>
								<td>Lastname</td>
								<td>Address</td>
								<td>Email Address</td>
								<td>Action</td>
							</tr>
								<?php 
								require 'Connection.php';
								$sql = "select CustomerID,Username,Password,Firstname,Middlename,Lastname,Address,EmailAddress from tbl_customers where Role = 'User'";
								$Resulta = mysqli_query($conn,$sql);
								while($Rows = mysqli_fetch_array($Resulta)):; 
								?>
							<tr style="color: black">
								<td style="text-align: center;"><?php $cid = $Rows[0]; echo $cid; ?></td>
								<td style="text-align: center;"><?php echo $Rows[1]; ?></td>
								<td style="text-align: center;"><?php echo $Rows[2]; ?></td>
								<td style="text-align: center;"><?php echo $Rows[3]; ?></td>
								<td style="text-align: center;"><?php echo $Rows[4]; ?></td>
								<td style="text-align: center;"><?php echo $Rows[5]; ?></td>
								<td style="text-align: center;"><?php echo $Rows[6]; ?></td>
								<td style="text-align: center;"><?php echo $Rows[7]; ?></td>
								<td style="text-align: center;">
									<a href="#" onclick="actionOnclick('Edit',<?php echo $cid; ?>)">Edit</a> | 
									<a href="#" onclick="actionOnclick('Delete',<?php echo $cid; ?>)">Delete</a>
								</td>
								<?php endwhile; ?>
							</tr>
						</table>
					</div>
                </div>
            </div>
        </div>

    </div>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>KMUTNB &copy; Luxshoery 2023</p>
                </div>
            </div>
        </div>
    </footer>
	

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script>
		function actionOnclick(Action,CustomerID){
			if(Action == "Edit")
			{
				if(confirm("Are you sure you want to edit this information?") == true)
				{
					window.open("register.php?ActionType=Edit&ID="+CustomerID,"_self",null,true);
				}
			}
			else if(Action == "Delete")
			{
				if(confirm("Are you sure you want to Delete this information?") == true)
				{
					window.open("Management_Customers_Action.php?ID="+CustomerID,"_self",null,true);
				}
			}
		}
	</script>

</body>

</html>

<style>
	html, body {
		height: 100%;
		margin: 0;
	}

	.container {
		display: flex;
		flex-direction: column;
		min-height: 100%;
	}

	footer {
		margin-top: auto;
	}
</style>
