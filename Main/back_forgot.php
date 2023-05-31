<?php
include "../administrator/connection.php";



function generateOTP($length = 6) {
    $characters = '0123456789';
    $otp = '';
    $charLength = strlen($characters);

    for ($i = 0; $i < $length; $i++) {
        $otp .= $characters[rand(0, $charLength - 1)];
    }

    return $otp;
}

$email = "";
$emailErr = "";

if (isset($_POST["btnForgot"])) {
    if (empty($_POST["email"])) {
        $emailErr = "Email is required!";
    } else {
        $email = $_POST["email"];
    }

    if ($email) {
        $check_email = mysqli_query($connections, "SELECT * FROM account WHERE acc_email='$email'");
        $check_email_row = mysqli_num_rows($check_email);

        if ($check_email_row > 0) {
            $manilaTimezone = new DateTimeZone('Asia/Manila');
            $manilaTime = new DateTime('now', $manilaTimezone);
            $manilaTimeStr = $manilaTime->format('Y-m-d H:i:s');

            // Generate a 6-digit OTP
            $otp = generateOTP(6);

            // Update the OTP in the database for the corresponding email
            $query = "UPDATE account SET Otp = '$otp' WHERE acc_email = '$email'";
            mysqli_query($connections, $query);


            $get_recordAccount = mysqli_query ($connections,"SELECT * FROM account where Otp='$otp' ");
            $row = mysqli_fetch_assoc($get_recordAccount);
            $db_acc_id = $row["acc_id"];
           
            echo "
            <script>window.location.href='../forgetmailer.php?db_acc_id=$db_acc_id';</script>";
            exit();
        } else {
            $emailErr = "Email is not registered!";
        }
    }
}



$newpsw=$cunfirm_newpsw="";
$newpswErr=$cunfirm_newpswErr="";
if(isset($_POST["btnNewPassword"])){
    $accid=$_GET["accid"];
    if(empty($_POST["newpsw"])){

        $newpswErr="New Password is Required !";

    }else{
        $newpsw =$_POST["newpsw"];
    }
//cunfirm password
    if(empty($_POST["cunfirm_newpsw"])){

        $cunfirm_newpswErr="Cunfirm Password is Required !";

    }else{
        $cunfirm_newpsw =$_POST["cunfirm_newpsw"];
    }

    if($newpsw && $cunfirm_newpsw ){

       

        if (strlen($newpsw) > 4) {

        if ($newpsw == $cunfirm_newpsw) 
        {
        $_SESSION["acc_id"] = $accid;

       
                
                date_default_timezone_set('Asia/Manila');
                $currentDateTime = date('Y-m-d g:i A');

                mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date) 
                VALUES('$accid', 'RECOVER ACCOUNT', '$currentDateTime')");

                $get_recordAccount = mysqli_query ($connections,"SELECT * FROM account where acc_id='$accid' ");
                $row = mysqli_fetch_assoc($get_recordAccount);
                $db_Otp = $row["Otp"];

                mysqli_query($connections, "UPDATE account SET acc_password='$newpsw' where acc_id='$accid'");
        

                mysqli_query($connections, "UPDATE account SET Otp='' WHERE acc_id='$accid'");

                echo "<script>
                                                   
                window.location.href = '../customer/home.php';
              </script>";

                }else{
                $cunfirm_newpswErr="Password doesn't match";   
                }
            
        }else{
            $cunfirm_newpswErr="Password is too short";   
        }
    }
}

?>
