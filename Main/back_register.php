<?php 
include("../administrator/connection.php");

function generateOTP($length = 6) {
    $characters = '0123456789';
    $otp = '';
    $charLength = strlen($characters);

    for ($i = 0; $i < $length; $i++) {
        $otp .= $characters[rand(0, $charLength - 1)];
    }

    return $otp;
}


$fname=$lname=$email=$contactNo=$uname=$password=$confirmPass="";
$fnameErr=$lnameErr=$emailErr=$contactNoErr=$unameErr=$passwordErr=$cunfirmPassErr="";

// $test="testtestets";
if(isset($_POST["btnCreate"])){

    if(empty($_POST["fname"])){
        $fnameErr = "First Name is Required !";
    
    }else{
        $fname= $_POST["fname"];     
        if (preg_match('/[^\p{L}\s]/u', $fname)) {

  $fnameErr="First name Donot Include Numbers or Special Characters";
           
            } else {
                if(empty($_POST["lname"])){
                    $lnameErr = "Last Name is Required !";
                
                }else{
                    $lname= $_POST["lname"];

                    if (preg_match('/[^\p{L}\s]/u', $lname)) {

                        $lnameErr="Last name Donot Include Numbers or Special Characters";
                                 
                                  } else {
                                    if(empty($_POST["email"])){
                                        $emailErr = "Email is Required !";
                                    
                                    }else{
                                        $email= $_POST["email"];
                                    }
            
                                    
                                                                    if(empty($_POST["contactNo"])){
            
                                                                        $contactNoErr = "Contact number is Required !";
                                                                    
                                                                    }else{
            
                                                                        $contactNo= $_POST["contactNo"];
                                                                        if (preg_match('/^0[0-9]{10}$/', $contactNo)) {
                                                                            if(empty($_POST["uname"])){
                                                                                $unameErr = "Username is Required !";
                                                                            
                                                                            }else{
                                                                                $uname= $_POST["uname"];
                                                                            }
                                                                        
                                                                            if(empty($_POST["password"])){
                                                                                $passwordErr = "password is Required !";
                                                                            
                                                                            }else{
                                                                                $password= $_POST["password"];
                                                                            }
                                                                            $confirmPass= $_POST["confirmPass"];
            
                                                                        }else{
            
                                                                        $contactNoErr="contact number is Invalid";
            
                                                                        }
                                                                    }
                                  }
                }

                      
              
            }

    }



  

   


   

   

    if( $fname && $lname && $email && $contactNo && $uname && $password){

                if($password!=$confirmPass){

                    $cunfirmPassErr="Password Not Match !";
                }else{

                if(strlen($fname)<=1){
                        $fnameErr="First name is too short";
                }else{

                        if(strlen($lname)<=1){
                            $lnameErr="Last name is too short";
                        }else{
                            
                                if (strlen($password) < 5) {
                                    $passwordErr = "Password is too short";
                                } else {
                                    if ($email) {
                                        $check_email = mysqli_query($connections, "SELECT * FROM account WHERE acc_email='$email'");
                                        $check_email_row = mysqli_num_rows($check_email);
                            
                                        if ($check_email_row > 0) {
                                            $emailErr = "Email is already taken!";
                                        } else {
                                            if ($uname) {
                                                $check_username = mysqli_query($connections, "SELECT * FROM account WHERE acc_username='$uname'");
                                                $check_username_row = mysqli_num_rows($check_username);
                            
                                                if ($check_username_row > 0) {
                                                    $unameErr = "Username is already taken!";
                                                } else {


                                                    
                                                    $manilaTimezone = new DateTimeZone('Asia/Manila');
                                                    $manilaTime = new DateTime('now', $manilaTimezone);
                                                    $manilaTimeStr = $manilaTime->format('Y-m-d H:i:s');


                                                    
                                                        // Generate a 6-digit OTP
                                                        $otp = generateOTP(6);

                                                        // Define the expiration time (e.g., 10 minutes from now)
                                           

                                                        // Insert the OTP and expiration time into the database
                                                        $query = "INSERT INTO account (acc_created, acc_username, acc_password, acc_fname, acc_lname, acc_type, acc_status, acc_email, acc_contact,Otp) 
                                                                VALUES ('$manilaTimeStr', '$uname', '$password', '$fname', '$lname', 'customer', '1', '$email', '$contactNo', '$otp')";

                                                        mysqli_query($connections, $query);

                                                        $get_recordAccount = mysqli_query ($connections,"SELECT * FROM account where acc_email='$email' ");
                                                        $row = mysqli_fetch_assoc($get_recordAccount);
                                                        $db_acc_id = $row["acc_id"];

                                                        // start user log
                                                        date_default_timezone_set('Asia/Manila');
                                                        $currentDateTime = date('Y-m-d g:i A');
                                                        mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date) 
                                                        VALUES('$db_acc_id', 'CREATE ACCOUNT', '$currentDateTime')");
                                                        //end user log
                                                        
                                                    echo "<script>
                                                   
                                                    window.location.href = '../mailer.php?db_acc_id=".$db_acc_id."';
                                                </script>";
                                                exit();
                                                }
                                            }
                                            
                                        }
                                    }
                                }
                           
                            
                         }
                }
                    
                }
    }   


}

?>
