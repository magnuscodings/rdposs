<?php 
include("backend/session.php");
include("backend/back_navbar.php");


if(isset($_SESSION["acc_id"])){
    $acc_id = $_SESSION["acc_id"];
    
    $get_record = mysqli_query ($connections,"SELECT * FROM account where acc_id='$acc_id' ");
    $row = mysqli_fetch_assoc($get_record);
    $acc_type = $row ["acc_type"];
    if($acc_type =="administrator"){
             //redirect administrator
             echo "<script>window.location.href='../administrator/'</script>";	
 } if($acc_type =="delivery person"){
             //redirect administrator
                echo "<script>window.location.href='../delivery/';</script>";	      
         
            }else if($acc_type =="cashier"){
                //redirect administrator
                   echo "<script>window.location.href='../POS/';</script>";	      
          }
 }
?>
<!DOCTYPE html>
<html>
<style>
</style>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $db_system_name ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/cart.css">


</head>
<style>
.navbar{
    background-color: #6D0F0F;
    padding: 1.5%;
}
body{

background-color: #F2F2F2;


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

</style>
<body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<?php 
$sql = mysqli_query($connections, "
SELECT COUNT(DISTINCT a.cart_prod_id) AS count_rows, SUM(a.cart_prodQty) AS qtys 
FROM cart AS a  
WHERE a.cart_user_id='{$_SESSION['acc_id']}'
");

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
                    <a class="nav-link" aria-current="page" href="products.php">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="cart.php">                        
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

<div class="container" style="min-height:400px;">

<?php 




if ($items == 0) {
    echo "<center><br><h2 class='cart-title mt-4 text-center'>My Cart</h2><h1> is empty</h1></center>";
} else {
    ?>
    <div class="wrapper">
        <div class="wrapper_content">
            <div class="header_title">
                <div class="title">
                 
                </div>
                <div class="amount">
                    <hr>

                    <form action="removeCart.php" method="POST">
                        <button type="submit" name="btnRemoveAll" class="btn btn-sm btn-danger">
                            <i class="fa-solid fa-trash fa-sm"></i>
                        </button>

                        <input type="checkbox" checked id="checkboxAll" onclick="toggleCheckboxes(this)">
                        <label for="checkboxAll">Select All</label>
                        <b>(<?=$count?>) ITEMS</b>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleCheckboxes(checkbox) {
            var checkboxes = document.getElementsByName('myCheckbox[]');
            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = checkbox.checked;
            }
        }
    </script>

    <?php 
    $total_bill = 0;
    $view_product_query = mysqli_query($connections, "SELECT *, SUM(a.cart_prodQty) as qty 
            FROM cart as a 
            LEFT JOIN product as b ON a.cart_prod_id = b.prod_id
            WHERE a.cart_user_id='{$_SESSION['acc_id']}'
            GROUP BY a.cart_prod_id");
    while ($product_row = mysqli_fetch_assoc($view_product_query)) {
        $db_cart_id = $product_row["cart_id"];    
        $db_prod_id = $product_row["prod_id"];    
        $db_prod_name = $product_row["prod_name"];
        $db_prod_orgprice = $product_row["prod_orgprice"];
        $db_prod_currprice = $product_row["prod_currprice"];
       
        $db_prod_unit = $product_row["prod_unit_id"];
        $db_prod_category = $product_row["prod_category_id"];
        $db_prod_description = $product_row["prod_description"];
        $db_prod_image = $product_row["prod_image"];        
        $db_cart_prodQty = $product_row["cart_prodQty"];   
        
        $db_qty=$product_row["qty"];

        $total_price = $db_prod_currprice * $db_cart_prodQty; // Calculate total price for the product
        $total_bill += $total_price; // Add the total price to the total bill

        $get_record_unit = mysqli_query($connections, "SELECT * FROM unit WHERE unit_id ='$db_prod_unit' ");
        $row_unit = mysqli_fetch_assoc($get_record_unit);
        $unit_name = $row_unit["unit_name"];
//<img src="../assets/img/1599802140_no-image-available.png" alt="" style="width: 200px; height: 150px;">
echo '
<div class="product_wrap">
    <input type="checkbox" name="myCheckbox[]" checked value="'.$db_prod_id.'">
    <label for="myCheckbox">Check</label>
    <div class="product_info">
        <div class="product_img">
';

if ($db_prod_image) {
    echo '
        <img src="../upload_prodImg/'.$db_prod_image.'" alt="ProductImage" width="200px" height="200px">
    ';
} else {
    echo '
        <img src="../assets/img/1599802140_no-image-available.png" alt="" style="width: 200px; height: 150px;">
    ';
}

echo '
        </div>
        <div class="product_data">
            <div class="description">
                <div class="main_header">'.ucwords($db_prod_name).'</div>
                <div class="sub_header">'.$db_prod_description.'</div>
            </div>
            <hr>
            <div class="price">
                <div class="current_price"><span>&#8369;</span> '.number_format($db_prod_currprice, 2, '.', ',').'</div>
                <div class="normal_price"><!--DISCOUNT FOR FUTURE PURPOSES--></div>
                <div class="discount"><!--DISCOUNT FOR FUTURE PURPOSES--></div>
            </div>
            <hr>
            <div class="discount">Qty '.$db_qty.' '.$unit_name.'</div>
            <hr>
            <div class="discount">Total price  <span>&#8369;</span> <font style="color:red;">'.number_format($total_price, 2, '.', ',').'</font></div>
        </div>
    </div>

    <div class="product_btns">
        <div class="remove remotogler" data-bs-toggle="modal" data-bs-target="#modalRemoveConfirm" 
	data-db_prod_id="'.$db_prod_id.'"
    data-db_prod_name="'.$db_prod_name.'"
        >
        
            Remove
        </div>
        <div class="whishlist">MOVE TO WISHLIST</div>
    </div>
</div>

<script>
    function redirectToRemoveCart(cartId) {
        window.location.href = "singleRemove.php?remove_id=" + cartId;
    }

    
</script>
';

    }
    ?>	
  

    
    

    <div class="product_btns">

        <div class="remove"><h2 style="color:black;">TOTAL:<span>&#8369;</span> <?php echo number_format($total_bill, 2, '.', ',');?></h2></div>

        <div class="whishlist">MOVE TO WISHLIST</div>
    </div>

    <div class="text-center">
        <button type="submit" name="btnCheckOut" class="btn btn-success fs-4">
            Checkout
            <i class="fa-solid fa-check fs-4"></i>
            <i class="fa fa-shopping-cart"></i>
        </button>
        </form>
    </div>
    <br>
    </div>
    
    </body>

    <div class="modal fade" id="modalRemoveConfirm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Remove from the cart</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="removeForm" method="POST">
          <input type="hidden" id="db_prod_id" name="remove_id">
          <center>Remove <b><span id='db_prod_nameDisplay'></span></b> From the cart?</center>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="confirmremove" class="btn btn-primary">Confirm</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script>
    
  $(document).ready(function() {
    $('#removeForm').submit(function(e) {
      e.preventDefault(); // Prevent the form from submitting normally

      // Serialize the form data
      var formData = $(this).serialize();

      // Send the AJAX request
      $.ajax({
        type: 'POST',
        url: 'singleRemove.php',
        data: formData,
        
        success: function(response) {
          // Display the validation result in the modal
          $('.error').html(response);
          window.location.reload();
        //  console.log(formData);
        }
      });

    });
  });





$('.remotogler').click(function(){
   db_prod_id = $(this).attr('data-db_prod_id')
    $('#db_prod_id').val(db_prod_id)
        
     db_prod_name = $(this).attr('data-db_prod_name')
    $('#db_prod_nameDisplay').text(db_prod_name)
    })
        
            </script>
    </html>
<?php
}
?>


