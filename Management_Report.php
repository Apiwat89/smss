<?php session_start(); include('Connection.php');?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Report</title>

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
		if(!empty($_SESSION["Username"]))
		{
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
                <a class="navbar-brand" href="index.html">Online Shoes Store</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php include('nav.php'); ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container" style="width: 92%;">
    <?php 
       $query = "
                SELECT pay.Bank, pay.Shipping, pay.DatePayment,
                    o.Size, o.Color, o.DateOrdered, o.OrderID,
                    p.Productname, p.ProductBrand,
                    c.Username,
                    r.DateReport, r.ReportID
                FROM tbl_reports AS r
                LEFT JOIN tbl_payments AS pay ON r.PaymentID = pay.PaymentID
                LEFT JOIN tbl_orders AS o ON pay.OrderID = o.OrderID
                LEFT JOIN tbl_products AS p ON o.ProductID = p.ProductID
                LEFT JOIN tbl_customers AS c ON pay.CustomerID = c.CustomerID 
                WHERE r.PaymentID IS NOT NULL
            ";
   
        $res = mysqli_query($conn,$query);
    ?>

    <div class="row">
        <div class="box">
            <div class="col-lg-12">
                <hr>
                    <h2 class="intro-text text-center" style="font-weight: bold;">Report</h2>
                <hr>
                <div class="table-responsive">
                    <table border="5px" class="table">
                        <tr style="text-align: center; color: black; font-weight: bold;">
                            <td>Report ID</td>
                            <td>Order ID</td>
                            <td>Orderer</td>
                            <td>Product Name</td>
                            <td>Product Brand</td>
                            <td>Size</td>
                            <td>Color</td>
                            <td>Bank</td>
                            <td>Shipping</td>
                            <td>DateOrdered</td>
                            <td>DatePayment</td>
                            <td>DateReport</td>
                        </tr>
                        <?php while ($Rows = mysqli_fetch_assoc($res)) { ?>
                            <tr style="color: black">
                                <td style="text-align: center;"><?php echo $Rows['ReportID']; ?></td>
                                <td style="text-align: center;"><?php echo $Rows['OrderID']; ?></td>
                                <td style="text-align: center;"><?php echo $Rows['Username']; ?></td>
                                <td style="text-align: center;"><?php echo $Rows['Productname']; ?></td>
                                <td style="text-align: center;"><?php echo $Rows['ProductBrand']; ?></td>
                                <td style="text-align: center;"><?php echo $Rows['Size']; ?></td>
                                <td style="text-align: center;"><?php echo $Rows['Color']; ?></td>
                                <td style="text-align: center;"><?php echo $Rows['Bank']; ?></td>
                                <td style="text-align: center;"><?php echo $Rows['Shipping']; ?></td>
                                <td style="text-align: center;"><?php echo $Rows['DateOrdered']; ?></td>
                                <td style="text-align: center;"><?php echo $Rows['DatePayment']; ?></td>
                                <td style="text-align: center;"><?php echo $Rows['DateReport']; ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- /.container -->

    <footer>
        <div class="footerD">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>KMUTNB &copy; Luxshoery 2023</p>
                </div>
            </div>
        </div>
    </footer>	

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>

<style>
	html, body {
		height: 100%;
		margin: 0;
        overflow-x: hidden; 
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