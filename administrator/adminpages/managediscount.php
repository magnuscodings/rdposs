<?php
include "backend/back_navbar.php";
include "../back_discount.php";
include "../update_discount.php";
include "navigation.php";
$discountNameErr = ""; 
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
                                 $finalDefault = $addship_in_orders + $get_tax_in_orders; // Calculate the total amount before applying the discount
                             
                                 if ($orders_voucher_rateClean) {
                                     $discount = $finalDefault * $orders_voucher_percent; // Calculate the discount amount
                                     $finalDefault = $finalDefault-$discount; // Add the discount amount to the final total with discount
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

        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

        
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
     
        <title>Manage discount</title>
       
    </head>
    <script>
$(document).ready(function () {
    new simpleDatatables.DataTable('#example');
});
</script>



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
                        <h1 class="mt-4" >Manage Discount</h1>
                        <div class="row">
                        <div class="card">
        <div class="card-body">
           
           
           
                <div class="container">
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label >Discount Name</label>
                        <input type="text" class="form-control" value='' name="discountName" value="" placeholder="First Name" >
                        <span class='error'><?=  $discountNameErr?></span>
                    </div>
                    
                    
                    
                    
                    


                   

                    <div class="mb-3">
                       <label >Discount Rate %</label>
                        <input type="text"  class="form-control"  name="discountRate" value="" placeholder="Enter Discount Rate">
                        <span class='error'><?=  $discountRateErr?></span>
                    </div>

                    
                    
                    
           
<div class="container d-flex justify-content-center">

    <button type="submit" name='btn_save_discount' class="form-control btn btn-primary" style='width:20%;'><b>ADD DISCOUNT</b></button>
</div>
</form>
<br>

<div class="card w-100">             
                        <div class="card-body">
                          
                          <div class="container">
                            <div class="table-responsive">
                                <table id="example"  class="table">
                                    <thead>
                                      <tr>
                                     
                                        <th scope="col">Discount Name</th>
                                        <th scope="col">Discount Rate</th>
                                        <th scope="col">Status</th>
                                        
                                       
                                       
                                      
                                        <th scope="col" style="text-align: center;">Action</th>
                                      </tr>
                                    </thead>
                                  
                                    <tbody>
                                    <?php  
                                    $view_query = mysqli_query($connections,"SELECT *
                                    from discount "); 
                                    $item_numer=0;
                                    while($row = mysqli_fetch_assoc($view_query)){ 
                                     
                                           $discount_id  = $row["discount_id"];
                                            $discount_name = $row["discount_name"];
                                            $discount_rate = $row["discount_rate"];
                                            $discount_status=$row["discount_status"];
      
                                    ?>
                                      <tr>
                                     
                                        
                                        <td><?php echo  $discount_name ?></td>
                                        <td><?php echo  $discount_rate ?>%</td>
                                        <td>
                                        <?php 
                                        
                                        if($discount_status=='1'){

                                            echo "<b style='color:green;'>Active</b>";

                                        }else{
                                            echo "<b style='color:red;'>Not Active</b>";
                                        }
                                         ?></td>
                                        
                                   
                                        
                                        
                                      
                                        <td>  <center>
                                       
        
        <button type="button" class="btn btn-primary btn-sm toglerUpdate" data-bs-toggle="modal" data-bs-target="#editdiscountForm"
          data-discount_id="<?php echo $discount_id; ?>"
          data-discount_name="<?php echo $discount_name; ?>"
          data-discount_rate="<?php echo $discount_rate; ?>"
        >

        <i class="fa fa-pencil" style="font-size:20px;color:white"></i>
        </button>

       
        <button type="button" class="btn btn-danger btn-sm toglerTrash" data-bs-toggle="modal" data-bs-target="#modaltrash"
          data-discount_id="<?php echo $discount_id; ?>"
          data-discount_name="<?php echo $discount_name; ?>"
          data-discount_rate="<?php echo $discount_rate; ?>"
        >
        <i class="fa fa-trash" style="font-size:20px;color:white"></i>
        </button>


        

           
        

        
    
          
            <?php 
             if($discount_status=='1'){
            ?>

            <button  class="btn btn-success btn-sm togleDisable">
                <i class="fas fa-toggle-on toglerDisable" style="font-size:20px;color:white" data-bs-toggle="modal" data-bs-target="#modalDisable"
                data-discount_id="<?= $discount_id ?>"
	        	data-discount_name="<?= $discount_name ?>"
                >      
            </i>
            </button>
            <?php
        }else{?>
        <button  class="btn btn-danger btn-sm togleEnable">
                <i class="fas fa-toggle-off toglerEnable" style="font-size:20px;color:white" data-bs-toggle="modal" data-bs-target="#modalEnable"
                data-discount_id="<?= $discount_id ?>"
	        	data-discount_name="<?= $discount_name ?>"
                >      
            </i>
            </button>
        <?php }?>
      
      

                                        </td>
                                      </tr>
                                      <?php  } ?>
                                    </tbody>
                                 
                                  </table>
                                
                            </div>
                            
                          </div>
                        </div>
                        <div class="card-footer">
                            
                        </div>
                    </div>
                   

                </div>
        </div>
       
   

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
       
    </body>
<!-- Modal discount Discount -->
<div class="modal fade" id="modalDisable" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Warning</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="float: right;"></button>
      </div>
   
      <form id="discountForm" >

      <input type="hidden" id='discount_id' name='discount_id'>
        <div class="modal-body">
          Disable Discount: <b style='color:red;'><span id="discount_name"></span></b>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit"  class="btn btn-primary">Confirm</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Enable Discount -->
<div class="modal fade" id="modalEnable" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Warning</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="float: right;"></button>
      </div>
   
      <form id="enableForm" >

      <input type="hidden" id='discount_id_enable' name='discount_id'>
        <div class="modal-body">
          Enable Discount: <b style='color:green;'><span id="discount_name_enable"></span></b>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit"  class="btn btn-primary">Confirm</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal trash Discount -->
<div class="modal fade" id="modaltrash" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Warning</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="float: right;"></button>
      </div>
   
      <form  method="POST" >
      <input type="hidden" id='discount_id_remove' name='discount_id'>
        <div class="modal-body">
         Permanent Remove Discount: <b style='color:green;'><span id="discount_name_remove"> ?</span></b>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name='btn_discount_remove'  class="btn btn-primary">Confirm</button>
        </div>
      </form>
    </div>
  </div>
</div>



 <!-- Modal UPDATE -->
<div class="modal fade" id="editdiscountForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="container">
          <form id="editdiscountForm" method="POST">
            <div class="mb-3">
              <input type="text" id='discount_id_update' name='discount_id_update'>
              <label for="discount_id_update">Discount ID</label>
          
            </div>

            <div class="mb-3">
              <label for="discount_name_update">Discount Name</label>
              <input type="text" class="form-control" id='discount_name_update' name="discount_name_update" value="" placeholder="Enter Discount Name">
           
            </div>

            <div class="mb-3">
              <label for="discount_rate_update">Discount Rate %</label>
              <input type="text" class="form-control" id='discount_rate_update' name="discount_rate_update" value="" placeholder="Enter Discount Rate">
            
            </div>

            <div class="container d-flex justify-content-center">
              <button type="submit" name="btn_update_discount" class="form-control btn btn-primary" style='width:20%;'>UPDATE</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script>



$(document).ready(function() {
  $('#discountForm').submit(function(e) {
    e.preventDefault(); // Prevent the form from submitting normally

    // Serialize the form data
    var formData = $(this).serialize();

    // Send the AJAX request
    $.ajax({
      type: 'POST',
      url: '../disableDiscount.php',
      data: formData,
      success: function(response) {
        swal({
          title: "Success!",
          text: "Disable Discount Successful",
          icon: "success",
          content: true // Use the "content" option instead of "html"
        }).then((value) => {
          if (value) {
            window.location.href = "managediscount.php";
            // Display the print receipt code here
          } else {
            window.location.reload();
          }
        });
        $('.error').html(response);
        console.log(response);
      }
    });
  });
});



$(document).ready(function() {
  $('#enableForm').submit(function(e) {
    e.preventDefault(); // Prevent the form from submitting normally

    // Serialize the form data
    var formData = $(this).serialize();

    // Send the AJAX request
    $.ajax({
      type: 'POST',
      url: '../enableDiscount.php',
      data: formData,
      success: function(response) {
        swal({
          title: "Success!",
          text: "enable discount Successful",
          icon: "success",
          content: true // Use the "content" option instead of "html"
        }).then((value) => {
          if (value) {
            window.location.href = "managediscount.php";
            // Display the print receipt code here
          } else {
            window.location.reload();
          }
        });
        $('.error').html(response);
        console.log(response);
      }
    });
  });
});


$(document).ready(function() {
  $('.toglerTrash').click(function() {
    // Retrieve data attributes
    var discount_id_remove = $(this).data('discount_id');
    var discount_name_remove = $(this).data('discount_name');

    // Update input fields with the retrieved values
    $('#discount_id_remove').val(discount_id_remove);
    $('#discount_name_remove').text(discount_name_remove); // Set the discount name in the modal

   // console.log(discount_id);
  });
});

$(document).ready(function() {
  $('.togleEnable').click(function() {
    // Retrieve data attributes
    var discount_id = $(this).find('.toglerEnable').data('discount_id');
    var discount_name = $(this).find('.toglerEnable').data('discount_name');

    // Update input fields with the retrieved values
    $('#discount_id_enable').val(discount_id);
    $('#discount_name_enable').text(discount_name); // Set the discount name in the modal

   // console.log(discount_id);
  });
});

$(document).ready(function() {
  $('.togleDisable').click(function() {
    // Retrieve data attributes
    var discount_id = $(this).find('.toglerDisable').data('discount_id');
    var discount_name = $(this).find('.toglerDisable').data('discount_name');

    // Update input fields with the retrieved values
    $('#discount_id').val(discount_id);
    $('#discount_name').val(discount_name);

    // Display the discount name in the modal
    $('#modalEditVoucher').on('show.bs.modal', function() {
      $(this).find('#discount_name').val(discount_name);
    });

    console.log(discount_id);
  });
});

$(document).ready(function() {
  $('.toglerUpdate').click(function() {
    // Retrieve data attributes
    var discount_id_update  = $(this).data('discount_id');
    var discount_name_update = $(this).data('discount_name');
    var discount_rate_update = $(this).data('discount_rate');

    // Update input fields with the retrieved values
    $('#discount_id_update').val(discount_id_update);
    $('#discount_name_update').val(discount_name_update);
    $('#discount_rate_update').val(discount_rate_update);

    console.log(discount_name);
  });
});




</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
     
       
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>


</html>
