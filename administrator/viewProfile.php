<?php

include "connection.php";
include "navigation.php";

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


    <title>View Profile</title>
</head>

<style>
.gradient-custom {
/* fallback for old browsers */
background: #f6d365;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1));

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1))
}
</style>

<?php 
/**
 * 
 *  $db_acc_id = $row["acc_id"];
        $db_acc_fname = $row["acc_fname"];
        $db_acc_lname = $row["acc_lname"];
        $db_emp_image = $row["emp_image"];
        
        $fullname = ucfirst($db_acc_fname) . " " . $db_acc_lname;
        $db_acc_contact = $row["acc_contact"];
        $db_emp_address = $row["emp_address"];
        $db_acc_username = $row["acc_username"];
        $db_acc_password = $row["acc_password"];
        $db_acc_username = $row["acc_username"];
        $db_acc_type = $row["acc_type"];
        $db_acc_email = $row["acc_email"];
 * 
 */
?>
<body>
<section class="vh-100" style="background-color: #f4f5f7;">
  <div class="container py-5 h-100" >
    <div class="row d-flex justify-content-center align-items-center h-500" >
      <div class="col col-lg-10 mb-4 mb-lg-0" >
        <div class="card mb-3" style="border-radius: .5rem;" >
          <div class="row g-0" >
            <div class="col-md-4 gradient-custom text-center text-white" 
              style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;" >
              <?php if($db_emp_image){ ?>
            <img src="../upload_img/<?php echo $db_emp_image ?>"
                alt="Avatar" class="img-fluid my-5" style="width: 40%; border-radius:50%; " />
             
          <?php }else{?>
            <img src="../upload_system/empty.png" alt="Avatar" class="img-fluid my-5" style="width: 40%; border-radius:50%; ">
          <?php } ?>
          <hr>
          <h4>Account no #<?php echo $db_acc_id ?></h4>
          <hr>
              <h3><?php echo $fullname ?></h3>
              <p><?php echo ucfirst($db_acc_type)?></p>

              <button style="background: transparent; border:0;" class="btn-hover" data-bs-toggle="modal" data-bs-target="#ModViewProfile" data-db_prod_id="<?= $db_prod_id ?>">
                <i class="far fa-edit" style="font-size: 200%;"></i>
              </button>


            </div>
            <div class="col-md-8">
              <div class="card-body p-4">
              <div class="mb-3">
                        <label>Upload Photo</label>
                        <input type="file" name="emp_image" class="btn btn-outline-secondary col-12">
                    
                        <?php if ($db_emp_image) : ?>
                            <img src="../upload_img/<?php echo $db_emp_image; ?>" alt="Employee Image" style="max-width: 200px; margin-top: 10px;">
                            <input type="hidden" name="current_emp_image" value="<?php echo $db_emp_image; ?>">
                        <?php else: ?>
                            <input type="hidden" name="current_emp_image" value="">
                        <?php endif; ?>
                    </div>

                <h6>Information</h6>
                <hr class="mt-0 mb-4">
                <div class="row pt-1">
                  <div class="col-6 mb-3">
                    <h6>First Name</h6>
                    <p class="text-muted"><?php echo $db_acc_fname?></p>
                  </div>
                  <div class="col-6 mb-3">
                    <h6>Last Name</h6>
                    <p class="text-muted"><?php echo  $db_acc_lname?></p>
                  </div>

                  <div class="col-6 mb-3">
                    <h6>Email</h6>
                    <p class="text-muted"><?php echo $db_acc_email?></p>
                  </div>
                  <div class="col-6 mb-3">
                    <h6>Phone</h6>
                    <p class="text-muted"><?php echo  $db_acc_contact?></p>
                  </div>
                </div>
                <h6>ADDRESS :</h6>
                <hr class="mt-0 mb-4">
                <div class="row pt-1">
                  <div class="col-6 mb-3">
          
                    <p class="text-muted"><?php echo $db_emp_address?></p>
                  </div>
                  
                </div>
               
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
<!-- Modal cart -->
<div class="modal fade" id="ModViewProfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Update User Information</h1>
        <br>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
  <div class="col-md-8 mx-auto">
    <div class="card-body p-4">
      <h1>Information</h1>
      <hr class="mt-0 mb-4">
      <div class="row pt-1">
        <div class="col-6 mb-3">
          <h6 class="text">First Name</h6>
          <input type="text" class="form-control text-center" value="<?php echo $db_acc_fname; ?>">
        </div>
        <div class="col-6 mb-3">
          <h6 class="text">Last Name</h6>
          <input type="text" class="form-control text-center" value="<?php echo $db_acc_lname; ?>">
        </div>
        <div class="col-20 mb-3">
          <h6 class="text">Email</h6>
          <input type="text" class="form-control text-center" value="<?php echo $db_acc_email; ?>">
        </div>
        <div class="col-8 mb-3">
          <h6 class="text">Phone</h6>
          <input type="text" class="form-control text-center" value="<?php echo $db_acc_contact; ?>">
        </div>
      </div>
      <h6>ADDRESS :</h6>
      <hr class="mt-0 mb-4">
      <div class="row pt-1">
        <div class="col-12 mb-3 text-center">
        <textarea class="form-control" rows="3"><?php echo $db_emp_address; ?></textarea>
      
        </div>
      </div>
    </div>
  </div>
</div>

      <div class="modal-footer text-center">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <form method="POST" action="addcart.php">
          <button type="submit" name="add" class="btn btn-primary">Confirm</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!--end modal-->


</html>