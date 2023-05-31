<?php

require 'administrator/connection.php';
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Get the db_acc_id from the query string
if (!isset($_GET['db_acc_id'])) {
    echo "db_acc_id parameter is missing";
    exit;
}
$db_acc_id = $_GET["db_acc_id"];

// Create a new PHPMailer instance
$mail = new PHPMailer(true);

try {
    // Database query to fetch account details
    $view_product_query = mysqli_query($connections, "SELECT * FROM account WHERE acc_id = '$db_acc_id'");

    // Check if any account is found
    if (mysqli_num_rows($view_product_query) == 0) {
        echo "Account not found";
        exit;
    }

    // Fetch account details
    $product_row = mysqli_fetch_assoc($view_product_query);
    $db_acc_email = $product_row["acc_email"];
    $db_acc_fname = $product_row["acc_fname"];
    $db_otp = $product_row["Otp"];

    // SMTP configuration
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'ardeleonpoultrysupplies@gmail.com';
    $mail->Password = 'tnsavbpnkjjwomzo';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    // Sender and recipient details
    $mail->setFrom('ardeleonpoultrysupplies@gmail.com', 'Ardeleon Poultry Supply');
    $mail->addAddress($db_acc_email, 'User nalang');
    $mail->addReplyTo('info@example.com', 'Information');

    // Email content
    $mail->isHTML(true);
    $mail->Subject = 'Here is the subject';
    $mail->Body = '
        <h2>Dear ' . $db_acc_fname . '</h2>
        
        This is your OTP from R DE LEON POULTRY SUPPLY <b>' . $db_otp . '</b>.<br> 
        It can only be used one time to confirm your account.
        .
        <br>
        Thank you,
    ';
    $mail->AltBody = '';

    // Send the email
    $mail->send();

    echo "<script>
            alert('OTP Sent Successfully!');
            window.location.href = 'main/cunfirmAccount.php?accid=$db_acc_id';
        </script>";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
