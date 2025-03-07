<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php if($_GET['ActionType'] == "Register"){echo "Register an Accout";}else echo "Edit Account Information"; ?></title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/business-casual.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
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
        <div class="box" style="display: flex; justify-content: center; align-items: center; border-radius: 10px;">
            <div class="col-lg-12" style="width: 50%;">
                <hr>
                <h2 class="intro-text text-center" style="font-weight: bold;">Register</h2>
                <hr>
                <form role="form" action="RegisterAction.php?ActionType=<?php echo $_GET['ActionType']; if(!empty($_GET['ID'])) echo "&ID=".$_GET['ID'];?>" method="POST">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" name="Username" class="form-control" id="Username" placeholder="Enter Username" value="<?php if ($_GET['ActionType'] == 'Edit') echo $editCutomerData['Username']; ?>" >
                    </div>

                    <div class="form-group">
                        <label for="Password">Password:</label>
                        <input type="<?php if ($_GET['ActionType'] == 'Edit') echo "text"; else echo "Password"; ?>" name="Password" class="form-control" id="Password" placeholder="Enter Password" value="<?php if ($_GET['ActionType'] == 'Edit') echo $editCutomerData['PASSWORD']; ?>" >
                    </div>

                    <div class="form-group">
                        <label for="Firstname">Firstname:</label>
                        <input type="text" name="Firstname" class="form-control" id="Firstname" placeholder="Enter Firstname" value="<?php if ($_GET['ActionType'] == 'Edit') echo $editCutomerData['Firstname']; ?>" >
                    </div>

                    <div class="form-group">
                        <label for="Middlename">Middlename:</label>
                        <input type="text" name="Middlename" class="form-control" id="Middlename" placeholder="Enter Middlename" value="<?php if ($_GET['ActionType'] == 'Edit') echo $editCutomerData['Middlename']; ?>" >
                    </div>

                    <div class="form-group">
                        <label for="Lastname">Lastname:</label>
                        <input type="text" name="Lastname" class="form-control" id="Lastname" placeholder="Enter Lastname" value="<?php if ($_GET['ActionType'] == 'Edit') echo $editCutomerData['Lastname']; ?>" >
                    </div>

                    <div class="form-group">
                        <label for="Address">Address:</label>
                        <input type="text" name="Address" class="form-control" id="Address" placeholder="Enter Address" value="<?php if ($_GET['ActionType'] == 'Edit') echo $editCutomerData['Address']; ?>" >
                    </div>

                    <div class="form-group">
                        <label for="EmailAddress">Email Address:</label>
                        <input type="email" name="EmailAddress" class="form-control" id="EmailAddress" placeholder="Enter Email Address" value="<?php if ($_GET['ActionType'] == 'Edit') echo $editCutomerData['EmailAddress']; ?>" >
                    </div>

                    <button type="submit" class="btn btn-default" style="display: block; float: right;" >Submit</button><br><br>
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

</body>

</html>

<style>
    input {
        width: 50%;
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
