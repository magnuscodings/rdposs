<?php

include ("../administrator/connection.php");

session_start();

if(isset($_SESSION["acc_id"])){
    $acc_id = $_SESSION["acc_id"];
    
    $get_record = mysqli_query ($connections,"SELECT * FROM account where acc_id ='$acc_id' AND acc_status ='0' ");
    $row = mysqli_fetch_assoc($get_record);
    $acc_type = $row ["acc_type"];
    
    
    if($acc_type =="administrator"){
                //redirect administrator
                    echo "<script>window.location.href='../administrator/adminpages/';</script>";	
               
    }else if($acc_type =="customer"){
        echo "<script>window.location.href='../customer/home.php'</script>";	

    }else if($acc_type =="delivery person"){
        echo "<script>window.location.href='../delivery/deliver.php'</script>";	
    
    }else if($acc_type =="customer"){
                //redirect user
                echo "<script>window.location.href='customer/'</script>";	
            }
}



$username = $password = "";
$usernameErr = $passwordErr = "";

if (isset($_POST["btnLogin"])) {
    // Validate username
    if (empty($_POST["username"])) {
        $usernameErr = "Username is required!";
    } else {
        $username = $_POST["username"];
    }

    // Validate password
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required!";
    } else {
        $password = $_POST["password"];
    }

    if ($username && $password) {

        
        $check_username = mysqli_query($connections, "SELECT * FROM account WHERE acc_username='$username' AND (acc_type='administrator' OR acc_type='delivery person' OR acc_type='customer')");
        $check_username_row = mysqli_num_rows($check_username);

        if ($check_username_row > 0) 
        {
            $row = mysqli_fetch_assoc($check_username);
            $acc_id = $row["acc_id"];
            $db_password = $row["acc_password"];
            $accountype = $row["acc_type"];
            $accountstatus = $row["acc_status"];


            if($accountstatus=='0'){
                if ($password == $db_password) 
                {
                            $_SESSION["acc_id"] = $acc_id;

                            if ($accountype == "administrator") {
                                // Redirect to administrator

                                 // Redirect to customer
                                 date_default_timezone_set('Asia/Manila');
                                 $currentDateTime = date('Y-m-d g:i A');
                                 mysqli_query($connections, "INSERT INTO system_log(sys_user_id ,sys_login) 
                                 VALUES('$acc_id','$currentDateTime')");
                                echo "<script>window.location.href='../administrator/adminpages/';</script>";
                            } else if ($accountype == "delivery person") {
                                // Redirect to delivery
                                 // Redirect to customer
                                 date_default_timezone_set('Asia/Manila');
                                 $currentDateTime = date('Y-m-d g:i A');
                                 mysqli_query($connections, "INSERT INTO system_log(sys_user_id ,sys_login) 
                                 VALUES('$acc_id','$currentDateTime')");
                                echo "<script>window.location.href='../delivery/deliver.php';</script>";
                            } else {
                                // Redirect to customer
                                date_default_timezone_set('Asia/Manila');
                                $currentDateTime = date('Y-m-d g:i A');
                                mysqli_query($connections, "INSERT INTO system_log(sys_user_id ,sys_login) 
                                VALUES('$acc_id','$currentDateTime')");
                                echo "<script>window.location.href='../customer/home.php';</script>";
                            }
                } else {
                    $passwordErr = "Incorrect password!";
                }
            }else if($accountstatus=='1'){
                $passwordErr="Your account is disabled. Please contact the administrator to activate it or create a new one. ";
            }else if($accountstatus=='2'){
                $passwordErr="This account is permanently blocked. Message the <a href='customerInquiry.php'>Administrator</a> to appeal.";
            }
        } else {
            $usernameErr = "Username is not registered!";
        }
    }
}
?>
