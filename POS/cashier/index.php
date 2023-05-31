<?php
include "connection.php";
include("checkout.php");
include("navigation.php");
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
}else{
				echo "<script>window.location.href='../';</script>";	  
	  }
 }
?>


<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="author" content="Bootstrap-ecommerce by Vosidiy">
<title><?php echo $db_system_name ?></title>
<link rel="shortcut icon" type="image/x-icon" href="../upload_system/<?php echo $db_system_logo ?>" >
<link rel="apple-touch-icon" sizes="180x180" href="../upload_system/<?php echo $db_system_logo ?>">
<link rel="icon" type="image/png" sizes="32x32" href="../upload_system/<?php echo $db_system_logo ?>">
<!-- jQuery -->
<!-- Bootstrap4 files-->
<link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css"/> 
<link href="assets/css/ui.css" rel="stylesheet" type="text/css"/>
<link href="assets/fonts/fontawesome/css/fontawesome-all.min.css" type="text/css" rel="stylesheet">
<!--<link href="assets/css/OverlayScrollbars.css" type="text/css" rel="stylesheet"/>-->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">  
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />

<!-- Font awesome 5 -->
<style>
	.avatar {
  vertical-align: middle;
  width: 35px;
  height: 35px;
  border-radius: 50%;
}
.bg-default, .btn-default{
	background-color: #f2f3f8;
}
.btn-error{
	color: #ef5f5f;
}
</style>
<!-- custom style -->
</head>
<body>
	

<!-- ========================= SECTION CONTENT ========================= -->

<section class="section-content padding-y-sm bg-default ">
<div class="container-fluid">
<div class="row">
	<div class="col-md-8 card padding-y-sm card ">
		<ul class="nav bg radius nav-pills nav-fill mb-3 bg" role="tablist">
				<li class="nav-item">
					<a class="nav-link active show " data-toggle="pill" href="#nav-tab-card">
					<i class="fa fa-tags"></i> All</a></li>
					 <?php 
			    $view_category_query = mysqli_query($connections, "SELECT * FROM category");
				while ($category_row = mysqli_fetch_assoc($view_category_query)) {
				   $db_category_id  = $category_row["category_id"];
				   $db_category_name = $category_row["category_name"];
		
				   ?>
					
					<li class="nav-item">
					<a class="nav-link hatdog" data-toggle="pill" href="#nav-tab-paypal" data-id="<?=$db_category_id?>">
					<i class="fa fa-tags "></i> <?php echo  $db_category_name ?></a></li>
				
					<?php } ?>
			
		</ul>
		
<span   id="items">
<div class="row">
	<!--start loop--->
	<?php 
			    $view_category_query = mysqli_query($connections, "SELECT *, SUM(b.s_amount) as prod_stocks
				from product as a
				LEFT JOIN stocks as b
				ON a.prod_id = b.s_prod_id
				where prod_status='0'
				GROUP BY a.prod_id");
				while ($category_row = mysqli_fetch_assoc($view_category_query)) {
				   $db_prod_id = $category_row["prod_id"];
				   $db_prod_name = $category_row["prod_name"];
				   $db_prod_currprice = $category_row["prod_currprice"];
				   $db_prod_stocks = $category_row["prod_stocks"];
				   $db_prod_unit_id = $category_row["prod_unit_id"];
				   $db_prod_category_id = $category_row["prod_category_id"];
				   $db_prod_description = $category_row["prod_description"];
				   $db_prod_image = $category_row["prod_image"];
				   $db_prod_description = $category_row["prod_description"];

				   $get_record_unit = mysqli_query ($connections,"SELECT * FROM unit where unit_id ='$db_prod_unit_id' ");
				   $row_unit = mysqli_fetch_assoc($get_record_unit);
				   $unit_name = $row_unit["unit_name"];

				   
				   ?>
<!--end loop--->
<div class="col-md-3 category <?= $db_prod_category_id ?> categprod<?=$db_prod_id?>">
	<figure class="card card-product">
		<!---<span class="badge-new"> NEW </span> -->
		<div class="img-wrap"> 
			<?php if($db_prod_image){?><img src="../../upload_prodImg/<?php echo $db_prod_image?>"><?php }else{ echo'<img src="../../assets/img/1599802140_no-image-available.png">';} ?>
			<a class="btn-overlay" href="#"><i class="fa fa-search-plus"></i> Quick view</a>
		</div>
		<figcaption class="info-wrap">
			<a href="#" class="title prodTitle" id="prod,<?=$db_prod_id?>" ><b><?php echo $db_prod_name?></b></a>
			<br>stock : <?php echo $db_prod_stocks?> <br><?php if($db_prod_stocks <=0){ echo "<b style='color:red;'>Not Available</b>";}else{ echo "<b style='color:green;'>Available</b>";} ?>
			<div class="action-wrap">
				<!---
					$db_prod_id
					
			-->
			<?php if($db_prod_stocks >=1){ ?>	<a  class="btn btn-primary btn-sm float-right  togler" data-bs-toggle="modal" data-bs-target="#ModalCart"
				data-id="<?= $db_prod_id ?>"
				data-unit_name="<?= $unit_name ?>"
				
				> 
					
				
				<i class="fa fa-cart-plus"></i> Add </a><?php }?>
				<div class="price-wrap h5">
					<span class="price-new"><span>&#8369;</span> <?php echo  number_format($db_prod_currprice, 2, '.', ',');?></span>
				</div> <!-- price-wrap.// -->
			</div> <!-- action-wrap -->
		</figcaption>
	</figure> <!-- card // -->
</div> <!-- col // -->
					<?php } ?>


					

</div> <!-- row.// -->
</span>
	</div>

<!-- Modal cart -->
<div class="modal fade" id="ModalCart" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
	
        <input type="number" name="qty" required class="form-control" min="1" placeholder="" >							
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="add" class="btn btn-primary">Cunfirm</button>
      </div>
	  	</form>
    </div>
  </div>
</div>
<!--end modal-->



<!-- Modal cart --><div class="modal fade" id="ModalRemove" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
		
	  <form method="POST" action="removecart.php">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Remove to cart</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
			<input type="text" id="id_remove" hidden name="removeid">
		<center> Remove <b id="db_prod_name" ></b>? </center>

		
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="btnRemove" class="btn btn-primary">Cunfirm</button>
      </div>
	  	</form>
    </div>
  </div>
</div>
<!--end modal-->




	<div class="col-md-4">
<div class="card">
	<span id="cart">
<table class="table table-hover shopping-cart-wrap">
<thead class="text-muted">
<tr>
  <th scope="col">Item</th>
  <th scope="col" width="120">Qty</th>
  <th scope="col" width="120">Price</th>
  <th scope="col" width="120">Total</th>

  <th scope="col" class="text-right" width="200">Delete</th>
</tr>
</thead>
<tbody>
<?php 
				
				$total = 0; // Initialize the total variable
				$finalTotal=0;//default
				$view_category_query = mysqli_query($connections, "SELECT * FROM `pos_cart` where pos_cart_user_id='$acc_id'");
				while ($category_row = mysqli_fetch_assoc($view_category_query)) {
					$pos_cart_id = $category_row["pos_cart_id"];
					$pos_cart_prod_id = $category_row["pos_cart_prod_id"];
					$pos_cart_user_id = $category_row["pos_cart_user_id"];
					$cart_prodQty = $category_row["cart_prodQty"];
				
					$get_product = mysqli_query($connections, "SELECT * FROM product where prod_id ='$pos_cart_prod_id'");
					$row_product = mysqli_fetch_assoc($get_product);
					$prod_name = $row_product["prod_name"];
					$prod_currprice = $row_product["prod_currprice"];
					$prod_image = $row_product["prod_image"];
				

					$get_record_unit = mysqli_query ($connections,"SELECT * FROM unit where unit_id ='$db_prod_unit_id' ");
					$row_unit = mysqli_fetch_assoc($get_record_unit);
					$unit_name = $row_unit["unit_name"];

					

					$subtotal = $cart_prodQty * $prod_currprice;
					$total += $subtotal; // Add the subtotal to the total
				
					$Addtax=$total*$db_system_tax;
					$finalTotal=$total+$Addtax;
				
				  ?>
<tr>
<td>
<figure class="media">
<div class="img-wrap">
    <?php if ($prod_image): ?>
        <img src="../../upload_prodImg/<?php echo $prod_image; ?>" class="img-thumbnail img-xs">
    <?php else: ?>
        <img src="../../assets/img/1599802140_no-image-available.png" class="img-thumbnail img-xs">
    <?php endif; ?>
</div>


<figcaption class="media-body">
		<h6 class="title text-truncate"><?php echo $prod_name; ?> </h6>
	</figcaption>
</figure> 
	</td>
	
	<td class="text-center">
    <div class="m-btn-group m-btn-group--pill btn-group mr-2" role="group" aria-label="...">
        <button type="button" class="m-btn btn btn-default decrease" onclick="decreaseQuantity(this)" data-id="<?php echo $pos_cart_id ?>"><i class="fa fa-minus"></i></button>
        <button type="button" class="m-btn btn btn-default" disabled><?php echo $cart_prodQty ?></button>
        <button type="button" class="m-btn btn btn-default" onclick="increaseQuantity(this)" data-id="<?php echo $pos_cart_id ?>"><i class="fa fa-plus"></i></button>
    </div>
</td>


	<td> 
		
		
			<div class="price-wrap"> 
				<var class="price price<?php echo $pos_cart_id ?>"><?php echo number_format($prod_currprice, 2, '.', ',')?></var> 
			</div> <!-- price-wrap .// -->
		
	</td>
	<td> 
		
		
			<div class="price-wrap"> 
				<var class="price total total<?php echo $pos_cart_id?>"><?php echo number_format($subtotal, 2, '.', ',')?></var> 
			</div> <!-- price-wrap .// -->
		
	</td>
	<td class="text-right"> 
	<a href="" class="btn btn-outline-danger remove" data-bs-toggle="modal" data-bs-target="#ModalRemove"
				data-id_remove="<?= $pos_cart_id ?>"
				data-unit_name_rem="<?= $unit_name ?>"
				data-db_prod_name="<?=$prod_name ?>"
				
				>
				
				<i class="fa fa-trash"></i></a>
	</td>
	
</tr>
<?php } ?>

</tbody>
</table>
</span>
</div> <!-- card.// -->
<!--START Discount-->
<form action="POST">
  <select name="discount" id="discountSelect" onchange="updateDiscountId()">
    <option value="0">SELECT DISCOUNT</option>
    <?php 
      $discount_query = mysqli_query($connections, "SELECT * FROM `discount`");
      while ($d_row = mysqli_fetch_assoc($discount_query)) {
        $db_discount_id = $d_row["discount_id"];
        $db_discount_name = $d_row["discount_name"];
        $db_discount_rate = $d_row["discount_rate"];
    ?>
    <option value="<?php echo $db_discount_rate ?>"><?php echo $db_discount_name ?></option>
    <?php } ?>
  </select>

</form>

<script>
  function updateDiscountId() {
    var selectElement = document.getElementById("discountSelect");
    var selectedOption = selectElement.options[selectElement.selectedIndex];
    var selectedDiscountName = selectedOption.text;
    document.getElementById("discountname").value = selectedDiscountName;
  }
</script>

<script>
  var finalTotal = <?php echo $finalTotal ?>; // Get the initial final total value from PHP
  
  function updateFinalTotal() {
    var discountSelect = document.getElementById("discountSelect");
    var selectedDiscountRate = parseFloat(discountSelect.value);
    var discountAmount = (selectedDiscountRate / 100) * finalTotal;
    var updatedTotal = finalTotal - discountAmount;
    
    document.getElementById("discount").textContent = selectedDiscountRate.toFixed(2) + "%";
    document.getElementById("tot").textContent = updatedTotal.toFixed(2);



	//call discount in modal
	var selectedDiscountRate = parseFloat(discountSelect.value);
    var discountAmount = (selectedDiscountRate / 100) * finalTotal;
    var updatedTotal = finalTotal - discountAmount;

    document.getElementById("discount").textContent = selectedDiscountRate.toFixed(2) + "%";
    document.getElementById("discountInput").value = selectedDiscountRate; // Set the selected discount value in the input field
    document.getElementById("tot").textContent = updatedTotal.toFixed(2);
	


	//final total and subtotal
	
  }
  
  var discountSelect = document.getElementById("discountSelect");
  discountSelect.addEventListener("change", updateFinalTotal);




</script>

<!--END Discount-->
<div class="box">
<dl class="dlist-align">
  <dt>Tax: </dt>
  <dd class="text-right" id="tax"><?php echo $db_system_tax ?></dd>
</dl>

<dl class="dlist-align">
  <dt>Sub Total:</dt>
  
  <dd class="text-right" >&#8369; <span id="subtot"><?php echo number_format($total, 2, '.', ',')?></span> </dd>
</dl>

<dl class="dlist-align">
  <dt>Discount:</dt>
  <dd class="text-right" > <span id="discount">0</span> </dd>
</dl>

<dl class="dlist-align">
  <dt>Total: </dt>
  <dd class="text-right h4 b">&#8369; <span id="tot"><?php echo number_format($finalTotal, 2, '.', ',')?> </span> </dd>
</dl>





<div class="row">
	<div class="col-md-6">
		<a href="#" class="btn  btn-default btn-error btn-lg btn-block toglerCancel" data-bs-toggle="modal" data-bs-target="#ModalCancel"
		data-pos_cart_id="<?= $pos_cart_id ?>"
		
		><i class="fa fa-times-circle "></i> Cancel </a>
	</div>
	<div class="col-md-6">
		<a href="#" class="btn  btn-primary btn-lg btn-block toglerCheckout" data-bs-toggle="modal" data-bs-target="#ModalCheckOut" 
	data-prod_id="<?= $db_prod_id ?>"
	data-pos_cart_user_id="<?= $pos_cart_user_id ?>"
	data-unit_name="<?= $unit_name ?>"
		
		><i class="fa fa-shopping-bag"></i> Check Out </a>
	</div>
</div>
</div> <!-- box.// -->
	</div>
</div>

</div><!-- container // finalTotalInput -->
</section>

	<!-- Modal CheckOUt-->
	<div class="modal fade" id="ModalCheckOut" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="checkoutForm" method="POST" >
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Check out</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
		<input type="hidden" name="discountname" id="discountname">
          <input type="hidden" id="finalTotalInput"    name="finalTotalDisplay">
          <input type="hidden" id="pos_cart_user_id"  name="pos_cart_user_id">
  
		  <?php 
	$view_query = mysqli_query($connections, "SELECT * FROM pos_cart where pos_cart_user_id=$acc_id");
	  $total_bill = 0;
	  while ($row = mysqli_fetch_assoc($view_query)) {
			$db_cart_user_id= $row["pos_cart_user_id"];
			$db_pos_cart_id = $row["pos_cart_id"]; 
			$db_cart_prod_id  = $row["pos_cart_prod_id"]; 
	  		$db_cart_prodQty  = $row["cart_prodQty"]; 
		  ?>
		 <!---Cart ID---->
		  <input type="hidden" value="<?php echo $db_pos_cart_id?>"  name="pos_cart_id[]">
		   <!---Product ID---->
		  <input type="hidden" value="<?php echo $db_cart_prod_id?>"  name="prod_id[]">
		   <!---Quantity---->
		  <input type="hidden" value="<?php echo $db_cart_prodQty?>"  name="prodqty[]">
		  
		  <?php }?>
		 
		  

		<input type="hidden" value="<?php echo $db_cart_user_id?>"   name="db_cart_user_id" value="0">
		  <input type="hidden" id="discountInput"   name="discount" value="0">

		
		  <input type="hidden" name="db_system_tax" value="<?php echo $db_system_tax?>"><br>
          <input type="text" name="Payment" placeholder="Enter Payment"><br>
          <span class="error"></span>

          <div>
            <label>Final Total:</label>
            <span id="finalTotalDisplay"><?php echo number_format($finalTotal, 2, '.', ',') ?></span>
          </div>
        </div>
		
		
		
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="btnPayment" class="btn btn-primary">Confirm</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
    $('#checkoutForm').submit(function(e) {
      e.preventDefault(); // Prevent the form from submitting normally

      // Serialize the form data
      var formData = $(this).serialize();

      // Send the AJAX request
      $.ajax({
        type: 'POST',
        url: 'checkout.php',
        data: formData,
        success: function(response) {
          // Display the validation result in the modal
          $('.error').html(response);
		  console.log(response)
        }
      });
    });
  });
</script>

<!--ModalCancel-->
	<!-- Start modal cancel -->
<div class="modal fade" id="ModalCancel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
		
	  <form method="POST" action="removeAll.php">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Warning</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
			<input type="hidden" value="<?php echo $pos_cart_user_id?>" name="pos_cart_user_id">
		REMOVE ALL FROM THE CART

	
      				
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="btnRemoveAll" class="btn btn-primary">Cunfirm</button>
      </div>
	  	</form>
    </div>
  </div>
</div>
<!--End Cancel--->
<!-- JavaScript code -->
<script>
  // Update the final total display in the modal
  document.getElementById("finalTotalDisplay").textContent = "<?php echo number_format($finalTotal, 2, '.', ',') ?>";
</script>

<!--START--->
<!-- ========================= SECTION CONTENT END// ========================= -->
<script src="assets/js/jquery-2.0.0.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.bundle.min.js" type="text/javascript"></script>


</body>

<script>
	//data-unit_name

	$('.togler').click(function(){
		id = $(this).attr('data-id')
		$('#id').val(id).hide()

		unit_name = $(this).attr('data-unit_name')
		$('#unit_name').val(unit_name)
-
		$('#unit_nameDisplay').text(unit_name)
	})


	//remove//data-unit_name//data-db_prod_name
	
	$('.remove').click(function(){
		id_remove = $(this).attr('data-id_remove')
		$('#id_remove').val(id_remove)

		unit_name_rem = $(this).attr('data-unit_name_rem')
		$('#unit_name_rem').val(unit_name_rem)
		$('#unit_name_remDisplay').text(unit_name_rem)

		db_prod_name = $(this).attr('data-db_prod_name')
		$('#db_prod_name').text(db_prod_name)
	})

	$('.total').each(function(){
		var total =parseFloat($(this).text()).toFixed(2)
		// console.log(total)
	})

</script>

<script>
    function decreaseQuantity(button) {
        var quantityElement = button.nextElementSibling;
        var quantity = parseInt(quantityElement.innerText);
		var cartId = button.getAttribute("data-id");

		priceChanger=$('.price'+cartId).text()
		totalChanger='.total'+cartId

		var qty = (quantity<=1) ? 1 : quantity-1
		
		var price=priceChanger*qty
		$(totalChanger).text(price.toFixed(2))

        if (quantity > 1) {
            quantityElement.innerText = quantity - 1;
            
            updateQuantity(cartId, quantity - 1);
        }
		var subtotal= 0
		var	tax =parseFloat($('#tax').text())
		var	discount =parseFloat($('#discount').text())/100

		$('.total').each(function(){
		var total =parseFloat($(this).text())
		subtotal+=total
		})
	$('#subtot').text(subtotal.toFixed(2))
		tax*=subtotal
		discount*=subtotal
		subtotal+=tax
		subtotal-=discount
		total =subtotal
		$('#tot').text(total.toFixed(2))
		
		//console.log(discount)

    }

    function increaseQuantity(button) {
        var quantityElement = button.previousElementSibling;
        var quantity = parseInt(quantityElement.innerText);
        quantityElement.innerText = quantity + 1;
        var cartId = button.getAttribute("data-id");
        updateQuantity(cartId, quantity + 1);

		var subtotal= 0
		var	tax =parseFloat($('#tax').text())
		var	discount =parseFloat($('#discount').text())/100

		priceChanger=$('.price'+cartId).text()
		totalChanger='.total'+cartId

		var qty = (quantity<=1) ? 1+1 : quantity+1
		
		var price=priceChanger*qty
		$(totalChanger).text(price.toFixed(2))


		var subtotal= 0
		$('.total').each(function(){
		var total =parseFloat($(this).text())
		subtotal+=total
		
		})
		$('#subtot').text(subtotal.toFixed(2))
		tax*=subtotal
		discount*=subtotal
		subtotal+=tax
		subtotal-=discount
		total =subtotal
		$('#tot').text(total.toFixed(2))
		

    }

    function updateQuantity(cartId, quantity) {
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "update_cart_quantity.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                console.log("Quantity updated successfully");
            }
        };
        xhttp.send("cartId=" + cartId + "&quantity=" + quantity);
    }
</script>

<script>//data-pos_cart_user_id

		$('.toglerCancel').click(function(){
		//data-pos_cart_user_id///data-prod_id
		pos_cart_id = $(this).attr('data-pos_cart_id')
		$('#pos_cart_id').val(pos_cart_id)

		})


	$('.toglerCheckout').click(function(){
		//data-pos_cart_user_id///data-prod_id
		pos_cart_user_id = $(this).attr('data-pos_cart_user_id')
		$('#pos_cart_user_id').val(pos_cart_user_id)

		prod_id = $(this).attr('data-prod_id')
		$('#prod_id').val(prod_id)

		id = $(this).attr('data-id')
		$('#id').val(id).hide()
		$('#finalTotalDisplay').text($('#tot').text())

		var finalTotalDisplayValue = $('#finalTotalDisplay').text();
		$('#finalTotalInput').val(finalTotalDisplayValue);

		
	})

	$('.hatdog').click(function(){
		$('.category').hide()
		var categ = $(this).attr('data-id')
		$('.'+categ).show()
	})
	$('.show').click(function(){
		$('.category').show()
	})
	
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

<!-- End of Script -->
</html>