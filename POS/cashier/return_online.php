<?php
include "connection.php";

include("navigation.php");
include "back_return.php";
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


<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="author" content="Bootstrap-ecommerce by Vosidiy">

<title><?php echo $db_system_name ?></title>
<link rel="shortcut icon" type="image/x-icon" href="../upload_system/<?php echo $db_system_logo ?>" >
<link rel="apple-touch-icon" sizes="180x180" href="../upload_system/<?php echo $db_system_logo ?>">
<link rel="icon" type="image/png" sizes="32x32" href="../upload_system/<?php echo $db_system_logo ?>">
<!-- jQuery -->
<!-- Bootstrap4 files-->
<link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css"/> 
<link href="assets/css/ui.css" rel="stylesheet" type="text/css"/>
<link href="assets/fonts/fontawesome/css/fontawesome-all.min.css" type="text/css" rel="stylesheet">
<!--<link href="assets/css/OverlayScrollbars.css" type="text/css" rel="stylesheet"/>-->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">  
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />

    <script>

$(document).ready(function () {
    $('#example').DataTable();
});
</script>
 <!-- Main -->
 <main class="main-container" style="z-index:2">
    <div class="fluid-container">
       <center> <h1>Return Records from Online orders</h1></center> 
        <div class="row">
            <div class="col-auto ms-auto m-3">
                <button class="btn btn-success addToggler" data-bs-toggle="modal" data-bs-target="#request">Add Record</button>
            </div>
        </div>
        <div class="table-responsive card">
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Product Code</th>
                        <th>Request</th>
                        <th>Quantity</th>
                        <th>Reason</th>
                        <th>Date</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $view_query = mysqli_query($connections, "SELECT * FROM return_ordering as a 
                    LEFT JOIN product as b 
                    ON a.ret_ol_product_code = b.prod_code
                    GROUP BY ret_ol_transaction_code;
                    ");
                    while ($row = mysqli_fetch_assoc($view_query)) {
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
                            <td><?= $ret_ol_product_code ?></td>
                            <td><?= $ret_ol_request ?></td>
                            <td><?= $ret_ol_qty ?></td>
                            <td><?= $ret_ol_reason ?></td>
                            <td><?= $ret_ol_date ?></td>

                            
                            <td class="text-center">
                                <button class="form-control btn btn-secondary toglerView"
                                data-bs-toggle="modal" data-bs-target="#ModalViewReturn"
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
                                
                                

                                >VIEW</button>

                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

 
<!-- Modal -->
<div class="modal fade" id="request" tabindex="-1" aria-labelledby="orderLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Return </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <p class="small" >Fill out Required fields.</p>
        <form method="POST" id="requestForm">
            <input type="text" name="addrequest" hidden>
            <div class="row">              
                <div class="col-sm-12 mb-2">
                    <div class="form-group form-group-default">
                        <label>Transaction Code</label>
                        <input type="text" value="<?= $tcode?>" placeholder="Enter Transaction Code" min="1"  name="tcode" class="form-control" Required>
                        
                    </div>
                </div>


                <div class="col-sm-12 mb-2">
                    <div class="form-group form-group-default">
                        <label>Product code:</label>
                        <input type="text" value="<?= $prod_code?>" placeholder="Enter Product code" min="1"  name="prod_code" class="form-control" Required>
                       
                    </div>
                </div>
                
            

                <div class="col-sm-12 mb-2">
                    <div class="form-group form-group-default">
                        <label>Quantity:</label>
                        <input type="number" value="<?= $quantity?>" placeholder="Quantity" min="1" id="quantity" name="quantity" class="form-control" Required>
                    </div>
                </div>

                

                <div class="col-sm-12 mb-2">
                    <div class="form-group form-group-default">
                        <label>Request:</label>
                        <select name="Request" class="form-control" >
                            <option value="">Select Request</option>
                            <option value="Refund" <?php if($request=='Refund'){echo "selected";}?>>Refund</option>
                            <option value="Return" <?php if($request=='Return'){echo "selected";}?>>Return</option>
                        </select>
                    </div>
                </div>

        
            
                <div class="col-sm-12 mb-2">
                    <div class="form-group form-group-default">
                        <label>Return reason:</label>
                        <textarea name="reason" cols="20" class="form-control" Required rows="5"><?= $reason?></textarea>
                     </div>
                </div>

                <div class="col-sm-12 mb-2">
                    <div class="form-group form-group-default">
                        <label>Customer namme:</label>
                       
                        <input type="text" value="<?=$cname?>" placeholder="Enter Customer name"  name="cname" class="form-control" Required>
                     </div>
                </div>

                <div class="col-sm-12 mb-2">
                    <div class="form-group form-group-default">
                        <label>Contact no:</label>
                        
                        <input type="text" value="<?= $cnom?>" placeholder="Enter Contact Number"  name="cnom" class="form-control" Required>
                     </div>
                </div>

                <div class="col-sm-12 mb-2">
                    <div class="form-group form-group-default">
                        <label>Address:</label>
                        <textarea name="address" cols="20" class="form-control" Required rows="5"><?= $address?></textarea>
                     </div>
                </div>
            </div>

      </div>
      <div class="modal-footer">

        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="btnReturnOnline" class="btn btn-primary">Confirm</button>
      </div>
      </form>

    </div>
  </div>
</div>


            

<!-- Modal -->
<div class="modal fade" id="ModalViewReturn" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
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
                                                                      <th scope="col"> Transaction#</th>
                                                                      <th scope="col"> Product#</th>
                                                                      <th scope="col"> Product name</th>
                                                                        <th scope="col">Request</th>
                                                                        <th scope="col">Quantity</th>
                                                                        <th scope="col">Reason</th>
                                                                        
                                                                        <th scope="col">Customer Name</th>
                                                                        <th scope="col">Contact number</th>
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


<script>

   
    $('.toglerView').click(function() {
        
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
