<?php

require 'administrator/connection.php';
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$db_acc_id = $_GET["db_acc_id"];

$mail = new PHPMailer(true);

$view_product_query = mysqli_query($connections, "SELECT * FROM account WHERE acc_id = '$db_acc_id'");

while ($product_row = mysqli_fetch_assoc($view_product_query)) {

    $db_acc_email = $product_row["acc_email"];
    $db_acc_fname = $product_row["acc_fname"];
    $db_otp= $product_row["Otp"];

    try {
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host = 'smtp.gmail.com';                             //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                     //Enable SMTP authentication
        $mail->Username = 'ardeleonpoultrysupplies@gmail.com';       //SMTP username
        $mail->Password = 'tnsavbpnkjjwomzo';                        //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;             //Enable implicit TLS encryption
        $mail->Port = 465;                                          //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        $mail->setFrom('ardeleonpoultrysupplies@gmail.com', 'Ardeleon Poultry Supply');
        $mail->addAddress(''.$db_acc_email.'', 'User nalang');     //Add a recipient
        $mail->addReplyTo('info@example.com', 'Information');

        $mail->isHTML(true);                                        //Set email format to HTML
        $mail->Subject = 'Here is the subject';
        $mail->Body = '
        <h2>Dear '.$db_acc_fname.'</h2>
        
        This is your OTP from R DE LEON POULTRY SUPPLY <b>' . $db_otp . '</b>.<br> 
        It can only be used one time to recover your Account.
        .
        <br>
        Thank you
        
        ';
        $mail->AltBody = '';

        $mail->send();

        echo "<script>
                alert('OTP Sent Successful!');
                window.location.href = 'main/cunfirmforgot.php?accid=" . $db_acc_id . "';
            </script>";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
