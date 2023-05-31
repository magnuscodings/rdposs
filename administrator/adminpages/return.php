<?php
include "backend/back_navbar.php";
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
                echo "<script>window.location.href='../../delivery/deliver.php';</script>";	      
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
        <title>List of Return</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
     
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>

   
    <body class="sb-nav-fixed " >
   
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
            <?php include "sidebar.php";?>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4" >Dashboard</h1>
                       
                        <div class="row">
                            
<style>
        .center-div {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
    <script>

$(document).ready(function () {
    $('#example').DataTable();
});
</script>
<body>

<div class="container-fluid">
    <div class="row justify-content-center"> <!-- Center the row -->
        <div class="col-15">
            <div class="container-fluid d-flex justify-content-center mb-2">
                <div class="card w-100">
                    <div class="card-body">
                        <h5 class="card-title" style="text-align: center;"><h1>LIST OF ALL ORDERS</h1>
                        <div class="container">
                        <table id="example" class="table">
  <thead>
    <tr>
      <th scope="col">Product Code</th>
      <th scope="col">Transaction Code</th>
      <th scope="col">Date Return</th>
      <th scope="col">Request</th>
      <th scope="col">Buy from</th>
      <th scope="col" style="text-align: center;">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    // Loop for returns_pos table
    $query_return_pos = mysqli_query($connections, "SELECT * FROM returns_pos");
    while ($row = mysqli_fetch_assoc($query_return_pos)) {
        $ret_id = $row["ret_id"];
        $ret_date = $row["ret_date"];
        $ret_datepurchase = $row["ret_datepurchase"];
        $ret_transaction_code = $row["ret_transaction_code"];
        $ret_product_code = $row["ret_product_code"];
        $ret_qty = $row["ret_qty"];
        $ret_request = $row["ret_request"];
        $ret_reason = $row["ret_reason"];
        $ret_customer_name = $row["ret_customer_name"];
        $ret_contact_number = $row["ret_contact_number"];
        $ret_address = $row["ret_address"];

        $get_prod = mysqli_query($connections, "SELECT * FROM product WHERE prod_code='$ret_product_code'");
        $prodrow = mysqli_fetch_assoc($get_prod);
        $get_prod_name = $prodrow["prod_name"];

        $ret_date_formatted = date("M j, Y, g:ia", strtotime($ret_date));
        $ret_datepurchase_formatted = date("M j, Y, g:ia", strtotime($ret_datepurchase));
    ?>
      <tr>
        <td scope="row"><?php echo $ret_product_code; ?></td>
        <td><?php echo $ret_transaction_code; ?></td>
        <td><?php echo $ret_date_formatted; ?></td>
        <td><?php echo $ret_request; ?></td>
        <td>Pos Orders</td>
        <td>
          <div class="container text-center">
            <div class="row align-items-start">
              <div class="container">
                <button type="button" class="btn btn-primary togler w-3 toglerViewPos" 
                  data-bs-toggle="modal" data-bs-target="#modalPOS" 
                  data-ret_id="<?= $ret_id ?>"
                  data-ret_date="<?= $ret_date ?>"
                  data-ret_datepurchase="<?= $ret_datepurchase ?>"
                  data-ret_transaction_code="<?= $ret_transaction_code ?>"
                  data-ret_product_code="<?= $ret_product_code ?>"
                  data-ret_qty="<?= $ret_qty ?>"
                  data-ret_request="<?= $ret_request ?>"
                  data-ret_reason="<?= $ret_reason ?>"
                  data-ret_customer_name="<?= $ret_customer_name ?>"
                  data-ret_contact_number="<?= $ret_contact_number ?>"
                  data-ret_address="<?= $ret_address ?>"
                  data-get_prod_name="<?= $get_prod_name ?>"
                >
                  View
                </button>
              </div>
            </div>
           
          </div>
        </td>
      </tr>
    <?php } ?>

    <?php
    // Loop for return_ordering table
    $query_return_ordering = mysqli_query($connections, "SELECT * FROM return_ordering");
    while ($row = mysqli_fetch_assoc($query_return_ordering)) {
      $ret_ol_id = $row["ret_ol_id"];
      $ret_ol_date = $row["ret_ol_date"];
  
   
      $ret_ol_transaction_code = $row["ret_ol_transaction_code"];
      $ret_ol_product_code = $row["ret_ol_product_code"];
      $ret_ol_qty = $row["ret_ol_qty"];
      $ret_ol_request = $row["ret_ol_request"];
      $ret_ol_paymethod = $row["ret_ol_paymethod"];
      $ret_ol_reason = $row["ret_ol_reason"];
      $ret_ol_customer_name = $row["ret_ol_customer_name"];

      $ret_ol_contact_number = $row["ret_ol_contact_number"];
      $ret_ol_address = $row["ret_ol_address"];

      $get_prod = mysqli_query ($connections,"SELECT * FROM product where prod_code='$ret_ol_product_code' ");
      $prodrow = mysqli_fetch_assoc($get_prod);
      $get_prod_name = $prodrow["prod_name"];

      $ret_ol_date=date("M j Y, g:ia", strtotime($ret_ol_date));
    ?>
      <tr>
        <td scope="row"><?php echo $ret_ol_product_code; ?></td>
        <td><?php echo $ret_ol_transaction_code; ?></td>
        <td><?= $ret_ol_date ?></td>
        <td><?php echo $ret_ol_request; ?></td>
        <td>Online Ordering</td>
        <td>
          <div class="container text-center">
            <div class="row align-items-start">
              <div class="container">
              <button type="button" class="btn btn-primary togler w-3 toglerViewOnline" 
                  data-bs-toggle="modal" data-bs-target="#modalPOS" 
                  data-ret_ol_id="<?= $ret_ol_id ?>"
                  data-ret_ol_date="<?= $ret_ol_date ?>"                              
                  data-ret_ol_transaction_code="<?= $ret_ol_transaction_code ?>"
                  data-ret_ol_product_code="<?= $ret_ol_product_code ?>"
                  data-ret_ol_qty="<?= $ret_ol_qty ?>"
                  data-ret_ol_request="<?= $ret_ol_request ?>"
                  data-ret_ol_paymethod="<?= $ret_ol_paymethod ?>"
                  data-ret_ol_reason="<?= $ret_ol_reason ?>"
                  data-ret_ol_customer_name="<?= $ret_ol_customer_name ?>"
                  data-ret_ol_contact_number="<?= $ret_ol_contact_number ?>"
                  data-ret_ol_address="<?= $ret_ol_address ?>"
                  data-get_prod_name="<?= $get_prod_name ?>"
              >
                  View
              </button>
              </div>
            </div>
           
          </div>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>



                                
                                  </div>
                                  
                    </div>
                    
         

                
   
         <div class="modal fade" id="modalPOS" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                              <div class="modal-dialog modal-xl"style="max-width: 1300px;">
                                                <div class="modal-content">
                                                  <div class="modal-body">
                                        
                                                         <div class="container">
                                                            <div class="row">
                                                                <div class="col">
                                                                <div class="container">
                                                                <h1 id="customer_name_grp">Return Information
                                                            
                                                            
                                                                </h1>

                                                                    <div class="container-fluid mb-3">
                                                                    </div>
                                                                </div>
                                                                </div>
                                                                <div class="col">
                                                                <div class="container d-flex justify-content-end">
                                                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">BACK</button>
                                                                </div>
                                                                </div>
                                                            </div>
                                                            <div class="table-responsive">
                                                            <table class="table">
                                                                  <thead>
                                                                      <tr>
                                                                      <th scope="col">Return Date</th>
                                                                      <th scope="col"> Transaction#</th>
                                                                      <th scope="col"> Product#</th>
                                                                      <th scope="col"> Item name</th>
                                                                        <th scope="col">Request</th>
                                                                        <th scope="col">Quantity</th>
                                                                        <th scope="col">Reason</th>
                                                                        
                                                                        <th scope="col">Customer Name</th>
                                                                        <th scope="col">Contact#</th>
                                                                        <th scope="col">Address</th>
                                                                        
                                                                      
                                                                      </tr>
                                                                    </thead>
                                                                    <tbody id="tbody">
                                                                      <tr >
                                                                        <th id="orders_date" scope="row"> </th>
                                                                        <td id="orders_date"></td>
                                                                        <td id="prod_name"></td>
                                                                        <td id="orders_qty"></td>

                                                                       
                                                                        <td id="prod_currprice"></td>
                                                                        <td id="orders_subtotal"></td>
                                            
                                                                      
                                                                      </tr>
                                                                    </tbody>
                                                              </table>
                                                          </div>
                                                </div>
                                              </div>
                                          </div>


                                          <!--DELIVER--->


                                        <!---cancel--->

                                        <div class="modal fade" id="modalOnline" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-body">
                                                <div class="container">
                                                  <div class="container mb-3" style="text-align: center;">
                                                      ARE YOU SURE YOU<br>
                                                      WANT TO CANCEL<br>
                                                      ORDERS
                                                  </div>
                                                  <div class="container d-flex justify-content-center">
                                                      <div class="row">
                                                          <div class="col">
                                                              <div class="container">
                                                                  <button type="button" class="btn btn-danger">NO</button>
                                                              </div>
                                                          </div>
                                                          <div class="col">
                                                              <div class="container">
                                                                  <button type="button" class="btn btn-success">YES</button>
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



<div class="modal fade" id="modalPOS" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 1300px;">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalLabel">Return Information</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Return Date</th>
                                <th scope="col">Transaction#</th>
                                <th scope="col">Product#</th>
                                <th scope="col">Product name</th>
                                <th scope="col">Request</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Reason</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Contact number</th>
                                <th scope="col">Address</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <tr>
                                <td id="ret_date"></td>
                                <td id="ret_transaction_code"></td>
                                <td id="ret_product_code"></td>
                                <td id="ret_product_name"></td>
                                <td id="ret_request"></td>
                                <td id="ret_qty"></td>
                                <td id="ret_reason"></td>
                                <td id="ret_customer_name"></td>
                                <td id="ret_contact_number"></td>
                                <td id="ret_address"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
<script>
   $('.toglerViewPos').click(function(){
            ret_date = $(this).attr('data-ret_date')   
            ret_datepurchase = $(this).attr('data-ret_datepurchase')
            get_prod_name = $(this).attr('data-get_prod_name')
            ret_transaction_code = $(this).attr('data-ret_transaction_code')
            ret_product_code = $(this).attr('data-ret_product_code')
            ret_qty = $(this).attr('data-ret_qty')
            ret_request = $(this).attr('data-ret_request')
            ret_reason = $(this).attr('data-ret_reason')
            ret_customer_name = $(this).attr('data-ret_customer_name')
            ret_contact_number = $(this).attr('data-ret_contact_number')
            ret_address = $(this).attr('data-ret_address')
 var tbody = $('#tbody');
         var total = 0;

        tbody.empty(); // Clear the tbody

        var tr = $("<tr>");
        var td = $("<td>").text(ret_date);
        tr.append(td);
        var td = $("<td>").text(ret_transaction_code);
        tr.append(td);
        var td = $("<td>").text(ret_product_code);
        tr.append(td);
        var td = $("<td>").text(get_prod_name);
        tr.append(td);
        var td = $("<td>").text(ret_request);
        tr.append(td);
        var td = $("<td>").text(ret_qty);
        tr.append(td);
        var td = $("<td>").text(ret_reason);
        tr.append(td);
       
        var td = $("<td>").text(ret_customer_name);
        tr.append(td);
        var td = $("<td>").text(ret_contact_number);
        tr.append(td);
        var td = $("<td>").text(ret_address);
        tr.append(td);

        tbody.append(tr);
      })
</script>



<script>

   
    $('.toglerViewOnline').click(function() {
        
        var ret_ol_date = $(this).attr('data-ret_ol_date');
        var get_prod_name = $(this).attr('data-get_prod_name');

       
        var ret_ol_transaction_code = $(this).attr('data-ret_ol_transaction_code');
        var ret_ol_product_code = $(this).attr('data-ret_ol_product_code');
        var ret_ol_qty = $(this).attr('data-ret_ol_qty');
        var ret_ol_request = $(this).attr('data-ret_ol_request');
        var ret_ol_paymethod = $(this).attr('data-ret_ol_paymethod');
        var ret_ol_reason = $(this).attr('data-ret_ol_reason');
        var ret_ol_customer_name = $(this).attr('data-ret_ol_customer_name');
        var ret_ol_contact_number = $(this).attr('data-ret_ol_contact_number');
        var ret_ol_address = $(this).attr('data-ret_ol_address');
        var get_prod_name = $(this).attr('data-get_prod_name');

        var tbody = $('#tbody');
         var total = 0;

        tbody.empty(); // Clear the tbody

        var tr = $("<tr>");
        var td = $("<td>").text(ret_ol_date);
        tr.append(td);
        var td = $("<td>").text(ret_ol_transaction_code);
        tr.append(td);
        var td = $("<td>").text(ret_ol_product_code);
        tr.append(td);
        var td = $("<td>").text(get_prod_name);
        tr.append(td);
        var td = $("<td>").text(ret_ol_request);
        tr.append(td);
        var td = $("<td>").text(ret_ol_qty);
        tr.append(td);
        var td = $("<td>").text(ret_ol_reason);
        tr.append(td);
       
        var td = $("<td>").text(ret_ol_customer_name);
        tr.append(td);
        var td = $("<td>").text(ret_ol_contact_number);
        tr.append(td);
        var td = $("<td>").text(ret_ol_address);
        tr.append(td);

        tbody.append(tr);

    });
</script>
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
      
    </body>
</html>
