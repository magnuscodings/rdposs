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
<?php 


$total_subtotal = 0; // Initialize the total_subtotal variable

$RDcode = $_GET["RDcode"];
$view_category_query = mysqli_query($connections, "SELECT * FROM orders WHERE order_transaction_code = '$RDcode'");
$order = mysqli_fetch_assoc($view_category_query);

  $db_orders_id = $order["orders_id"];
  $db_order_transaction_code  = $order["order_transaction_code"];
  $db_orders_date = $order["orders_date"];
  $db_orders_customer_id = $order["orders_customer_id"];
  

  $get_cashier = mysqli_query($connections, "SELECT * FROM account WHERE acc_id = '$db_orders_customer_id' ");
  $crow = mysqli_fetch_assoc($get_cashier);
  $db_acc_fname = $crow["acc_fname"];
  $db_acc_lname = $crow["acc_lname"];   
 $fullname=$db_acc_fname." ".$db_acc_lname;       

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <title>Receipt</title>
</head>
<style>
    @media print {
      @page {
        size: 8.5in 11in; /* Adjust the size according to your bond paper dimensions */
        margin: 0; /* Remove default page margins */
      }

      body {
        margin: 1cm; /* Add a small margin to prevent content from touching the edge of the paper */
      }

      .print-button {
        display: none;
      }
    }
  </style>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card mt-5">
          <div class="card-header bg-dark text-white">
            <h4 class="text-center"><?php echo $db_system_name?></h4>
            <p class="text-center"><?php echo $db_system_address?></p>
          </div>
          <div class="card-body">
            <div class="row">
            <div class="col-md-6">
              <p><b>Transaction Code: </b><?php echo $db_order_transaction_code?></p>
            </div> 
            </div>

            <div class="row">
            <div class="col-md-6">
              <p><b>Transaction Date: </b><?php echo date("M j Y, g:ia", strtotime($db_orders_date))?></p>
            </div> 
            </div>
            
            <div class="row">
            <div class="col-md-6">
                <p><b>Cashier: </b><?php echo $fullname;?></p>
              </div>
            </div>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Product Code</th>
                  <th>Item</th>
                  <th>Quantity</th>
                  <th>Price</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $count =0;
                $view_category_query = mysqli_query($connections, "SELECT *,
                 SUM(orders_qty) AS product_qty, SUM(orders_qty * orders_prod_price) AS total_price
                FROM orders
                WHERE order_transaction_code = '$RDcode'
                GROUP BY orders_prod_id");

                $sum_total_price = 0;
               while ($order = mysqli_fetch_assoc($view_category_query)) {
                  //prod_code
                

                  $orders_id  = $order["orders_id"];
                  $order_transaction_code	 = $order["order_transaction_code"];
                  $orders_prod_id = $order["orders_prod_id"];
                  $orders_customer_id = $order["orders_customer_id"];
                  $orders_nickname = $order["orders_nickname"];

                  $product_qty = $order["product_qty"];
                  $total_price=$order["total_price"];
//                  $discount_decimal=$db_orders_discount/1 00;

                  $orders_email= $order["orders_email"];
                  $orders_contact = $order["orders_contact"];
                  $orders_paymethod	 = $order["orders_paymethod"];
                  $orders_qty = $order["orders_qty"];
                  $db_orders_tax = $order["orders_tax"];

                  $orders_prod_price = $order["orders_prod_price"];

                  $orders_subtotal = $order["orders_subtotal"];

                  $orders_ship_fee = $order["orders_ship_fee"];

                 

                  
                  $orders_address = $order["orders_address"];
                  
                  $orders_date = $order["orders_date"];

           
                  $tax_percentage_formatted = number_format($db_orders_tax); // Format the percentage to 2 decimal places
                
                 
                
                  $get_order = mysqli_query($connections, "SELECT * FROM product WHERE prod_id = '$orders_prod_id' ");
                  $row = mysqli_fetch_assoc($get_order);
                  $db_prod_currprice = $row["prod_currprice"];
                  $db_prod_unit_id = $row["prod_unit_id"];     
                  $db_prod_name = $row["prod_name"];       
                  $db_orders_prod_code = $row["prod_code"];  


                  $get_cashier = mysqli_query($connections, "SELECT * FROM unit WHERE unit_id = '$db_prod_unit_id' ");
                  $crow = mysqli_fetch_assoc($get_cashier);
                  $db_unit_name = $crow["unit_name"];

                  
                  

              
                  
                  $subtotal = $db_prod_currprice * $orders_qty;
                 
                  
               
                    //$db_orders_discount
                 
                
                  
                 // $gettotal=($gettax+$total_subtotal)-$getdiscount;

                   $sum_total_price += $order['total_price'];
                   $gettax=$db_orders_tax*$sum_total_price;


               

                  $count ++;

                  $orders_voucher_name = $order["orders_voucher_name"];
                   $orders_voucher_rate = $order["orders_voucher_rate"];
                //  $voucher_percent=$orders_voucher_rate/100;
                  $voucher_percent = preg_replace('/[^0-9]/', '', $orders_voucher_rate);
                 if($voucher_percent){ 
                  $getdiscount = $voucher_percent /100;
                 }
                  ?>
                
                <tr>
                  <td><?php echo  $db_orders_prod_code ?></td>
                  <td> <?php echo $db_prod_name?></td>
                  <td> <?php echo $product_qty?>&nbsp;<?php echo $db_unit_name?></td>
                  <td>&#8369; <?php echo number_format($db_prod_currprice, 2, '.', ',')?></td>
                </tr>
                <?php }
                    $sum_total_price
                ?>
                
              </tbody>
            </table>
            <hr>
            product Count : <?php echo  $count ?>
            <div class="row">
              <div class="col-md-6 offset-md-6">
                <table class="table table-bordered">
                  <tbody>
                    <!-- &#8369; <span id="subtot"><?php echo number_format($total, 2, '.', ',')?>-->
                    <tr>
                      <td>Subtotal</td>
                      <td>&#8369; <?php echo number_format($sum_total_price, 2, '.', ',')?></td><!--subtotal-->
                    </tr>
                    
                    <tr>
                      <td>VAT (<?php echo ($db_orders_tax*100)?>%)</td>
                      <td>&#8369; <?php echo number_format($gettax, 2)?></td><!--VAT-->
                    </tr>

                    <tr>
                      <td>Shipping fee</td>
                      <td>&#8369; <?php echo number_format($orders_ship_fee,2)?></td><!--shipfee-->
                    </tr>
                    <?php
                    $total_subtotal=$sum_total_price+$gettax+$orders_ship_fee;
                    if($voucher_percent){ ?>
                    <tr>
                     
                    <td colspan="2"><?php echo $orders_voucher_name?></td>
                     
                    </tr>
                    <tr>
                      <td>
                        <?php echo $orders_voucher_rate?>
                      </td>
                      <td>&#8369; <?php echo number_format($voucer_equivalent=$getdiscount*($voucher_value=$gettax+$orders_ship_fee+$sum_total_price),2)?></td><!--voucher-->
                    </tr>
                    <tr>
                      <td>Total </td>
                      <td>&#8369; <?php echo number_format($super_total=$total_subtotal-$voucer_equivalent,2) ?></td><!--total true-->
                    </tr>
                    <?php }else{?>
                      <tr>
                      <td>Total </td>
                      <td>&#8369; <?php echo number_format($total_subtotal,2) ?></td><!--total false-->
                    </tr>
                      <?php }?>
                    

                   

                   
                  </tbody>
                </table>
              </div>
            </div>
            <p class="text-center">Thank you for purchasing :) </p>
          </div>
        </div>
        
        <button class="btn btn-primary mt-3 print-button" onclick="printReceipt()">Print Receipt</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    function printReceipt() {
      window.print();
    }
  </script>
</body>

</html>
