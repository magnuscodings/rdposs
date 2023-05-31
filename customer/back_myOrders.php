<?php
include("../administrator/connection.php");
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['btncancel'])) {
    // Get the order ID and status from the AJAX request
    $orders_id = $_POST['orders_id'];
    $status = $_POST['status'];
   
    $value2=$_POST["value2"];

    // Perform the delete operation in the database
    $delete_query = "DELETE FROM orders WHERE orders_prod_id = '$orders_id' AND order_transaction_code='$value2' AND orders_status <> 'Cancelled'";
    $result = mysqli_query($connections, $delete_query);

    if ($result) {
        // Deletion successful
        echo 'success';
    } else {
        // Deletion failed
        echo 'error';
    }
}
?>
