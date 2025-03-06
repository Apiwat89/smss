<?php session_start(); include('Connection.php');?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Best Sellers</title>
	
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
    $Username = null;
    if(!empty($_SESSION["Username"])) {
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
                <a class="navbar-brand" href="index.php">Online Shoes Store</a>
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
            <div class="box" style="border-radius: 10px;">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Top 5 <strong>BEST</strong>sellers</h2>
                    <hr>
                </div><br></br>
            </div>
        </div>

        <?php
            $num = 1;
            $sql = "SELECT * FROM `tbl_products` LIMIT 5";
            $Resulta = mysqli_query($conn,$sql);
            while($Rows = mysqli_fetch_array($Resulta)){
                echo '  
                    <div class="row">
                        <div class="box" style="border-radius: 10px;">
                            <div class="col-lg-12">
                                <hr>
                                <h2 class="intro-text text-center" >Top '. $num.'</h2>
                                <hr>
                                <img class="img-responsive img-border img-left" src="img/'.$Rows[7].'" alt="">
                                <hr class="visible-xs">
                                <p><strong>Product Name:</strong> '.$Rows[1].'</p>
                                <p><strong>Product Brand:</strong> '.$Rows[2].'</p>
                                <p><strong>Size Available:</strong> '.$Rows[3].'</p>
                                <p><strong>Colors Available:</strong> '.$Rows[4].'</p>
                                <p><b>Price:</b> '.number_format($Rows[5]).' บาท</p>
                                <a onclick="addToCartOnclick('.$Rows[0].');" href="#"  style="margin-bottom: 5px;" class="btn btn-primary">Add to Cart</a>
                            </div>
                        </div>
                    </div>';
                $num++;
            }
        ?>
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
        function addToCartOnclick(ProductID)
        {   
            window.open("Order.php?ProductID="+ProductID,"_self",null,true);
        }
    </script>

</body>

</html>

