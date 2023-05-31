<?php 
include("backend/session.php");
include("backend/back_navbar.php");


$url_category_id=$_GET["db_category_id"];
?>
<!DOCTYPE html>
<html>
<style>
</style>
<head>
	<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title><?php echo $db_system_name?></title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/cart.css">
	<link rel="stylesheet" href="css/products.css">
	<link rel="stylesheet" href="css/newproduct.css">
</head>
<style>


body{

	background-color: #F2F2F2;


}
.navbar{
    background-color: #dd3434e8;
    padding: 1.5%;
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
$sql = mysqli_query($connections, "SELECT COUNT(*) as count_rows, SUM(a.cart_prodQty) as qtys FROM cart as a  
WHERE a.cart_user_id='{$_SESSION['acc_id']}'");
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
                    <a class="nav-link" aria-current="page" href="home.php">Homepage</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="products.php">Products</a>
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
					<img src="../upload_system/empty.png" alt="" width="30" height="30">     <?php echo ucfirst($db_acc_lname) ?>
                
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

  <!-- Header-->
  <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
				
                    <h1 class="display-4 fw-bolder">
					<img src="../upload_system/<?php echo $db_system_logo ?>" alt="" width="150" height="140">
						<?php echo $db_system_name ?></h1>
                   
                </div>
            </div>
        </header>

<div class="container con-1">
	<div class="row">
		<div class="col-md-2">
		<select name="" id="categorySelect" class="sel text-center mb-3 text-warning fw-bold rounded-pill" onchange="location = this.value;">
    <option value="">Select Categories</option>
	<option value="products.php" >All Products</option>
    <?php

    $view_product_query = mysqli_query($connections, "SELECT * FROM category");
    while ($category_row = mysqli_fetch_assoc($view_product_query)) {
        $db_category_id  = $category_row["category_id"];
        $db_category_name = $category_row["category_name"];
    ?>
    <option value="category.php?db_category_id=<?php echo $db_category_id?>" ><?php echo $db_category_name ?></option>  
	<?php }?>
</select>
		</div>
		<center>		
		<div class="col-md-4">
		
		<h2><?php 
		$get_record_unit = mysqli_query ($connections,"SELECT * FROM category where category_id ='$url_category_id' ");
		$row_unit = mysqli_fetch_assoc($get_record_unit);
	echo $category_name = $row_unit["category_name"];
		?></h2>
		
		</div>
		</center>
	</div>
	<br>
	<div class="row">
	<?php

   $view_product_query = mysqli_query($connections, "SELECT *, SUM(b.s_amount) as prod_stocks
	FROM product as a
	LEFT JOIN stocks as b
	ON a.prod_id = b.s_prod_id
   WHERE prod_status = '0' AND prod_category_id = '$url_category_id'");
               
				
				  while ($product_row = mysqli_fetch_assoc($view_product_query)) {
                     $db_prod_id = $product_row["prod_id"];
                     $db_prod_name = $product_row["prod_name"];
                     $db_prod_orgprice = $product_row["prod_orgprice"];
                     $db_prod_currprice = $product_row["prod_currprice"];
                     $db_prod_stocks = $product_row["prod_stocks"];
                     $db_prod_unit = $product_row["prod_unit_id"];
                    $db_prod_category = $product_row["prod_category_id"];
                     $db_prod_description = $product_row["prod_description"];
                     $db_prod_image = $product_row["prod_image"];		
					 
					 $get_record_unit = mysqli_query ($connections,"SELECT * FROM unit where unit_id ='$db_prod_unit' ");
					$row_unit = mysqli_fetch_assoc($get_record_unit);
					$unit_name = $row_unit["unit_name"];

                    
	?>
	<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
		
	  <form method="POST" action="addcart.php">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add to cart</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
		<input type="text" id="id" name="id">

		<?php
		 ?>
        <input type="number" name="qty" required class="form-control" min="1" placeholder="How many <?php echo $unit_name ?> ?">							
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="add" class="btn btn-primary">Cunfirm</button>
      </div>
	  	</form>
    </div>
  </div>
</div>
<!--START--->
<!--END MODAL-->
	
	<?php
			if($db_prod_image){
	?>
		<div class="col-md-3 product">
			<div class="card">

			<img src="../upload_prodImg/<?php echo  $db_prod_image ?>" alt="drinks1">
				<h5><?php echo $db_prod_name ?></h5>
				<h6></h6>
				<input type="text" class="form-control" id="exampleTextField" value="&#8369; <?php  echo number_format($db_prod_currprice, 2, '.', ',') ?>" disabled style="border-radius:30px;">
		
				<button class="btn btn-warning rounded-pill " onclick="view_product(<?= $db_prod_id ?>)">                  
        View product
	</button>

	<script>
function view_product(id) {
  // JavaScript code here
  // Redirect to a specific URL
  window.location.href = "view_product.php?view_id=" + id;
  // or perform other actions onclick="view_product()"
}
</script>


				<button class="btn btn-warning rounded-pill togler" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="<?= $db_prod_id ?>">Add to Cart</button>
					</div>
		</div>
	<?php }else{
?>
			<div class="col-md-3 product">
						<div class="card">
						<?php if($db_prod_image){ ?>
      <img src="../upload_prodImg/<?php echo $db_prod_image ?>" alt="drinks1">
    <?php }else{ ?>
      <img src="../assets/img/1599802140_no-image-available.png" alt="" style="width: 80%; height: 80%;">
    <?php } ?>

							<h5><?php echo $db_prod_name ?></h5>
							<input type="text" class="form-control" id="exampleTextField" value="&#8369; <?php  echo number_format($db_prod_currprice, 2, '.', ',') ?>" disabled style="border-radius:30px;">
		
							<button class="btn btn-warning rounded-pill " onclick="view_product(<?= $prod_id ?>)">                  
        View product
	</button>

	<script>
function view_product(id) {
  // JavaScript code here
  // Redirect to a specific URL
  window.location.href = "view_product.php?view_id=" + id;
  // or perform other actions onclick="view_product()"
}
</script>

							
							<button class="btn btn-warning rounded-pill togler" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="<?= $db_prod_id ?>">Add to Cart</button>
						</div>
					</div>
<?php 
					} 
					
					}
	 ?>	
	</div>
	<br><br>
</div>
</body>
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
  <!-- End of .container -->
</body>

</html>
<script>
	$('.togler').click(function(){
		id = $(this).attr('data-id')
		$('#id').val(id).hide()
	})
</script>