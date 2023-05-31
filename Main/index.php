<?php 

include("../customer/backend/back_navbar.php");
include "navbar.php";



include ("../administrator/connection.php");
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
			 echo "<script>window.location.href='../customer/login.php'</script>";	
		  }
 }
?>
<!DOCTYPE html>
<html>
<style>
</style>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $db_system_name ?></title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/cart.css">
	<link rel="stylesheet" href="css/products.css">
</head>
<body>


 

  <!-- Carousel -->
  <div id="demo" class="carousel slide" data-bs-ride="carousel">
    <h1 class="featured">Featuring Products</h1>
    <!-- Indicators/dots -->
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
      <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
      <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
    </div>
    
    <!-- The slideshow/carousel -->
    <div class="carousel-inner">
      <div class="carousel-item active">
         <img src="../upload_system/<?php echo $db_system_banner?>" alt="New York" class="d-block">
        <div class="carousel-caption">
          <h3>Junior Round Cakes</h3>
          <p>A Cake that you won't like to miss !</p>
        </div>
      </div>
      <div class="carousel-item">
	  <img src="../upload_system/<?php echo $db_system_banner?>" alt="New York" class="d-block">
        <div class="carousel-caption">
          <h3>Dedication Cake</h3>
          <p>The most precious Cake in Italy, that is made just for you</p>
        </div> 
      </div>
      <div class="carousel-item">
        <img src="../upload_system/<?php echo $db_system_banner?>" alt="New York" class="d-block">
        <div class="carousel-caption">
          <h3>Roll Cakes</h3>
          <p>Eat this and you will forget your name.</p>
        </div>  
      </div>
    </div>
    
    <!-- Left and right controls/icons -->
    <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>
  
  <!-- end -->
  <div class="container con-1">
    <h1>Our Products</h1>
	<div class="row">
   <?php
                  $view_product_query = mysqli_query($connections, "SELECT * FROM product WHERE prod_status = '0'");
                  while ($product_row = mysqli_fetch_assoc($view_product_query)) {
                     $db_prod_id = $product_row["prod_id"];
                     $db_prod_name = $product_row["prod_name"];
                     $db_prod_orgprice = $product_row["prod_orgprice"];
                     $db_prod_currprice = $product_row["prod_currprice"];
            
                     $db_prod_unit = $product_row["prod_unit_id"];
                     $db_prod_category = $product_row["prod_category_id"];
                     $db_prod_description = $product_row["prod_description"];
                     $db_prod_image = $product_row["prod_image"];
					 
			if($db_prod_image){?>
		<div class="col-md-3 product">
			<div class="card">
				<img src="../upload_prodImg/<?php echo $db_prod_image ?>" alt="<?php echo  $db_prod_name?>">
				<h5><?php echo  $db_prod_name?></h5>
				<h6><?php echo  $db_prod_currprice?></h6>
				<a href="login.php" class="btn  rounded-pill">Add to Cart</a>
			</div>
		</div>
		<?php } }?>
	</div>
	
</div>

<br><br>

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
</body>
</html>
	

