<?php
include "../administrator/connection.php";
include "backend/back_navbar.php";


?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/delivery.css">

    <title>Track order</title>
</head>


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
<nav class="navbar navbar-expand-lg navbar-dark" style='background-color:6D0F0F;'>
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

<body>
<div id="here">
    <div class="container px-1 px-md-2 py-5 mx-auto">
    <?php

$URLtransaction_code=$_GET["transaction_code"];
$get_record = mysqli_query ($connections,"SELECT * FROM orders where order_transaction_code='$URLtransaction_code' ");
$row = mysqli_fetch_assoc($get_record);
$db_acc_id = $row["orders_prod_id"];

   
$view_query = mysqli_query($connections, "SELECT *, SUM(orders_subtotal) as sum_subtotal
FROM orders 
WHERE (orders_status ='Preparing' OR orders_status ='In-Transit' OR orders_status ='Delivered')
AND order_transaction_code='".$URLtransaction_code."' GROUP BY order_transaction_code");
           
$total_subtotal = 0; 
while($row = mysqli_fetch_assoc($view_query)) {
    $orders_id = $row["orders_id"];
    $db_order_transaction_code = $row["order_transaction_code"]; 
    $db_orders_status = $row["orders_status"];   
    $db_orders_date = $row["orders_date"];   
    $db_orders_subtotal = $row["sum_subtotal"]; // Use "sum_subtotal" instead of "orders_subtotal"
    $orders_ship_fee=$row["orders_ship_fee"];
    $orders_tax=$row["orders_tax"];
    
    $orders_voucher_name=$row["orders_voucher_name"];
    $orders_voucher_rate = preg_replace("/[^0-9.]/", "", $row["orders_voucher_rate"]);
    if($orders_voucher_rate){
    $orders_voucher_rate=$orders_voucher_rate/100;
    }


    $total_subtotal += $db_orders_subtotal; 

?>


        <div class="card">
       
            <div class="row d-flex justify-content-between px-3 top">


           
                        
               <?php if($db_orders_status=="In-Transit" OR $db_orders_status=="Delivered"){?>
                <div class="d-flex">
                    <h5>TRANSACTION CODE <span class="text-primary font-weight-bold"><?php echo $db_order_transaction_code?></span></h5>
                </div>
                <?php }?>


                <div class="d-flex flex-column text-sm-right">
                   <p class="mb-0">ORDER DATE : <h3><?php echo  date("M j Y, g:ia", strtotime($db_orders_date))?></h3></p> 
                   <!--   <p>USPS <span class="font-weight-bold">234094567242423422898</span></p>-->
                </div>
            </div>
            <!-- Add class 'active' to progress -->
            <div class="row d-flex justify-content-center">
                <div class="col-11">
                <ul id="progressbar" class="text-center">
         
                    <li class="<?php if($db_orders_status=="Preparing" OR $db_orders_status=="In-Transit" OR $db_orders_status=="Delivered"){ echo "active";}?> step0"><b>Preparing</b><br><img class="icon" src="https://i.imgur.com/9nnc9Et.png"> </li>
                
                    <li class="<?php if($db_orders_status=="In-Transit" OR $db_orders_status=="Delivered"){ echo "active";} ?> step0"><b>In-Transit</b><br><img class="icon" src="https://i.imgur.com/TkPm63y.png"></li>
                    <li class="<?php if($db_orders_status=="Delivered"){ echo "active";} ?> step0"><b>Delivered</b><br><img class="icon" src="https://cdn-icons-png.flaticon.com/512/6491/6491423.png"></li>
                
                </ul>
                </div>

                <div class="col-11">
                <div class="container">
                                                              <div class="row">
                                                                  <div class="col">
                                                                      <div class="container">
                                                                          
                                                                      </div>
                                                                  </div>
                                                                  <div class="col">
                                                                      <div class="container d-flex justify-content-end">
                                                                          <div class="card" style="width: 25rem;">
                                                                              <div class="card-body">
                                                                                <div class="container">
                                                                                  <div class="row">
                                                                                      <div class="col">
                                                                                          <div class="container d-flex justify-content-end">
                                                                                              <p class="card-text">Subtotal:</p>
                                                                                          </div>
                                                                                      </div>
                                                                                      <div class="col">
                                                                                          <div class="container d-flex justify-content-left">
                                                                                              <p class="card-text">₱ <?= number_format($db_orders_subtotal,2) ?></p>
                                                                                          </div>
                                                                                      </div>
                                                                                  </div>
                                                                                  <div class="row mb-2">
                                                                                      <div class="col">
                                                                                          <div class="container d-flex justify-content-end">
                                                                                              <p class="card-text">VAT</p>
                                                                                              (<p class="card-text" ><?=$vat=$orders_tax*100?>%</p>) :
                                                                                          </div>
                                                                                      </div>
                                                                                      
                                                                                      <div class="col">
                                                                                          <div class="container d-flex justify-content-left">
                                                                                              <p class="card-text" >₱ <?= number_format($vat_equivalent=$orders_tax*$db_orders_subtotal,2)?></p>
                                                                                          </div>
                                                                                      </div>
                                                                                  </div>

                                                                                  <div class="row mb-2">
                                                                                      <div class="col">
                                                                                          <div class="container d-flex justify-content-end">
                                                                                              <p class="card-text">Shipping fee:</p>
                                                                                          </div>
                                                                                      </div>
                                                                                      
                                                                                      <div class="col">
                                                                                          <div class="container d-flex justify-content-left">
                                                                                              <p class="card-text" >₱ <?php echo number_format($orders_ship_fee,2)?></p>
                                                                                          </div>
                                                                                      </div>
                                                                                  </div>
                                                                                <?php
                                                                                /**
                                                                                 * 
                                                                                 * $orders_voucher_name=$row["orders_voucher_name"];
                                                                                    $orders_voucher_rate=$row["orders_voucher_rate"];
                                                                                 */
                                                                                if($orders_voucher_rate){
                                                                                ?>
                                                                                  <div class="row mb-2" id='voucherRow'>
                                                                                      <div class="col">
                                                                                          <div class="container d-flex justify-content-end">
                                                                                              <p class="card-text">Voucher:</p>
                                                                                          </div>
                                                                                      </div>
                                                                                      
                                                                                      <div class="col">
                                                                                          <div class="container d-flex justify-content-left">
                                                                                              <p class="card-text" ><?= $orders_voucher_name?></p>
                                                                                          </div>
                                                                                      </div>
                                                                                  </div>
                                                                                  <?php } ?>
                                                                             
                                                                                  
                                        <!--//$orders_voucher_name-->
                                                                                  <div class="container border"></div>
                                                                                  <div class="row">
                                                                                      <div class="container d-flex justify-content-center">
                                                                                          Total order:&nbsp;₱ <?php
                                                                                           $total_order=($db_orders_subtotal+$vat_equivalent+$orders_ship_fee);

                                                                        if($orders_voucher_rate){
                                                                         $voucherDiscountFrom_total_order =$orders_voucher_rate*$total_order;
                                                                          
                                                                                           $final_total=$total_order-$voucherDiscountFrom_total_order;
                                                                        }else{
                                                                            $final_total=$total_order;
                                                                        }
                                                                                         echo  number_format($final_total,2)
                                                                                           ?> 
                                                                                      </div>
                                                                                 
                                                                                  </div>
                                                                                </div>


                                                                                <div class="container border">
                                                                                    <div class="row">
                                                                                        <div class="container d-flex justify-content-center">
                                                                                            <button class="form-control btn btn-secondary" onclick="redirectToReceiptPage()">PRINT RECEIPT</button>
                                                                                            <span id="transactionDisplay" hidden></span>

                                                                                            <script>
                                                                                                function redirectToReceiptPage() {
                                                                                                    var url = 'order_receipt.php?RDcode=<?= $URLtransaction_code ?>';
                                                                                                    window.location.href = url;
                                                                                                }
                                                                                            </script>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                </div>
                                                                              </div>
                                                                            </div>
                                                                            
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>
                </div>
            </div>
            
            <?php 
                }?>
        </div>
    </div>


</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</html>
