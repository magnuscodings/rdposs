<?php
include "backend/back_navbar.php";
include "../back_voucher.php";
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
    <script>
$(document).ready(function () {
    new simpleDatatables.DataTable('#example');
});
</script>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Manage Voucher</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
     
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
                        <h1 class="mt-4" >Manage Promo Voucher</h1>
                        <div class="row">
                        <div class="card">
        <div class="card-body">
           
           
           
                <div class="container">
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label >Voucher Name</label>
                        <input type="text" class="form-control" value='<?= $voucherName ?>' name="voucherName" value="" placeholder="First Name" >
                        <span class='error'><?=  $voucherNameErr?></span>
                    </div>
                    
                    
                    
                    
                    


                   

                    <div class="mb-3">
                       <label >Discount Rate %</label>
                        <input type="text"  class="form-control"  name="discountRate" value="<?= $discountRate ?>" placeholder="Enter Discount Rate">
                        <span class='error'><?=  $discountRateErr?></span>
                    </div>

                    <div class="mb-3">
                       <label >Date Expire</label>
                        <input type="date" class="form-control" value="<?= $dateExpire?>" name="dateExpire" value="">
                        <span class='error'><?=  $dateExpireErr?></span>
                    </div>


                    <div class="mb-3">
                       <label>Set Maximum Limit</label>
                        <input type="number" min='1' class="form-control" name="maximumLimit" value="<?= $maximumLimit ?>" placeholder="Set Limit ">
                        <span class='error'><?=  $maximumLimitErr?></span>
                    </div>
                    
                    
           
<div class="container d-flex justify-content-center">

    <button type="submit" name='btn_save_voucher' class="form-control btn btn-primary" style='width:20%;'><b>ADD VOUCHER</b></button>
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
                                     
                                        <th scope="col">Voucher Name</th>
                                        <th scope="col">Discount Rate</th>
                                        <th scope="col">Expiration Date</th>
                                        <th scope="col">Available limit</th>
                                        <th scope="col">Voucher Status</th>
                                       
                                      
                                        <th scope="col" style="text-align: center;">Action</th>
                                      </tr>
                                    </thead>
                                  
                                    <tbody>
                                    <?php  
                                    $view_query = mysqli_query($connections,"SELECT *
                                    from voucher "); 
                                    $item_numer=0;
                                    while($row = mysqli_fetch_assoc($view_query)){ 
                                     
                                           $voucher_id  = $row["voucher_id"];
                                            $voucher_name = $row["voucher_name"];
                                            $voucher_discount = $row["voucher_discount"];
                                            $voucher_created = $row["voucher_created"];
                                            $voucher_expiration = $row["voucher_expiration"];
                                            $voucher_maximumLimit = $row["voucher_maximumLimit"];

                                            $voucher_status = $row["voucher_status"];
                                            

                                        
                                            
                                          

                                        
                                           
                                           
                                    ?>
                                      <tr>
                                     
                                        
                                        <td><?php echo  $voucher_name ?></td>
                                        <td><?php echo  $voucher_discount?>%</td>
                                        <td>
                                            <?php
                                            if (strtotime($voucher_expiration) > strtotime('today')) {
                                                echo "<b style='color:green;'>" . date("M j Y, g:ia", strtotime($voucher_expiration)) . "</b>";
                                            } else {
                                                // The voucher has expired, so you can handle it accordingly
                                                echo "Expired";
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo  $voucher_maximumLimit?></td>
                                        <td>
                                        <?php 
                                        if($voucher_status=='1'){
                                             echo "<b style='color:green;'>ACTIVE</b>";
                                        }else{
                                            echo "<b style='color:red;'>NOT ACTIVE</b>";
                                        } ?></td>
                                        
                                      
                                        <td>
                                      
        <button type="button" class="btn btn-primary btn-sm toglerEditVoucher" data-bs-toggle="modal" data-bs-target="#modalEditVoucher"
        data-voucher_id="<?= $voucher_id ?>"
		data-voucher_name="<?= $voucher_name ?>"
        data-voucher_discount="<?= $voucher_discount ?>"
		data-voucher_created="<?= $voucher_created ?>"
        data-voucher_maximumLimit="<?= $voucher_maximumLimit ?>"
        data-voucher_expiration="<?= $voucher_expiration ?>"
    
        >
        <i class="fa fa-pencil" style="font-size:20px;color:white"></i>
        </button>

        <button type="button" class="btn btn-danger btn-sm toglerTrash" data-bs-toggle="modal" data-bs-target="#modaltrash"
        data-voucher_id="<?= $voucher_id ?>"
		data-voucher_name="<?= $voucher_name ?>"
        >
       
        <i class="fa fa-trash" style="font-size:20px;color:white"></i>
        </button>

           
       
            <?php 
             if($voucher_status=='1'){
            ?>
            <button  class="btn btn-success btn-sm togleDisable">
                <i class="fas fa-toggle-on toglerDisable" style="font-size:20px;color:white" data-bs-toggle="modal" data-bs-target="#modalDisable"
                data-voucher_id="<?= $voucher_id ?>"
	        	data-voucher_name="<?= $voucher_name ?>"
                >      
            </i>
            </button>
            <?php
        }else{?>
        <button  class="btn btn-danger btn-sm togleEnable">
                <i class="fas fa-toggle-off toglerEnable" style="font-size:20px;color:white" data-bs-toggle="modal" data-bs-target="#ModalEnable"
                data-voucher_id="<?= $voucher_id ?>"
	        	data-voucher_name="<?= $voucher_name ?>"
                >      
            </i>
            </button>
        <?php }?>
           
        </div>
    </div>
</div>

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
<!-- Modal Disable Discount -->
<div class="modal fade" id="ModalDisable" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Warning</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="float: right;"></button>
      </div>
   
      <form id="disableForm" >

      <input type="hidden" id='voucher_id' name='voucher_id'>
        <div class="modal-body">
          Disable Discount: <b style='color:red;'><span id="voucher_name"></span></b>
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

      <input type="hidden" id='voucher_id_trash' name='voucher_id'>
        <div class="modal-body">
         Permanent Remove Voucher: <b style='color:green;'><span id="voucher_name_trash"> ?</span></b>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name='btn_voucher_remove'  class="btn btn-primary">Confirm</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal Enable Discount -->
<div class="modal fade" id="ModalEnable" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Warning</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="float: right;"></button>
      </div>
   
      <form id="enableForm" >

      <input type="hidden" id='voucher_id_enable' name='voucher_id'>
        <div class="modal-body">
          Enable Discount: <b style='color:green;'><span id="voucher_name_enable"></span></b>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit"  class="btn btn-primary">Confirm</button>
        </div>
      </form>
    </div>
  </div>
</div>





  <!-- Modal UPDATE -->
<div class="modal fade" id="modalEditVoucher" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="container">
          <form id="editVoucherForm" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
              <input type="hidden" id="voucher_id_modal" name="voucher_id"> <!-- Updated ID here -->
              <label>Voucher Name</label>
              <input type="text" class="form-control" id="voucher_name_modal" name="voucherName" placeholder="Enter Voucher Name"> <!-- Updated ID here -->
              <span class="error"><?= $voucherNameErr ?></span>
            </div>

            <div class="mb-3">
              <label>Discount Rate %</label>
              <input type="text" class="form-control" id='voucher_discount' name="discountRate" placeholder="Enter Discount Rate">
              <span class='error'><?= $discountRateErr ?></span>
            </div>

            <div class="mb-3">
              <label>Date Expire</label>
              <input type="date" class="form-control" id='voucher_expiration_modal' name="dateExpire" value="">
              <span class='error'><?= $dateExpireErr ?></span>
            </div>

            <div class="mb-3">
              <label>Set Maximum Limit</label>
              <input type="text" id="voucher_maximumLimit_modal" class="form-control" name="maximumLimit" value="5" placeholder="Set Limit"> <!-- Updated ID here -->
              <span class="error"><?= $maximumLimitErr ?></span>
            </div>

            <div class="container d-flex justify-content-center">
              <button type="submit" name="btn_update" class="form-control btn btn-primary" style="width:20%;">UPDATE</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
$(document).ready(function() {
  $('#editVoucherForm').submit(function(e) {
    e.preventDefault(); // Prevent the form from submitting normally

    // Serialize the form data
    var formData = $(this).serialize();

    // Send the AJAX request
    $.ajax({
      type: 'POST',
      url: '../update_voucher.php',
      data: formData,
      success: function(response) {
        swal({
          title: "Success!",
          text: "Update voucher Successful",
          icon: "success",
          content: true // Use the "content" option instead of "html"
        }).then((value) => {
          if (value) {
            window.location.href = "managevoucher.php";
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
  $('#disableForm').submit(function(e) {
    e.preventDefault(); // Prevent the form from submitting normally

    // Serialize the form data
    var formData = $(this).serialize();

    // Send the AJAX request
    $.ajax({
      type: 'POST',
      url: '../disable.php',
      data: formData,
      success: function(response) {
        swal({
          title: "Success!",
          text: "Disable voucher Successful",
          icon: "success",
          content: true // Use the "content" option instead of "html"
        }).then((value) => {
          if (value) {
            window.location.href = "managevoucher.php";
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
      url: '../enable.php',
      data: formData,
      success: function(response) {
        swal({
          title: "Success!",
          text: "Disable voucher Successful",
          icon: "success",
          content: true // Use the "content" option instead of "html"
        }).then((value) => {
          if (value) {
            window.location.href = "managevoucher.php";
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

//toglerTrash
$(document).ready(function() {
  $('.toglerTrash').click(function() {
    // Retrieve data attributes
    var voucher_id_trash = $(this).data('voucher_id');
    var voucher_name_trash = $(this).data('voucher_name');

    // Update input fields with the retrieved values
    $('#voucher_id_trash').val(voucher_id_trash);
    $('#voucher_name_trash').text(voucher_name_trash); // Set the voucher name in the modal

    console.log(voucher_id_trash);
  });
});

$(document).ready(function() {
  $('.togleEnable').click(function() {
    // Retrieve data attributes
    var voucher_id = $(this).find('.toglerEnable').data('voucher_id');
    var voucher_name = $(this).find('.toglerEnable').data('voucher_name');

    // Update input fields with the retrieved values
    $('#voucher_id_enable').val(voucher_id);
    $('#voucher_name_enable').text(voucher_name); // Set the voucher name in the modal

   // console.log(voucher_id);
  });
});


$(document).ready(function() {
  $('.togleEnable').click(function() {
    // Retrieve data attributes
    var voucher_id = $(this).find('.toglerEnable').data('voucher_id');
    var voucher_name = $(this).find('.toglerEnable').data('voucher_name');

    // Update input fields with the retrieved values
    $('#voucher_id_enable').val(voucher_id);
    $('#voucher_name_enable').text(voucher_name); // Set the voucher name in the modal

   // console.log(voucher_id);
  });
});




$(document).ready(function() {
  $('.togleDisable').click(function() {
    // Retrieve data attributes
    var voucher_id = $(this).find('.toglerDisable').data('voucher_id');
    var voucher_name = $(this).find('.toglerDisable').data('voucher_name');

    // Update input fields with the retrieved values
    $('#voucher_id').val(voucher_id);
    $('#voucher_name').text(voucher_name); // Set the voucher name in the modal

   // console.log(voucher_id);
  });
});

//toglerDisable
$(document).ready(function() {
  $('.toglerEditVoucher').click(function() {
    // Retrieve data attributes
    var voucher_id = $(this).data('voucher_id');
    var voucher_name = $(this).data('voucher_name');
    var voucher_discount = $(this).data('voucher_discount');
    var voucher_expiration = $(this).data('voucher_expiration');
    var voucher_maximumLimit = $(this).data('voucher_maximumLimit');

    // Update input fields with the retrieved values
    $('#voucher_id_modal').val(voucher_id);
    $('#voucher_name_modal').val(voucher_name);
    $('#voucher_discount').val(voucher_discount);
    $('#voucher_expiration_modal').val(voucher_expiration);
    $('#voucher_maximumLimit').val(voucher_maximumLimit); // Updated ID here

    // Automatically select the date
    var formattedDate = voucher_expiration.substring(0, 10);
    $('#voucher_expiration_modal').val(formattedDate);

    console.log(voucher_maximumLimit);
  });
});



</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
     
       
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>


</html>
