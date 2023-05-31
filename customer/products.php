<?php 
include("backend/session.php");
include("backend/back_navbar.php");

if(isset($_SESSION["acc_id"])){
    $acc_id = $_SESSION["acc_id"];
    
    $get_record = mysqli_query ($connections,"SELECT * FROM account where acc_id='$acc_id' ");
    $row = mysqli_fetch_assoc($get_record);
    $acc_type = $row ["acc_type"];
    if($acc_type =="administrator"){
             //redirect administrator
             echo "<script>window.location.href='../administrator/'</script>";	
 } if($acc_type =="delivery person"){
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
        <meta name="description" content="" />
        <meta name="author" content="" />
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
    background-color: #6D0F0F;
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
.btn-warning{
	color:#000;
	background-color:#ffc107;
	border-color:#ffc107;
}

.search-container {
    max-width: 30%; /* Adjust the value as per your preference */
  }
</style>

<body >
<main>
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
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <a class="navbar-brand" href="home.php"><img src="../upload_system/<?php echo $db_system_logo ?>" alt="" width="50" height="40"><?php echo $db_system_name ?></a>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="home.php">Home</a>
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
					<img src="../upload_system/empty.png" alt="" width="30" height="30">    <?php echo ucfirst($db_acc_lname) ?>
                
				 <?php } ?>
				</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="viewProfile.php">View Profile</a>
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
<!---start search div---->
<br>
<div class="container">
  <h2>Search</h2>
  <form class="form-inline my-2 my-lg-0 search-container">
  <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="searchInput">
 	
  </form>
</div>
<!---end search div --->
<section class="py-5">  <div class="container px-4 px-lg-5 mt-5">
      <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
		<div class="col-md-2">
		<select name="" id="categorySelect" class="sel text-center mb-3 text-warning fw-bold rounded-pill">
    <option value="" disabled>Select Categories</option>
	<option class="nav-link show" data-id="all">All Products</option>
    <?php
    $view_product_query = mysqli_query($connections, "SELECT * FROM category");
    while ($category_row = mysqli_fetch_assoc($view_product_query)) {
        $db_category_id  = $category_row["category_id"];
        $db_category_name = $category_row["category_name"];
    ?>
    <option class="nav-link hatdog" data-id="<?=$db_category_id?>"><?php echo $db_category_name ?></option>
   	<?php }?>
</select>

		</div>
		
		
	</div>
	
	<br>
	
	<div class="row">
		
	<?php
                  $view_category_query = mysqli_query($connections, "SELECT *, SUM(b.s_amount) as prod_stocks
				  from product as a
				  LEFT JOIN stocks as b
				  ON a.prod_id = b.s_prod_id
				  where prod_status='0'
				  GROUP BY a.prod_id");
				  while ($product_row = mysqli_fetch_assoc($view_category_query)) {
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
		<center>	How many <span id='unit_nameDisplay'></span>? </center>

		
        <input type="number" name="qty" required class="form-control" min="1" placeholder="">							
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="add" class="btn btn-primary">Cunfirm</button>
      </div>

	  
	  	</form>
		
    </div>
  </div>
  
</div>

<div class="col-md-3 col-sm-6 product <?= $db_prod_category ?> categprod<?=$db_prod_category?>" data-name="<?= $db_prod_name ?>">
     <div class="card" style="background-color:white; border-color:gray;">
    <?php if($db_prod_image){ ?>
      <img src="../upload_prodImg/<?php echo $db_prod_image ?>" alt="drinks1">
    <?php }else{ ?>
      <img src="../assets/img/1599802140_no-image-available.png" alt="" style="width: 80%; height: 80%;">
    <?php } ?>
    <h5><a href="#" class="title prodTitle" id="prod,<?=$db_prod_id?>" ><b><?php echo $db_prod_name?></b></a></h5>
    <h6 style='color:black;'>Stocks: <?php echo $db_prod_stocks?></h6>
	<?php if($db_prod_stocks >=1){?><h6 class="text-success">AVAILABLE</h6> <?php }else{ echo '
    <h6 class="text-danger">NOT AVAILABLE</h6> ';}?>
	

    <input type="text" class="form-control" id="exampleTextField" value="&#8369; <?php echo number_format($db_prod_currprice, 2, '.', ',') ?>" disabled style="border-radius:10px; width:100%; text-align:center;">
	

	<button
	
	style='color:#000;
	background-color:#ffc107;
	border-color:#ffc107;'

	class="btn btn-warning rounded-pill " onclick="view_product(<?= $db_prod_id ?>)">                  
        View product
	</button>

	<script>
function view_product(id) {
  
  window.location.href = "view_product.php?view_id=" + id;
 
}
</script>


	<?php
  if($db_prod_stocks >=1){
  ?>

  <button 
	style='color:#000;
	background-color:#ffc107;
	border-color:#ffc107;
	' class="btn btn-warning rounded-pill togler" data-bs-toggle="modal" data-bs-target="#exampleModal" 
	data-id="<?= $db_prod_id ?>"
	data-unit_name="<?= $unit_name ?>"
	>     
       Add to Cart
        <i class="fa fa-shopping-cart"></i></button><?php }?>

  
</div>
</div>

	
<?php 
					
					
					}
	 ?>	
	</div>
	<br><br>
</div>
</main>

<?php
include "include/footer.php";
?>

</html>
</body>
<script>


	$('.togler').click(function(){
		id = $(this).attr('data-id')
		$('#id').val(id).hide()

		unit_name = $(this).attr('data-unit_name')
		$('#unit_name').val(unit_name)

		$('#unit_nameDisplay').text(unit_name)
	})


	$('#categorySelect').change(function() {
    var selectedCategory = $(this).find(':selected').data('id');
    if (selectedCategory === 'all') {
      $('.product').show();
    } else {
      $('.product').hide();
      $('.categprod' + selectedCategory).show();
    }
  });
</script>


<script>
  document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.getElementById("searchInput");
    const products = document.querySelectorAll(".product");

    searchInput.addEventListener("input", function() {
      const searchTerm = searchInput.value.trim().toLowerCase();

      products.forEach(function(product) {
        const productName = product.dataset.name.toLowerCase();
        if (productName.includes(searchTerm)) {
          product.style.display = "block";
        } else {
          product.style.display = "none";
        }
      });
    });
  });
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


