<?php $current_page = basename($_SERVER['SCRIPT_NAME']); ?>

<?php if (empty($_SESSION['Admin'])) { ?>
    <li><a href="index.php" class="<?= ($current_page == 'index.php') ? 'Acc' : ''; ?>">Home</a></li>
    <li><a href="bestseller.php" class="<?= ($current_page == 'bestseller.php') ? 'Acc' : ''; ?>">Best Sellers</a></li>
    <li><a href="shop.php" class="<?= ($current_page == 'shop.php') ? 'Acc' : ''; ?>">Shop</a></li>
    <?php 
        if ($Username == null) {
            echo '<li><a href="register.php?ActionType=Register" class="' . (($current_page == "register.php") ? "Acc" : "") . '">Register</a></li>';
            echo '<li><a href="Login.php" class="' . (($current_page == "Login.php") ? "Acc" : "") . '">Login</a></li>';
        } else {
            echo '<li><a href="Cart.php" class="' . (($current_page == "Cart.php") ? "Acc" : "") . '">Cart <i class="fa-solid fa-cart-shopping"></i> </a></li>';
            echo '<li><a href="Setting.php" class="' . (($current_page == "Setting.php") ? "Acc" : "") . '">Setting <i class="fa-solid fa-gear"></i> </a></li>';
            echo '<li> <a href="Logout.php" class="AccLog">'. htmlspecialchars($Username) .'<i class="fas fa-sign-out-alt" style="margin-left: 8px;"></i>  </a> </li>';
        } 
    ?>
<?php } else { ?>
    <li><a href="Management_Orders.php" class="<?= ($current_page == 'Management_Orders.php') ? 'Acc' : ''; ?>">Orders</a></li>
    <li><a href="Management_Report.php" class="<?= ($current_page == 'Management_Report.php') ? 'Acc' : ''; ?>">Report</a></li>
    <li><a href="Management_Products.php?ProductAction=Add" class="<?= ($current_page == 'Management_Products.php') ? 'Acc' : ''; ?>">Products</a></li>
    <li><a href="Management_ProductsList.php" class="<?= ($current_page == 'Management_ProductsList.php') ? 'Acc' : ''; ?>">Product List</a></li>
    <li><a href="Management_Customers.php" class="<?= ($current_page == 'Management_Customers.php') ? 'Acc' : ''; ?>">Customers</a></li>
    <?php 
        if(!empty($_SESSION['Admin'])) {
            echo '<li> <a href="Logout.php" class="AccLog">'. htmlspecialchars($Username) .'<i class="fas fa-sign-out-alt" style="margin-left: 8px;"></i>  </a> </li>';
        } 
    ?>
<?php } ?>

<style>
    .Acc {
        color: #ffffff !important; 
        background-color: #FF69B4; 
        font-weight: bold;
        padding: 5px 10px; 
        text-decoration: none;
        display: inline-block;
    }

    .Acc:hover, .Acc:focus {
        color: #ffffff !important;
        background-color: #FF1493 !important;
        text-decoration: none;
    }

    .AccLog {
        color: #FF69B4 !important; 
    }

    .AccLog:hover {
        color: #FF1493 !important;
    }
</style>