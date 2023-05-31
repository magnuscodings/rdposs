<?php 

include("backend/back_navbar.php");

include "../connection.php";
include "../back_account.php";
include "navigation.php";
include "../addstocks.php";


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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 



    <script>

        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>
    <title>Check orders</title>
   </head>
<body >
   
    


    <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
            <?php include "sidebar.php"; ?>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                    <h1 class="mt-4" >List of orders</h1>
<div class="container-fluid">
    <div class="row justify-content-center"> <!-- Center the row -->
        <div class="col-15">
            <div class="container-fluid d-flex justify-content-center mb-2">
                <div class="card w-100">
                    <div class="card-body">
                        
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
            GROUP_CONCAT(acc_fname SEPARATOR ', ') AS customer_name_grp,
             GROUP_CONCAT(orders_prod_id SEPARATOR ', ') AS order_id_grp,
             GROUP_CONCAT(prod_name SEPARATOR ', ') AS product_name_grp,
             GROUP_CONCAT(orders_qty SEPARATOR ', ') AS order_qty_grp,
             GROUP_CONCAT(prod_currprice SEPARATOR ', ') AS product_currprice_grp,
             GROUP_CONCAT((prod_currprice*orders_qty) SEPARATOR ', ') AS totalprice
             FROM orders as a 
             LEFT JOIN product as b 
             ON a.orders_prod_id = b.prod_id
             LEFT JOIN account as acc_b 
             ON a.orders_customer_id = acc_b.acc_id
             WHERE  (orders_status='Complete' OR  orders_status='Not Delivered' OR orders_status='Delivered'
             OR orders_status='In-Transit'OR orders_status='Preparing') AND display_status='0'
             GROUP BY order_transaction_code;");
              $item_numer=0;
              
              while($row = mysqli_fetch_assoc($view_query)){ //<-- ginagamit tuwing kukuha ng database
                                             $orders_prod_id = $row["orders_prod_id"];
                                             
                                            $orders_ship_fee = $row["orders_ship_fee"];
                                            $orders_voucher_name = $row["orders_voucher_name"];
                                            $orders_voucher_rate = $row["orders_voucher_rate"];




                                            $orders_paymethod = $row["orders_paymethod"];
                                            $orders_subtotal = $row["orders_subtotal"];
                                            $order_id_grp = $row["order_id_grp"];

                                            $product_name_grp = $row["product_name_grp"];

                                            $customer_fname = $row["acc_fname"];
                                            $customer_lname = $row["acc_lname"];
                                            $customer_id_grp = $row["acc_id"];

                                            $customer_name_grp = $customer_fname." ".$customer_lname;
                                    

                                            $order_qty_grp = $row["order_qty_grp"];
                                            $product_currprice_grp = $row["product_currprice_grp"];
                                            $totalprice = $row["totalprice"];                        
                                            $db_orders_date = $row["orders_date"];
                                            $orders_date =date("M j Y, g:ia", strtotime($db_orders_date ));

                                            $orders_status = $row["orders_status"];
                                            $order_transaction_code = $row["order_transaction_code"];
                                            $orders_qty = $row["orders_qty"];
                                            
                                            $item_numer++;                      
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
                                   
                                      
                                        
                                        <td>
                                  <?php if($orders_status=="Not Delivered"){
                                        
                                        echo  "<b style='color:red;'>".$orders_status."</b>";

                                        }else if($orders_status=="Complete"){
                                        
                                          echo  "<b style='color:green; '>".$orders_status."</b>";

                                        }else{
                                          echo  "<b style='color:gray;'>".$orders_status."</b>";
                                        }
                                        
                                        ?></td>
                                        <td>
                                        <div class="container text-center">
    <div class="row align-items-start">
    <div class="container">
                                        <!--START BUTTON
                                    $prod_name/orders_qty/prod_currprice//customer_name_grp
                                    -->
                                    <button type="button" 
                                            class="btn btn-primary togler w-3" 
                                            data-bs-toggle="modal"
                                            data-bs-target="#exampleModal"
                                            data-id="<?=$orders_prod_id?>"
                                            data-transaction="<?=$order_transaction_code?>"
                                            data-orders_address="<?=$orders_address?>"
                                            data-orders_prod_id="<?=$orders_prod_id?>"
                                            data-customer_id_grp="<?=$customer_id_grp?>"
                                            data-prod_name="<?=$prod_name?>"
                                            data-orders_qty="<?=$orders_qty?>"
                                            data-prod_currprice="<?=$prod_currprice?>"
                                            data-prod_nem="<?=$product_name_grp?>"
                                            data-product_name_grp="<?=$product_name_grp?>"
                                            data-product_currprice_grp="<?=$product_currprice_grp?>"
                                            data-order_qty_grp="<?=$order_qty_grp?>"
                                            data-order_id_grp="<?=$order_id_grp?>"
                                            data-totalprice="<?=$totalprice?>"
                                            data-customer_name_grp="<?=$customer_name_grp?>"
                                            data-orders_ship_fee="<?=$orders_ship_fee?>"
                                            data-orders_voucher_name="<?=$orders_voucher_name?>"
                                            data-orders_voucher_rate="<?=$orders_voucher_rate?>"
                                    >
                                    
                                        View
                                    </button>

                                         
                                      </div>
                                  
                                        
                                    </div>
                                    <div class="container">
                                     <?php if($orders_status=="Preparing"){?>
                                    <button type="button" class="btn btn-danger canceltoogle"  data-bs-toggle="modal" data-bs-target="#modalCancel" 
                                        data-transaction="<?=$order_transaction_code?>">
                                          Cancel
                                      </button>
                                      <?php }else if($orders_status=="Not Delivered" || $orders_status=="Complete"){?>
                                        
                                        <button type="button" class="btn btn-danger Toglearchive"data-bs-toggle="modal" data-bs-target="#modalarchive" 
                                        data-transaction="<?=$order_transaction_code?>"
                                        >
                                          Archive
                                      </button> 
                                        <?php }?> 
                                        
                                      
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
                                                                <strong id="customer_name_grp"></strong>#(RDL<strong id="customer_id_grp"></strong>)

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
                                                                                              <p class="card-text" id="subtowtal">1,000.00</p>
                                                                                          </div>
                                                                                      </div>
                                                                                  </div>
                                                                                   <!--- 
                                   $orders_ship_fee = $row["orders_ship_fee"];
                                            $orders_voucher_name = $row["orders_voucher_name"];
                                            $orders_voucher_rate = $row["orders_voucher_rate"];
                                  -->
                                                                                  <div class="row mb-2">
                                                                                      <div class="col">
                                                                                          <div class="container d-flex justify-content-end">
                                                                                              <p class="card-text">VAT:&nbsp;</p>(<p class="card-text" ><span id="taxPercent"></span>%)</p>
                                                                                          </div>
                                                                                      </div>
                                                                                      <div class="col">
                                                                                          <div class="container d-flex justify-content-left">
                                                                                              <p class="card-text" ><span id="formattedsubtax"></span></p>
                                                                                          </div>
                                                                                      </div>
                                                                                  </div>

                                                                                  <div class="row mb-2">
                                                                                      <div class="col">
                                                                                          <div class="container d-flex justify-content-end">
                                                                                              <p class="card-text">Shipfee:&nbsp;</p>
                                                                                          </div>
                                                                                      </div>
                                                                                      <div class="col">
                                                                                          <div class="container d-flex justify-content-left">
                                                                                              <p class="card-text" ><span id="orders_ship_fee"></span></p>
                                                                                          </div>
                                                                                      </div>
                                                                                  </div>

                                                                                  <div class="row mb-2">
                                                                                      <div class="col">
                                                                                          <div class="container d-flex justify-content-end">
                                                                                              <p class="card-text">Voucher&nbsp;</p>
                                                                                          </div>
                                                                                      </div>
                                                                                      <div class="col">
                                                                                          <div class="container d-flex justify-content-left">
                                                                                              <p class="card-text" ><span id="orders_voucher_name"></span></p>
                                                                                          </div>
                                                                                      </div>
                                                                                  </div>

                                                                                  <div class="container border"></div>
                                                                                  <div class="row">
                                                                                      <div class="container d-flex justify-content-center">
                                                                                          Total Due:<span id="finalDue"> </span>
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


                                          <!--modalarchive--->

                                          <div class="modal fade" id="modalarchive" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-body">
                                                  <div class="container">
                                                    <div class="container mb-3" style="text-align: center;">
                                                        ARE YOU SURE YOU<br>
                                                        WANT TO MOVE TO ARCHIVE THIS RECORD ?<br>
                                                        
                                                    </div>
                                                    <form action="../back_cancel.php" method="POST">
                                                    <input type="text" hidden id="transactionArchive" name="transaction">
                                                    <div class="container d-flex justify-content-center">
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="container">
                                                                    <button type="button" data-bs-dismiss="modal" class="btn btn-danger">NO</button>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="container">
                                                                    <button type="submit" name="btnArchive" class="btn btn-success">YES</button>
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

                                        <div class="modal fade" id="modalCancel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-body">
                                                <div class="container">

                                                <form action="../back_cancel.php" method="POST">
                                                  <div class="container mb-3" style="text-align: center;">
                                                      ARE YOU SURE YOU<br>
                                                      WANT TO CANCEL<br>
                                                      ORDERS
                                                  </div>
                                                  

                                                  <input type="hidden" id="transactionCancel" name="transaction">

                                                 
                                                  <div class="container d-flex justify-content-center">
                                                      <div class="row">
                                                          <div class="col">
                                                              <div class="container">
                                                                  <button type="button" data-bs-dismiss="modal" class="btn btn-danger">NO</button>
                                                              </div>
                                                          </div>
                                                          <div class="col">
                                                              <div class="container">
                                                                  <button type="submit" name="btnCancel" class="btn btn-success">YES</button>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      </form>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
 </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

 
<script>
$('.togler').click(function() {
  
  var customer_id_grp = $(this).attr('data-customer_id_grp');

  $("#customer_id_grp").text(customer_id_grp);
  
  var orders_ship_fee = parseFloat($(this).attr('data-orders_ship_fee'));
  
  var formattedTotal = orders_ship_fee.toLocaleString('en-PH', { style: 'currency', currency: 'PHP' });
  $("#orders_ship_fee").text(formattedTotal);


  var orders_voucher_name = $(this).attr('data-orders_voucher_name');
  $("#orders_voucher_name").text(orders_voucher_name);



  var orders_prod_id = $(this).attr('data-orders_prod_id');
  var transaction = $(this).attr('data-transaction');
  var order_date = $(this).attr('data-order_date');
  var orders_qty = $(this).attr('data-orders_qty');
  var customer_name_grp = $(this).attr('data-customer_name_grp'); // Bagong pangalan ng variable
  var prod_name = $(this).attr('data-prod_name');
  var prod_currprice = $(this).attr('data-prod_currprice');
  var orders_subtotal = $(this).attr('data-orders_subtotal');
  var prod_nem = $(this).attr('data-prod_nem');
  var product_name_grp = $(this).attr('data-product_name_grp');
  var order_qty_grp = $(this).attr('data-order_qty_grp');
  var product_currprice_grp = $(this).attr('data-product_currprice_grp');
  var order_id_grp = $(this).attr('data-order_id_grp');
  var totalprice_data = $(this).attr('data-totalprice'); // Bagong pangalan ng variable

  var tbody = $('#tbody');

  tbody.empty();

  var prodname = prod_nem.split(',');
  var product_name_grp_data = product_name_grp.split(','); // Bagong pangalan ng variable
  var order_qty_grp = order_qty_grp.split(',');
  var product_currprice_grp = product_currprice_grp.split(',');
  var order_id_grp = order_id_grp.split(',');

  var totalprice = totalprice_data.split(','); // Bagong pangalan ng variable

  var total = 0;
  prodname.forEach((product, index) => {

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

  var tax = parseFloat(<?php echo json_encode($db_system_tax); ?>);
  var taxPercent = tax * 100;
  var subtax = tax * total;
  //$("#subtowtal").text(total.toFixed(2));
  var formattedTotal = total.toLocaleString('en-PH', { style: 'currency', currency: 'PHP' });
  $("#subtowtal").text(formattedTotal);

  var formattedsubtax = subtax.toLocaleString('en-PH', { style: 'currency', currency: 'PHP' });
  $("#formattedsubtax").text(formattedsubtax);

  
  $("#taxPercent").text(taxPercent);

  total += subtax;
  
  var orders_voucher_rate = $(this).attr('data-orders_voucher_rate');
  var clean_orders_voucher_rate = orders_voucher_rate.replace(/[^0-9.]/g, '');
  var clean_orders_voucher_rate_decimal=clean_orders_voucher_rate/100
  var voucher_equvalent= clean_orders_voucher_rate_decimal*(total+orders_ship_fee)
  
  var_total_ship=total+orders_ship_fee
  
  var finalDue= var_total_ship-voucher_equvalent

  $("#subtax").text(subtax.toFixed(2));
  var formattedfinalDue= finalDue.toLocaleString('en-PH', { style: 'currency', currency: 'PHP' });
  $("#finalDue").text(formattedfinalDue);

  $("#transaction_archive").val(transaction);
  
  
  console.log(transaction)

  

  $("#customer_name_grp").text(customer_name_grp);

});//customer_name_grp
</script>

<script>
$('.canceltoogle').click(function() {
  var transaction = $(this).attr('data-transaction');
  $('#transactionCancel').val(transaction);
});
</script>


<script>
$('.Toglearchive').click(function() {
  var transaction = $(this).attr('data-transaction');
  $('#transactionArchive').val(transaction);


  console.log(transaction)
});
</script>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    
                </footer>
            </div>
        </div>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>

        
   </body>

<script>

  function showExpirationDateInput() {
    document.getElementById('expirationDateInput').style.display = 'block';
    document.getElementsByName('expirationOption')[1].removeAttribute('required');
  }
  function hideExpirationDateInput() {
    document.getElementById('expirationDateInput').style.display = 'none';
    document.getElementsByName('prod_expiration')[0].value = ''; // Resetting the value
    document.getElementsByName('expirationOption')[0].setAttribute('required', 'required');
  }

  
      //db_prod_id
      $('.toglerView').click(function() {
  var db_prod_id_view = $(this).data('db_prod_id');
  var db_prod_name = $(this).data('db_prod_name');
  var db_prod_added = $(this).data('db_prod_added');
  var db_prod_edit = $(this).data('db_prod_edit');
  var db_prod_orgprice = $(this).data('db_prod_orgprice');
  var db_prod_currprice = $(this).data('db_prod_currprice');
  var db_prod_stocks = $(this).data('db_prod_stocks');
  var db_unit_name = $(this).data('db_unit_name');
  var db_category_name = $(this).data('db_category_name');
  var db_prod_status = $(this).data('db_prod_status');
  var db_prod_image = $(this).data('db_prod_image');
  var db_prod_description = $(this).data('db_prod_description');

  $('#db_prod_id_view').text(db_prod_id_view);
  $('#db_prod_nameView').text(db_prod_name);
  $('#db_prod_added').text(db_prod_added);
  $('#db_prod_edit').text(db_prod_edit);
  $('#db_prod_orgprice').text(db_prod_orgprice);
  $('#db_prod_currprice').text(db_prod_currprice);
  $('#db_prod_stocks').text(db_prod_stocks);
  $('#db_unit_name').text(db_unit_name);
  $('#db_category_name').text(db_category_name);
  $('#db_prod_status').text(db_prod_status);

  $('#db_prod_image').attr('src', '../upload_prodImg/' + db_prod_image);

  // Set the description text with line breaks and truncation
  var db_prod_description_element = $('#db_prod_description');
  var maxLength = 200; // Maximum length for description before truncation
  var truncatedText = db_prod_description.length > maxLength ? db_prod_description.substring(0, maxLength) + '...' : db_prod_description;
  var descriptionText = truncatedText.replace(/\n/g, '<br>'); // Replace newline characters with line breaks
  db_prod_description_element.html('<i>' + descriptionText + '</i>');
  
  // Set the color of product status based on availability
  var db_prod_status_element = $('#db_prod_status');
  db_prod_status_element.text(db_prod_status);
  
  if (db_prod_status === "AVAILABLE") {
    db_prod_status_element.css("color", "green");
  } else {
    db_prod_status_element.css("color", "red");
  }
});

//toglerAddStock

$('.toglerAddStock').click(function(){


  db_prod_id_add = $(this).attr('data-db_prod_id_add')
        $('#db_prod_id_add').val(db_prod_id_add)
  
  db_prod_name1 = $(this).attr('data-db_prod_name')
        $('#db_prod_name1').text(db_prod_name1)
})

    
$('.toglerRemove').click(function(){

    db_prod_name = $(this).attr('data-db_prod_name')
            $('#db_prod_name').val(db_prod_name)



        db_prod_id = $(this).attr('data-db_prod_id')
            $('#db_prod_id').val(db_prod_id)


            acc_id = $(this).attr('data-acc_id')
            $('#acc_id').val(acc_id)


		db_prod_name = $(this).attr('data-db_prod_name')
		$('#db_prod_name').val(db_prod_name)
-
		$('#db_prod_nameDisplay').text(db_prod_name)
	})

</script>
</html>