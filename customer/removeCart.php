
<?php 
include "../administrator/connection.php";
$productId=$accountId=$myCheckbox='';


?>

<?php
if (isset($_POST['btnRemoveAll'])) {
    if (!empty($_POST['myCheckbox'])) {
        $checkboxes = $_POST['myCheckbox'];
        $checkboxes = array_map('intval', $checkboxes);
        $checkboxesStr = implode(',', $checkboxes);

        // Perform the delete query
        $deleteQuery = "DELETE FROM cart WHERE cart_prod_id IN ($checkboxesStr)";
        $result = mysqli_query($connections, $deleteQuery);

        if ($result) {
            // Deletion successful
            // You can redirect to the cart page or display a success message
            echo "<script>window.location.href = 'cart.php';</script>";
        } else {
            // Deletion failed
            // You can display an error message or handle it as needed
            echo "Failed to delete items from the cart.";
        }
    }
}
//btnCheckOut

if (isset($_POST['btnCheckOut'])) {
    if (!empty($_POST['myCheckbox'])) {
        $checkboxes = $_POST['myCheckbox'];
        $checkboxes = array_map('intval', $checkboxes);
        $checkboxesStr = implode(',', $checkboxes);

    

      
            ?>
            


            <?php 
include("backend/session.php");
include("backend/back_navbar.php");
?>
<!DOCTYPE html>
<html>
<style>
</style>
<head>
   
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Place order</title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/cart.css">

</head>
<style>

.navbar{
    background-color:#6D0F0F;
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
                    <a class="nav-link" aria-current="page" href="home.php">Home</a>
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

  <!-- header -->
<form action="back_ordering.php" method="POST">
    <div class="container">
		<div class="my-3">
			<div class="card rounded-0 shadow">
				<div class="card-body">
					<div class="container-fluid">
						<div class='row'>
                            
							<div class="col-md-6 lh-1">
                                <?php                 

                                   /**
                    
                                  * 
                                  
                                  */
                                date_default_timezone_set('Asia/Manila');
                                $currentDateTime = date('Y-m-d g:i A');
                                ?>
                            <h3>Date</h3>
								<p class="mb-1"><?php echo $currentDateTime;?></p>
				
                                <br>
                                <p class="mb-1">
                                <input type="hidden" class="form-control" name="customer_id" value="<?php echo $db_acc_id?>"  style="width:250;" required>
                               </p>

                               <p class="mb-1"><strong>Nickname on your street?</strong>:
                                <input type="text" class="form-control" name="nickname" value="<?php echo ucfirst($db_acc_fname)?>" placeholder="Item Name" style="width:250;" required>
                               </p>
                               <p class="mb-1"><strong>Contact</strong>:
                                <input type="text" class="form-control" name="contact" value="<?php echo $db_acc_contact?>" placeholder="Item Name" style="width:250;" required>
                               </p>
								<h3>Delivery Address</h3>
								<p class="mb-1">
                            <div class="mb-3">

                        <textarea name="deliveryaddress" class="form-control" rows="3" placeholder="Enter Address" style="width:250;" required></textarea>

                            </div></p>

								
								<p class="mb-1"><strong>Email</strong>:
                                <input type="text" class="form-control" name="email" value=" <?php echo $db_acc_email?>" placeholder="Email" style="width:250;" required>
                                </p>
								
							</div>
							<div class="col-md-6 lh-1">
    <h3>Order Summary</h3>
    <select class="form-select" id="discount-select" onchange="updateDiscountName()" aria-label="Default select example" style="width:250">
        <option   selected>Select Discount Voucher</option>
        <?php 
        date_default_timezone_set('Asia/Manila');
        $currentDateTime = date('Y-m-d H:i:s');
    
        $view_query = mysqli_query($connections, "SELECT * FROM voucher WHERE voucher_expiration >= '$currentDateTime' AND voucher_maximumLimit >= 1 ");
        while($row = mysqli_fetch_assoc($view_query)){ 
            $voucher_id = $row["voucher_id"];
            $db_voucher_name = $row["voucher_name"];
            $db_voucher_discount = $row["voucher_discount"];
            $db_voucher_discount_percent = $db_voucher_discount/100;

            $db_voucher_created = $row["voucher_created"];
            $db_voucher_expiration = $row["voucher_expiration"];
            $db_voucher_maximumLimit = $row["voucher_maximumLimit"];
            $db_voucher_status = $row["voucher_status"];
            ?>
            <option  value="<?= $db_voucher_discount_percent ?>"><?= $db_voucher_name ?></option>
        <?php } ?>
    </select>

    <br><br>

    <?php
    $view_query = mysqli_query($connections, "SELECT * FROM cart WHERE cart_prod_id IN ($checkboxesStr)");
    $total_bill = 0;
    while ($row = mysqli_fetch_assoc($view_query)) {
        $db_cart_id = $row["cart_id"];
        $db_cart_prod_id = $row["cart_prod_id"];
        $db_cart_user_id = $row["cart_user_id"];
        $db_cart_prodQty = $row["cart_prodQty"];

        $get_product_record = mysqli_query($connections, "SELECT * FROM product WHERE prod_id='$db_cart_prod_id'");
        $row_product = mysqli_fetch_assoc($get_product_record);
        $db_prod_id = $row_product["prod_id"]; 
        $db_prod_name = $row_product["prod_name"]; 
        $db_prod_currprice = $row_product["prod_currprice"]; 
        $db_prod_unit_id = $row_product["prod_unit_id"]; 
        $db_prod_image = $row_product["prod_image"]; 
        $db_prod_category_id = $row_product["prod_category_id"]; 

        $get_unit_record = mysqli_query($connections, "SELECT * FROM unit WHERE unit_id='$db_prod_unit_id'");
        $row_unit = mysqli_fetch_assoc($get_unit_record);
        $db_unit_id = $row_unit["unit_id"]; 
        $db_unit_name = $row_unit["unit_name"]; 

        $total_price = $db_prod_currprice * $db_cart_prodQty; // Calculate total price for the product
        $total_bill += $total_price; // Add the total price to the total bill

        $get_taxt_value=$db_system_tax*$total_bill;
        $subtotal=$total_bill+$get_taxt_value;
        
        ?>
        <input type="hidden" value="<?php echo $db_cart_id ?>" name="cart_id[]">
        <input type="hidden" value="<?php echo $db_acc_id ?>" name="acc_id[]">
        <input type="hidden" value="<?php echo $db_prod_id ?>" name="prod_id[]">
        <input type="hidden" value="<?php echo $db_prod_currprice ?>" name="prod_currprice[]">
        <p class="mb-2"><strong>Items</strong>: <?php echo $db_prod_name ?></p>
        <p class="mb-2"><strong>Price</strong>: <?php echo $db_prod_currprice ?></p>
        <p class="mb-2"><strong>Quantity</strong>: <?php echo $db_cart_prodQty ?></p>
       
        <hr>
        <p class="mb-2"><strong>Total</strong>:<span>&#8369;</span> <?php echo number_format($total_price, 2, '.', ',') ?></p>
        <hr>
        <input type="hidden" value="<?php echo $db_cart_prodQty ?>" name="db_cart_prodQty[]">
        <input type="hidden" value="<?php echo $total_price ?>" name="total_price[]">
    <?php } ?>
   
    <center><p class="mb-4"><strong>Subtotal</strong>:<span>&#8369;</span> <span id="order-total"><?php echo number_format($total_bill, 2, '.', ',') ?></span></p></center>
    <center><p class="mb-4"><strong>VAT</strong>(<?php echo ($db_system_tax*100) ?>%) :<span>&#8369;</span><?=number_format($get_taxt_value,2)?> </p></center>
   
    <center><p class="mb-4"><strong>Shipping fee</strong>:<span>&#8369;</span> <?php echo number_format($db_system_shipfee, 2) ?></p></center>
    <hr>
    <center>
         <p class="mb-4" hidden><strong>Voucher name: </strong><span id="discountnameTxt"></span></p>
        
    </center>
    <center>
        <p class="mb-4"><strong>Total order</strong>:<span>&#8369;</span> <span id="total_amount"> <?php echo number_format($order_final= $subtotal + $db_system_shipfee, 2, '.', ',') ?></span></p>
        
    </center>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function updateDiscountName() {
        
        var selectedVoucher = $("#discount-select option:selected").text();
        $("#discountnameTxt").text(selectedVoucher);
        $("#discountnameTxt").parent().removeAttr('hidden'); // Show the voucher name element
    }

    $(document).ready(function() {
    $('#discount-select').change(function() {
        var selectedDiscount = $(this).val();
     


        var totalAmount = <?php echo $subtotal + $db_system_shipfee; ?>;
        if (selectedDiscount !== 'Select Discount Voucher') {
            var GetdiscountAmount = totalAmount * selectedDiscount;
            var discountedAmount = totalAmount - GetdiscountAmount;
          
          $('#GetdiscountAmount').text(GetdiscountAmount.toFixed(2));
            $('#total_amount').text(discountedAmount.toFixed(2));
            $("#discountnameTxt").parent().removeAttr('hidden');
            
            
           
          

        } else {
            $('#total_amount').text(<?php echo $order_final ?>);
            $("#discountnameTxt").parent().attr('hidden', true);
        }
    });
});


</script>


					</div>
				</div>
				<div class="card-footer py-1">
					<div class="row justify-content-center">
						<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
							<div class="d-grid">
                <button type="button" class="btn btn-dark placeOrder" data-bs-toggle="modal" data-bs-target="#exampleModal">
               Place Order
</button>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">[Payment] Transaction</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       
        <select name="paymethod" class="form-control mt-2" title="Select payment option" required>
            <option value="">Payment option</option>
            <option value="Cash on Delivery">Cash on Delivery</option>
            <option value="Gcash">Gcash</option>
        </select>
        <input type="hidden" name="ship_fee" value='<?php echo number_format($db_system_shipfee,2)?>'>
        
        
        <input type="hidden" class="form-control mt-2" id="order_id" name="ssid" required>
        <input type="hidden" id="discount-name-placeOrder" name="discountname">
     
        <input type="hidden" id="discount-rate-placeOrder" name="discountrate">
        <input type="hidden" value="<?php echo $db_system_tax?>" name="orders_tax">

        
    </div>



		<div class="modal-footer">
			<button type="submit" name="btnCunfirm" class="btn btn-danger">Confirm</button>
			<button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">No</button>
		</div>
	 
    </div>
  </div>
</div>
</div>
</form>


</body>
<script>
 $(document).ready(function() {
    $('.placeOrder').click(function() {
        var selectedDiscountName = $('#discount-select option:selected').text();
        var selectedDiscountRate = $('#discount-select option:selected').val() * 100;

        if (selectedDiscountName === 'Select Discount Voucher') {
            selectedDiscountName = '';
            selectedDiscountRate = '';
        }

        $('#discount-name-placeOrder').val(selectedDiscountName);
       // $('#discountnameTxt').text(selectedDiscountName);
        $('#discount-rate-placeOrder').val(selectedDiscountRate);

        var orderTotal = document.getElementById("total_amount").innerText;
        $('#orderTotal').val(orderTotal);
    });
});

</script>
</html>











            
            <?php
        

        
    }
}
?>


