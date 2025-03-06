<?php session_start(); include('Connection.php');?>
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
		if(!empty($_SESSION["Username"]))
		{
			$Username = $_SESSION["Username"];
		}
	?>
</head>

<body>
    <div class="brand" style="margin: 0 auto;">Luxshoery</div>
    <div class="address-bar" style="margin: 0 auto;"><strong>step</strong> into style </div>

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

    <div class="container" style="width: 95%;">
    <?php 
        $sql = "
            SELECT 
                tbl_orders.OrderID AS OrderID, 
                tbl_orders.CustomerID AS CustomerID, 
                tbl_customers.Username AS Username,
                tbl_payments.Bank AS Bank, 
                tbl_payments.PaymentID AS PaymentID,
                tbl_products.Productname, 
                tbl_products.ProductBrand, 
                tbl_orders.Size, 
                tbl_orders.Color, 
                tbl_products.ProductPrice, 
                tbl_orders.DateOrdered 
            FROM tbl_orders 
            LEFT JOIN tbl_products ON tbl_orders.ProductID = tbl_products.ProductID 
            LEFT JOIN tbl_payments ON tbl_orders.OrderID = tbl_payments.OrderID 
            LEFT JOIN tbl_reports ON tbl_orders.OrderID = tbl_reports.OrderID 
            LEFT JOIN tbl_customers ON tbl_orders.CustomerID = tbl_customers.CustomerID
            WHERE tbl_reports.OrderID IS NULL 
            ORDER BY tbl_orders.OrderID, tbl_payments.PaymentID
        ";

        $res = mysqli_query($conn, $sql);
        $readyOrders = [];
        $pendingOrders = [];

        while ($Rows = mysqli_fetch_assoc($res)) {
            if ($Rows['Bank'] != null) {
                $readyOrders[] = $Rows;
            } else {
                $pendingOrders[] = $Rows;
            }
        }
    ?>

    <div class="row">
        <div class="box">
            <div class="col-lg-12">
                <?php if (empty($readyOrders) && empty($pendingOrders)) { ?>
                    <hr>
                    <h2 class="intro-text text-center" style="font-weight: bold;">No orders yet</h2>
                    <hr>
                    <div class="table-responsive">
                        <table border="5px" class="table">
                            <tr style="text-align: center; color: black; font-weight: bold;">
                                <td>Order ID</td>
                                <td>Customer ID</td>
                                <td>Product Name</td>
                                <td>Product Brand</td>
                                <td>Product Size</td>
                                <td>Product Color</td>
                                <td>Product Price</td>
                                <td>Bank</td>
                                <td>Date Ordered</td>
                                <td>Send</td>
                                <td>Action</td>
                            </tr>
                        </table>
                    </div>
                <?php } ?>

                <?php if (!empty($readyOrders)) { ?>
                    <hr>
                    <h2 class="intro-text text-center" style="font-weight: bold;">Ready to Send</h2>
                    <hr>
                    <div class="table-responsive">
                        <table border="5px" class="table">
                            <tr style="text-align: center; color: black; font-weight: bold;">
                                <td>Order ID</td>
                                <td>Orderer</td>
                                <td>Product Name</td>
                                <td>Product Brand</td>
                                <td>Product Size</td>
                                <td>Product Color</td>
                                <td>Product Price</td>
                                <td>Bank</td>
                                <td>Date Ordered</td>
                                <td>Send</td>
                                <td>Action</td>
                            </tr>
                            <?php foreach ($readyOrders as $Rows) { ?>
                                <tr style="color: black">
                                    <td style="text-align: center;"><?php echo $Rows['OrderID']; ?></td>
                                    <td style="text-align: center;"><?php echo $Rows['Username']; ?></td>
                                    <td style="text-align: center;"><?php echo $Rows['Productname']; ?></td>
                                    <td style="text-align: center;"><?php echo $Rows['ProductBrand']; ?></td>
                                    <td style="text-align: center;"><?php echo $Rows['Size']; ?></td>
                                    <td style="text-align: center;"><?php echo $Rows['Color']; ?></td>
                                    <td style="text-align: center;"><?php echo number_format($Rows['ProductPrice']); ?></td>
                                    <td style="text-align: center; color: green;"><?php echo $Rows['Bank']; ?></td>
                                    <td style="text-align: center;"><?php echo $Rows['DateOrdered']; ?></td>
                                    <td style="text-align: center;">
                                        <a href="#" onclick="SendOrderOnclick('<?php echo $Rows['PaymentID']; ?>');">Send</a>
                                    </td>
                                    <td style="text-align: center;">
                                        <a href="#" onclick="CancelOrderOnclick(<?php echo $Rows['OrderID']; ?>);">Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                <?php } ?>

                <?php if (!empty($pendingOrders)) { ?>
                    <hr>
                    <h2 class="intro-text text-center" style="font-weight: bold;">Pending Orders</h2>
                    <hr>
                    <div class="table-responsive">
                        <table border="5px" class="table">
                            <tr style="text-align: center; color: black; font-weight: bold;">
                                <td>Order ID</td>
                                <td>Orderer</td>
                                <td>Product Name</td>
                                <td>Product Brand</td>
                                <td>Product Size</td>
                                <td>Product Color</td>
                                <td>Product Price</td>
                                <td>Bank</td>
                                <td>Date Ordered</td>
                                <td>Action</td>
                            </tr>
                            <?php foreach ($pendingOrders as $Rows) { ?>
                                <tr style="color: black">
                                    <td style="text-align: center;"><?php echo $Rows['OrderID']; ?></td>
                                    <td style="text-align: center;"><?php echo $Rows['Username']; ?></td>
                                    <td style="text-align: center;"><?php echo $Rows['Productname']; ?></td>
                                    <td style="text-align: center;"><?php echo $Rows['ProductBrand']; ?></td>
                                    <td style="text-align: center;"><?php echo $Rows['Size']; ?></td>
                                    <td style="text-align: center;"><?php echo $Rows['Color']; ?></td>
                                    <td style="text-align: center;"><?php echo number_format($Rows['ProductPrice']); ?></td>
                                    <td style="text-align: center; color: red;">Not paid</td>
                                    <td style="text-align: center;"><?php echo $Rows['DateOrdered']; ?></td>
                                    <td style="text-align: center;">
                                        <a href="#" onclick="CancelOrderOnclick(<?php echo $Rows['OrderID']; ?>);">Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

    <!-- /.container -->

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
        function SendOrderOnclick(ID) {
            if(confirm("Are you sure you need to send this item?")==true) {
                window.location.href = "ReportAction.php?id=" + ID;
			}
        }

		function CancelOrderOnclick(ID)
		{
			if (confirm("Are you sure you want to Delete this order?")) {
                window.location.href = "Management_Orders_Action.php?id=" + ID;
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