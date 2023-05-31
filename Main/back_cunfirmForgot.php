<?php

session_start();

if (isset($_SESSION["acc_id"])) {
    $acc_id = $_SESSION["acc_id"];

    $get_record = mysqli_query($connections, "SELECT * FROM account WHERE acc_id ='$acc_id' AND acc_status ='0'");
    $row = mysqli_fetch_assoc($get_record);
    $acc_type = $row["acc_type"];

    if ($acc_type == "administrator") {
        // Redirect administrator
        echo "<script>window.location.href='../administrator/';</script>";
        exit;
    } else if ($acc_type == "customer") {
        echo "<script>window.location.href='../customer/home.php'</script>";
        exit;

    } else if ($acc_type == "delivery person") {
        echo "<script>window.location.href='../delivery/home.php'</script>";
        exit;
    } else if ($acc_type == "customer") {
        // Redirect user
        echo "<script>window.location.href='../customer/'</script>";
        exit;
    }
}

$accid = $_GET['accid'];
$EnterOtp = '';
$EnterOtpErr = '';

$view_product_query = mysqli_query($connections, "SELECT * FROM account WHERE acc_id = '$accid'");
$product_row = mysqli_fetch_assoc($view_product_query);

if ($product_row) {
    $db_acc_id = $product_row["acc_id"];
    $db_acc_email = $product_row["acc_email"];
    $db_acc_otp = $product_row["Otp"];
}

if (isset($_POST['btnSendOtp'])) {
    if (empty($_POST['EnterOtp'])) {
        $EnterOtpErr = 'One Time Pin is required';
    } else {
        $EnterOtp = $_POST['EnterOtp'];
    }

    if ($EnterOtp) {
        if ($db_acc_otp == "0") {
            $EnterOtpErr = "INVALID OTP";
        } else {
            if ($EnterOtp == $db_acc_otp) {
                $_SESSION["acc_id"] = $accid;
                mysqli_query($connections, "UPDATE account SET acc_status='0' WHERE acc_id='$db_acc_id'");

                // Start code for session
                // ... (Add your session-related code here)
                // End code for session

                echo "<script>alert('Your Account Successfully Recovered!'); document.location.href='recover.php?accid=$db_acc_id';</script>";
                exit;
            } else {
                $EnterOtpErr = 'Incorrect OTP!';
            }
        }
    }
}
?>
