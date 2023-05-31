<?php
include "backend/back_navbar.php";
include "../back_category.php";
include "../update_category.php";
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
        <title>Manage Category</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
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
                        <h1 class="mt-4" >Manage Category</h1>
                        <div class="row">
                        <div class="card">
        <div class="card-body">
           
           
           
                <div class="container">
<form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label >Category name</label>
                        <input type="text" class="form-control" value='' name="category_name" value="" placeholder="Enter Category Name" >
                        <span class='error'><?=  $category_nameErr?></span>
                    </div>
                    
                    
                    
                    
                    


                   

                    <div class="mb-3">
                       <label >Critical level</label>
                        <input type="text"  class="form-control"  name="critical_lvl" value="" placeholder="Enter Critical Level">
                        <span class='error'><?=  $critical_lvlErr?></span>
                    </div>
          
           
<div class="container d-flex justify-content-center">

    <button type="submit" name='btn_save_category' class="form-control btn btn-primary" style='width:20%;'><b>ADD CATEGORY</b></button>
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
                                     
                                        <th scope="col">Category Name</th>
                                        <th scope="col">Critical Level</th>
                                        <th scope="col">Status</th>
                                        
                                       
                                       
                                      
                                        <th scope="col" style="text-align: center;">Action</th>
                                      </tr>
                                    </thead>
                                  
                                    <tbody>
                                    <?php  
                                    $view_query = mysqli_query($connections,"SELECT *
                                    from category "); 
                                    $item_numer=0;
                                    while($row = mysqli_fetch_assoc($view_query)){ 
                                     
                                           $category_id  = $row["category_id"];
                                            $category_name = $row["category_name"];
                                            $critical_level = $row["critical_level"];
                                            $category_status=$row["category_status"];
      
                                    ?>
                                      <tr>
                                     
                                        
                                        <td><?php echo  $category_name ?></td>
                                        <td><?php echo  $critical_level ?></td>
                                        <td>
                                        <?php 
                                        
                                        if($category_status=='1'){

                                            echo "<b style='color:green;'>Active</b>";

                                        }else{
                                            echo "<b style='color:red;'>Not Active</b>";
                                        }
                                         ?></td>
                                        
                                   
                                        
                                        
                                      
                                        <td>  <center>
                                       
       
        <button type="button" class="btn btn-primary btn-sm toglerEditCategory" data-bs-toggle="modal" data-bs-target="#ModaleditCategory"
          data-category_id="<?php echo $category_id; ?>"
          data-category_name="<?php echo $category_name; ?>"
          data-critical_level="<?php echo $critical_level; ?>"
        >

        <i class="fa fa-pencil" style="font-size:20px;color:white"></i>
        </button>

       
        <button type="button" class="btn btn-danger btn-sm toglerRemove" data-bs-toggle="modal" data-bs-target="#ModalRemove"
          data-category_id="<?php echo $category_id; ?>"
          data-category_name="<?php echo $category_name; ?>"
          data-critical_level="<?php echo $critical_level; ?>"
        >
        <i class="fa fa-trash" style="font-size:20px;color:white"></i>
        </button>
        
        
            <?php 
             if($category_status=='1'){
            ?>

            <button  class="btn btn-success btn-sm togleDisable"data-bs-toggle="modal" data-bs-target="#modalDisable"
            data-category_id="<?= $category_id ?>"
	        data-category_name="<?= $category_name ?>"
            >
                <i class="fas fa-toggle-on " style="font-size:20px;color:white">      
            </i>
            </button>
            <?php
        }else{?>
        <button  class="btn btn-danger btn-sm togleEnable"data-bs-toggle="modal" data-bs-target="#modalEnable"
        data-category_id="<?= $category_id ?>"
	    data-category_name="<?= $category_name ?>"
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

      <input type="hidden" id='category_id' name='category_id'>
        <div class="modal-body">
          Disable Discount: <b style='color:red;'><span id="category_name"></span></b>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name='btn_disable' class="btn btn-primary">Confirm</button>
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
   
      <form method='POST' >

      <input type="hidden" id='category_id_enable' name='category_id'>
        <div class="modal-body">
          Enable Discount: <b style='color:green;'><span id="category_name_enable"></span></b>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name='btn_enable'  class="btn btn-primary">Confirm</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal remove Discount -->
<div class="modal fade" id="ModalRemove" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Warning</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="float: right;"></button>
      </div>
   
      <form method='POST' >

      <input type="hidden" id='category_id_remove' name='category_id'>
        <div class="modal-body">
          Remove Category: <b style='color:green;'><span id="category_name_remove"></span></b>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name='btn_remove_category'  class="btn btn-primary">Confirm</button>
        </div>
      </form>
    </div>
  </div>
</div>




 <!-- Modal UPDATE -->
<div class="modal fade" id="ModaleditCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="container">
          <form  method="POST">
           
              <input type="hidden" id='category_id' name='category_id'>
             

            <div class="mb-3">
              <label >Category Name</label>
              <input type="text" class="form-control" id='category_name' name="category_name" value="" placeholder="Enter Category Name">
           
            </div>

            <div class="mb-3">
              <label >Critical Level</label>
              <input type="text" class="form-control" id='critical_level' name="critical_level" value="" placeholder="Enter Critical Level">
            
            </div>

            <div class="container d-flex justify-content-center">
              <button type="submit" name="btn_update_category" class="form-control btn btn-primary" style='width:20%;'>UPDATE</button>
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
  $('.toglerRemove').click(function() {
    // Retrieve data attributes
    var category_id_remove = $(this).data('category_id');
    var category_name_remove = $(this).data('category_name');

  
    $('#category_id_remove').val(category_id_remove);
    $('#category_name_remove').text(category_name_remove); // Set the discount name in the modal

   //console.log(category_name);
  });
});

$(document).ready(function() {
  $('.togleEnable').click(function() {
    // Retrieve data attributes
    var category_id = $(this).data('category_id');
    var category_name = $(this).data('category_name');

  
    $('#category_id_enable').val(category_id);
    $('#category_name_enable').text(category_name); // Set the discount name in the modal

   //console.log(category_name);
  });
});

$(document).ready(function() {
  $('.togleDisable').click(function() {
    // Retrieve data attributes
    var category_id = $(this).data('category_id');
    var category_name = $(this).data('category_name');

    // Update input fields with the retrieved values
    $('#category_id').val(category_id);
    $('#category_name').text(category_name);

    console.log(category_name);

  });
});

$(document).ready(function() {
  $('.toglerEditCategory').click(function() {
    // Retrieve data attributes
    var category_id  = $(this).data('category_id');
    var category_name = $(this).data('category_name');
    var critical_level = $(this).data('critical_level');

    // Update input fields with the retrieved values
    $('#category_id').val(category_id);
    $('#category_name').val(category_name);
    $('#critical_level').val(critical_level);

    console.log(category_name);
  });
});




</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
     
       
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>


</html>
