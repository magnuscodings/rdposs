<?php
include("../administrator/connection.php");
include("back_cunfirmAcc.php");


include("../customer/backend/back_navbar.php");


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $db_system_name ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <!-- owl stylesheets -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
        media="screen">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <style>

        
        @media (max-width: 576px) {
            body {
                background-image: none;
            }
        }

        .max-height-30 {
            max-height: 60vh;
        }
    </style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <a class="navbar-brand" href="index.php"><img src="../upload_system/<?php echo $db_system_logo ?>" alt="" width="50" height="40"><?php echo $db_system_name ?></a>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="index.php">Homepage</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="products.php">Products</a>
                </li>
				<li class="nav-item">
                    <a class="nav-link" aria-current="page" href="about.php">About us</a>
                </li>
                
                
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                
            </ul>
        </div>
    </div>
</nav>

    <style>

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
    <!-- banner section start -->
    <!-- banner section start -->
    <?php
$accid=$_GET['accid'];
$view_product_query = mysqli_query($connections, "SELECT * FROM account WHERE acc_id = '$accid'");
$product_row = mysqli_fetch_assoc($view_product_query);

if ($product_row) {
    $db_acc_id  = $product_row["acc_id"];
    $db_acc_email= $product_row["acc_email"];
    $db_acc_otp= $product_row["Otp"];
}
?>
    <div class="banner_section layout_padding">
    <div class="container">
        <div id="main_slider" class="carousel slide" data-ride="carousel">
       
        <form method="POST">
        
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-md-6 mx-auto"> <!-- Added "mx-auto" class to center the column -->
                            <div class="card text-center login-card">
                                <div class="card-body">
                                    <div class="mb-5">
                                   

                                        <h1 class="login-heading">CONFIRM ACCOUNT</h1> <!-- Corrected spelling of "CONFIRM" -->
                                    </div>


                                    <div class="mb-3">
                                        <label style='float:left;'>Enter OTP on your email: <b><?php echo $db_acc_email?></b></label>
                                        <input type="text" class="form-control" placeholder="Enter One Time Pin" value='<?php echo $EnterOtp?>' name="EnterOtp">
                                        <span class="error"><?php echo $EnterOtpErr?></span>
                                    </div>
                                
                                    <div class="d-grid gap-2 col-12 mx-auto mb-3">
                                        <button class="btn btn-success" type="submit" name="btnSendOtp">SEND</button> 
                                    </div>
                                    <div class="mb-3 text-primary">
                                        <a class="nav-link" href="back_resendOtp.php?accid=<?php echo$accid ?>">Resend Otp</a>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
       
        </div>
    </div>
</div>



	<!-- Footer -->
	<footer
			class="text-center text-lg-start text-dark"
			style="background-color: #ECEFF1"
			>
	  <!-- Section: Social media -->
	  <section
			   class="d-flex justify-content-between p-4 text-white"
			   style="background-color: #d12130"
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
				  style="width: 60px; background-color: #7c4dff; height: 2px"
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
	style="width: 60px; background-color: #7c4dff; height: 2px"
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
		   style="background-color: #d12130"
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

</html>
