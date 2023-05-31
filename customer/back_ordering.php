<?php
include "../administrator/connection.php";

$customer_name=$contact=$deliveryaddress=$email=$paymethod=$discountname=$discountrate="";


if(isset($_POST["btnCunfirm"])){

	
	

	echo '<pre>';
	//generate Transaction Code
	$length = 5; // Desired length of the code
	$code = '';
	
	for ($i = 0; $i < $length; $i++) {
		$code .= mt_rand(0, 9); // Append a random number between 0 and 9
	}
	
	
	foreach ($_POST['cart_id'] as $key => $value) {
		$acc_id = $_POST['acc_id'][$key];
		$prod_id =  $_POST['prod_id'][$key];
		$prod_currprice =  $_POST['prod_currprice'][$key];	
		$cart_id = $_POST['cart_id'][$key];
		$total_price=$_POST["total_price"][$key];
		$db_cart_prodQty=$_POST["db_cart_prodQty"][$key];
		
		$discountname=$_POST["discountname"];
		$discountrate=$_POST["discountrate"];
		$orders_tax=$_POST["orders_tax"];
		$orders_ship_fee=$_POST["ship_fee"];

	$customer_id=$_POST["customer_id"];

	$nickname=$_POST["nickname"];
	$contact=$_POST["contact"];
	
	$deliveryaddress=$_POST["deliveryaddress"];
	$email=$_POST["email"];
	$paymethod=$_POST["paymethod"];

	date_default_timezone_set('Asia/Manila');
	$currentDateTime = date('Y-m-d g:i A');

	
//deduct stocks
$get_productStocks = mysqli_query ($connections,"SELECT * FROM product where prod_id='$prod_id' ");
	
	$row_stocks = mysqli_fetch_assoc($get_productStocks);
	$db_prod_id = $row_stocks["prod_id"];
	
//insert
mysqli_query($connections,"
INSERT INTO orders
(orders_prod_id, order_transaction_code, orders_customer_id, orders_nickname, orders_email, orders_contact, orders_paymethod, orders_qty,orders_prod_price, orders_subtotal,orders_ship_fee,orders_tax, orders_voucher_name, orders_voucher_rate, orders_address, orders_date, orders_status) 
VALUES (
'" . $prod_id . "', 
'RD" . $code . "', 
'" . $customer_id . "', 
'" . $nickname . "', 
'" . $email . "', 
'" . $contact . "', 
'" . $paymethod . "', 
'" . $db_cart_prodQty . "', 
'" . $prod_currprice . "', 
'" . $total_price . "', 

'" . $orders_ship_fee . "', 
'" . $orders_tax . "', 
'" . $discountname . "', 
'" . $discountrate . "%', 
'" . $deliveryaddress . "', 
'" . $currentDateTime . "', 
'Preparing')");

//remove to cart
mysqli_query($connections, "DELETE FROM cart WHERE cart_id ='$cart_id' AND cart_user_id='$acc_id' ");		
			

	}

		



}
echo "<script> window.location.href = 'myOrders.php'; </script>";
?>