<?php 
include "connection.php";
include "back_account.php";
include "navigation.php";


if(isset($_SESSION["acc_id"])){
    $acc_id = $_SESSION["acc_id"];
    
    $get_record = mysqli_query ($connections,"SELECT * FROM account where acc_id='$acc_id' ");
    $row = mysqli_fetch_assoc($get_record);
    $acc_type = $row ["acc_type"];
    if($acc_type =="customer"){
             //redirect administrator
             echo "<script>window.location.href='../customer/home.php'</script>";	
 } if($acc_type =="delivery person"){
             //redirect administrator
                echo "<script>window.location.href='../delivery/';</script>";	      
 } if($acc_type =="cashier"){
             //redirect administrator
                echo "<script>window.location.href='../cashier/';</script>";	         
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
    <title>Manage User</title>
  </head>
<body>
   
    <div class="container-fluid">
        <div class="row">
            <div class="col-9">
                <div class="container-fluid d-flex justify-content-center mb-2">
                    <div class="card w-100">
                        <div class="card-body">
                          <h5 class="card-title" style="text-align: center;">Manage Accounts</h5>
                          <div class="container">
                            <div class="table-responsive">
                                <table id="example"  class="table">
                                    <thead>
                                      <tr>
                                        <th scope="col">NO.</th>
                                        <th scope="col">USER ID</th>
                                        <th scope="col">NAME</th>
                                        <th scope="col">CONTACT</th>
                                        <th scope="col">EMAIL</th>
                                        <th scope="col">USERNAME</th>
                                      
                                        <th scope="col">TYPE</th>
                                        <th scope="col">STATUS</th>
                                       
                                        <th scope="col" style="text-align: center;">Action</th>
                                      </tr>
                                    </thead>
                                  
                                    <tbody>
                                    <?php 
                                    $fullname="";
                                    $view_query = mysqli_query($connections,"SELECT * from account "); 
                                    // where account_type='0'
                                    $item_numer=0;
                                    while($row = mysqli_fetch_assoc($view_query)){ //<-- ginagamit tuwing kukuha ng database
                                     
                                            $db_acc_id = $row["acc_id"];
                                            $db_acc_username = $row["acc_username"];
                                            $db_acc_password = $row["acc_password"];
                                            $db_acc_fname= $row["acc_fname"];
                                            $db_acc_lname = $row["acc_lname"];
                                            
                                            $db_acc_type = $row["acc_type"];
                                            $db_acc_status = $row["acc_status"];
                                            $db_acc_email = $row["acc_email"];

                                            $db_acc_contact = $row["acc_contact"];

                                            $fullname=ucfirst($db_acc_fname)." ".$db_acc_lname;
                                            $item_numer++;  
                                    ?>
                                      <tr>
                                        <td scope="row"><?php echo $item_numer?></td>
                                        <td>RDL <?php echo $db_acc_id?></td>
                                        <td><?php echo $fullname?></td>
                                        <td><?php echo  $db_acc_contact?></td>
                                        <td><?php echo  $db_acc_email?></td>
                                        <td><?php echo $db_acc_username ?></td>
                                        <td><?php echo  $db_acc_type?></td>
                                        <td><?php if($db_acc_status=='0'){ echo "Active";} else if($db_acc_status=='1'){ echo "Disable";}?></td>
                                        <td>
                                            <div class="container text-center">
                                                <div class="row align-items-start">
                                                    <div class="col mb-2">
                                                    <button type="button" class="btn btn-primary btn-sm" onclick="updateUser(<?php echo $db_acc_id; ?>)"><i class="fa fa-pencil" style="font-size:20px;color:white"></i>

                                                    <script>
                                                    function updateUser(db_acc_id) {
                                                    window.location.href = "editaccount.php?user_id=" + db_acc_id;
                                                    }
                                                    </script>



                                                    </div>
                                                    <div class="col mb-2">
                                                    <button type="submit" class="btn btn-success btn-sm" onclick="ViewProduct(<?php echo $db_acc_id; ?>)"><i class="fa fa-eye" style="font-size:20px;color:white"></i></button>

                                                           
                                                    </div>


                                                    <div class="col mb-2">
                                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-acc-id="<?php echo $db_acc_id; ?>" data-fullname="<?php echo $fullname; ?>">
                                                        <i class="fa fa-trash" style="font-size:20px;color:white"></i>
                                                    </button>



                                                    <!-- Modal -->
                                                                                                        
                                                                                                                    <!-- Modal -->
                                                                 <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                Are you sure you want to Disable User ID: <span id="accId"></span>?
                                                                                <br>
                                                                                Full Name: <span id="fullname"></span>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <form method="POST" action="update.php"> <!-- Update the action attribute with the appropriate URL -->
                                                                                    <input type="hidden" name="acc_id" id="updateAccountId" value="">
                                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                                    <button type="submit" name="confirm" class="btn btn-danger">Disable</button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>




                                                </div>

                                                    
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
            <div class="col">
            <div class="container-fluid d-flex justify-content-start">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title" style="text-align: center;">Add User</h5>
            <form method="POST" enctype="multipart/form-data">
                <div class="container">
                    <div class="mb-3">
                        <label >First name</label>
                        <input type="text" class="form-control" value='<?php echo $fname?>' name="fname" value="" placeholder="First Name">
                        <span class='error'><?php echo $fnameErr; ?></span>
                    </div>
                    <div class="mb-3">
                       <label >Last name</label>
                        <input type="text" class="form-control" name="lname" value="<?php echo $lname?>" placeholder="Last Name">
                        <span class='error'><?php echo $lnameErr; ?></span>
                    </div>
                    <div class="mb-3">
                        <label >Contact</label>
                        <input type="text" class="form-control" name="contactNo" value="<?php echo $contactNo?>" placeholder="Contact">
                        <span class='error'><?php echo $contactNoErr; ?></span>
                    </div>
                    <div class="mb-3">
                       <label >Email</label>
                        <input type="email" class="form-control" min='0' name="email" value="<?php echo $email?>" placeholder="Email">
                        <span class='error'><?php echo $emailErr; ?></span>
                    </div>
                    <label >Complete Address</label>
                    <div class="mb-3">
                        <textarea name="emp_address" class="form-control" rows="3"  placeholder="Complete Address"><?php echo $emp_address?></textarea>
                        <span class='error'><?php echo $emp_addressErr; ?></span>                         
                    </div>
                    <div class="mb-3">
                    <label >Upload Photo</label>
                        <input type="file" name="emp_image" class="btn btn-outline-secondary col-12">Attach image
                        <span class='error'><?php echo $emp_imageErr; ?></span>   
                    </div>
                    <div class="mb-3">
                       <label >Username</label>
                        <input type="text" class="form-control"  name="uname" value="<?php echo$uname?>" placeholder="Username">
                        <span class='error'><?php echo $unameErr; ?></span>   
                    </div>
                    <div class="mb-3">
                       <label >Password</label>
                        <input type="password" class="form-control" min='0' name="password" value="" placeholder="Password">
                        <span class='error'><?php echo $passwordErr; ?></span>   
                    </div>
                    
                    
                    <div class="mb-3">
                    <label >User Type</label>
                    <div class="dropdown">
    <select class="btn btn-secondary dropdown-toggle btn-sm" name="utype">
        <option value="">Select</option> 
        <option value="customer" class="dropdown-item" <?php if($utype == 'customer'){ echo 'selected';} ?>>customer</option>
        <option value="delivery person" class="dropdown-item" <?php if($utype == 'delivery person'){ echo 'selected';} ?>>delivery person</option>
        <option value="cashier" class="dropdown-item" <?php if($utype == 'cashier'){ echo 'selected';} ?>>cashier</option>
        <option value="administrator" class="dropdown-item" <?php if($utype == 'administrator'){ echo 'selected';} ?>>administrator</option>
    </select>
    <span class='error'><?php echo $utypeErr; ?></span>
</div>

                  
                    </div>
                    <hr>
                    
                    <div class="container d-flex justify-content-center">
                        
                        <button type="submit"  name='btnAddUser' class="btn btn-primary btn-sm">ADD USER</button>
                 
                    </div>

                </div>
        </div>
        </form>

    </div>
</div>
</div>

            
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <script>
        function updateUser(db_acc_id) {
            window.location.href = "editUser.php?user_id=" + db_acc_id;
        }

        function ViewProduct(db_acc_id) {
            // Implement your logic here
        }

     
    </script>
<script>

    //4 parts to update.php, button danger,  modal , and etong script
    // Function to handle button click event and update the modal
    function updateModal(accId, fullName) {
        document.getElementById('accId').textContent = accId;
        document.getElementById('fullname').textContent = fullName;
        document.getElementById('updateAccountId').value = accId;
    }

    // Event listener to capture button click event and update the modal
    document.addEventListener('DOMContentLoaded', function () {
        var buttons = document.querySelectorAll('button[data-acc-id]');
        buttons.forEach(function (button) {
            button.addEventListener('click', function () {
                var accId = button.getAttribute('data-acc-id');
                var fullName = button.getAttribute('data-fullname'); // Add this line to get the fullname attribute
                updateModal(accId, fullName);
            });
        });
    });
</script>


    
</body>
</html>