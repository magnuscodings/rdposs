<?php 
include("backend/session.php");
include("backend/back_navbar.php");
include("Back_myOrders.php");

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
?>
<!DOCTYPE html>
<html>
<style>
</style>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $db_system_name ?></title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
	<link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/cart.css">
	

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
                    <a class="nav-link " aria-current="page" href="home.php">Homepage</a>
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
                    <a class="nav-link active" href="myOrders.php">My Orders</a>
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
<main>
<div id="here">
  <!-- Start delivery section -->
  <?php
 $db_order_transaction_code=""; 
$get_orderrecord = mysqli_query ($connections,"SELECT * FROM orders where orders_customer_id='".$db_acc_id."' Group by order_transaction_code ");
$row = mysqli_fetch_assoc($get_orderrecord);


if ($row !== null) {
    $db_order_transaction_code = $row["order_transaction_code"];
    $db_orders_status = $row["orders_status"];




	

  ?>
  <!-- end delivery section -->

	<!-- <div class="container"> -->
	<div class="container">
	<table class="table bg-light text-center mt-2 table-order">
		<thead>
			<tr>
				
				
				<th>Transaction Code</th>
			
			
				<th>Order Date</th>
				<th>Product Name</th>
				<th>Mode of payment</th>
				<th>Quantity</th>
				<th>Subtotal</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$view_query = mysqli_query($connections, "
			SELECT orders_id, order_transaction_code, orders_nickname, orders_email, orders_contact, orders_paymethod, orders_qty, orders_prod_id, SUM(orders_qty) as qty, SUM(orders_subtotal) as subtotal, orders_voucher_rate, orders_address, orders_date, orders_status
			FROM orders
			WHERE (orders_status ='Preparing' OR orders_status ='In-Transit' OR orders_status ='Delivered')
			AND orders_customer_id='".$db_acc_id."'
			GROUP BY orders_prod_id, order_transaction_code
			ORDER BY orders_id ASC;
		");
		
		
		
		// Create an empty array to store the combined subtotals
		$combined_subtotals = array();
		
		// Iterate through the result set
		if (mysqli_num_rows($view_query) > 0) {
			while ($row = mysqli_fetch_assoc($view_query)) {
				$orders_prod_id = $row["orders_prod_id"];
				$orders_subtotal = $row["subtotal"];
			
				// Check if the orders_prod_id exists in the combined subtotals array
				if (isset($combined_subtotals[$orders_prod_id])) {
					// If it exists, add the subtotal to the existing value
					$combined_subtotals[$orders_prod_id] += $orders_subtotal;
				} else {
					// If it doesn't exist, initialize the subtotal
					$combined_subtotals[$orders_prod_id] = $orders_subtotal;
				}
			
				// The rest of your code...
			
				$orders_id = $row["orders_id"];
				$order_transaction_code = $row["order_transaction_code"];
				$orders_nickname = $row["orders_nickname"];
				$orders_email = $row["orders_email"];
				$orders_contact = $row["orders_contact"];
				$orders_paymethod = $row["orders_paymethod"];
				$orders_qty = $row["orders_qty"];
				$db_qty = $row["qty"];
				$orders_voucher_rate = $row["orders_voucher_rate"];
				$orders_address = $row["orders_address"];
				$orders_date = $row["orders_date"];
				$orders_status = $row["orders_status"];
			
				$get_Product_info = mysqli_query($connections, "SELECT * FROM product WHERE prod_id='$orders_prod_id'");
				$product_row = mysqli_fetch_assoc($get_Product_info);
				$prod_name = $product_row["prod_name"];
				$prod_currprice = $product_row["prod_currprice"];
			
				?>
				<tr>
					
						<td><?php echo $order_transaction_code ?></td>
					
			
					
					<input type="hidden" value="<?php echo $orders_id ?>" name="orders_id">
					<td>
						<?php
						if ($orders_date !== null) {
							$dateTime = date("M j Y, g:ia", strtotime($orders_date));
							echo $dateTime;
						}
						?>
					</td>
			
					<td><?php echo $prod_name ?></td>
					<td><?php echo $orders_paymethod ?></td>
					
					<td>
						<?php 
						$get_product_record = mysqli_query($connections, "SELECT a.*, SUM(b.s_amount) AS prod_stocks
						FROM product AS a
						LEFT JOIN stocks AS b ON a.prod_id = b.s_prod_id
						WHERE a.prod_id = '$orders_prod_id'
						GROUP BY a.prod_id");
					
					$per_row = mysqli_fetch_assoc($get_product_record);
					$db_prod_stocks = $per_row["prod_stocks"];
					$db_prod_name = $per_row["prod_name"];
						?>
					<?php  if ($db_qty > $db_prod_stocks) {
						
						echo "<b style='color:red;'>OUT OF STOCKS</b>"; 

					}else{
						echo $db_qty; 
					}	
					?>
						
					<td><?php echo $orders_subtotal ?></td>
					<td><?php echo $orders_status ?></td>
					<?php if ($orders_status == "In-Transit" || $orders_status == "Delivered") { ?>
						<td>

						<button type="button" class="btn btn-success" onclick="myFunction('<?php echo $order_transaction_code ?>')">Track Orders</button>

<script>
function myFunction(order_transaction_code) {
  window.location.href = "order_progress.php?transaction_code=" + order_transaction_code;
}
</script>

						</td>

					<?php } else { ?>
						<td>
							<button type="button" class="btn btn-success zz" value="<?= $orders_prod_id ?>"
									data-value2="<?= $order_transaction_code ?>" data-bs-toggle="modal"
									data-bs-target="#exampleModal">Cancel 
							</button>
							
						</td>
					<?php } ?>
				</tr>
				<?php
			} // end while
			
				?>
				
				<?php
			}
			 
		} else {
				
			echo "<center><br><h2 class='cart-title mt-4 text-center'>My Order</h2><h1> is empty</h1></center>";
		
	}
			?>
	</tbody>
</table>
</div>

	<!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Cancel Order</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<input type="hidden" class="form-control mt-2" id="orders_id" name="orders_id" required>
					<input type="hidden" class="form-control mt-2" id="status" name="status" required>
					<h5>Are you sure you want to cancel your order?</h5>
				</div>
				<div class="modal-footer">
					<button type="button" id="cancelBtn" class="btn btn-danger">Yes</button>
					<button type="button" class="btn btn-primary" data-bs-dismiss="modal">No</button>
				</div>
			</div>
		</div>
	</div>
</div>
<br><br>
</main>

<?php
include "include/footer.php";
?>
<script>



$(document).ready(function() {
  var orderTransactionCode; // Declare a variable to store the order transaction code

  $('.zz').click(function() {
    var orderId = $(this).val();
    orderTransactionCode = $(this).attr('data-value2'); // Store the order transaction code in the variable
    $('#orders_id').val(orderId);
    $('#status').val('Cancelled');
    $('#order_transaction_code').text(orderTransactionCode); // Display the order transaction code
   // console.log("Clicked Order Transaction Code: " + orderTransactionCode); // Display the order transaction code in the console
  });

  $('#cancelBtn').click(function() {
    var orderId = $('#orders_id').val();
    var status = $('#status').val();
    var value2 = $('.zz').data('value2'); // Retrieve the value2 from the .zz button
    $.ajax({
      url: 'back_myOrders.php',
      type: 'POST',
      data: { orders_id: orderId, status: status, btncancel: true, value2: orderTransactionCode },
      success: function(response) {
        // Refresh the page
         location.reload();
        //console.log(orderId, orderTransactionCode); // Use the orderTransactionCode variable here
      },
      error: function(xhr, status, error) {
        alert('Failed to cancel the order.');
      }
    });
  });
});
</script>






	</div>
</div>

	

