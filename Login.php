<? session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/business-casual.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">
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
    <div class="box" style="display: flex; flex-direction: column; justify-content: center; align-items: center; border-radius: 10px;">		
        <div class="col-lg-12" style="width: 50%;">
            <hr>
            <h2 class="intro-text text-center" style="font-weight: bold;">Please Login</h2>
            <hr>
        </div>

        <div class="col-md-6">
            <form role="form" action="LoginDestination.php" method="POST">
                <div class="form-group">
                    <label for="Username">Username:</label>
                    <input type="text" name="Username" class="form-control" id="Username" placeholder="Enter Username" required>
                </div>

                <div class="form-group">
                    <label for="Password">Password:</label>
                    <input type="password" name="Password" class="form-control" id="Password" placeholder="Enter password" required>
                </div>

                <button type="submit" style="display: block; float: right;" class="btn btn-default">Submit</button>
            </form>
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
        z-index: 99999;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        display: none;
    }
</style>