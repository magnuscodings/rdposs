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
       
 }
 }
$view_id=$_GET["view_id"];
 $get_record = mysqli_query ($connections,"SELECT *, SUM(b.s_amount) as prod_stocks
 from product as a
 LEFT JOIN stocks as b
 ON a.prod_id = b.s_prod_id
 where prod_id='$view_id'
 GROUP BY a.prod_id ");
		$row = mysqli_fetch_assoc($get_record);
		 $db_prod_name = $row["prod_name"];
         $db_prod_currprice = $row["prod_currprice"];
         $db_prod_unit_id = $row["prod_unit_id"];
         $db_stocks = $row["prod_stocks"];
         $db_prod_category_id = $row["prod_category_id"];
         $db_prod_description = $row["prod_description"];
         $db_prod_image= $row["prod_image"];

         $get_unit = mysqli_query ($connections,"SELECT * FROM unit where unit_id ='$db_prod_unit_id' ");
         $rowunit = mysqli_fetch_assoc($get_unit);   
         $db_unit_name = $rowunit["unit_name"];    

            $get_category = mysqli_query ($connections,"SELECT * FROM category where category_id ='$db_prod_category_id' ");
            $rowcat = mysqli_fetch_assoc($get_category);   
            $db_category_name = $rowcat["category_name"];    
      
?>

<!DOCTYPE html>
<html>
<style>
    
    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      margin: 0;
    }

    main {
      flex: 1;
    }
    
    @media (max-width: 375px) and (max-height: 667px) {
  .related-products-section {
    display: none;
  }

}

  </style>
<head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="PADILLA" />   
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


</style>

<body >
    <main>
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
            <a class="navbar-brand" href="home.php">
                <img src="../upload_system/<?php echo $db_system_logo ?>" alt="" width="50" height="40"><?php echo $db_system_name ?>
            
            </a>
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
						<a class="dropdown-item" href="#">View Profile</a>
						<a class="dropdown-item" href="#">Account Setting</a>
                        <a class="dropdown-item" href="backend/logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<?php 
/* 
<?php if($db_prod_image){ ?>
      <img src="../upload_prodImg/<?php echo $db_prod_image ?>" alt="drinks1">
    <?php }else{ ?>
         80%; height: 80%;">
    <?php } ?>

     $db_prod_name = $row["prod_name"];
         $db_prod_currprice = $row["prod_currprice"];
         $db_prod_unit_id = $row["prod_unit_id"];
         $db_stocks = $row["prod_stocks"];
         $db_prod_category_id = $row["prod_category_id"];
         $db_prod_description = $row["prod_description"];
         $db_prod_image= $row["prod_image"];

         $get_unit = mysqli_query ($connections,"SELECT * FROM unit where unit_id ='$db_prod_unit_id' ");
         $rowunit = mysqli_fetch_assoc($get_unit);   
         $db_unit_name = $rowunit["unit_name"];    

            $get_category = mysqli_query ($connections,"SELECT * FROM category where category_id ='$db_prod_category_id' ");
            $rowcat = mysqli_fetch_assoc($get_category);   
            $db_category_name = $rowcat["category_name"];    
*/
?>
<section class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6"><?php if($db_prod_image){ ?><img class="card-img-top mb-5 mb-md-0" src="../upload_prodImg/<?php echo $db_prod_image ?>" alt="..." />   <?php }else{ ?> <img class="card-img-top mb-5 mb-md-0" src="../assets/img/1599802140_no-image-available.png" alt="..." />   <?php } ?></div>
                    <div class="col-md-6">
                        <div class="small mb-1"><?php if($db_stocks > 0){ ?> 
                            <h2 class="text-success">Available</h2>


                            <br>Stocks: <?php echo $db_stocks?> <?php echo ucfirst($db_unit_name); }else{ echo "<h2 class='text-danger'>Not Available</h2>";} ?></div>
                        <h1 class="display-5 fw-bolder"><?php echo $db_prod_name ?></h1>
                        <div class="fs-5 mb-5">
                           <!--- <span class="text-decoration-line-through">$45.00</span> -->
                            <span>&#8369;</span> <?php echo  number_format($db_prod_currprice, 2, '.', ',');?></span>
                        </div>
                        <p class="lead"><?php echo  $db_prod_description?></p>
                        <div class="d-flex">
                            <button class="btn btn-warning rounded-pill togler" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="<?= $view_id ?>" <?php if($db_stocks <= 0){ echo "disabled"; }?> >     
       Add to Cart
        <i class="fa fa-shopping-cart"></i></button>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Related items section-->
       
        <section class="py-5 bg-light related-products-section"> <!-- Add the 'related-products-section' class -->

            <div class="container px-4 px-lg-5 mt-5" >
                <h2 class="fw-bolder mb-4">Related products</h2>
             
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php 
       
       $view_RELATEDproduct = mysqli_query($connections, "SELECT a.*, SUM(b.s_amount) AS prod_stocks
       FROM product AS a
       LEFT JOIN stocks AS b ON a.prod_id = b.s_prod_id
       WHERE a.prod_category_id = $db_prod_category_id
       GROUP BY a.prod_id
       ORDER BY b.s_created ASC");

  
     
     while($row = mysqli_fetch_assoc($view_RELATEDproduct)){ //<-- ginagamit tuwing kukuha ng database
         
         $prod_id  = $row["prod_id"];
         $db_prod_currprice = $row["prod_currprice"];
         $db_prod_unit_id = $row["prod_unit_id"];
         $db_stocks = $row["prod_stocks"];
         $db_prod_category_id = $row["prod_category_id"];
         $db_prod_description = $row["prod_description"];
         $db_prod_image= $row["prod_image"];
         $prod_name= $row["prod_name"];

         $get_unit = mysqli_query ($connections,"SELECT * FROM unit where unit_id ='$db_prod_unit_id' ");
         $rowunit = mysqli_fetch_assoc($get_unit);   
         $db_unit_name = $rowunit["unit_name"];    

            $get_category = mysqli_query ($connections,"SELECT * FROM category where category_id ='$db_prod_category_id' ");
            $rowcat = mysqli_fetch_assoc($get_category);   
            $db_category_name = $rowcat["category_name"];    

      
     ?>
                    <div class="col mb-5" >
                        <div class="card h-100" style="color:black; background-color:white; border-color: gray;" >
                            <!-- Product image-->
                            <img class="card-img-top"<?php if($db_prod_image){ ?>src="../upload_prodImg/<?php echo $db_prod_image ?>" style='border-radius:20px;' alt="..." /><?php }else{ ?>
                                <img class="card-img-top mb-5 mb-md-0" src="../assets/img/1599802140_no-image-available.png" style='border-radius:20px;' alt="..." />
                                <?php }?>
                            <!-- Product details-->
                            <div class="card-body p-4" >
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?php echo  $prod_name?></h5>
                                    <!-- Product price-->
                                    <span>&#8369;</span> <?php echo  number_format($db_prod_currprice, 2, '.', ',');?></span>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                
                                <div class="text-center">
                                    
                                
                                <button class="btn btn-warning rounded-pill togler" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="<?= $prod_id ?>" <?php if($db_stocks <= 0){ echo "disabled"; }?> >     
       Add to Cart
        <i class="fa fa-shopping-cart"></i></button>
<br><br>
        <button class="btn btn-warning rounded-pill " onclick="view_product(<?= $prod_id ?>)">                  
        View product
	</button>

	<script>
function view_product(id) {
  
  window.location.href = "view_product.php?view_id=" + id;

}
</script>

                                </div>
                                
                            </div>
                        </div>
                    </div>
        <?php } ?>
                   
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>


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
		<input type="hidden" id="id" name="id">

		<?php
		 ?>
        <input type="number" name="qty" required class="form-control" min="1" >							
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="add" class="btn btn-primary">Cunfirm</button>
      </div>
	  	</form>
    </div>
  </div>
</div>
</main>


<?php
include "include/footer.php";
?>

</html>
</body>
<!--START--->
<!--END MODAL-->
        <script>
	$('.togler').click(function(){
		id = $(this).attr('data-id')
		$('#id').val(id).hide()
	})
</script>


<script>
  $(document).ready(function() {
    var counter = 9;
    window.setInterval(function() {
      counter = counter - 3;
      if (counter >= 0) {
        document.getElementById('off').innerHTML = counter;
      }
      if (counter === 0) {
        counter = 9;
      }
      $("#here").load(window.location.href + " #here");
    }, 3000);
  });
</script>