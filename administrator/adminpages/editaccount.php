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
    <title>Update Account</title>
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
                        <div class="card">
        <div class="card-body">
            <h5 class="card-title" style="text-align: center;">Update User</h5>
            <?php

            $user_id=$_REQUEST["user_id"];
            	$view_query = mysqli_query($connections,"SELECT * from account where  acc_id ='$user_id' "); 
                // where account_type='0'
                
                while($row = mysqli_fetch_assoc($view_query)){ //<-- ginagamit tuwing kukuha ng database
                    
                    $db_acc_id = $row["acc_id"];
                    $db_acc_created = $row["acc_created"];
                    $db_acc_username = $row["acc_username"];
                    $db_acc_password = $row["acc_password"];
                    $db_acc_fname = $row["acc_fname"];
                    $db_acc_lname = $row["acc_lname"];

                    $db_acc_type = $row["acc_type"];
                    $db_acc_status = $row["acc_status"];
                    $db_acc_email = $row["acc_email"];
                    $db_acc_contact = $row["acc_contact"];
                    
                    $db_emp_address = $row["emp_address"];
                    $db_emp_image = $row["emp_image"];
                  
                    
            
            ?>
            <form method="POST" enctype="multipart/form-data">
                <div class="container">
                    <input type="hidden" value='<?= $db_acc_id?>' name='accid'>
                    <div class="mb-3">
                        <label >First name</label>
                        <input type="text" class="form-control" value='<?php echo $db_acc_fname?>' name="fname" value="" placeholder="First Name">
                        <span class='error'><?php echo $fnameErr; ?></span>
                    </div>
                    <div class="mb-3">
                       <label >Last name</label>
                        <input type="text" class="form-control" name="lname" value="<?php echo $db_acc_lname?>" placeholder="Last Name">
                        <span class='error'><?php echo $lnameErr; ?></span>
                    </div>
                    <div class="mb-3">
                        <label >Contact</label>
                        <input type="text" class="form-control" name="contactNo" value="<?php echo $db_acc_contact?>" placeholder="Contact">
                        <span class='error'><?php echo $contactNoErr; ?></span>
                    </div>
                    <div class="mb-3">
                       <label >Email</label>
                        <input type="email" class="form-control" min='0' name="email" value="<?php echo $db_acc_email?>" placeholder="Email">
                        <span class='error'><?php echo $emailErr; ?></span>
                    </div>
                    <label >Complete Address</label>
                    <div class="mb-3">
                        <textarea name="emp_address" class="form-control" rows="3"  placeholder="Complete Address"><?php echo $db_emp_address?></textarea>
                        <span class='error'><?php echo $emp_addressErr; ?></span>                         
                    </div>


                    <div class="mb-3">
                        <label>Upload Photo</label>
                        <input type="file" name="emp_image" class="btn btn-outline-secondary col-12">
                        <span class='error'><?php echo $emp_imageErr; ?></span>
                        <?php if ($db_emp_image) : ?>
                            <img src="../../upload_img/<?php echo $db_emp_image; ?>" alt="Employee Image" style="max-width: 200px; margin-top: 10px;">
                            <input type="hidden" name="current_emp_image" value="<?php echo $db_emp_image; ?>">
                        <?php else: ?>
                            <input type="hidden" name="current_emp_image" value="">
                        <?php endif; ?>
                    </div>




                    <div class="mb-3">
                       <label >Username</label>
                        <input type="text" class="form-control"  name="uname" value="<?php echo$db_acc_username?>" placeholder="Username">
                        <span class='error'><?php echo $unameErr; ?></span>   
                    </div>
                    <div class="mb-3">
                       <label>Password</label>
                        <input type="text" class="form-control" name="password" value="<?php echo $db_acc_password?>" placeholder="Password">
                        <span class='error'><?php echo $passwordErr; ?></span>   
                    </div>
                    
                    
                    <div class="mb-3">
    <label>User Type</label>
    <div class="dropdown">
        <select class="btn btn-secondary dropdown-toggle btn-sm" name="utype">
            <option value="">Select</option> 
            <option value="customer" class="dropdown-item" <?php if($db_acc_type == 'customer'){ echo 'selected';}?>>customer</option>
            <option value="delivery person" class="dropdown-item"<?php if($db_acc_type == 'delivery person'){ echo 'selected';}?>>delivery person</option>
            <option value="cashier" class="dropdown-item"<?php if($db_acc_type == 'cashier'){ echo 'selected';}?> >cashier</option>
            <option value="administrator" class="dropdown-item"<?php if($db_acc_type == 'administrator'){ echo 'selected';}?> >administrator</option>
        </select>
        <span class='error'><?php echo $utypeErr; ?></span>
    </div>
</div>

<hr>
<div class="container d-flex justify-content-center">
    <button type="submit" name='btnUpdateUser' class="btn btn-primary btn-sm">UPDATE USER</button>
</div>

                   

                </div>
        </div>
        </form>
        <?php
         }
        ?>

    </div>
</div>
                        </div>
      
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

  $('#db_prod_image').attr('src', '../../upload_prodImg/' + db_prod_image);

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