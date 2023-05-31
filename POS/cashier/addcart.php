<?php 
session_start();
include("back_navbar.php");
if(isset($_POST['add'])){
    $user = htmlentities($_SESSION['acc_id']);
    $qty = htmlentities($_POST['qty']);
    $prod_id = htmlentities($_POST['id']);

    $get_productStocks = mysqli_query ($connections, "SELECT a.*, SUM(b.s_amount) as prod_stocks
    FROM product as a
    LEFT JOIN stocks as b ON a.prod_id = b.s_prod_id
    WHERE a.prod_status = '0' AND a.prod_id = '$prod_id'
    GROUP BY a.prod_id
    ORDER BY b.s_created ASC");

	
	$row_stocks = mysqli_fetch_assoc($get_productStocks);
	$db_prod_id = $row_stocks["prod_id"];
	$db_prod_stocks = $row_stocks["prod_stocks"];

    if($qty<=$db_prod_stocks){

         $sql="INSERT INTO `pos_cart` (`pos_cart_id`, `pos_cart_prod_id`, `pos_cart_user_id`, `cart_prodQty`) VALUES (NULL, '$prod_id', '$user', '$qty')";
           
           
         if(mysqli_query($connections,$sql)){
                

               echo "<script>window.location.href='index.php';</script>";
            }
    }else{
        echo "<script>
         alert('insufficient stocks');
         window.location.href='index.php';
        </script>";

    }


}else{
    echo "<script>window.location.href='products.php';</script>";
}

?>