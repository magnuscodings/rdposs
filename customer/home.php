<?php 

include("backend/back_navbar.php");
include "backend/session.php";

if(isset($_SESSION["acc_id"])){
    $acc_id = $_SESSION["acc_id"];
    
    $get_record = mysqli_query ($connections,"SELECT * FROM account where acc_id='$acc_id' ");
    $row = mysqli_fetch_assoc($get_record);
    $acc_type = $row ["acc_type"];
    if($acc_type =="administrator"){
             //redirect administrator
             echo "<script>window.location.href='../administrator/'</script>";	
 }else if($acc_type =="delivery person"){
             //redirect administrator
                echo "<script>window.location.href='../delivery/';</script>";	      
       
      }else if($acc_type =="cashier"){
        //redirect administrator
           echo "<script>window.location.href='../POS/';</script>";	      
  }
 }
?>
<!DOCTYPE html>
<html>

<head>
      <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title><?php echo $db_system_name ?></title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>    
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/cart.css">
	<link rel="stylesheet" href="css/products.css">
</head>

<style>

.navbar{
  background-color: #6D0F0F;

    padding: 1.5%;
}



body{

background-color: #F2F2F2;


}

.notification-count {
    display: inline-block;
    background-color: yellow;
    color: black;
    font-weight: bold;
    padding: 2px 6px;
    border-radius: 50%;
    width: 20px; /* Adjust width to desired size */
    height: 20px; /* Adjust height to desired size */
    text-align: center;
    line-height: 15px; /* Adjust line-height to vertically center align */
}


</style>
<body>
<?php 
$sql = mysqli_query($connections, "
SELECT COUNT(DISTINCT a.cart_prod_id) AS count_rows, SUM(a.cart_prodQty) AS qtys 
FROM cart AS a  
WHERE a.cart_user_id='{$_SESSION['acc_id']}'
");
$row = mysqli_fetch_assoc($sql);
$count = $row['count_rows'];
$items = $row['qtys'];
?>
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <a class="navbar-brand" href="home.php"><img src="../upload_system/<?php echo $db_system_logo ?>" alt="" width="50" height="40"><?php echo $db_system_name ?></a>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="products.php">Products</a>
                </li>
				<li class="nav-item">
                    <a class="nav-link" href="cart.php">                        
                        Cart<span class="shopping-cart-icon">
                            <i class="fa fa-shopping-cart"></i>
                            <span class="notification-count"><?php echo $count;?></span>
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="myOrders.php">My Orders</a>
                </li>
          
                <li class="nav-item">
                    <a class="nav-link" href="faq.php">FAQs</a>
                </li>
				<li class="nav-item dropdown" style='background-color:rgb(0,0,0,0.5); border-radius:10px;'>
				
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<?php if($db_emp_image){ ?>
				<img src="../upload_img/<?php echo $db_emp_image ?>" alt="" width="35" height="30" style='border-radius:50%;'>    <?php echo ucfirst($db_acc_lname) ?>
			  <?PHP }else{?>
				<img src="../upload_system/empty.png" alt="" width="30" height="30">    <?php echo ucfirst($db_acc_lname) ?>
			
			 <?php } ?>
			</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="#">View Profile</a>
					<a class="dropdown-item" href="#">Account Setting</a>
					<a class="dropdown-item" href="backend/logout.php">Logout</a>
				</div>
			</li>
            </ul>
        </div>
    </div>
</nav>


 

 <!-- Carousel -->
<div id="demo" class="carousel slide" data-bs-ride="carousel">
  <h1 class="featured">Featuring Products</h1>
  
  <!-- The slideshow/carousel -->
  <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="3000">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="../upload_system/<?php echo $db_system_banner ?>" style="width:50%;" alt="Los Angeles" class="d-block">
        <div class="carousel-caption">
          <h3><?php echo $db_system_name ?></h3>
          <!-- <p>A steak that you won't like to miss!</p>-->
        </div>
      </div>
      
      <?php 
      $view_product_query = mysqli_query($connections, "SELECT * FROM product WHERE prod_status = '0'");
      while ($product_row = mysqli_fetch_assoc($view_product_query)) {
        $db_prod_id = $product_row["prod_id"];
        $db_prod_name = $product_row["prod_name"];
        $db_prod_image = $product_row["prod_image"];
        $db_prod_currprice = $product_row["prod_currprice"];
        $db_prod_description = $product_row["prod_description"];
      ?>
      
      <?php if($db_prod_image){?>
      <div class="carousel-item">
        <img src="../upload_prodImg/<?php echo $db_prod_image ?>" alt="Chicago" class="d-block">
        <div class="carousel-caption">
          <h2><?php echo $db_prod_name?></h2>
          <h3><?php echo "&#8369; ",number_format($db_prod_currprice, 2, '.', ',') ?></h3>
          <p><?php echo $db_prod_description?></p>

        </div> 
      </div>
      <?php
      }
    } ?>
    
  </div>

  <!-- Left and right controls/icons -->
  <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>



  
  <!-- end -->
  
<!-- <div class="container my-5"> -->
	<!-- Footer -->
  <br><br><br><br>
	<footer
			class="text-center text-lg-start text-dark"
			style="background-color:#F2F2F2;";
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
		   style="background-color: #6D0F0F;
"
		   >
		© 2023 Copyright:
		<a class="text-light text-decoration-none" href="#"><?php echo $db_system_name ?></a>
	  </div>
	  <!-- Copyright -->
	</footer>
	<!-- Footer -->
  </div>
  <!-- End of .container -->
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>

</html>
	