<?php 


include "connection.php";
include "back_inventory.php";
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
    <title>Report</title>
   </head>
<body >
   
    <div class="container-fluid">
        <div class="row">
            <div class="col-10">
                <div class="container-fluid d-flex justify-content-center mb-2">
                    <div class="card w-100">             
                        <div class="card-body">
                          <h5 class="card-title" style="text-align: center;">REPORT</h5>
                          <div class="container">
                          <div class="row">
  <div class="col-md-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Total Sales</h5>
        <?php
$sql_pos = "SELECT orders_tcode, orders_final
FROM pos_orders
GROUP BY orders_tcode";
$result_pos = mysqli_query($connections, $sql_pos);
if ($result_pos) {
    $row_pos = mysqli_fetch_assoc($result_pos);
    $orders_final = $row_pos['orders_final'];

    $sql = "SELECT SUM(orders_subtotal) AS total_subtotal FROM orders";
    $result = mysqli_query($connections, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalSubtotal = $row['total_subtotal'];

        echo "<h1> ORDERING: " . $totalSubtotal . "</h1>";
        echo "<h1> POS: " . $orders_final . "</h1>";
    } else {
        echo "Error: " . mysqli_error($connections);
    }
} else {
    echo "Error: " . mysqli_error($connections);
}

?>


      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Total User</h5>
        <?php
$sql = "SELECT COUNT(*) AS total_account FROM Account";
$result = mysqli_query($connections, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $total_account = $row['total_account'];
    echo "<h1>" . $total_account."</h1>";
} else {
    echo "Error: " . mysqli_error($connections);
}

?>       
    </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Total Product</h5>
<?php
$sql = "SELECT COUNT(*) AS total_products FROM product";
$result = mysqli_query($connections, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalProducts = $row['total_products'];
    echo "<h1>" . $totalProducts."</h1>";
} else {
    echo "Error: " . mysqli_error($connections);
}
mysqli_close($connections);
?>
      </div>
    </div>
  </div>
</div>
                            
                          </div>
                        </div>
                        <div class="card-footer">
                         
 



                    
                    
                   <!---end footer card--> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
  <div class="container-fluid d-flex justify-content-start" style='position:fixed;'>
    <div class="card">
      <div class="card-body">
        <h5 class="card-title" style="text-align: center;">LIST REPORT</h5>
        <form method="POST" enctype="multipart/form-data">
          <div class="container">
            <div class="mb-3">
            <button type="button" class="btn btn-primary btn-fixed-width" onclick="inventoryReport()">INVENTORY REPORT</button>

            </div>
            <div class="mb-3">
              <button type="button" class="btn btn-primary btn-fixed-width" onclick="salesReport()">SALES REPORT</button>
            </div>

            <br>
            <h5 class="card-title" style="text-align: center;" >SYSTEM LOG</h5>
            <div class="mb-3">
              <button type="button" class="btn btn-primary btn-fixed-width" onclick="userLog()">USER LOG</button>
            </div>
            <div class="mb-3">
              <button type="button" class="btn btn-primary btn-fixed-width" onclick="systemLog()">SYSTEM LOG</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
<script>
         // start onclick button
function inventoryReport() {
  window.location.href = "inventoryReport.php";
}

function salesReport() {
  window.location.href = "inventoryReport.php";
}

function userLog() {
  window.location.href = "Userlog.php";
}

function systemLog() {
  window.location.href = "systemLog.php";
}
        //end onclick button
</script>

            
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

<script>
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