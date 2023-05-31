<?php
include "connection.php";
include("checkout.php");
include("navigation.php");
if(isset($_SESSION["acc_id"])){
    $acc_id = $_SESSION["acc_id"];
    
    $get_record = mysqli_query ($connections,"SELECT * FROM account where acc_id='$acc_id' ");
    $row = mysqli_fetch_assoc($get_record);
    $acc_type = $row ["acc_type"];
    if($acc_type =="administrator"){
             //redirect administrator
             echo "<script>window.location.href='../administrator/'</script>";	
 }else if($acc_type =="delivery person"){
             //redirect administrator
                echo "<script>window.location.href='../delivery/';</script>";	      
 }else if($acc_type =="cashier"){
}else{
				echo "<script>window.location.href='../';</script>";	  
	  }
 }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
 
<style>
  .btn-fixed-width {
    width: 200px; /* Default width */
  }

  /* Adjust the width for smaller screens */
  @media (max-width: 576px) {
    .btn-fixed-width {
      width: 100%; /* Full width on small screens */
    }
  }
</style>


    <script>

        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>
    <title>Transaction History</title>
   </head>
<body >
   
    <div class="container-fluid">
        <div class="row">
            <div class="col-10">
                <div class="container-fluid d-flex justify-content-center mb-2">
                    <div class="card w-100">             
                        <div class="card-body">
                          <h5 class="card-title" style="text-align: center;">History of Transaction</h5>
                          <div class="container">
                            <div class="table-responsive">
                                <table id="example"  class="table">
                                    <thead>
                                      <tr>
                                        <th scope="col" style='width:10;'>Transaction&nbsp;code</th>
                                       
                                        <th scope="col">Transaction Date</th>
                                        <th scope="col">Status</th>

                                        <th scope="col">Cashier</th>
                                       
                                        
                                        <th scope="col">Action</th>
                                      
                                        
                                      </tr>
                                    </thead>
                                  
                                    <tbody>
                                    <?php  
                            //        $view_query = mysqli_query($connections,"SELECT * from pos_orders where orders_status='done' group by orders_tcode"); 
                            $view_query = mysqli_query($connections, "SELECT *,
                            GROUP_CONCAT(orders_prod_id SEPARATOR ', ') AS order_id_grp,
                            GROUP_CONCAT(prod_name SEPARATOR ', ') AS product_name_grp,
                            GROUP_CONCAT(orders_prodQty SEPARATOR ', ') AS order_qty_grp,
                            GROUP_CONCAT(prod_currprice SEPARATOR ', ') AS product_currprice_grp,
                            GROUP_CONCAT((prod_currprice*orders_prodQty) SEPARATOR ', ') AS totalprice
                            FROM pos_orders as a 
                            LEFT JOIN product as b 
                            ON a.orders_prod_id = b.prod_id
                            where orders_status='done'
                            GROUP BY orders_tcode;");
                                 
                                    $item_numer=0;
                                    while($row = mysqli_fetch_assoc($view_query)){ //<-- ginagamit tuwing kukuha ng database
                                     
                                            $orders_orders_id = $row["orders_orders_id"];
                                            $orders_tcode = $row["orders_tcode"];
                                            $orders_prod_id = $row["orders_prod_id"];
                                            $orders_cart_id = $row["orders_cart_id"];
                                            $orders_prodQty = $row["orders_prodQty"];
                                            $orders_discount = $row["orders_discount"];
                                            $orders_tax = $row["orders_tax"];
                                            $orders_date = $row["orders_date"];


                                            $refund_deadline = date("Y-m-d H:i:s", strtotime($orders_date . " + 7 days")); // Calculate the refund deadline

                                            $current_time = date("Y-m-d H:i:s"); // Get the current date and time
                                            
                                            if ($current_time <= $refund_deadline) {
                                                // Customer is still within the 7-day refund window
                                                $status= "<b style='color:green;'>You can request a return or refund.</b>";
                                            } else {
                                                // Refund window has expired
                                                $status= "<b style='color:red;'>The Guarantee has expired.</b>";
                                            }

                                            $orders_final = $row["orders_final"];
                                            $orders_payment = $row["orders_payment"];
                                            $orders_change = $row["orders_change"];
                                            $orders_user_id = $row["orders_user_id"];
                                            $orders_status = $row["orders_status"];

                                            $totalprice = $row["totalprice"];
                                            //grp
                                            $order_id_grp = $row["order_id_grp"];
                                            $product_name_grp = $row["product_name_grp"];
                                            $order_qty_grp = $row["order_qty_grp"];
                                            $product_currprice_grp = $row["product_currprice_grp"];
                                        
                                                   
                                            
                                           $get_account = mysqli_query ($connections,"SELECT * FROM account where acc_id='$orders_user_id' ");
                                           $accrow = mysqli_fetch_assoc($get_account);
                                            $db_acc_fname = $accrow["acc_fname"];
                                            $db_acc_lname = $accrow["acc_lname"];
                                            $fullname=$db_acc_fname." ".$db_acc_lname;


                                            $getprod = mysqli_query ($connections,"SELECT * FROM product where prod_id='$orders_prod_id' ");
                                            $prodrow = mysqli_fetch_assoc($getprod);
                                             $prod_name = $prodrow["prod_name"];
                                             $prod_currprice = $prodrow["prod_currprice"];
                                    
                                             $orders_date=date("M j Y, g:ia", strtotime($orders_date))
               
                                    ?>
                                      <tr>
                                        <td scope="row"><?php echo $orders_tcode?></td>
                                       
                                        <td><?php echo $orders_date?></td>
                                        <td><?php echo $status?></td>
                                        <td><?php echo  $fullname?></td>
                                 
                                    <td>
                                        <button onclick="redirectToDirectory('<?php echo $orders_tcode ?>')" class="form-control btn btn-success "
                                        data-bs-toggle="modal" data-bs-target="#ModalView"
                                        data-orders_orders_id="<?= $orders_orders_id ?>"
                                        data-orders_tcode="<?= $orders_tcode ?>"
                                        data-orders_prod_id="<?= $orders_prod_id ?>"
                                        data-orders_cart_id="<?= $orders_cart_id ?>"
                                        data-orders_prodQty="<?= $orders_prodQty ?>"

                                        data-orders_discount="<?= $orders_discount ?>"
                                        data-orders_tax="<?= $orders_tax ?>"
                                        data-orders_date="<?= $orders_date ?>"
                                        
                                        data-orders_final="<?= $orders_final ?>"
                                        data-orders_payment="<?= $orders_payment ?>"
                                        data-orders_change="<?= $orders_change ?>"

                                         data-orders_user_id="<?= $orders_user_id ?>"
                                            date-prod_name="<?= $prod_name ?>"
                                            date-prod_currprice="<?= $prod_currprice ?>"
                                            date-fullname="<?= $fullname ?>"

                                            data-prod_nem="<?=$product_name_grp?>"
                                          data-product_name_grp="<?=$product_name_grp?>"
                                          data-product_currprice_grp="<?=$product_currprice_grp?>"
                                          data-order_qty_grp ="<?=$order_qty_grp?>"
                                          data-order_id_grp ="<?=$order_id_grp?>"
                                          data-totalprice ="<?=$totalprice?>"
                                        
                                        >
                                       
                                            
                                        <?php  $fullname?>

                                        
                                        View</button>
                                     
                                    </td> 
                                      
                                      </tr>
                                      <?php  } ?>
                                    </tbody>      
                                  </table>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
</div>


<script>
  function redirectToDirectory(orderCode) {
    window.location.href = "receipt.php?RDcode=" + orderCode;
  }
</script>
<div class="modal fade" id="ModalView" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" style="max-width: 800px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Transaction Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <div class="table-responsive">
        <b>Transaction code:</b> <span id="orders_tcode"></span>
       <br>
        <b> Order Date :</b> <span id="orders_date"></span>
          <label id="orders_date" style="float: right;"></label>

  
          <br>
          <b>Cashier: </b><span id="fullnameDisplay"></span>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Product ID</th>
                <th scope="col">Product name</th>
                <th scope="col">Qty</th>
                <th scope="col">Price</th>
                <th scope="col">Subtotal</th>
               
              </tr>
              
            </thead>
            
            <tbody id="tbody">
              <tr>
                <td id="order_id_grp"></td>
                <td id="product_name_grp"></td>
                <td id="orders_prodQty"></td>
                <td id="orders_subtotal"></td>
              </tr>

              
            </tbody>
          </table>
         
      
        </div>
        <div class="container">
                                                              <div class="row">
                                                                  <div class="col">
                                                                      <div class="container">
                                                                          
                                                                      </div>
                                                                  </div>
                                                                  <div class="col">
                                                                      <div class="container d-flex justify-content-end">
                                                                          <div class="card" style="width: 25rem;">
                                                                              <div class="card-body">
                                                                                <div class="container">
                                                                                


                                                                                  <div class="row">
                                                                                      <div class="col">
                                                                                          <div class="container d-flex justify-content-end">
                                                                                              <p class="card-text">Sub Total:</p>
                                                                                          </div>
                                                                                      </div>
                                                                                      <div class="col">
                                                                                          <div class="container d-flex justify-content-left">
                                                                                              <p class="card-text" id="subtowtal">₱ 1,000.00</p>
                                                                                          </div>
                                                                                      </div>
                                                                                  </div>

                                                                                 


                                                                                  <div class="row mb-2">
                                                                                      <div class="col">
                                                                                          <div class="container d-flex justify-content-end">
                                                                                              <p class="card-text">Value Added Tax:</p>
                                                                                          </div>
                                                                                      </div>
                                                                                      <div class="col">
                                                                                          <div class="container d-flex justify-content-left">
                                                                                              <p class="card-text" ><span id="subtax"></span>%</p>
                                                                                          </div>
                                                                                      </div>
                                                                                  </div>

                                                                                  <div class="row mb-2">
                                                                                      <div class="col">
                                                                                          <div class="container d-flex justify-content-end">
                                                                                              <p class="card-text">Total Discount:</p>
                                                                                          </div>
                                                                                      </div>
                                                                                      <div class="col">
                                                                                          <div class="container d-flex justify-content-left">
                                                                                              <p class="card-text" id="discountPercent">₱ 0.00</p>
                                                                                          </div>
                                                                                      </div>
                                                                                  </div>

                                                                                  <div class="container border"></div>
                                                                                  <div class="row">
                                                                                      <div class="container d-flex justify-content-center">
                                                                                          Total Due: &nbsp; <span id="totalDue"> </span>
                                                                                      </div>
                                                                                 
                                                                                  </div>
                                                                         
                                                                                </div>
                                                                              </div>
                                                                            </div>
                                                                            
                                                                    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="btnPrint" class="btn btn-primary">Print</button>
      </div>
    </div>
  </div>
</div>





<script>
 

                                        
  
  $('.toglerView').click(function() {
    
    var orders_user_id = $(this).data('orders_user_id');
    var orders_prod_id = $(this).attr('data-orders_prod_id');
    var orders_tcode = $(this).attr('data-orders_tcode');
    var orders_date = $(this).attr('data-orders_date');
    var orders_prodQty = $(this).attr('data-orders_prodQty');

    var product_name_grp = $(this).attr('data-product_name_grp'); 
    var product_currprice_grp = $(this).attr('data-product_currprice_grp'); 
    var order_qty_grp = $(this).attr('data-order_qty_grp'); 
    var order_id_grp = $(this).attr('data-order_id_grp'); 


    var orders_discount = $(this).attr('data-orders_discount');     
    
    var orders_payment = $(this).attr('data-orders_payment');
    var prod_currprice = $(this).attr('data-prod_currprice');
    var orders_final = $(this).attr('data-orders_final');
    var orders_change = $(this).attr('data-orders_change');
    
    var fullnameDisplay = $(this).attr('date-fullname');
    var orders_user_id = $(this).attr('data-orders_user_id');
      //money format//fullname
      
    var totalprice = $(this).data('totalprice');
      
    var tbody = $('#tbody');

    
    $('#fullnameDisplay').text(fullnameDisplay)
    $('#orders_date').text(orders_date)
    $('#orders_tcode').text(orders_tcode)


    tbody.empty(); // Ito ang karagdagang bahagi para burahin ang mga dati at i-reset ang tbody.


    var prodname = product_name_grp.split(',');
    var product_name_grp = product_name_grp.split(',');
    var order_qty_grp = order_qty_grp.split(',');
    var product_currprice_grp = product_currprice_grp.split(',');
    var order_id_grp = order_id_grp.split(',');
    var totalprice = totalprice.split(',');

    var total = 0;

    prodname.forEach((product,index) => {
        var tr = $("<tr>");
        var td = $("<td>").text(order_id_grp[index]);
        tr.append(td);
        var td = $("<td>").text(product);
        tr.append(td);
        var td = $("<td>").text(order_qty_grp[index]);
        tr.append(td);
        var td = $("<td>").text(product_currprice_grp[index]);
        tr.append(td);
        var td = $("<td>").text(totalprice[index]);
        tr.append(td);
        tbody.append(tr);


        total += parseFloat(totalprice[index]);
    });
    
    var tax = parseFloat(<?php echo json_encode($db_system_tax);?>);
   
    
   

    var taxPercent = tax * 100;

    var subtax = tax * total;

    var discountPercent = (orders_discount * total)/100;


    $("#subtowtal").text(total.toLocaleString('en-PH', { style: 'currency', currency: 'PHP' }));
    $("#subtax").text(taxPercent);
    
    $("#discountPercent").text(discountPercent.toLocaleString('en-PH', { style: 'currency', currency: 'PHP' }));
    total += subtax;
    total -= discountPercent;
    $("#totalDue").text(total.toLocaleString('en-PH', { style: 'currency', currency: 'PHP' }));
});


</script>