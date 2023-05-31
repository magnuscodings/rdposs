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
    <title>Activity log</title>
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
                       
                 
                        <div class="card w-100">             
                        <div class="card-body">
                          <h5 class="card-title" style="text-align: center;">USER LOG REPORT</h5>
                          <div class="container">
                            <div class="table-responsive">
                                <table id="example"  class="table">
                                    <thead>
                                      <tr>
                                        <th scope="col" style='width:5;'>Account#.</th>
                                        <th scope="col">Account#</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Fullname</th>
                                        <th scope="col">Activity</th>
                                        <th scope="col">Date</th>
                                       
                                     
                                      
                                        
                                      </tr>
                                    </thead>
                                  
                                    <tbody>
                                    <?php  
                                    $view_query = mysqli_query($connections,"SELECT * from users_log"); 
                                    $item_numer=0;
                                    while($row = mysqli_fetch_assoc($view_query)){ //<-- ginagamit tuwing kukuha ng database
                                     
                                            $db_act_id = $row["act_id"];
                                            $db_act_account_id = $row["act_account_id"];
                                            $db_act_activity = $row["act_activity"];
                                            $db_act_date = $row["act_date"];
                                         
                                        
                                            
                                            $get_recordUnit = mysqli_query ($connections,"SELECT * FROM account where acc_id ='$db_act_account_id' ");
                                            $row = mysqli_fetch_assoc($get_recordUnit);
                                            $db_acc_id  = $row["acc_id"];
                                            $db_acc_username  = $row["acc_username"];
                                            $db_acc_fname  = $row["acc_fname"];
                                            $db_acc_lname  = $row["acc_lname"];
                                            $fullname=$db_acc_fname." ".$db_acc_lname;

                                            $item_numer++;  
                                           
                                    ?>
                                      <tr>
                                        <td scope="row"><?php echo $item_numer?></td>
                                        <td><?php echo $db_act_account_id?></td>
                                        <td><?php echo $db_acc_username?></td>
                                        <td><?php echo  $fullname?>&nbsp;
                                        
                                      
<script>
function backTo() {
window.location.href = "addstocks.php";
}
</script>
                                    
                                    </td>
                                    <td><?php echo $db_act_activity ?></td>
                                    <td><?php echo  date("M j Y, g:ia", strtotime($db_act_date))?></td>
                                  
                                   
                                      
                                        
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