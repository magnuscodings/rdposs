<?php 

include("backend/back_navbar.php");

include("backend/session.php");
?>
<style>


body{

	background-color: #F2F2F2;


}
.navbar{
    background-color: #d12130;
    padding: 1.5%;
}
.notification-count {
    display: inline-block;
    background-color: yellow;
    color: black;
    font-weight: bold;
    padding: 2px 6px;
    border-radius: 50%;
    width: 20px; /* Adjust width to desired size */
    height: 20px; /* Adjust height to desired size */
    text-align: center;
    line-height: 15px; /* Adjust line-height to vertically center align */
}
.btn-warning{
	color:#000;
	background-color:#ffc107;
	border-color:#ffc107;
}

.search-container {
    max-width: 30%; /* Adjust the value as per your preference */
  }
</style>

<body >
<main>
<?php 
$sql = mysqli_query($connections, "SELECT COUNT(*) as count_rows, SUM(a.cart_prodQty) as qtys FROM cart as a  
WHERE a.cart_user_id='{$_SESSION['acc_id']}'");
$row = mysqli_fetch_assoc($sql);
$count = $row['count_rows'];
$items = $row['qtys'];
?>	
	<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <a class="navbar-brand" href="home.php"><img src="../upload_system/<?php echo $db_system_logo ?>" alt="" width="50" height="40"><?php echo $db_system_name ?></a>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="products.php">Products</a>
                </li>
				<li class="nav-item">
                    <a class="nav-link" href="cart.php">                        
                        Cart<span class="shopping-cart-icon">
                            <i class="fa fa-shopping-cart"></i>
                            <span class="notification-count"><?php echo $count;?></span>
                        </span>
                    </a>
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
						<a class="dropdown-item" href="viewProfile.php">View Profile</a>
						<a class="dropdown-item" href="#">Account Setting</a>
                        <a class="dropdown-item" href="backend/logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>