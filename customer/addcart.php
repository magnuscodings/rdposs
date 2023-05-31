<?php 
session_start();
include("backend/back_navbar.php");
if(isset($_POST['add'])){
    $user=htmlentities($_SESSION['acc_id']);
    $qty=htmlentities($_POST['qty']);
    $prod_id=htmlentities($_POST['id']);


    

    $get_productStocks = mysqli_query ($connections,"SELECT *, SUM(b.s_amount) as prod_stocks
    from product as a
    LEFT JOIN stocks as b
    ON a.prod_id = b.s_prod_id
    where prod_id='$prod_id' 
    GROUP BY a.prod_id ");
	
	$row_stocks = mysqli_fetch_assoc($get_productStocks);
	$db_prod_id = $row_stocks["prod_id"];
	$db_prod_stocks = $row_stocks["prod_stocks"];

    if($qty<=$db_prod_stocks){

         $sql="INSERT INTO `cart` (`cart_id`, `cart_prod_id`, `cart_user_id`, `cart_prodQty`) VALUES (NULL, '$prod_id', '$user', '$qty')";
           
           
         if(mysqli_query($connections,$sql)){
             
	

              echo "<script>window.location.href='products.php';</script>";
            }else{
              echo "<script>window.location.href='products.php';</script>";
                }
    }else{
         echo "<script>
        alert('insufficient stocks');
         window.location.href='products.php';
       </script>";

    }


}else{
    echo "<script>window.location.href='products.php';</script>";
}

?>