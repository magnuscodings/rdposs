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
    <title>Inventory Report</title>
   </head>
<body >
   
    <div class="container-fluid">
        <div class="row">
            <div class="col-10">
                <div class="container-fluid d-flex justify-content-center mb-2">
                    <div class="card w-100">             
                        <div class="card-body">
                          <h5 class="card-title" style="text-align: center;">INVENTORY REPORT</h5>
                          <div class="container">
                            <div class="table-responsive">
                                <table id="example"  class="table">
                                    <thead>
                                      <tr>
                                        <th scope="col" style='width:5;'>Item No.</th>
                                        <th scope="col">Item Code</th>
                                        <th scope="col">Item Name</th>
                                        <th scope="col">Stocks</th>
                                        <th scope="col">Stock Level</th>
                                        <th scope="col">Unit</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Expiration Date</th>
                                      
                                        
                                      </tr>
                                    </thead>
                                  
                                    <tbody>
                                    <?php  
                                    $view_query = mysqli_query($connections,"SELECT * from product where prod_status='0'"); 
                                    $item_numer=0;
                                    while($row = mysqli_fetch_assoc($view_query)){ //<-- ginagamit tuwing kukuha ng database
                                     
                                            $db_prod_id = $row["prod_id"];
                                            $db_prod_name = $row["prod_name"];
                                            $db_prod_orgprice = $row["prod_orgprice"];
                                            $db_prod_currprice = $row["prod_currprice"];
                                            $db_prod_stocks = $row["prod_stocks"];
                                            

                                            


                                            $db_prod_unit_id = $row["prod_unit_id"];
                                            $db_prod_category_id = $row["prod_category_id"];
                                            $db_prod_description = $row["prod_description"];

                                            $db_prod_image = $row["prod_image"];

                                            $item_numer++;  
                                            $db_prod_added = $row["prod_added"];
                                            $db_prod_edit = $row["prod_edit"];
                                            $db_prod_status = $row["prod_status"];
                                            if($db_prod_status=="0"){

                                                $db_prod_status="AVAILABLE";
                                                
                                            }

                                            if($db_prod_status=="0"){

                                                $db_prod_status="UN AVAILABLE";
                                                
                                            }
                                            
                                            $get_recordUnit = mysqli_query ($connections,"SELECT * FROM unit where unit_id='$db_prod_unit_id' ");
                                            $row = mysqli_fetch_assoc($get_recordUnit);
                                            $db_unit_name = $row["unit_name"];

                                            $get_recordCategory = mysqli_query ($connections,"SELECT * FROM category where category_id='$db_prod_category_id' ");
                                            $row = mysqli_fetch_assoc($get_recordCategory);
                                            $db_category_name = $row["category_name"];//
                                            $db_critical_level = $row["critical_level"];

                                            if($db_prod_stocks<=$db_critical_level){

                                                $level="<b style='color:red;'>Critical Level</b>";

                                            }else{

                                                $level="<b style='color:green;'>Normal Level</b>";
                                            }
                                           
                                           
                                    ?>
                                      <tr>
                                        <td scope="row"><?php echo $item_numer?></td>
                                        <td><?php echo $db_prod_id?></td>
                                        <td><?php echo $db_prod_name?></td>
                                        <td><?php echo  $db_prod_stocks?>&nbsp;
                                        
                                      
<script>
function backTo() {
window.location.href = "addstocks.php";
}
</script>
                                    
                                    </td>
                                    <td><?php echo $level ?></td>
                                    <td><?php echo  $db_unit_name?></td>
                                    <td><?php echo  $db_category_name?></td>
                                    <td></td> 
                                      
                                        
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
  window.location.href = "salesReport.php";
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