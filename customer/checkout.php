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

</head>
<style>

.navbar{
    background-color: #dd3434e8;
    padding: 1.5%;
}


body{

background-color: #F2F2F2;


}
</style>

<body>
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <a class="navbar-brand" href="home.php"><img src="../upload_system/<?php echo $db_system_logo ?>" alt="" width="50" height="40"><?php echo $db_system_name ?></a>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="home.php">Homepage</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="products.php">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="cart.php">Cart</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="myOrders.php">My Orders</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="faq.php">FAQs</a>
                </li>
			<li class="nav-item dropdown" style='background-color:rgb(0,0,0,0.5); border-radius:10px;'>
				
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<?php if($db_emp_image){ ?>
				<img src="../upload_img/<?php echo $db_emp_image ?>" alt="" width="35" height="30" style='border-radius:50%;'>    <?php echo ucfirst($db_acc_lname) ?>
			  <?PHP }else{?>
				<img src="../upload_system/empty.png" alt="" width="30" height="30">    <?php echo ucfirst($db_acc_lname) ?>
			
			 <?php } ?>
			</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="#">View Profile</a>
					<a class="dropdown-item" href="#">Account Setting</a>
					<a class="dropdown-item" href="backend/logout.php">Logout</a>
				</div>
			</li>
            </ul>
        </div>
    </div>
</nav>

  <!-- header -->

<div class="container">
		<div class="my-3">
			<div class="card rounded-0 shadow">
				<div class="card-body">
					<div class="container-fluid">
						<div class='row'>
							<div class="col-md-6 lh-1">
								<h3>Delivery Address</h3>
								<p class="mb-1"> Sampaloc, Manila</p>
								<p class="mb-1"><strong>Phone</strong>: 0912-123-4567</p>
								<p class="mb-1"><strong>Email</strong>: myemail@gmail.com</p>
								
							</div>
							<div class="col-md-6 lh-1">
								<h3>Order Summery</h3>
								<p class="mb-2"><strong>Items</strong>: 400.00</p>
								<p class="mb-2"><strong>Delivery</strong>: 0.0</p>
								<p class="mb-2"><strong>Total</strong>: 400.00</p>
								<p class="mb-4"><strong>Order Total</strong>: PHP 400.00</p>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer py-1">
					<div class="row justify-content-center">
						<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
							<div class="d-grid">
                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">Place Order</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">[Payment] Transaction</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <select name="" id="" class="form-control mt-2" title="Select payment option" required>
          <option value="">Payment option</option>
          <option value="">Cash on Delivery</option>
          <option value="">Paypal</option>
        </select>
        <input type="text" placeholder="Input Address" title="Input Address" class="form-control mt-2" required>
	 
		<input type="hidden" class="form-control mt-2" id="order_id" name="ssid" required>
		</div>
		<div class="modal-footer">
			<button type="submit" name="cancel" class="btn btn-danger">Confirm</button>
			<button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">No</button>
		</div>
	 
    </div>
  </div>
</div>
</div>
</body>
</html>