<?php
include "connection.php";


$quantity=$db_prod_id_add=$prod_expiration="";
$quantityErr=$db_prod_id_addErr=$prod_expirationErr="";

if(isset($_POST["btnAddstocks"])){

    $quantity=$_POST["quantity"];
    
    $db_prod_id_add=$_POST["db_prod_id_add"];
   
    $prod_expiration=$_POST["prod_expiration"];

    mysqli_query($connections, "INSERT INTO `stocks` (`s_id`, `s_created`, `s_expiration`, `s_prod_id`, `s_amount`) VALUES (NULL, current_timestamp(), ' $prod_expiration', '$db_prod_id_add', '$quantity')");


    echo '
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
                    <script>
                        swal({
                            title: "Success!",
                            text: "Add Stocks succesfully",
                            icon: "success",
                            html: true
                        }).then((value) => {
                            if (value) {
                                window.location.href = "inventory.php";
                            } else {
                                window.location.reload();
                            }
                        });
                    </script>
                    ';
}


?>