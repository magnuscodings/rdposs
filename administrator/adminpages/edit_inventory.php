<?php 

include("backend/back_navbar.php");

include "../connection.php";
include "../back_inventory.php";
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
    <title>Inventory</title>
   </head>
<body >
   
    


    <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
            <?php include "sidebar.php"; ?>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4" >Dashboard</h1>
                       
                        <div class="row">
                            
                        <div class="container-fluid">
        <div class="row">
          
            
                        <div class="card-footer">
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
        <div class="card-body">
            <h5 class="card-title" style="text-align: center;">UPDATE ITEM </h5>
            <?php 

             $item_code=$_GET["item_code"];

            $view_query = mysqli_query($connections,"SELECT * from product where prod_id =' $item_code'"); 
            // where account_type='0'
            
            while($row = mysqli_fetch_assoc($view_query)){ //<-- ginagamit tuwing kukuha ng database
                
                $db_prod_id = $row["prod_id"];
                $db_prod_code = $row["prod_code"];
                $db_prod_name = $row["prod_name"];
                $db_prod_orgprice = $row["prod_orgprice"];
                $db_prod_currprice = $row["prod_currprice"];
       
                $db_prod_unit = $row["prod_unit_id"];
                $db_prod_category= $row["prod_category_id"];
                $db_prod_description = $row["prod_description"];
                $db_prod_image = $row["prod_image"];
       
                
            ?>
            <form method="POST" enctype="multipart/form-data">
                <div class="container">
                    <!-- Start expiration date -->
                    <div class="container">
 

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
</script>


                <!---end expiration date-->
                    <div class="mb-3">
                        <label for="">Item Name</label>
                        <input type="text" class="form-control" name="prod_name" value="<?php echo $db_prod_name  ?>" placeholder="Item Name">
                        <span class='error'><?php echo $prod_nameErr; ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="">Original Price</label>
                        <input type="text" class="form-control" name="prod_orgprice" value="<?php echo $db_prod_orgprice ?>" placeholder="Original Price">
                        <span class='error'><?php echo $prod_orgpriceErr; ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="">Current Price</label>
                        <input type="text" class="form-control" name="prod_currprice" value="<?php echo  $db_prod_currprice ?>" placeholder="Current Price">
                        <span class='error'><?php echo $prod_currpriceErr; ?></span>
                    </div>
                 

                    <div class="mb-3">
                    <div class="mb-3">
    <label for="">Unit</label>
    <div class="dropdown">
        <select class="btn btn-secondary dropdown-toggle btn-sm" name="prod_unit">
            <option value="">Unit</option>
            <?php
            $view_query = mysqli_query($connections, "SELECT * FROM unit where unit_status='1'");
            while ($row = mysqli_fetch_assoc($view_query)) {
                $db_unit_id = $row["unit_id"];
                $db_unit_name = $row["unit_name"];
                $selected = ($db_prod_unit == $db_unit_id) ? "selected" : "";
                $selected_value = ($_POST['prod_unit'] == $db_unit_id) ? "selected" : "";
                echo "<option value=\"$db_unit_id\" class=\"dropdown-item\" $selected $selected_value>$db_unit_name</option>";
            }
            ?>
        </select>
    </div>
    <span class='error'><?php echo $prod_unitErr; ?></span>
</div>
<div class="mb-3">
    <label for="">Category</label>
    <div class="dropdown">
        <select class="btn btn-secondary dropdown-toggle btn-sm" name="prod_category">
            <option value="">Category</option>
            <?php
            $view_query = mysqli_query($connections, "SELECT * FROM category");
            while ($row = mysqli_fetch_assoc($view_query)) {
                $db_category_id = $row["category_id"];
                $db_category_name = $row["category_name"];
                $selected = ($db_prod_category == $db_category_id) ? "selected" : "";
                $selected_value = ($_POST['prod_category'] == $db_category_id) ? "selected" : "";
                echo "<option value=\"$db_category_id\" class=\"dropdown-item\" $selected $selected_value>$db_category_name</option>";
            }
            ?>
        </select>
    </div>
    <span class='error'><?php echo $prod_categoryErr; ?></span>
</div>




                    <div class="mb-3">
                        <label for="">Description</label>
                        <textarea name="prod_description" class="form-control" rows="3" placeholder="Enter description"><?php echo  $db_prod_description;  ?></textarea>

                    </div>
                    <div class="mb-3">
            <label for="">Image uploaded</label>
            
            <div id="drag-drop-area">
                <div class="drag-drop-text">
                    <?php if($db_prod_image){?>
                    <img src='../../upload_prodImg/<?php echo $db_prod_image ?>' alt='Product Image' style='max-width: 50%;'>
                    <?php }else{ ?>
                    <img src="../../assets/img/1599802140_no-image-available.png" alt="" style="width: 200px; height: 150px;">
                     <?php } ?>   
                </div>
                <input type="file" id="file-input" name='prod_image' />


            </div>
          
            <?php 
            
            
            
            
            ?>

          
        </div>
        
        <div class="container d-flex justify-content-center">
            <button type="submit" name='btnEditProduct' class="btn btn-success" style="width: 20%;">UPDATE ITEM</button>
        </div>
    </div>
</form>
        <?php } ?>

    </div>
</div>
<!-- Modal Remove acc_id -->
<div class="modal fade" id="ModRemoveProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
		
	  <form method="POST" id="archProd">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add to cart</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
			<input type="hidden" id="db_prod_id" name="db_prod_id">
            <input type="hidden" id="db_prod_name" name="db_prod_name">
            <input type="hidden" id="acc_id" name="acc_id">
			Are you sure to move <b id="db_prod_nameDisplay"></b> to Archive ? <span id='unit_nameDisplay'></span>
	
      					
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="btnArchive" class="btn btn-primary">Cunfirm</button>
      </div>
	  	</form>
    </div>
  </div>
</div>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
 <script>
  $(document).ready(function() {
    $('#archProd').submit(function(e) {
      e.preventDefault(); // Prevent the form from submitting normally

      // Serialize the form data
      var formData = $(this).serialize();

      // Send the AJAX request
      $.ajax({
        type: 'POST',
        url: 'archProd.php',
        data: formData,
        success: function(response) {
          // Show the swal alert based on the response
          if (response.indexOf('ARCHIVE PRODUCT SUCCESS') !== -1) {
            swal({
              title: 'Success!',
              text: 'ARCHIVE PRODUCT SUCCESS',
              icon: 'success',
              html: true
            }).then((value) => {
              if (value) {
                window.location.href = 'inventory.php';
              } else {
                window.location.reload();
              }
            });
          } else {
            $('.error').html(response); // Display the validation result in the modal
          }
        }
      });
    });
  });
</script>



<!--End modal Remove--><!-- Modal View Product -->
<div class="modal fade" id="ModViewProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg"> <!-- Use modal-lg class to make the modal large -->
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">View product</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="table-responsive"> <!-- Add a wrapper div with the table-responsive class -->
        <table class="table" border="5">
  <tr>
  <center><h1>PRODUCT INFORMATION</h1></center>
    <td colspan="4">
     
      <br><br>
      <b>Product Name:</b> <span id="db_prod_nameView"></span><br>
      <b>Date Added:</b> <span id="db_prod_added"></span><br>
      <b>Last Edit:</b> <span id="db_prod_edit"></span><br>
    </td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td><b>Product ID</b></td>
    <td><b>Original Price</b></td>
    <td><b>Current Price</b></td>
    <td><b>Stocks</b></td>
    <td><b>Unit</b></td>
    <td><b>Category</b></td>
    <td><b>Product Status</b></td>
  </tr>
  <tr>
    <td id="db_prod_id_view"></td>
    <td id="db_prod_orgprice"></td>
    <td id="db_prod_currprice"></td>
    <td id="db_prod_stocks"></td>
    <td id="db_unit_name"></td>
    <td id="db_category_name"></td>
    <td id="db_prod_status"></td>
  </tr>
  <tr>
  <td colspan="7">
  <h3>Product Description:</h3>
  <p id="db_prod_description"></p>
</td>

  </tr>
</table>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>


<!------->
<!--End modal Remove--><!-- Modal View Product -->
<div class="modal fade" id="ModAddStocks" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg"> <!-- Use modal-lg class to make the modal large -->
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" >Add stocks</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
       
      </div>
      <div class="modal-body">
        <h1 id='db_prod_name1'></h1>
      <p class="small" >Fill out Required fields.</p>
        <form  method="POST" >
       
            <div class="row" >
                <div class="col-sm-12 mb-2">
                    <div class="form-group form-group-default">
                        <label>Stocks Quantity</label>
                        <input type="number" placeholder="Quantity" min="1" name="quantity" class="form-control" Required>

                        <input type="hidden" id="db_prod_id_add" name="db_prod_id_add">

                        <input type="text" value="0" hidden id="stocks_name" name="stocks_name">

                       
                    </div>
                </div>
                 <!-- Start expiration date -->
                    <div class="container">
                <div class="mb-3" id="expirationDateInput" >
                  <label>Expiration Date</label>
                  <input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" name="prod_expiration" >
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="expirationOption" value="withExpiration" onclick="showExpirationDateInput()" required>
                  <label class="form-check-label" for="expire">
                    With Expiration
                  </label>
                </div>
                <div class="form-check-inline">
                  <input class="form-check-input" type="radio" name="expirationOption" value="" onclick="hideExpirationDateInput()">
                  <label class="form-check-label" for="noexpire">
                    No Expiration
                  </label>
                </div>
              </div>
                <!---end expiration date-->
            </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" name="btnAddstocks">Add stocks</button>
            </div>
          
            </div>
            
      </form>
    </div>
  </div>
</div>

<!------->




            
        </div>
    </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
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