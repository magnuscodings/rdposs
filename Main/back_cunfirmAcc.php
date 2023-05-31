<?php
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

    if ($EnterOtp == $db_acc_otp) {
        mysqli_query($connections, "UPDATE account SET acc_status='0' WHERE acc_id='$db_acc_id'");
        mysqli_query($connections, "UPDATE account SET Otp='0' WHERE acc_id='$db_acc_id'");

        echo "<script>alert('Your Account Successfully Created!'); document.location.href='login.php';</script>";
    } else {
        $EnterOtpErr = 'Incorrect OTP!';
    }
}
?>
