
<?php 
// $db_cart_id 
include "../administrator/connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$db_cart_id = $_REQUEST["remove_id"];






   mysqli_query($connections, "DELETE FROM cart WHERE cart_prod_id ='$db_cart_id'");
  // echo "<script>window.location.href = 'cart.php';</script>";

  
}
?>