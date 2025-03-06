<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Product List</title>

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
                <a class="navbar-brand" href="index.html">Online Shoes Store</a>
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
					<hr>
					<h2 class="intro-text text-center" style="font-weight: bold;">Product List</h2>
					<hr>
					<div class="col-lg-12">
						<div class="table-responsive">
							<table border="5px" class="table">
								<tr style="text-align: center; color: Black; font-weight: bold;">
									<td>Image</td>
									<td>Product ID</td>
									<td>Product Name</td>
									<td>Product Brand</td>
									<td>Product Size</td>
									<td>Product Color</td>
									<td>Product Price</td>
									<td>Product Category</td>
									<td>Action</td>
								</tr>
								
								<?php 
									require 'Connection.php';
									$sql = "select * from tbl_products";
									$Resulta = mysqli_query($conn,$sql);
									while($Rows = mysqli_fetch_array($Resulta)):; 
								?>
								<tr style="color: black">
                                    <td><img style="width: 50px; height: 50px;" src="img/<?php echo $Rows[7]; ?>" alt="Product Image"></td>
									<td style="text-align: center;"><?php $cid = $Rows[0]; echo $cid; ?></>
									<td style="text-align: center;"><?php echo $Rows[1]; ?></td>
									<td style="text-align: center;"><?php echo $Rows[2]; ?></td>
									<td style="text-align: center;"><?php echo $Rows[3]; ?></td>
									<td style="text-align: center;"><?php echo $Rows[4]; ?></td>
									<td style="text-align: center;"><?php echo number_format($Rows[5]); ?></td>
									<td style="text-align: center;"><?php echo $Rows[6]; ?></td>
									<td style="text-align: center;">
                                        <a href="#" onclick="ProductOnlick('Edit',<?php echo $Rows[0]; ?>)">Edit</a> | 
                                        <a href="#" onclick="ProductOnlick('Delete',<?php echo $Rows[0]; ?>)">Delete</a>
									</td>
									<?php endwhile; ?>
								</tr>
							</table>
						</div>
					</div>
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
    function ProductOnlick(action, pid) {
    if (action == "Edit") {
        if (confirm("Are you sure you want to edit this product?") == true) {
            // โหลดข้อมูลสินค้าจาก ProdID และแสดงในฟอร์มแก้ไขสินค้า
            window.open("Management_Products.php?ProdID=" + pid + "&ProductAction=" + action, "_self", null, true);
        }
    } else if (action == "Delete") {
        if (confirm("Are you sure you want to Delete this product?") == true) {
            window.open("Management_Products_Action.php?ProdID=" + pid + "&ProductAction=" + action, "_self", null, true);
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