<?php
include("back_navbar.php");

include("session.php");

// Get the current page URL
$currentURL = $_SERVER['REQUEST_URI'];
?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">


<nav class="navbar navbar-expand-lg navbar-dark mb-5" style="background-color: #6D0F0F;">
  <div class="container">
    <a class="navbar-brand" href="index.php"><img src="../../upload_system/<?php echo $db_system_logo?>" class="img-fluid" alt="nothing" style="height: 40px; width: 40px; border-radius:50%;"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        
        <li class="nav-item">
          <a class="nav-link <?php if (strpos($currentURL, 'index.php') !== false) echo 'active'; ?>" href="index.php">CASHIER</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if (strpos($currentURL, 'transaction.php') !== false) echo 'active'; ?>" href="transaction.php">TRANSACTION</a>
        </li>
        <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle <?php if (strpos($currentURL, 'return.php') !== false) echo 'active'; ?>" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                RETURN
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="return_pos.php">RETURN IN POS</a></li>
                <li><a class="dropdown-item" href="return_online.php">RETURN IN ONLINE</a></li>
                <!-- Add more options as needed -->
              </ul>
            </li>
       
        <li class="nav-item dropdown">
          <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php if($db_emp_image){ ?>
            <img src="../../upload_img/<?php echo $db_emp_image ?>" alt="" width="35" height="30" style='border-radius:50%;'> <?php echo ucfirst($db_acc_lname) ?>
          <?php }else{?>
            <img src="../../upload_system/empty.png" alt="" width="30" height="30"> <?php echo ucfirst($db_acc_lname) ?>
          <?php } ?>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="viewProfile.php?profileid=<?php echo $db_acc_id ?>">View Profile</a>
            <a class="dropdown-item" href="#">Account Settings</a>
            <a class="dropdown-item" href="logout.php">Logout</a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
