<?php 
    session_start();
    include('Connection.php');

    $id = $_GET['id'];
    echo $id;
    
    $sql = "
        SELECT tbl_payments.PaymentID AS PaymentID,
            tbl_orders.OrderID AS OrderID,
            tbl_orders.CustomerID AS CustomerID, 
            tbl_products.ProductID AS ProductID,
            tbl_customers.Address AS Address
        FROM tbl_orders 
        LEFT JOIN tbl_products ON tbl_orders.ProductID = tbl_products.ProductID 
        LEFT JOIN tbl_payments ON tbl_orders.OrderID = tbl_payments.OrderID 
        LEFT JOIN tbl_customers ON tbl_orders.CustomerID = tbl_customers.CustomerID 
        WHERE tbl_payments.PaymentID = '$id' 
        ORDER BY tbl_orders.OrderID, tbl_payments.PaymentID
    ";
    $res = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($res)) {
        $PaymentID = $row['PaymentID'];
        $OrderID = $row['OrderID'];
        $CustomerID = $row['CustomerID'];
        $ProductID = $row['ProductID'];
        $address = $row['Address'];
        $DateReport = date("Y/m/d");

        $sqlIn = "INSERT INTO tbl_reports (`PaymentID`, `OrderID`, `CustomerID`, `ProductID`, `DateReport`, `Address`) 
                  VALUES ('$PaymentID', '$OrderID', '$CustomerID', '$ProductID', '$DateReport', '$address')";
        $resIn = mysqli_query($conn, $sqlIn);

        if ($resIn) {
            echo "<script>window.alert('Order sent successfully'); window.open('Management_Orders.php','_self',null,true);</script>";
        } else {
            die("Error inserting into tbl_reports: " . mysqli_error($conn));
        }
    } else {
        die("No data");
    }
?>