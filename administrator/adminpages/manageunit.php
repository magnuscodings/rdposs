<?php
include "backend/back_navbar.php";
include "../back_unit.php";
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
        <title>Manage Unit</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
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
            <?php include "sidebar.php"; ?>
            </div>
            <div id="layoutSidenav_content">
                <main>
                        <div class="container-fluid px-4">
                        <h1 class="mt-4" >Manage Unit</h1>
                        <div class="row">
                        <div class="card">
        <div class="card-body">
           
           
           
                <div class="container">
<form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label >Unit name</label>
                        <input type="text" class="form-control" value='' name="unit_name" value="" placeholder="Enter Unit Name" >
                        <span class='error'><?=  $unit_nameErr?></span>
                    </div>

           
<div class="container d-flex justify-content-center">

    <button type="submit" name='btn_save_category' class="form-control btn btn-primary" style='width:20%;'><b>ADD UNIT</b></button>
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
                                     
                                        <th scope="col">Unit</th>
                                        
                                        <th scope="col">Status</th>
                                        
                                       
                                       
                                      
                                        <th scope="col" style="text-align: center;">Action</th>
                                      </tr>
                                    </thead>
                                  
                                    <tbody>
                                    <?php  
                                    $view_query = mysqli_query($connections,"SELECT *
                                    from unit "); 
                                    $item_numer=0;
                                    while($row = mysqli_fetch_assoc($view_query)){ 
                                     
                                           $unit_id = $row["unit_id"];
                                            $unit_name = $row["unit_name"];
                                            $unit_status = $row["unit_status"];
                                            
      
                                    ?>
                                      <tr>
                                     
                                        
                                        <td><?php echo  $unit_name ?></td>
                                       
                                        <td>
                                        <?php 
                                        
                                        if($unit_status=='1'){

                                            echo "<b style='color:green;'>Active</b>";

                                        }else{
                                            echo "<b style='color:red;'>Not Active</b>";
                                        }
                                         ?></td>
                                        
                                   
                                        
                                        
                                      
                                        <td>  <center>
                                       
        <div class="col-md-4 mb-2">
        <button type="button" class="btn btn-primary btn-sm toglerEditUnit" data-bs-toggle="modal" data-bs-target="#ModaleditUnit"
          data-unit_id="<?php echo $unit_id; ?>"
          data-unit_name="<?php echo $unit_name; ?>"
       
        >

        <i class="fa fa-pencil" style="font-size:20px;color:white"></i>
        </button>

        <button type="button" class="btn btn-danger btn-sm togleRemove" data-bs-toggle="modal" data-bs-target="#ModalDeleteCat"
        data-unit_id="<?php echo $unit_id; ?>"
          data-unit_name="<?php echo $unit_name; ?>"
        >

        <i class="fa fa-trash" style="font-size:20px;color:white"></i>
        </button>

            <?php 
             if($unit_status=='1'){
            ?>

            <button  class="btn btn-success btn-sm togleDisable"data-bs-toggle="modal" data-bs-target="#modalDisable"
            data-unit_id="<?php echo $unit_id; ?>"
            data-unit_name="<?php echo $unit_name; ?>"
            >
                <i class="fas fa-toggle-on " style="font-size:20px;color:white">      
            </i>
            </button>
            <?php
        }else{?>
        <button  class="btn btn-danger btn-sm togleEnable"data-bs-toggle="modal" data-bs-target="#modalEnable"
            data-unit_id="<?php echo $unit_id; ?>"
            data-unit_name="<?php echo $unit_name; ?>"
        >
                <i class="fas fa-toggle-off " style="font-size:20px;color:white"
               
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
   
      <form method='POST' >

      <input type="hidden" id='unit_id_diable' name='unit_id'>
        <div class="modal-body">
          Disable Discount: <b style='color:red;'><span id="unit_name_diable"></span></b>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name='btn_disable_unit' class="btn btn-primary">Confirm</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal enable Discount -->
<div class="modal fade" id="modalEnable" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Warning</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="float: right;"></button>
      </div>
   
      <form method='POST' >

      <input type="hidden" id='unit_id_enable' name='unit_id'>
        <div class="modal-body">
          Enable Discount: <b style='color:red;'><span id="unit_name_enable"></span></b>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name='btn_enable_unit' class="btn btn-primary">Confirm</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal remove unit -->
<div class="modal fade" id="ModalDeleteCat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Warning</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="float: right;"></button>
      </div>
            
      <form method='POST' >

      <input type="hidden" id='unit_id_remove' name='unit_id'>
        <div class="modal-body">
          You want to remove <b style='color:red;'><span id="unit_name_remove"> ?</span></b>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name='btn_remove_unit' class="btn btn-primary">Confirm</button>
        </div>
      </form>
    </div>
  </div>
</div>






 <!-- Modal UPDATE -->
<div class="modal fade" id="ModaleditUnit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="container">
          <form  method="POST">
           
              <input type="hidden" id='unit_id_edit' name='unit_id'>

            <div class="mb-3">
              <label >Unit Name</label>
              <input type="text" class="form-control" id='unit_name_edit' name="unit_name" value="" placeholder="Enter Unit Name">
            </div>

            <div class="container d-flex justify-content-center">
              <button type="submit" name="btn_update_unit" class="form-control btn btn-primary" style='width:20%;'>UPDATE</button>
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
  $('.togleRemove').click(function() {
    // Retrieve data attributes
    var unit_id_remove = $(this).data('unit_id');
    var unit_name_remove= $(this).data('unit_name');

    // Update input fields with the retrieved values
    $('#unit_id_remove').val(unit_id_remove);
    $('#unit_name_remove').text(unit_name_remove);

    console.log(unit_name_remove);

  });
});


$(document).ready(function() {
  $('.togleEnable').click(function() {
    // Retrieve data attributes
    var unit_id_enable = $(this).data('unit_id');
    var unit_name_enable= $(this).data('unit_name');

    // Update input fields with the retrieved values
    $('#unit_id_enable').val(unit_id_enable);
    $('#unit_name_enable').text(unit_name_enable);

    console.log(unit_id_enable);

  });
});


$(document).ready(function() {
  $('.togleDisable').click(function() {
    // Retrieve data attributes
    var unit_id_diable = $(this).data('unit_id');
    var unit_name_diable = $(this).data('unit_name');

    // Update input fields with the retrieved values
    $('#unit_id_diable').val(unit_id_diable);
    $('#unit_name_diable').text(unit_name_diable);

    console.log(unit_id_diable);

  });
});

$(document).ready(function() {
  $('.toglerEditUnit').click(function() {
    // Retrieve data attributes
    var unit_id_edit = $(this).data('unit_id');
    var unit_name_edit= $(this).data('unit_name');

    // Update input fields with the retrieved values
    $('#unit_id_edit').val(unit_id_edit);
    $('#unit_name_edit').val(unit_name_edit);

    console.log(unit_id_edit);
  });
});




</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
     
       
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>


</html>
