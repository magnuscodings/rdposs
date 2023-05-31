<?php
include "backend/back_navbar.php";
include "../back_maintinance.php";
include "navigation.php";
if(isset($_SESSION["acc_id"])){
    $acc_id = $_SESSION["acc_id"];
    
    $get_record = mysqli_query ($connections,"SELECT * FROM account where acc_id='$acc_id' ");
    $row = mysqli_fetch_assoc($get_record);
    $acc_type = $row ["acc_type"];
    if($acc_type =="customer"){
             //redirect administrator
             echo "<script>window.location.href='../customer/home.php'</script>";	
 }else if($acc_type =="delivery person"){
             //redirect administrator
                echo "<script>window.location.href='../delivery/';</script>";	      
               }else if($acc_type =="cashier"){
                  //redirect administrator
                     echo "<script>window.location.href='../POS/';</script>";	      
            }
 }

 
 
                                 $view_query = mysqli_query($connections, "
                                 SELECT order_transaction_code, orders_ship_fee, orders_tax,
                                orders_voucher_rate, SUM(orders_subtotal) AS total_subtotal    
                                 FROM `orders`
                                 GROUP BY order_transaction_code,
                                 orders_ship_fee, orders_tax, orders_voucher_rate;
                             ");
                             
                             // Initialize variables
                            $final = 0; 
                            while ($row = mysqli_fetch_assoc($view_query)) {
                                 $total_subtotal = $row["total_subtotal"];
                                 $orders_ship_fee = $row["orders_ship_fee"];
                                 $orders_tax = $row["orders_tax"];
                                 $orders_voucher_rate = $row["orders_voucher_rate"];
                             
                                 $orders_voucher_rateClean = preg_replace('/[^0-9.]/', '', $orders_voucher_rate);
                             
                                 if ($orders_voucher_rateClean) {
                                     $orders_voucher_percent = $orders_voucher_rateClean / 100;
                                 }
                             
                                 $addship_in_orders = $total_subtotal + $orders_ship_fee; // Add shipfee to the subtotal
                                 $get_tax_in_orders = $total_subtotal * $orders_tax; // Get VAT from the subtotal
                                 $finalDefault = $addship_in_orders + $get_tax_in_orders; // Calculate the total amount before applying the voucher
                             
                                 if ($orders_voucher_rateClean) {
                                     $voucher = $finalDefault * $orders_voucher_percent; // Calculate the voucher amount
                                     $finalDefault = $finalDefault-$voucher; // Add the voucher amount to the final total with voucher
                                 }

                              $final +=$finalDefault; //total sales in ordering
                                 }

                            $pos_query = mysqli_query($connections, "SELECT
                                orders_tcode,orders_final FROM `pos_orders` GROUP BY orders_tcode");
                                // Initialize variables
                                $pos_final = 0;
                            while ($row_pos = mysqli_fetch_assoc($pos_query)) {
                                    $orders_final = $row_pos["orders_final"];

                                    $pos_final+=$orders_final; //total sales in POS
                                }
                               
                                $Total_Sales=$pos_final+$final; //overall sales
                                 
                            //delivery
                            $delivery_query = mysqli_query($connections, "SELECT COUNT(*) AS row_count
                            FROM (
                                SELECT order_transaction_code
                                FROM orders
                                WHERE orders_status = 'Preparing' OR orders_status = 'In-transit'
                                GROUP BY order_transaction_code
                            ) AS subquery");
                            $row_deliver = mysqli_fetch_assoc($delivery_query);
                            $row_count = $row_deliver["row_count"];


                                // Initialize variables
                           
                           
                                 
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>System Settings</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
       
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>

    <style>
.bg-custom-color {
    background-color: #6D0F0F;
}

.card-body {
        font-size: 25px; /* Adjust the font size as per your requirement */
    }
        
    </style>
    <body class="sb-nav-fixed" >
       
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
            <?php include "sidebar.php";?>
            </div>
            <div id="layoutSidenav_content">
                <main>
                        <div class="container-fluid px-4">
                        <h1 class="mt-4" >Update System Settings</h1>
                        <div class="row">
                        <div class="card">
        <div class="card-body">
           
            <?php

           
            	$view_query = mysqli_query($connections,"SELECT * from maintinance"); 
                // where account_type='0'
                
                while($row = mysqli_fetch_assoc($view_query)){ //<-- ginagamit tuwing kukuha ng database
                    
                    $system_id = $row["system_id"];
                    $system_name = $row["system_name"];
                    $system_banner = $row["system_banner"];
                    $system_logo = $row["system_logo"];
                    $system_content = $row["system_content"];
                    $system_address = $row["system_address"];

                    $system_contact = $row["system_contact"];
                    $system_tax = $row["system_tax"];

                    $system_shipfee = $row["system_shipfee"];
                   
                  
                    
            
            ?>
            <form method="POST" enctype="multipart/form-data">
                <div class="container">
                    
                    <div class="mb-3">
                        <label >System Name</label>
                        <input type="text" class="form-control" value='<?php echo $system_name?>' name="SystemName" value="" placeholder="First Name">
                       
                    </div>
                    <div class="mb-3">
                       <label >System Banner</label>
                        <input type="file" name="SystemBanner" class="btn btn-outline-secondary col-12">
                     
                        <?php if ($system_banner) : ?>
                            <img src="../../upload_system/<?php echo $system_banner; ?>" style="max-width: 200px; margin-top: 10px;">
                            <input type="hidden" name="SystemBanner" value="<?php echo $system_banner; ?>">
                        <?php else: ?>
                            <input type="hidden" name="SystemBanner" value="">
                        <?php endif; ?>
                       
                    </div>
                    <div class="mb-3">
                        <label >System Logo</label>
                        <input type="file" name="SystemLogo" class="btn btn-outline-secondary col-12">
                       
                        <?php if ($system_logo) : ?>
                            <img src="../../upload_system/<?php echo $system_logo; ?>" alt="SystemLogo"
                             style="max-width: 200px; margin-top: 10px;">
                            <input type="hidden" name="SystemLogo" value="<?php echo $system_logo; ?>">
                        <?php else: ?>
                            <input type="hidden" name="SystemLogo" value="">
                        <?php endif; ?>
                      
                    </div>
                    
                    <label >System Content</label>
                    <div class="mb-3">
                        <textarea name="SystemContent" class="form-control" rows="3"  placeholder="Enter Content of System"><?php echo $system_content?></textarea>
                                              
                    </div>

                    <label >Address</label>
                    <div class="mb-3">
                        <textarea name="SystemAddress" class="form-control" rows="3"  placeholder="Complete Address"><?php echo $system_address?></textarea>
                                              
                    </div>


                    <div class="mb-3">
                       <label >Store Contact #</label>
                        <input type="text" class="form-control"  name="SystemContact" value="<?php echo$system_contact?>" placeholder="Store Contact Number">
                       
                    </div>

                    <div class="mb-3">
                       <label >Tax <?php echo ($system_tax*100)?>%</label>
                        <input type="decimal" min='0' class="form-control"  name="SystemTax" value="<?php echo $system_tax?>" placeholder="Set System Tax">
                        
                    </div>

                    
                    <div class="mb-3">
                       <label>Shipfee for ordering</label>
                        <input type="text" class="form-control" name="SystemShipfee" value="<?php echo $system_shipfee?>" placeholder="Set Shipfee">
                       
                    </div>
                    
                    
                    <div class="mb-3">
   
</div>

<hr>
<div class="container d-flex justify-content-center">
    <button type="submit" name='btn_save_system' class="btn btn-success btn-sm">UPDATE SYSTEM</button>
</div>

                   

                </div>
        </div>
        </form>
        <?php
         }
        ?>

    </div>
</div>
                        </div>
      
                    </div>
                    
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
