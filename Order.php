<?php session_start(); include('Connection.php');?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Order</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/business-casual.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" 
    rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" 
    rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        #pdetails span{
            float: right;
        }
    </style>

    <?php
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
                <a class="navbar-brand" href="index.php">Luxshoery</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php include('nav.php'); ?>
                </ul>
            </div>
        </div>
    </nav>
    
    <?php
        $UN = $_SESSION['Username'];
        $PASS = $_SESSION['Password'];
        $ProductID = $_GET['ProductID'];
        
        if(empty($UN)){echo '<script>window.open("Login.php","_self",null,true);</script>';}
        
        $sql = "SELECT * FROM `tbl_customers` WHERE `Username` = '".$UN."' and `Password` = '".$PASS."' and `Role` = 'User'";
        $res = mysqli_query($conn,$sql);
        while($Rows = mysqli_fetch_array($res)){
            $CustomerID = $Rows[0];
        }

        // Fetch product details from tbl_products
        $product_sql = "SELECT * FROM tbl_products WHERE ProductID = $ProductID";
        $product_result = mysqli_query($conn, $product_sql);
        $product_row = mysqli_fetch_assoc($product_result);
        $product_color = $product_row['ProductColor'];
        $product_size = $product_row['ProductSize'];
        $product_name = $product_row['Productname'];
    ?>

    <div class="container">

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Order</h2>
                    <hr><br>
                </div>
                <div class="col-md-6 d-flex justify-content-center align-items-center">
                 <form role="form" action="OrderAction.php?ProductID=<?php echo $ProductID; ?>&CustomerID=<?php echo $CustomerID; ?>" method="POST">
                    <div class="form-group">
                      <label for="ProductID" style="float: left;">Product ID:</label>
                      <input type="text" name="ProductID" class="form-control" id="ProductID" value="<?php echo $ProductID; ?>" disabled>
                    </div>
                    <div class="form-group">
                      <label for="CustomerID" style="float: left;">Customer ID:</label>
                      <input type="text" name="CustomerID" class="form-control" id="CustomerID" value="<?php echo $CustomerID; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="ProductName" style="float: left;">Product Name:</label>
                        <input type="text" name="ProductName" class="form-control" id="ProductName" value="<?php echo $product_name; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="ProductColor" style="float: left;">Product Color:</label>
                        <input type="text" name="ProductColor" class="form-control" id="ProductColor" value="<?php echo $product_color; ?>">
                    </div>
                    <div class="form-group">
                        <label for="ProductSize" style="float: left;">Product Size:</label>
                        <input type="text" pattern="[0-9]*" inputmode="numeric" name="ProductSize" class="form-control" id="ProductSize" value="<?php echo $product_size; ?>">
                    </div>
                        <button type="submit" style="float: right;" class="btn btn-default">Submit</button>
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

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>

<style> 
    .box {
        display: grid;
        justify-items: center;
        align-items: center;
        text-align: center;
    }
</style>