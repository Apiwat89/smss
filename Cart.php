<?php session_start(); include('Connection.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Cart</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/business-casual.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <?php
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
                <a class="navbar-brand" href="index.php">Cart</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php include('nav.php'); ?>
                </ul>
            </div>
        </div>
    </nav>

    <?php 
        $queryC = "SELECT * FROM `tbl_customers` WHERE `Username` = '".$_SESSION["Username"]."' and `Password` = '".$_SESSION["Password"]."'";
        $resC = mysqli_query($conn,$queryC);
        $rowC = mysqli_fetch_array($resC,MYSQLI_ASSOC);
        $ID = $rowC['CustomerID'];

        $queryO = "SELECT * FROM `tbl_orders` WHERE `CustomerID` = '$ID'";
        $resO = mysqli_query($conn,$queryO);
    ?>

    <div class="container-fluid">
    <?php 
        $inspectingItems = [];
        $cartItems = [];

        while($rowOrders = mysqli_fetch_assoc($resO)) { 
            $ProductID = $rowOrders['ProductID'];
            $queryP = "SELECT * FROM `tbl_products` WHERE `ProductID` = '$ProductID'";
            $resP = mysqli_query($conn, $queryP);

            if (mysqli_num_rows($resP) > 0) {
                $rowProducts = mysqli_fetch_assoc($resP);

                $queryM = "SELECT * FROM `tbl_payments` WHERE `OrderID` = '".$rowOrders['OrderID']."'";
                $resM = mysqli_query($conn, $queryM);

                if (mysqli_num_rows($resM) > 0) {
                    while ($rowPayments = mysqli_fetch_assoc($resM)) { 
                        $queryC = "SELECT * FROM `tbl_reports` WHERE `PaymentID` = '".$rowPayments['PaymentID']."'";
                        $resC = mysqli_query($conn, $queryC);
                        $isInspecting = (mysqli_num_rows($resC) == 0);

                        $item = [
                            'product' => $rowProducts,
                            'order' => $rowOrders,
                            'payment' => $rowPayments
                        ];

                        if ($isInspecting) {
                            $inspectingItems[] = $item;
                        } 
                    }
                } else {
                    $item = [
                        'product' => $rowProducts,
                        'order' => $rowOrders
                    ]; $cartItems[] = $item;
                }
            }
        }

        if (empty($inspectingItems) && empty($cartItems)) {
            echo '<h2 class="intro-text text-center" style="font-weight: bold; padding: 200px;">Please '.
            '<a href="shop.php" style="color: #007bff; text-decoration: none;">add</a> a product</h2>';

        }
        
        if (!empty($inspectingItems)) { 
            echo '<hr><h2 class="intro-text text-center" style="font-weight: bold;">Inspecting</h2><hr>';
            foreach ($inspectingItems as $item) { ?>
                <div class="row">
                    <div class="col-lg-6">
                        <img src="img/<?php echo htmlspecialchars($item['product']['ProductImageName']); ?>" class="img-fluid" alt="Product Image">
                    </div>
                    <div class="col-lg-6">
                        <div class="product-details">
                            <h3><?php echo $item['product']['Productname'] ?></h3>
                            <p><strong>Brand:</strong> <?php echo $item['product']['ProductBrand'] ?> (<?php echo $item['product']['ProductCategory'] ?>) </p>
                            <p><strong>Size Available:</strong> <?php echo $item['order']['Size'] ?> </p>
                            <p><strong>Colors Available:</strong> <?php echo $item['order']['Color'] ?> </p>
                            <p><strong>Price:</strong> <?php echo number_format($item['product']['ProductPrice']) ?>.00</p>
                            <h3 class="Inspecting">Inspecting</h3>
                        </div>
                    </div>
                </div>
            <?php }
        }

        if (!empty($cartItems)) { 
            echo '<hr><h2 class="intro-text text-center" style="font-weight: bold;">Cart</h2><hr>';
            foreach ($cartItems as $item) { ?>
                <div class="row">
                    <div class="col-lg-6">
                        <img src="img/<?php echo htmlspecialchars($item['product']['ProductImageName']); ?>" class="img-fluid" alt="Product Image">
                    </div>
                    <div class="col-lg-6">
                        <div class="product-details">
                            <h3><?php echo $item['product']['Productname'] ?></h3>
                            <p><strong>Brand:</strong> <?php echo $item['product']['ProductBrand'] ?> (<?php echo $item['product']['ProductCategory'] ?>) </p>
                            <p><strong>Size Available:</strong> <?php echo $item['order']['Size'] ?> </p>
                            <p><strong>Colors Available:</strong> <?php echo $item['order']['Color'] ?> </p>
                            <p><strong>Price:</strong> <?php echo number_format($item['product']['ProductPrice']) ?>.00</p>
                            <button class="btn btn-primary" 
                                onclick="openPaymentModal(
                                    '<?php echo $item['order']['OrderID']; ?>', 
                                    '<?php echo $ID; ?>'
                                )">
                                Order Now
                            </button>
                        </div>
                    </div>
                </div>
        <?php }} ?>

        <?php 
            $showFinish = false;

            $queryCOM = "
                SELECT p.ProductImageName, p.Productname, p.ProductBrand, p.ProductCategory, p.ProductPrice, 
                    o.Size, o.Color, r.PaymentID
                FROM tbl_payments AS pay
                LEFT JOIN tbl_reports AS r ON pay.PaymentID = r.PaymentID
                LEFT JOIN tbl_orders AS o ON pay.OrderID = o.OrderID
                LEFT JOIN tbl_products AS p ON o.ProductID = p.ProductID
                WHERE r.PaymentID IS NOT NULL AND pay.CustomerID = '$ID'
            ";

            $resCOM = mysqli_query($conn, $queryCOM);
            
            if ($resCOM && mysqli_num_rows($resCOM) > 0) {
                while($rowPayments = mysqli_fetch_assoc($resCOM)) {
                    if (!$showFinish) { ?>
                        <hr>
                        <h2 class="intro-text text-center" style="font-weight: bold;">Shipped</h2>
                        <hr>
        <?php $showFinish = true; } ?>
            <div class="row">
                <div class="col-lg-6">
                    <img src="img/<?php echo htmlspecialchars($rowPayments['ProductImageName']); ?>" class="img-fluid" alt="Product Image">
                </div>
                <div class="col-lg-6">
                    <div class="product-details">
                        <h3><?php echo $rowPayments['Productname'] ?></h3>
                        <p><strong>Brand:</strong> <?php echo $rowPayments['ProductBrand'] ?> (<?php echo $rowPayments['ProductCategory'] ?>) </p>
                        <p><strong>Size Available:</strong> <?php echo $rowPayments['Size'] ?> </p> 
                        <p><strong>Colors Available:</strong> <?php echo $rowPayments['Color'] ?> </p> 
                        <p><strong>Price:</strong> <?php echo number_format($rowPayments['ProductPrice']) ?>.00</p>
                        
                        <h3 class="finish">The product has been shipped</h3>
                    </div>
                </div>
            </div>
        <?php }} ?>
    </div>

    <!-- Modal -->
    <div class="modal" tabindex="-1" id="paymentModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Order</h5>
                </div>
                <div class="modal-body">
                    <form  method="POST" action="paymentAction.php">
                        <div class="mb-3" style="margin-bottom: 20px;">
                            <label for="bankSelect" class="form-label">Choose a Bank</label>
                            <select name="bankSelect" class="form-select" id="bankSelect" required>
                                <option value="" disabled selected>Select Bank</option>
                                <option value="Kasikorn">Kasikorn</option>
                                <option value="SCB">SCB</option>
                                <option value="Bangkok">Bangkok</option>
                                <option value="Savings">Savings</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="shippingMethod" class="form-label">Choose Shipping Method</label>
                            <select name="shippingMethod" class="form-select" id="shippingMethod" required>
                                <option value="" disabled selected>Select Shipping</option>
                                <option value="standard">standard</option>
                                <option value="express">Express</option>
                            </select>
                        </div>

                        <input type="hidden" name="OrderID" id="OrderID">
                        <input type="hidden" name="CustomerID" id="CustomerID">

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-success">Confirm Order</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="goBack()">Close</button>
                        </div>
                    </form>
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
        function openPaymentModal(OrderID, CustomerID) {
            document.getElementById('OrderID').value = OrderID;
            document.getElementById('CustomerID').value = CustomerID;
            var modal = document.getElementById('paymentModal');
            modal.style.display = "block";
        }

        function goBack() {
            location.reload();
        }
    </script>

</body>

</html>

<style>
    .container-fluid {
        background-color:rgb(255, 255, 255);
        width: 80%;
        border-radius: 20px;
        margin-bottom: 20px;
    }

    .img-fluid {
        display: block; 
        margin: 10px auto; 
        border-radius: 10px;
        width: 60%;
        height: auto;
    }

    .product-details {
        padding: 20px;
    }

    .product-details h3 {
        font-size: 1.8rem;
        margin-bottom: 10px;
    }

    .product-details p {
        margin-bottom: 10px;
    }

    .product-details .btn {
        padding: 10px 20px;
        background-color: #28a745;
        border: none;
    }

    .product-details .btn:hover {
        background-color: #218838;
    }

    .modal-content {
        border-radius: 10px;
        border: 1px solid #e0e0e0;
        width: 50%;
    }

    .modal-header {
        background-color: #FF69B4;
        color: white;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        padding: 10px;
        margin-bottom: 20px;
    }

    .modal-title {
        font-size: 1.5rem;
        font-weight: bold;
    }

    .form-label {
        font-weight: 600;
        color: #333;
    }

    .form-select {
        border-radius: 8px;
        padding: 10px;
    }

    .modal-body {
        background-color: #f8f9fa;
    }

    .btn {
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        align-items: center;
        margin-bottom: 10px;
    }

    .btn-success {
        background-color: #28a745;
        border: none;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .btn-secondary {
        background-color:rgb(113, 113, 113);
        border: none;
        color:rgb(255, 255, 255);
    }

    .btn-secondary:hover {
        background-color: rgb(63, 63, 63);
        color:rgb(255, 255, 255);
    }

    .d-flex {
        margin-top: 20px;
    }

    .Inspecting {
        color: orange;
    }

    .finish {
        color: green;
    }
</style>