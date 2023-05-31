<?php 
include "../administrator/connection.php";
include "navigation.php"; 
//confirmDeliver
if (isset($_POST["confiem"])) {
  $transactionId = $_POST["transactionId"];

  // Call data from the product table

  // print_r($_POST);
  $ids = explode(",", $_POST['productId']);
  $qtys = explode(",", $_POST['qty']);

  // Checker
  $counter = 0;
  $hasInsufficientStocks = false; // Flag to track if there are insufficient stocks

  foreach ($ids as $key => $productId) { // Product ID per ID
    $qty = $qtys[$key]; // [Per qty ng orders eto na yon]
    $id = $ids[$key];

    // Select id
    // qtyProduct
    $get_product_record = mysqli_query($connections, "SELECT a.*, SUM(b.s_amount) AS prod_stocks
    FROM product AS a
    LEFT JOIN stocks AS b ON a.prod_id = b.s_prod_id
    WHERE a.prod_id = '$id'
    GROUP BY a.prod_id");

$per_row = mysqli_fetch_assoc($get_product_record);
$db_prod_stocks = $per_row["prod_stocks"];
$db_prod_name = $per_row["prod_name"];


    if ($qty > $db_prod_stocks) {
      // Quantity is greater than available stocks
      // Add appropriate error handling or display a message to the user
      echo "<script> alert('Insufficient stocks for product: $db_prod_name')</script>";
      $hasInsufficientStocks = true;
      // You can choose to exit the loop or stop further processing here
      echo "<script>window.location.href='deliver.php';</script>";
      break;
      
    }
    
  }

  if (!$hasInsufficientStocks) {
    // Sufficient stocks for all products, perform the update
    foreach ($ids as $key => $productId) { //product id per id 
      $qty = $qtys[$key]; //[per qty ng orders eto na yon]
     // mysqli_query($connections , "UPDATE `stocks` SET `s_amount` = prod_stocks -'$qty' WHERE `product`.`s_prod_id` = '$productId';");
  
/* */
$get_record = mysqli_query($connections, "SELECT * FROM product as a
LEFT JOIN stocks as b ON a.prod_id = b.s_prod_id
WHERE a.prod_status = '0' AND a.prod_id = '$productId'
ORDER BY b.s_created ASC");

$remainingQty = $qty; // Track the remaining quantity

while ($row = $get_record->fetch_array()) {
$db_s_id = $row["s_id"];
$db_s_amount = $row["s_amount"];

if ($db_s_amount > 0) {
$deductQty = min($remainingQty, $db_s_amount); // Deduct the minimum of remainingQty and db_s_amount
$remainingQty -= $deductQty; // Update the remaining quantity

mysqli_query($connections, "UPDATE stocks
SET s_amount = s_amount - '$deductQty'
WHERE s_id = '$db_s_id'");

if ($remainingQty == 0) {
// All quantity has been deducted, exit the loop
break;
}
}
}
/* */

      
      $update_query = mysqli_query($connections, "UPDATE orders SET orders_status = 'In-Transit' WHERE order_transaction_code = '$transactionId '");

    

    }

//start deduct voucher
    $get_orderrecord = mysqli_query($connections,"SELECT * FROM orders WHERE order_transaction_code = '$transactionId '");
    $get_rowrecord = mysqli_fetch_assoc($get_orderrecord);
    $orders_voucher_name = $get_rowrecord["orders_voucher_name"];
   
    $transactionId;

    date_default_timezone_set('Asia/Manila');
    $currentDateTime = date('Y-m-d H:i:s');

    $view_query = mysqli_query($connections, "SELECT * FROM voucher WHERE voucher_expiration >= '$currentDateTime' AND voucher_name ='$orders_voucher_name'");
    while($row = mysqli_fetch_assoc($view_query)){ 
        $voucher_id = $row["voucher_id"];
        $db_voucher_name = $row["voucher_name"];
        $db_voucher_discount = $row["voucher_discount"];
        $db_voucher_discount_percent = $db_voucher_discount/100;

        $db_voucher_created = $row["voucher_created"];
        $db_voucher_expiration = $row["voucher_expiration"];
        $db_voucher_maximumLimit = $row["voucher_maximumLimit"];
        $db_voucher_status = $row["voucher_status"];


    echo  $db_voucher_maximumLimit-=1;

  mysqli_query($connections,"UPDATE voucher SET voucher_maximumLimit='$db_voucher_maximumLimit' where voucher_name ='$orders_voucher_name'");


}
//end deduct voucher


      // start user log
     date_default_timezone_set('Asia/Manila');
     $currentDateTime = date('Y-m-d g:i A');
     mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date) 
     VALUES('".$db_acc_id."', 'DELIVER TRANSACTION ID:$transactionId ', '$currentDateTime')");
     //end user log
     echo "<script>window.location.href='deliver.php';</script>";
  }


  }


if(isset($_POST["confirmDeliver"])){
    $transactionId=$_POST["transactionId"];
    date_default_timezone_set('Asia/Manila');
    $currentDateTime = date('Y-m-d g:i A');
   
    $update_query = mysqli_query($connections, "UPDATE orders SET orders_status = 'Delivered',orders_dates_delivered='$currentDateTime' WHERE order_transaction_code = '$transactionId '");

    // start user log
     //   date_default_timezone_set('Asia/Manila');
     $currentDateTime = date('Y-m-d g:i A');
     mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date) 
     VALUES('".$db_acc_id."', 'DELIVERED TRANSACTION ID:$transactionId ', '$currentDateTime')");
     //end user log
     echo "<script>window.location.href='deliver.php';</script>";

}
//btnArchive
if(isset($_POST["btnArchive"])){
    $transactionId=$_POST["transactionId"];
    $update_query = mysqli_query($connections, "UPDATE orders SET orders_status = 'Complete' WHERE order_transaction_code = '$transactionId '");

    // start user log
     //   date_default_timezone_set('Asia/Manila');
     $currentDateTime = date('Y-m-d g:i A');
     mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date) 
     VALUES('".$db_acc_id."', 'ARCHIVE TRANSACTION ID:$transactionId ', '$currentDateTime')");
     //end user log
     echo "<script>window.location.href='deliver.php';</script>";

}



//btnCancel

if(isset($_POST["btnCancel"])){
  $transactionId = $_POST["transactionId"];
  $delete_query = mysqli_query($connections, "DELETE FROM orders WHERE order_transaction_code = '$transactionId'");
  // start user log
     //   date_default_timezone_set('Asia/Manila');
     $currentDateTime = date('Y-m-d g:i A');
     mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date) 
     VALUES('".$db_acc_id."', 'CANCEL TRANSACTION ID:$transactionId ', '$currentDateTime')");
     //end user log
  echo "<script> window.location.href = 'deliver.php'; </script>";
}


//btnInvalid
if(isset($_POST["btnInvalid"])){
  $transactionId=$_POST["transactionId"];
    $update_query = mysqli_query($connections, "UPDATE orders SET orders_status = 'Not Delivered' WHERE order_transaction_code = '$transactionId '");

    // start user log
     //   date_default_timezone_set('Asia/Manila');
     $currentDateTime = date('Y-m-d g:i A');
     mysqli_query($connections, "INSERT INTO users_log(act_account_id, act_activity, act_date) 
     VALUES('".$db_acc_id."', 'NOT DELIVERED TRANSACTION ID:$transactionId ', '$currentDateTime')");
     //end user log
     echo "<script>window.location.href='deliver.php';</script>";

}
?>