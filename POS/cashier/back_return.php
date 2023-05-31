<?php
include "connection.php";


$tcode=$prod_code=$prod_name=$quantity=$request=$reason=$cnom=$address=$cname="";
$tcodeErr="";

if(isset($_POST["btnReturnPos"]))
{
    $tcode=$_POST["tcode"];
    $prod_code=$_POST["prod_code"];
   
    $quantity=$_POST["quantity"];
    $request=$_POST["Request"];
 
    $reason=$_POST["reason"];
    $cnom=$_POST["cnom"];
    $address=$_POST["address"];
    $cname=$_POST["cname"];
if($tcode&&$prod_code&&$quantity&&$request&&$reason&&$cnom&&$address&&$cname)
    {
    $check_order_record = mysqli_query($connections,"SELECT * from pos_orders WHERE orders_tcode='$tcode'");
	$check_order_record_row = mysqli_num_rows ($check_order_record);	
	if($check_order_record_row  > 0)
                {
        $check_prod_record = mysqli_query($connections,"SELECT * from product WHERE prod_code='$prod_code'");
        $check_prod_record_row = mysqli_num_rows ($check_prod_record);
                        if($check_prod_record_row  > 0)
                        {
                            $row = mysqli_fetch_assoc($check_order_record);
                            $orders_prod_id = $row ["orders_prod_id"];
                            $orders_cart_id = $row ["orders_cart_id"];
                            $orders_date = $row ["orders_date"];                                   
                            $check_order_qty = mysqli_query($connections,"SELECT * 
                                    from pos_orders WHERE orders_tcode='$tcode' AND orders_prod_id='$orders_prod_id'");
                                
                                $order_qty_row = mysqli_num_rows ($check_order_qty);
                                
                                    $db_orders_prodQty = $row ["orders_prodQty"];

                
            
               
                    

            

                    $refund_deadline = date("Y-m-d H:i:s", strtotime($orders_date . " + 7 days")); // Calculate the refund deadline

                    $current_time = date("Y-m-d H:i:s"); // Get the current date and time
                 
                if($quantity <=$db_orders_prodQty)
                {
                    if ($current_time <= $refund_deadline) {
            
                
                    


                    mysqli_query($connections,"INSERT INTO `returns_pos` (`ret_id`, `ret_date`, `ret_datepurchase`, `ret_transaction_code`, `ret_product_code`, `ret_qty`, `ret_request`, `ret_reason`, `ret_customer_name`, `ret_contact_number`, `ret_address`)
                    VALUES (NULL, current_timestamp(), '$orders_date', '$tcode', '$prod_code', '$quantity', '$request', '$reason', '$cname', '$cnom', '$address');");

                        echo '
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
                        <script>
                            swal({
                                title: "Success!",
                                text: "Return Information Recorded ",
                                icon: "success",
                                html: true
                            }).then((value) => {
                                if (value) {
                                    window.location.href = "return_pos.php";
                                    // Display the print receipt code here
                                
                                } else {
                                    window.location.reload();
                                }
                            });
                        </script>
                        ';

                    }else{  echo '
                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
                                    <script>
                                        swal({
                                            title: "Error!",
                                            text: "The Guarantee has expired ! ",
                                            icon: "error",
                                            html: true
                                        })
                                    </script>
                        ';} 
                }else{

                    echo '
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
                    <script>
                        swal({
                            title: "Error!",
                            text: "The quantity is too high, does not match what is recorded in the Receipt! ",
                            icon: "error",
                            html: true
                        })
                    </script>
                ';
                    
                }
          
                    }else
                        {
                            

                            echo '
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
                                <script>
                                    swal({
                                        title: "Error!",
                                        text: "Product Code Not Found in The Receipt  ",
                                        icon: "error",
                                        html: true
                                    })
                                </script>
                            ';
                        }

                }else{       echo '
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
                    <script>
                        swal({
                            title: "Error!",
                            text: "Transaction Code Not Found in POS Record ! ",
                            icon: "error",
                            html: true
                        })
                    </script>
                ';
                    }


    }
    
}
if(isset($_POST["btnReturnOnline"]))
{
    $tcode=$_POST["tcode"];
    $prod_code=$_POST["prod_code"];
   
    $quantity=$_POST["quantity"];
    $request=$_POST["Request"];
 
    $reason=$_POST["reason"];
    $cnom=$_POST["cnom"];
    $address=$_POST["address"];
    $cname=$_POST["cname"];
if($tcode&&$prod_code&&$quantity&&$request&&$reason&&$cnom&&$address&&$cname)
    {
    $check_order_record = mysqli_query($connections,"SELECT * from orders WHERE order_transaction_code='$tcode' AND orders_status='Complete'");
	$check_order_record_row = mysqli_num_rows ($check_order_record);	

	if($check_order_record_row  > 0)
                {
        $check_prod_record = mysqli_query($connections,"SELECT * from product WHERE prod_code='$prod_code'");
        $check_prod_record_row = mysqli_num_rows ($check_prod_record);
                        if($check_prod_record_row  > 0)
                        {
                            $row = mysqli_fetch_assoc($check_order_record);
                            $orders_prod_id = $row ["orders_prod_id"];
                            
                            $orders_date = $row ["orders_date"]; 
                            $orders_dates_delivered = $row ["orders_dates_delivered"]; 
                                                                        
                            $check_order_qty = mysqli_query($connections,"SELECT * 
                            from orders WHERE order_transaction_code='$tcode' AND orders_prod_id='$orders_prod_id'");
                                
                                $order_qty_row = mysqli_num_rows ($check_order_qty);
                                
                                    $db_orders_prodQty = $row ["orders_qty"];

                
            
               
                    //PROD66826

            

                    $refund_deadline = date("Y-m-d H:i:s", strtotime($orders_dates_delivered . " + 7 days")); // Calculate the refund deadline

                    $current_time = date("Y-m-d H:i:s"); // Get the current date and time
                 
                if($quantity <=$db_orders_prodQty)
                {
                    if ($current_time <= $refund_deadline) {
            
                
                    


                        mysqli_query($connections, "INSERT INTO `return_ordering` 
   (`ret_ol_id`, `ret_ol_date`, `ret_ol_transaction_code`, `ret_ol_product_code`, `ret_ol_qty`,`ret_ol_request`, `ret_ol_reason`, `ret_ol_customer_name`, `ret_ol_contact_number`, `ret_ol_address`)
                        VALUES (NULL, current_timestamp(), '$tcode', '$prod_code', '$quantity', '$request', '$reason', '$cname', '$cnom', '$address');");
                        

                        echo '
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
                        <script>
                            swal({
                                title: "Success!",
                                text: "Return Information Recorded ",
                                icon: "success",
                                html: true
                            }).then((value) => {
                                if (value) {
                                    window.location.href = "return_online.php";
                                    // Display the print receipt code here
                                
                                } else {
                                    window.location.reload();
                                }
                            });
                        </script>
                        ';

                    }else{  echo '
                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
                                    <script>
                                        swal({
                                            title: "Error!",
                                            text: "The Guarantee has expired ! ",
                                            icon: "error",
                                            html: true
                                        })
                                    </script>
                        ';} 
                }else{

                    echo '
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
                    <script>
                        swal({
                            title: "Error!",
                            text: "The quantity is too high, does not match what is recorded in the Receipt record! ",
                            icon: "error",
                            html: true
                        })
                    </script>
                ';
                    
                }
          
                    }else
                        {
                            

                            echo '
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
                                <script>
                                    swal({
                                        title: "Error!",
                                        text: "Product Code Not Found in The Receipt  ",
                                        icon: "error",
                                        html: true
                                    })
                                </script>
                            ';
                        }

                }else{       echo '
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
                    <script>
                        swal({
                            title: "Error!",
                            text: "Transaction Code Not Found in POS Record ! ",
                            icon: "error",
                            html: true
                        })
                    </script>
                ';
                    }


    }
    
}


?>