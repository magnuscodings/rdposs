<?php
include "backend/back_navbar.php";
include "navigation.php";

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

 
 
                                 $view_query = mysqli_query($connections, "
                                 SELECT order_transaction_code, orders_ship_fee, orders_tax,
                                orders_voucher_rate, SUM(orders_subtotal) AS total_subtotal    
                                 FROM `orders`
                                 GROUP BY order_transaction_code,
                                 orders_ship_fee, orders_tax, orders_voucher_rate;
                             ");
                             
                             // Initialize variables
                            $final = 0; 
                            while ($row = mysqli_fetch_assoc($view_query)) {
                                 $total_subtotal = $row["total_subtotal"];
                                 $orders_ship_fee = $row["orders_ship_fee"];
                                 $orders_tax = $row["orders_tax"];
                                 $orders_voucher_rate = $row["orders_voucher_rate"];
                             
                                 $orders_voucher_rateClean = preg_replace('/[^0-9.]/', '', $orders_voucher_rate);
                             
                                 if ($orders_voucher_rateClean) {
                                     $orders_voucher_percent = $orders_voucher_rateClean / 100;
                                 }
                             
                                 $addship_in_orders = $total_subtotal + $orders_ship_fee; // Add shipfee to the subtotal
                                 $get_tax_in_orders = $total_subtotal * $orders_tax; // Get VAT from the subtotal
                                 $finalDefault = $addship_in_orders + $get_tax_in_orders; // Calculate the total amount before applying the voucher
                             
                                 if ($orders_voucher_rateClean) {
                                     $voucher = $finalDefault * $orders_voucher_percent; // Calculate the voucher amount
                                     $finalDefault = $finalDefault-$voucher; // Add the voucher amount to the final total with voucher
                                 }

                              $final +=$finalDefault; //total sales in ordering
                                 }

                            $pos_query = mysqli_query($connections, "SELECT
                                orders_tcode,orders_final FROM `pos_orders` GROUP BY orders_tcode");
                                // Initialize variables
                                $pos_final = 0;
                            while ($row_pos = mysqli_fetch_assoc($pos_query)) {
                                    $orders_final = $row_pos["orders_final"];

                                    $pos_final+=$orders_final; //total sales in POS
                                }
                               
                                $Total_Sales=$pos_final+$final; //overall sales
                                 
                            //delivery
                            $delivery_query = mysqli_query($connections, "SELECT COUNT(*) AS row_count
                            FROM (
                                SELECT order_transaction_code
                                FROM orders
                                WHERE orders_status = 'Preparing' OR orders_status = 'In-transit'
                                GROUP BY order_transaction_code
                            ) AS subquery");
                            $row_deliver = mysqli_fetch_assoc($delivery_query);
                            $row_count = $row_deliver["row_count"];


                                // Initialize variables
                           
                           
                                 
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
     
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>

   
    <body class="sb-nav-fixed " >
   
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
            <?php include "sidebar.php";?>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4" >Dashboard</h1>
                       
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Total Delivery: <?php echo $row_count?></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                            
                                    <div class="card-body">Total Sales :&#8369; <?php  echo number_format($Total_Sales,2);?></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-secondary  text-white mb-4">
                                    <div class="card-body">Total Product:
                                    <?php
                                    $sql = "SELECT COUNT(*) AS total_products FROM product";
                                    $result = mysqli_query($connections, $sql);

                                    if ($result) {
                                        $row = mysqli_fetch_assoc($result);
                                        $totalProducts = $row['total_products'];
                                        echo $totalProducts;
                                    }?>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                <center> <div class="card-body">Total User:
                                    <?php
                                    $sql = "SELECT COUNT(*) AS total_account FROM Account";
                                    $result = mysqli_query($connections, $sql);

                                    if ($result) {
                                        $row = mysqli_fetch_assoc($result);
                                        $total_account = $row['total_account'];
                                        echo  $total_account;
                                    }
                                    ?>
                                    </div>
                                </center>
                                    
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area me-1"></i>
                                        Area Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Bar Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                DataTable Example
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Address</th>
                                            <th>Contact#</th>
                                            <th>Email</th>
                                            <th>Start date</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Email</th>
                                            <th>Contyact #</th>
                                            <th>Email</th>
                                            <th>Start date</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php 
                                        $full_name="";
                                        $view_query = mysqli_query($connections,"SELECT * from account where acc_type='administrator'
                                        OR acc_type='cashier' OR acc_type='delivery person'
                                         "); 
                                        // where account_type='0'
                                        
                                        while($row = mysqli_fetch_assoc($view_query)){ //<-- ginagamit tuwing kukuha ng database
                                            
                                            $acc_id = $row["acc_id"];
                                            $acc_fname = $row["acc_fname"];
                                            $acc_lname = $row["acc_lname"];
                                            $acc_type = $row["acc_type"];
                                            $acc_contact = $row["acc_contact"];
                                            $emp_address = $row["emp_address"];
                                            $acc_email = $row["acc_email"];
                                            $acc_created = $row["acc_created"];
                                            
                                            $full_name = ucfirst($acc_fname)." ".ucfirst($acc_lname);

                                        ?>
                                        <tr>
                                            <td><?= $full_name ?></td>
                                            <td><?= ucfirst($acc_type)?></td>
                                            <td><?= $emp_address?></td>
                                            <td><?= $acc_contact?></td>
                                            <td><?= $acc_email?></td>
                                            <td><?= $acc_created ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <?php 
        $sql = "SELECT DATE_FORMAT(orders_date, '%M %e') AS orders_date, SUM(orders_subtotal) AS weeklybenta
        FROM orders
        WHERE orders_status = 'Complete' AND MONTH(orders_date) = MONTH(CURRENT_DATE())
        GROUP BY WEEK(orders_date)
        ";
        $result = $connections->query($sql);
        $weeklySales = array();
        $weeklyOrderDate = array();

        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            array_push( $weeklySales,$row['weeklybenta']);
            array_push( $weeklyOrderDate,$row['orders_date']);
        }
        $weeklySales = json_encode($weeklySales);
        $weeklyOrderDate = json_encode($weeklyOrderDate);
            }

            $sql = "
            SELECT  DATE_FORMAT(orders_date, '%M') as orders_date,SUM(`orders_subtotal`) AS monthlySales
            FROM `orders`
            WHERE `orders_status` = 'Complete' AND YEAR(orders_date) = YEAR(CURRENT_DATE())
            GROUP BY DATE_FORMAT(`orders_date`, '%Y-%m')
            ";
            $result = $connections->query($sql);
            $monthlySales = array();
            $monthlyOrderDate = array();
    
            if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                array_push($monthlySales,$row['monthlySales']);
                array_push($monthlyOrderDate,$row['orders_date']);
            }
            $monthlySales = json_encode($monthlySales);
            $monthlyOrderDate = json_encode($monthlyOrderDate);
                }
        ?>

                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script>
            var weeklySales = <?php echo $weeklySales?>;
            var weeklyOrderDate = <?php echo $weeklyOrderDate?>;
            var monthlySales = <?php echo $monthlySales?>;
            var monthlyOrderDate = <?php echo $monthlyOrderDate?>;
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        
    </body>
</html>
