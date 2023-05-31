
<?php



// Get the current page URL
$currentURL = $_SERVER['REQUEST_URI'];
?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">


<link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <style>
.bg-custom-color {
    background-color: #6D0F0F;
}

.card-body {
        font-size: 25px; /* Adjust the font size as per your requirement */
    }
</style>
  
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-custom-color">
            <!-- Navbar Brand style="background-color: #6D0F0F;"-->
            <img src="../../upload_system/<?php echo $db_system_logo?>" class="img-fluid" alt="nothing" style="height: 55px; width: 55px; border-radius: 50%;">
            <a class="navbar-brand ps-3" href="index.php"><h1><?php echo $db_system_name?></h1></a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                
            </form>
            <!-- Navbar-->
           
           
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4" >
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="viewProfile.php?profileid=<?php echo $db_acc_id ?>">Settings</a></li>
                        <li><a class="dropdown-item" href="activitylog.php">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="backend/logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
            
        </nav>