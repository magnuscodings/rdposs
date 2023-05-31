<?php
 include("../customer/backend/back_navbar.php");
include "navbar.php";

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
   
    <title><?php echo $db_system_name?></title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/cart.css">
	<link rel="stylesheet" href="css/products.css">
	

</head>
<style>


body{

	background-color: #F2F2F2;


}
.navbar{
    background-color: #d12130;
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

  .button-container {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 20px;
  }

</style>

<body >
<main>




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
	
<div class="col-md-3 col-sm-6 product <?= $db_prod_category ?> categprod<?=$db_prod_category?>" data-name="<?= $db_prod_name ?>">
  <div class="card" style="background-color:white; border-color:gray;">
    <?php if($db_prod_image){ ?>
      <img src="../upload_prodImg/<?php echo $db_prod_image ?>" alt="drinks1">
    <?php }else{ ?>
      <img src="../assets/img/1599802140_no-image-available.png" alt="" style="width: 80%; height: 80%;">
    <?php } ?>
    <h5>
      <a href="#" class="title prodTitle" id="prod,<?=$db_prod_id?>" >
        <b><?php echo $db_prod_name?></b>
      </a>
    </h5>
    <h6 style='color:black;'>Stocks: <?php echo $db_prod_stocks?></h6>
    <?php if($db_prod_stocks >= 1){ ?>
      <h6 class="text-success">AVAILABLE</h6>
    <?php }else{ ?>
      <h6 class="text-danger">NOT AVAILABLE</h6>
    <?php } ?>

    <input type="text" class="form-control" id="exampleTextField" value="&#8369; <?php echo number_format($db_prod_currprice, 2, '.', ',') ?>" disabled style="border-radius:10px; width:100%; text-align:center;">
<center>
    <button style='color:#000; background-color:#ffc107; border-color:#ffc107;' class="btn btn-warning rounded-pill" onclick="view_product(<?= $db_prod_id ?>)">
      View product
    </button>
</center>
    <script>
      function view_product(id) {
        window.location.href = "view_product.php?view_id=" + id;
      }

	  function login() {
        window.location.href = "login.php";
      }
    </script>

    <?php if($db_prod_stocks >= 1){ ?>
<center>
		<button onclick="login()" style='color:#000; background-color:#ffc107; border-color:#ffc107;' class="btn btn-warning rounded-pill togler" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="<?= $db_prod_id ?>" data-unit_name="<?= $unit_name ?>">
        Add to Cart
        <i class="fa fa-shopping-cart"></i>
      </button>
</center>
    <?php } ?>
  </div>
</div>
<?php } ?>
</div>
<br><br>
</div>
</main>


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


