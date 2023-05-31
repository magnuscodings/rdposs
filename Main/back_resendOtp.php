<?php 
include ("../administrator/connection.php");
$accid=$_GET['accid'];

function generateOTP($length = 6) {
    $characters = '0123456789';
    $otp = '';
    $charLength = strlen($characters);

    for ($i = 0; $i < $length; $i++) {
        $otp .= $characters[rand(0, $charLength - 1)];
    }

    return $otp;
}
     // Generate a 6-digit OTP
     $otp = generateOTP(6);

mysqli_query($connections,"UPDATE account SET Otp='$otp' WHERE acc_id='$accid'");
                    
echo "<script>
                                                   
window.location.href = '../mailer.php?otp=".$otp."';
</script>";


?>