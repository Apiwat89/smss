<?php session_start(); include('Connection.php');?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Online Shoes Store</title>
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

    <div class="container">

        <div class="row">
            <div class="box">
                <div class="col-lg-12 text-center">
                    <div id="carousel-example-generic" class="carousel slide">
                        <ol class="carousel-indicators hidden-xs">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
							<li data-target="#carousel-example-generic" data-slide-to="3"></li>
                        </ol>

                        <div class="carousel-inner">
                            <div class="item active">
                                <img class="img-responsive img-full" src="img/IMG_0708.png" alt="">
                            </div>
                            <div class="item">
                                <img class="img-responsive img-full" src="img/IMG_0709.png" alt="">
                            </div>
                            <div class="item">
                                <img class="img-responsive img-full" src="img/IMG_0710.png" alt="">
                            </div>
							<div class="item">
                                <img class="img-responsive img-full" src="img/IMG_0711.png" alt="">
                            </div>
                        </div>
                        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                            <span class="icon-prev"></span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                            <span class="icon-next"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
		
		<?php 
			$sql = "SELECT * FROM `tbl_products` Limit 10";
			$Resulta = mysqli_query($conn,$sql);
		?>
		
		<?php while($Rows = mysqli_fetch_array($Resulta)){
		echo '	
		<div class="col-sm-4 col-lg-4 col-md-4">
             <div class="thumbnail">
				<h4 style="text-align: center;">'.$Rows[2].'</h4>
                <img style="border: 2px solid gray; border-radius: 10px; height: 229px; width: 298px;" src="img/'.$Rows[7].'" alt="">
                <div class="caption">
					<p><strong>Product Name:</strong> '.$Rows[1].'</p>
					<p><strong>Size Available:</strong> '.$Rows[3].'</p>
					<p><strong>Colors Available:</strong> '.$Rows[4].'</p>
					<p><strong>Price: '.number_format($Rows[5]).'.00</strong></p>
                </div>
				<center><a class="add" btn-primary" onclick="addToCartOnclick('.$Rows[0].');" href="#"  style="margin-bottom: 5px;" class="btn btn-primary">Add to Cart</a></center>
            </div>
        </div>
		';
		}?>
		
	</div>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>
					<?php 
                        if ($Username != null) {
                            echo '<strong>'.$Username.'</strong>'; 
                        } else if (!empty($_SESSION['Admin'])) {
                            echo '<strong>'.$_SESSION['Admin'].'</strong>'; 
                        }
                    ?>
					<br>
					<strong>
					<?php 
                        if ($Username != null) {echo '<a href="Logout.php">Logout</a>';} 
                        else if (!empty($_SESSION['Admin'])) {echo '<a href="Logout.php">Logout</a>';} 
                        else {echo '<a href="Login.php">Login</a>';} 
                    ?> | 
					<a href="#">Back to top</a>
					</strong><br>
					KMUTNB &copy; Luxshoery 2023
					</p>
					
                </div>
            </div>
        </div>
    </footer>

    <?php
        if (isset($_SESSION['toast_message'])) {
            $toast_message = $_SESSION['toast_message'];
            unset($_SESSION['toast_message']);
            echo "<script>
                window.onload = function() {
                    var toast = document.createElement('div');
                    toast.classList.add('toast');
                    toast.innerHTML = '$toast_message';
                    document.body.appendChild(toast);
                    toast.style.display = 'block'; // Show toast

                    setTimeout(function() {
                        toast.style.display = 'none'; // Hide toast after 5 seconds
                    }, 5000);
                };
            </script>";
        }
    ?>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
		$('.carousel').carousel({
			interval: 5000 //changes the speed
		})
		
		$('#reg').click(function(){
			window.open('register.html',_self);
		});
		
		function addToCartOnclick(ProductID)
		{	
            var isAdmin = <?php echo isset($_SESSION['Admin']) ? 'true' : 'false'; ?>;
            if (isAdmin) {
                if (confirm("Unable to order products because you are an admin")) {
                    window.location.href = "index.php";
                }
            } else {
                window.location.href = "Order.php?ProductID=" + ProductID;
            }
		}
    </script>
</body>

</html>

<style>
    .add {
        text-decoration: none;
        background-color: #4CAF50; 
        color: white; 
        padding: 10px 15px; 
        border-radius: 5px; 
        font-size: 14px;
        display: inline-block; 
        transition: background-color 0.3s ease; 
    }

    .add:hover {
        background-color: #45a049; 
        text-decoration: none;
        color: white; 
    }

    .toast {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            z-index: 9999;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: none;
        }
</style>