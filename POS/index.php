<?php
include("back_login.php");


include("cashier/back_navbar.php");

if(isset($_SESSION["acc_id"])){
    $acc_id = $_SESSION["acc_id"];
    
    $get_record = mysqli_query ($connections,"SELECT * FROM account where acc_id='$acc_id' ");
    $row = mysqli_fetch_assoc($get_record);
    $acc_type = $row ["acc_type"];
    if($acc_type =="administrator"){
             //redirect administrator
                echo "<script>window.location.href='../administrator/';</script>";	        
 } if($acc_type =="delivery person"){
             //redirect administrator
                echo "<script>window.location.href='../delivery/';</script>";	      
 } if($acc_type =="cashier"){
             //redirect administrator
                echo "<script>window.location.href='cashier/index.php';</script>";	         
 }
 }
 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <!-- owl stylesheets -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
        media="screen">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    
    <style>

        
        @media (max-width: 576px) {
            body {
                background-image: none;
            }
        }

        .max-height-30 {
            max-height: 60vh;
        }

		.banner_section {
    width: 100%;
    float: left;
    background-image: url("../upload_system/<?php echo$db_system_banner?>");
    height: auto;
    background-size: 100%;
    padding: 10px 0px 25px 0px;
    background-repeat: no-repeat;

}
@media (max-width: 576px) { /* Apply styles only for screens up to 576px wide (mobile devices) */
  .col-md-6 {
    margin-left: auto; /* Auto margin on the left side to center the column */
    margin-right: auto; /* Auto margin on the right side to center the column */
    float: none; /* Remove float property to center the column */
  }
}


    </style>
</head>
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <a class="navbar-brand" href="index.php"><img src="../upload_system/<?php echo $db_system_logo ?>" alt="" width="50" height="40"><?php echo $db_system_name ?></a>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="index.php">Homepage</a>
                </li>
                
				<li class="nav-item">
                    <a class="nav-link" aria-current="page" href="about.php">About us</a>
                </li>
                
                
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                
            </ul>
        </div>
    </div>
</nav>

  <!-- header   <img src="../upload_system/// echo $db_system_banner" alt="New York" class="d-block"> -->
<body>
    
    
    <!-- banner section start -->
    <!-- banner section start -->
    <div class="banner_section layout_padding">
  <div class="container">
    <div id="main_slider" class="carousel slide" data-ride="carousel">
      <form method="POST">
        <div class="row align-items-center">
          <div class="col-md-6 mx-auto"> <!-- Add 'mx-auto' class to center the column -->
            <div class="card text-center login-card">
              <div class="card-body">
                <div class="mb-5">
                  <h1 class="login-heading">LOGIN</h1>
                </div>
                <div class="mb-3">
                  <label style='float:left;'>Username</label>
                  <input type="text" class="form-control" placeholder="Username" name="username">
                  <span class="error"><?php echo $usernameErr?></span>
                </div>
                <div class="mb-3">
                  <label style='float:left;'>Password</label>
                  <input type="password" class="form-control" placeholder="Password" name="password">
                  <span class="error"> <?php echo $passwordErr?></span>
                </div>
                <div class="d-grid gap-2 col-12 mx-auto mb-3">
                  <button class="btn btn-success" type="submit" name="btnLogin">LOGIN</button>
                </div>
                
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>



 	<!-- Footer -->
   