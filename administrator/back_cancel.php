<?php

include "connection.php";
echo "<pre>";
print_r($_POST);

if (isset($_POST['btnArchive'])) {
    
    $transaction = htmlentities($_POST['transaction']);

    $sql = "UPDATE `orders` SET `display_status` = '1' WHERE `order_transaction_code` = '$transaction';";

    
    if (mysqli_query($connections, $sql)) {
        header("Location:adminpages/checkorders.php");
    } else {
        header("Location:adminpages/checkorders.php");
    }
}


if (isset($_POST['btnCancel'])) {
    $transaction = htmlentities($_POST['transaction']);
    $sql = "DELETE FROM `orders` WHERE `orders`.`order_transaction_code` = '$transaction';";
    if (mysqli_query($connections, $sql)) {
        header("Location:adminpages/checkorders.php");
    } else {
        header("Location:adminpages/checkorders.php");
    }
}


 
?>


