<?php

session_start();
$Username = null;
if (!empty($_SESSION["Username"])) {
    $Username = $_SESSION["Username"];
}
$ProductAction = isset($_GET["ProductAction"]) ? $_GET["ProductAction"] : "";
if (empty($_SESSION['Admin'])) {
    echo '<script>window.open("index.php","_self",null,true);</script>';
}

$editProductID = null;
$editProductData = array(); // ข้อมูลสินค้าที่ต้องการแก้ไข

// ตรวจสอบว่ามีการส่งค่า ProdID มาจาก URL หรือไม่
if ($ProductAction == "Edit" && isset($_GET['ProdID'])) {
    $editProductID = $_GET['ProdID'];

    // ตรวจสอบว่ามีการเชื่อมต่อฐานข้อมูลหรือไม่
    require 'Connection.php'; // เปลี่ยนตามชื่อไฟล์ที่เชื่อมต่อฐานข้อมูล

    // สร้างคำสั่ง SQL เพื่อดึงข้อมูลสินค้าจากฐานข้อมูล
    $sql = "SELECT * FROM tbl_products WHERE ProductID = $editProductID";

    // ส่งคำสั่ง SQL ไปที่ฐานข้อมูล
    $result = mysqli_query($conn, $sql);

    // ตรวจสอบว่ามีข้อมูลที่ดึงได้หรือไม่
    if (mysqli_num_rows($result) > 0) {
        // ถ้ามีข้อมูล ดึงข้อมูลและเก็บไว้ในตัวแปร $editProductData
        $editProductData = mysqli_fetch_assoc($result);
    } else {
        // ถ้าไม่มีข้อมูลให้แสดงข้อความ "0 results"
        echo "0 results";
    }
}

?>

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
                    <hr>
                    <h2 class="intro-text text-center" style="font-weight: bold;">Products</h2>
                    <hr>
                    <div class="col-md-12">  
                        <div class="col-md-6">   
                            <form role="form" action="Management_Products_Action.php?ProductAction=<?php echo $ProductAction; if ($ProductAction == "Edit") echo "&ProdID=" . $editProductID; ?>" method="POST" enctype="multipart/form-data">
                            
                            <div class="form-group">
                              <label for="ProductName">Product Name:</label>
                              <input type="text" name="ProductName" class="form-control" id="ProductName" placeholder="Enter Product Name" value="<?php if ($ProductAction == "Edit") echo $editProductData['Productname']; ?>" required>
                            </div>
                            
                            <div class="form-group">
                              <label for="ProductBrand">Product Brand:</label>
                              <input type="text" name="ProductBrand" class="form-control" id="ProductBrand" placeholder="Enter Product Brand" value="<?php if ($ProductAction == "Edit") echo $editProductData['ProductBrand']; ?>" required>
                            </div>
                            
                            <div class="form-group">
                              <label for="ProductPrice">Product Price:</label>
                              <input type="text" pattern="[0-9]*" inputmode="numeric" name="ProductPrice" class="form-control" id="ProductPrice" placeholder="Enter Product Price" value="<?php if ($ProductAction == "Edit") echo $editProductData['ProductPrice']; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">   
                            <div class="form-group">
                              <label for="ProductSize">Size Available:</label>
                              <input type="text" pattern="[0-9]*" inputmode="numeric" name="ProductSize" class="form-control" id="ProductSize" placeholder="Enter Product Size" value="<?php if ($ProductAction == "Edit") echo $editProductData['ProductSize']; ?>" required>
                            </div>
                        
                            <div class="form-group">
                              <label for="ProductColor">Colors Available:</label>
                              <input type="text" name="ProductColor" class="form-control" id="ProductColor" placeholder="Enter Product Color" value="<?php if ($ProductAction == "Edit") echo $editProductData['ProductColor']; ?>" required>
                            </div>
                            
                            <div class="form-group">
                              <label for="ProductCategory">Category:</label>
                              <input type="text" name="ProductCategory" class="form-control" id="ProductCategory" placeholder="Enter Product Category" value="<?php if ($ProductAction == "Edit") echo $editProductData['ProductCategory']; ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="ProductImage">Product Image:</label>
                                <?php if ($ProductAction == "Edit") { ?>
                                    <img src="img/<?php echo htmlspecialchars($editProductData['ProductImageName']); ?>" width="100" alt="Product Image">
                                    <input type="file" name="ProductImage">
                                <?php } else { ?>
                                    <input type="file" name="ProductImage" required>
                                <?php } ?>
                            </div>
                            
                            <div class="form-group">
                            <button type="submit" style="float: right;" class="btn btn-default">Submit</button>
                            </div>
                        </div>
                        </form>
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
</body>
</html>
