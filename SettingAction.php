<?php 
	session_start();
	include('Connection.php');

    $ID = $_POST['CustomerID'];
    $user = $_POST['Username'];
    $first = $_POST['Firstname'];
    $middle = $_POST['Middlename'];
    $lass = $_POST['Lastname'];
    $address = $_POST['Address'];
    $email = $_POST['EmailAddress'];
    $pass = $_POST['Password'];
    $Cpass = $_POST['CPassword'];
    echo $ID;

    if ($pass == $Cpass) {
        $queryUp = "UPDATE tbl_customers SET Username='$user', PASSWORD='$pass', Firstname='$first', Middlename='$middle',
            Lastname='$lass', Address='$address', EmailAddress='$email' WHERE CustomerID = '$ID'";
        $res = mysqli_query($conn, $queryUp);
        if ($res) {
            $_SESSION['toast_message'] = 'Completely updated information';
            header('Location: Setting.php');
            $_SESSION["Username"] = null;
            $_SESSION["Password"] = null;
            $_SESSION["Admin"] = null;
            header('Location: Login.php');
            exit;
        } else {
            $_SESSION['toast_message_error'] = 'Unsuccessful change';
            header('Location: Setting.php');
            exit;
        }
    } else {
        $_SESSION['toast_message_error'] = 'Unsuccessful change';
        header('Location: Setting.php');
        exit;
    }
?>