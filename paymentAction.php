<?php
      session_start();
      include('Connection.php');
            
      $orderID = $_POST['OrderID'];
      $customerID = $_POST['CustomerID'];
      $bankSelect = $_POST['bankSelect'];
      $shippingMethod = $_POST['shippingMethod'];
      $DatePayment = date("Y/m/d");

      $query = "INSERT INTO `tbl_payments`(`OrderID`, `CustomerID`, `Bank`, `Shipping`, `DatePayment`) 
            VALUES ('$orderID', '$customerID', '$bankSelect', '$shippingMethod', '$DatePayment')";
      $res = mysqli_query($conn,$query);

      if($res){
            $_SESSION['messagecart'] = 'Payment has been completed. You can now wait to receive the product.';
            header('Location: Cart.php');
            exit;
      }
?>