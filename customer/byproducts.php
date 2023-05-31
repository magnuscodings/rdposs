<?php 
include("backend/session.php");
include("backend/back_navbar.php");
?>
<!DOCTYPE html>
<html>
<style>
</style>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>My Ecoommerce</title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/cart.css">
	<link rel="stylesheet" href="css/products.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<div class="container-fluid">
	  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
		<a class="navbar-brand" href="home.php"><img src="images/logo.png" alt="" width="50" height="40"> MY ECCOMERCE</a>
		<ul class="navbar-nav me-auto mb-2 mb-lg-0">
		  <li class="nav-item">
			<a class="nav-link " aria-current="page" href="home.php">Homepage</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link " aria-current="page" href="products.php">Products</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="cart.php">Cart</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="myOrders.php">My Orders</a>
		  </li>
		 
		  <li class="nav-item">
			<a class="nav-link" href="faq.php">FAQs</a>
		  </li>
		   <li class="nav-item">
			<a class="nav-link" href="login.php">LOGOUT</a>
		  </li>
		</ul>
		<form class="d-flex">
		  <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
		  <button class="btn btn-outline-success" type="submit">Search</button>
		</form>
	  </div>
	</div>
  </nav>
  <!-- header -->

<div class="container">
	<div class="row by">
		<div class="col-md-4 by2"><img src="images/drinks1.jpg" class="img1 im im1" alt=""></div>
		<div class="col-md-4 by2 by3">
			<div class="col-md"><img src="images/drinks1.jpg" class="img2 im" alt=""></div>
			<div class="col-md"><img src="images/drinks3.png" class="img2 im" alt=""></div>
			<div class="col-md"><img src="images/drinks4.png" class="img2 im" alt=""></div>
			<div class="col-md"><img src="images/drinks5.png" class="img2 im" alt=""></div>

		</div>
		<div class="col-md-4 des1">
			<div class="col-md"><span class="s-title">Softdrinks</span></div> <br>
			<div class="col-md"> <span class="s-title2">Softdrinks bundle 1</span></div> <br>
			<div class="col-md"> <span class="s-title3">P100</span></div>
			<div class="s-title4">
				<div class="col-md "> Expiration Date: N/A</div>
				<div class="col-md des"> Drink this and it will refresh your life.</div>
				<div class="col-md"> <b> Stock left: 45</b></div>
			</div>
			<div class="col-md mt-3">
				<button type="submit" class="btn btn-primary text-light fw-bold rounded-pill">Add to cart</button>
			</div>
		</div>

	</div>
</div>
</body>
</html>
<script>
	$(document).ready(function(){
    $('.im').on('click',function(){
		$(".im1").attr("src",$(this).attr("src"));
    });
});
</script>