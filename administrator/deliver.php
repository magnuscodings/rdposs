<?php 


include "navigation.php"; 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>
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
                        <h5 class="card-title" style="text-align: center;"><h1>LIST OF ORDERS</h1>
                        <div class="container">
                                <table id="example"  class="table">
                                    <thead>
                                      <tr>
                                        <th scope="col">Order ID</th>                                      
                                        <th scope="col">Transaction Code</th>
                                        <th scope="col">Order Date</th>
                                       
                                        <th scope="col">Mode of payment</th>
                                      
                                      
                                        <th scope="col">Status</th>
                                       
                                        <th scope="col" style="text-align: center;">Action</th>
                                      </tr>
                                    </thead>
                                  
                                    <tbody>
                                    <?php                           
             $view_query = mysqli_query($connections, "SELECT *,
             GROUP_CONCAT(orders_prod_id SEPARATOR ', ') AS order_id_grp,
             GROUP_CONCAT(prod_name SEPARATOR ', ') AS product_name_grp,
             GROUP_CONCAT(orders_qty SEPARATOR ', ') AS order_qty_grp,
             GROUP_CONCAT(prod_currprice SEPARATOR ', ') AS product_currprice_grp,
             GROUP_CONCAT((prod_currprice*orders_qty) SEPARATOR ', ') AS totalprice
             FROM orders as a 
             LEFT JOIN product as b 
             ON a.orders_prod_id = b.prod_id
             WHERE orders_status ='in-transit'
             GROUP BY order_transaction_code;");
                                    
                                   
                                    // where account_type='0'
                                    $item_numer=0;
                                    while($row = mysqli_fetch_assoc($view_query)){ //<-- ginagamit tuwing kukuha ng database
                                        
                                            
                                            $orders_prod_id = $row["orders_prod_id"];
                                            $orders_customer_id = $row["orders_customer_id"];
                                           
                                            $orders_paymethod = $row["orders_paymethod"];
                                            $orders_subtotal = $row["orders_subtotal"];
                                            

                                            $order_id_grp = $row["order_id_grp"];
                                            $product_name_grp = $row["product_name_grp"];
                                            $order_qty_grp = $row["order_qty_grp"];
                                            $product_currprice_grp = $row["product_currprice_grp"];
                                            $totalprice = $row["totalprice"];
                                           
                                            $db_orders_date = $row["orders_date"];
                                            $orders_date =date("M j Y, g:ia", strtotime($db_orders_date ));

                                            $orders_status = $row["orders_status"];
                                            $order_transaction_code = $row["order_transaction_code"];
                                            $orders_qty = $row["orders_qty"];
                                            
                                            $item_numer++;       
                                            
                                            $get_accountrecord = mysqli_query ($connections,"SELECT * FROM account where acc_id ='$orders_customer_id' ");
                                            $row = mysqli_fetch_assoc($get_accountrecord);
                                            $acc_fname=$row["acc_fname"];
                                            $acc_lname=$row["acc_lname"];
                                            $customer_fullname=$acc_fname." ".$acc_lname;
                                    
                                            $get_productrecord = mysqli_query ($connections,"SELECT * FROM product where prod_id  ='$orders_prod_id' ");
                                            $row = mysqli_fetch_assoc($get_productrecord);
                                            $prod_name=$row["prod_name"];
                                            $prod_unit_id=$row["prod_unit_id"];
                                            $prod_category_id=$row["prod_category_id"];
                                            $prod_image=$row["prod_image"];
                                            $prod_currprice=$row["prod_currprice"]
                                    ?>
                                      <tr>
                                        <td scope="row"><?php echo $item_numer?></td>
                                        <td scope="row"><?php echo $order_transaction_code?></td>
                                        <td><?php echo $orders_date?></td>
                                       
                                        <td><?php echo  $orders_paymethod?>&nbsp;
                                        
                                        
<script>
function backTo() {
window.location.href = "addstocks.php";
}
</script>
                                    
                                    </td>
                                   
                                      
                                        
                                        <td><?php echo  $orders_status;?></td>
                                        <td>
                                        <div class="container text-center">
    <div class="row align-items-start">
    <div class="container">
                                        <!--START BUTTON
                                    $prod_name/orders_qty/prod_currprice
                                    -->
                                          <button type="button" 
                                          class="btn btn-primary togler w-25" 
                                          data-bs-toggle="modal"
                                          data-bs-target="#exampleModal"
                                          data-id="<?=$orders_prod_id?>"
                                          data-transaction="<?=$order_transaction_code?>"
                                          data-$orders_address="<?=$orders_address?>"
                                          data-orders_prod_id="<?=$orders_prod_id?>"
                                          data-customer_fullname="<?=$customer_fullname?>"
                                          data-prod_name="<?=$prod_name?>"
                                          data-orders_qty="<?=$orders_qty?>"
                                          data-prod_currprice="<?=$prod_currprice?>"
                                          data-prod_nem="<?=$product_name_grp?>"
                                          data-product_name_grp="<?=$product_name_grp?>"
                                          data-product_currprice_grp="<?=$product_currprice_grp?>"
                                          data-order_qty_grp ="<?=$order_qty_grp?>"
                                          data-order_id_grp ="<?=$order_id_grp?>"
                                          data-totalprice ="<?=$totalprice?>"
                                         
                                           >
                                              View
                                          </button>
                                         
                                      </div>
                                      <div class="container">
                                        <button type="button" class="btn btn-success tugle"  data-bs-toggle="modal" data-bs-target="#exampleModal1" 
                                        data-transaction="<?=$order_transaction_code?>"
                                        >
                                            Deliver
                                        </button>
                                        
                                    </div>
                                    <div class="container">
                                      <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModa2">
                                          Cancel
                                      </button>
                                      
                                  </div>
</div>   

                                        </td>
                                      </tr>
                                      <?php  } ?>
                                    </tbody>
                                    
                                  </table>
                                
                                  </div>
                                  
                    </div>
                    
         

                
    <!--VIEW ORDERS-->
   
         <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                              <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                  <div class="modal-body">
                                        
                                                      <div class="container">
                                                          <div class="row">
                                                          
                                                              <div class="col">

                                                              
                                                                  <div class="container">
                                                             
                                                                      <h1 id="customer_fullname"></h1>
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
                                                                        <th scope="col">Product ID</th>
                                                                        <th scope="col">Product Name</th>
                                                                        <th scope="col">Quantity</th>
                                                                        <th scope="col">Price</th>
                                                                        <th scope="col">Total Amount</th>
                                                                      
                                                                      </tr>
                                                                    </thead>
                                                                    <tbody id="tbody">
                                                                      <tr >
                                                                        <th id="orders_prod_id" scope="row"></th>
                                                                        <td id="prod_name"></td>
                                                                        <td id="orders_qty"></td>
                                                                        <td id="prod_currprice"></td>
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
                                                                                  <div class="container border"></div>
                                                                                  <div class="row">
                                                                                      <div class="container d-flex justify-content-center">
                                                                                          Total Due: ₱ <span id="totalDue"> </span>
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
                                                  </div>
                                                </div>
                                              </div>
                                          </div>


                                          <!--DELIVER--->

                                          <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-body">
                                                  <div class="container">
                                                    <div class="container mb-3" style="text-align: center;">
                                                        ARE YOU SURE YOU<br>
                                                        WANT TO PROCCED<br>
                                                        TO ORDERS
                                                    </div>
                                                    <form action="deliver.php" method="POST">
                                                    <input type="text" id="transactionDeliver" hidden name="transactionId">
                                                    <div class="container d-flex justify-content-center">
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="container">
                                                                    <button type="button" data-bs-dismiss="modal" class="btn btn-danger">NO</button>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="container">
                                                                    <button type="submit" name="confiem" class="btn btn-success">YES</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </form>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                        </div>

                                        <!---cancel--->

                                        <div class="modal fade" id="exampleModa2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>
<script>
     //start line sa pagpapasa ng data galing sa buttons
    //data-orders_prod_id
    //data-$orders_address
    // data-customer_fullname
    // data-prod_name/data-orders_qty
    //orders_subtotal/prod_currprice
    $('.togler').click(function(){
    var orders_prod_id = $(this).attr('data-orders_prod_id');
    var transaction = $(this).attr('data-transaction');
    var order_date = $(this).attr('data-order_date');
    var orders_qty = $(this).attr('data-orders_qty');
    var customer_fullname = $(this).attr('data-customer_fullname');     
    var prod_name = $(this).attr('data-prod_name');
    var prod_currprice = $(this).attr('data-prod_currprice');
    var orders_subtotal = $(this).attr('data-orders_subtotal');
    var prod_nem = $(this).attr('data-prod_nem');
    var product_name_grp = $(this).attr('data-product_name_grp');
    var order_qty_grp = $(this).attr('data-order_qty_grp');
    var product_currprice_grp = $(this).attr('data-product_currprice_grp');
    var order_id_grp = $(this).attr('data-order_id_grp');
    var totalprice = $(this).attr('data-totalprice');
   
    var tbody = $('#tbody');
  
    tbody.empty(); // Ito ang karagdagang bahagi para burahin ang mga dati at i-reset ang tbody.

    var prodname = prod_nem.split(',');
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
    $("#subtowtal").text(total);
    $("#subtax").text(taxPercent);
    total += subtax;
    $("#totalDue").text(total);
});

       //end line sa pagpapasa ng data galing sa buttons
</script>

<script>
    $('.tugle').click(function(){
        var transaction = $(this).attr('data-transaction')
        $('#transactionDeliver').val(transaction)
    })
</script>