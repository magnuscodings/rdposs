<?php 
include ("back_register.php");

include("../customer/backend/back_navbar.php");
include "navbar.php";

if(isset($_SESSION["acc_id"])){
    $acc_id = $_SESSION["acc_id"];
    
    $get_record = mysqli_query ($connections,"SELECT * FROM account where acc_id='$acc_id' ");
    $row = mysqli_fetch_assoc($get_record);
    $acc_type = $row ["acc_type"];
    if($acc_type =="administrator"){
             //redirect administrator
                echo "<script>window.location.href='../administrator/';</script>";	        
 } if($acc_type =="delivery person"){
             //redirect administrator
                echo "<script>window.location.href='../delivery/';</script>";	      
        
 }else{        //redirect user
             echo "<script>window.location.href='../user/login.php'</script>";	
          }
 }
 
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Registration</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<!-- MATERIAL DESIGN ICONIC FONT -->
		<link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">

		<!-- STYLE CSS -->
		
        
	</head>
	


      <div class="banner_section layout_padding">
    <div class="container">
        
            <div class="wrapper">
                <div class="inner">
                    <div class="image-holder">
                        <img src="../assets/logos.png" height="100%" style="border-radius: 5%;" alt="">
                    </div>

                    <form action="" method="POST">
                        <h3 style="color: white; font-family: Arial, sans-serif;">Registration Form</h3>

                        <span class="error"><?php echo $fnameErr; ?></span><br>
                        <div class="form-wrapper">
                            <input type="text" name="fname" value="<?php echo $fname?>" placeholder="First Name" class="form-control">
                        </div>

                        <span class="error"><?php echo $lnameErr; ?></span>
                        <div class="form-wrapper">
                            <input type="text" name="lname" value="<?php echo $lname?>" placeholder="Last Name" class="form-control">
                        </div>

                        <span class="error"><?php echo $emailErr; ?></span>
                        <div class="form-wrapper">
                            <input type="text" name="email" value="<?php echo $email?>" placeholder="Email Address" class="form-control">
                            <i class="zmdi zmdi-email"></i>
                        </div>

                        <span class="error"><?php echo $contactNoErr; ?></span>
                        <div class="form-wrapper">
                            <input type="text" name="contactNo" value="<?php echo $contactNo?>" placeholder="Contact Number" class="form-control">
                            <i class="zmdi zmdi-phone"></i>
                        </div>

                        <span class="error"><?php echo $unameErr; ?></span>
                        <div class="form-wrapper">
                            <input type="text" name="uname" value="<?php echo $uname?>" placeholder="Username" class="form-control">
                            <i class="zmdi zmdi-account"></i>
                        </div>

                        <span class="error"><?php echo $passwordErr; ?></span>
                        <div class="form-wrapper">
                            <input type="password" value="" name="password" placeholder="Password" class="form-control">
                            <i class="zmdi zmdi-lock"></i>
                        </div>

                        <span class="error"><?php echo $cunfirmPassErr; ?></span>
                        <div class="form-wrapper">
                            <input type="password" name="confirmPass" placeholder="Confirm Password" class="form-control">
                            <i class="zmdi zmdi-lock"></i>
                        </div>
                        <div class="remember-forgot">
                            <label class="text-white"><input type="checkbox" required> I agree to the terms & conditions</label>
                        </div>

                        <button type="submit" name="btnCreate">Register
                            <i class="zmdi zmdi-arrow-right"></i>
                        </button>
                    </form>
                </div>
            </div>
        
    </div>
</div>

<style>
    .banner_section {
        padding: 20px;
    }

    .inner {
        position: relative;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .image-holder img {
        height: 100%;
        border-radius: 5%;
    }

    .form-wrapper {
        margin-bottom: 10px;
    }

    button[type="submit"] {
        margin-top: 10px;
        padding: 10px 20px;
        background-color: #333;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    /* Responsive Styles */

    @media only screen and (max-width: 768px) {
        .banner_section {
            padding: 10px;
        }
    }

    @media only screen and (max-width: 480px) {
        .banner_section {
            padding: 5px;
        }

        .inner {
            top: 5%;
            height: 90%;
        }

        .form-wrapper input,
        button[type="submit"] {
            font-size: 14px;
        }
    }

    .banner_section {
    width: 100%;
    float: left;
    background-image: url(../cover/cover1.jpg);
    height: auto;
    background-size: 100%;
    padding: 10px 0px 25px 0px;
    background-repeat: no-repeat;
}
</style>


			<!-- Footer -->
	<footer
			class="text-center text-lg-start text-dark"
			style="background-color: #ECEFF1"
			>
	  <!-- Section: Social media -->
	  <section
			   class="d-flex justify-content-between p-4 text-white"
			   style="background-color: #6D0F0F"
			   >
		<!-- Left -->
		
		<!-- Right -->
	  </section>
	  <!-- Section: Social media -->
	  <?php 
			    $view_product_query = mysqli_query($connections, "SELECT * FROM maintinance");
				while ($maitinance_row = mysqli_fetch_assoc($view_product_query)) {
				   $db_system_id = $maitinance_row["system_id"];
				   $db_system_name = $maitinance_row["system_name"];
				   $db_system_banner = $maitinance_row["system_banner"];
				   $db_system_logo	 = $maitinance_row["system_logo"];
				
				   $db_system_address = $maitinance_row["system_address"];
				   $db_system_contact= $maitinance_row["system_contact"];
				   $db_system_tax = $maitinance_row["system_tax"];

			?>
	  <!-- Section: Links  -->
	  <section class="">
		<div class="container bg text-center text-md-start mt-5">
		  <!-- Grid row -->
		  <div class="row mt-3">
			<!-- Grid column -->
			<div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
			  <!-- Content -->
		
				  <h6 class="text-uppercase fw-bold">ADDRESS</h6>
			  <hr
				  class="mb-4 mt-0 d-inline-block mx-auto"
				  style="width: 60px; background-color: #6D0F0F; height: 2px"
				  />
			  <p><i class="fas fa-home mr-3"></i> <?php echo $db_system_address?></p>
			</div>
			<!-- Grid column -->
  
			<!-- Grid column -->
			<div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
			  <!-- Links -->
			 
			</div>
			<!-- Grid column -->
  
			<!-- Grid column -->
			<div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
			  <!-- Links -->
			
			  
			</div>
			<!-- Grid column -->
  
			<!-- Grid column -->
			
			<div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
			  <!-- Links -->
			  <h6 class="text-uppercase fw-bold">CONTACT</h6>

<hr
	class="mb-4 mt-0 d-inline-block mx-auto"
	style="width: 60px; background-color: #6D0F0F; height: 2px"
	/>
	<p><i class="fas fa-phone mr-3"></i> <?php echo  $db_system_contact?></p>
			 
		
			 
			</div>
			<?php }?>
			<!-- Grid column -->
		  </div>
		  <!-- Grid row -->
		</div>
	  </section>
	  <!-- Section: Links  -->
  
	  <!-- Copyright -->
	  <div
		   class="text-center p-3 text-light"
		   style="background-color: #6D0F0F"
		   >
		© 2023 Copyright:
		<a class="text-light text-decoration-none" href="#"><?php echo $db_system_name ?></a
		  >
	  </div>
	  <!-- Copyright -->
	</footer>
	<!-- Footer -->
  </div>
  
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <!-- footer section end -->
    <!-- Javascript files-->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/plugin.js"></script>
    <!-- sidebar -->
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
	</body>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</html>