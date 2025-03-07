<?php

use LDAP\Result;

 session_start(); include('Connection.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Setting</title>
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

    <div class="container">
        <div class="box" style="display: flex; flex-direction: column; justify-content: center; align-items: center; border-radius: 10px;">		
            <div class="col-lg-12" style="width: 50%;">
                <hr>
                <h2 class="intro-text text-center" style="font-weight: bold;">Setting</h2>
                <hr>
            </div>

            <?php 
                $queryC = "SELECT * FROM `tbl_customers` WHERE `Username` = '".$_SESSION["Username"]."' and `Password` = '".$_SESSION["Password"]."'";
                $resC = mysqli_query($conn,$queryC);
                $rowC = mysqli_fetch_array($resC,MYSQLI_ASSOC);
                $ID = $rowC['CustomerID'];

                $queryCustomer = "SELECT * FROM tbl_customers WHERE CustomerID = '$ID'";
                $resCustomer = mysqli_query($conn, $queryCustomer);
                $result = mysqli_fetch_assoc($resCustomer);
            ?>

            <div class="col-md-6">
                <form role="form" action="SettingAction.php" method="POST">
                    <div class="form-group">
                        <label for="Username">Username: <span style="color: red;">*</span></label>
                        <input type="text" name="Username" class="form-control" id="Username" placeholder="Enter Username" value="<?php echo $result['Username']?>" required>
                    </div>

                    <div class="form-group">
                        <label for="Firstname">Firstname:</label>
                        <input type="text" name="Firstname" class="form-control" id="Firstname" placeholder="Enter Firstname" value="<?php echo $result['Firstname']?>" required>
                    </div>

                    <div class="form-group">
                        <label for="Middlename">Middlename:</label>
                        <input type="text" name="Middlename" class="form-control" id="Middlename" placeholder="Enter Middlename" value="<?php echo $result['Middlename']?>" required>
                    </div>

                    <div class="form-group">
                        <label for="Lastname">Lastname:</label>
                        <input type="text" name="Lastname" class="form-control" id="Lastname" placeholder="Enter Lastname" value="<?php echo $result['Lastname']?>" required>
                    </div>

                    <div class="form-group">
                        <label for="Address">Address:</label>
                        <input type="text" name="Address" class="form-control" id="Address" placeholder="Enter Address" value="<?php echo $result['Address']?>" required>
                    </div>

                    <div class="form-group">
                        <label for="EmailAddress">EmailAddress:</label>
                        <input type="text" name="EmailAddress" class="form-control" id="EmailAddress" placeholder="Enter EmailAddress" value="<?php echo $result['EmailAddress']?>" required>
                    </div>

                    <div class="form-group">
                        <label for="Password">Password:<span style="color: red;">*</span></label>
                        <input type="password" name="Password" class="form-control" id="Password" placeholder="Enter password" value="<?php echo $result['PASSWORD']?>" required>
                        <br><label for="Password">Confirm Password:<span style="color: red;">*</span></label>
                        <input type="password" name="CPassword" class="form-control" id="Password" placeholder="Enter password" value="<?php echo $result['PASSWORD']?>" required>
                    </div>
                    <button type="submit" style="display: block; float: right;" class="btn btn-default">Submit</button>
                    <p class='test'>UID: <?php echo $result['CustomerID']; ?></p>
                    <input type="hidden" name="CustomerID" value="<?php echo $result['CustomerID']; ?>">
                </form>
            </div>
        </div>
    </div>

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

<?php
        if (isset($_SESSION['toast_message_error'])) {
            $toast_message_error = $_SESSION['toast_message_error'];
            unset($_SESSION['toast_message_error']);
            echo "<script>
                window.onload = function() {
                    var toast = document.createElement('div');
                    toast.classList.add('toast');
                    toast.innerHTML = '$toast_message_error';
                    document.body.appendChild(toast);
                    toast.style.display = 'block'; // Show toast

                    setTimeout(function() {
                        toast.style.display = 'none'; // Hide toast after 5 seconds
                    }, 5000);
                };
            </script>";
        }
    ?>

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

<style>
    .test {
        font-size: 12px;
        float: left;
        margin-top: 8px;
    }

    .toast {
        position: fixed;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        background-color:rgb(167, 40, 40);
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 16px;
        z-index: 9999;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        display: none;
    }
</style>