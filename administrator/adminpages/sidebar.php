
<?php 
$currentURL = $_SERVER['REQUEST_URI'];
?>
<nav class="sb-sidenav accordion sb-sidenav-dark bg-custom-color" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link <?php if (strpos($currentURL, 'index.php') !== false) echo 'active'; ?>" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link <?php if (strpos($currentURL, 'inventory.php') !== false) echo 'active'; ?>" href="inventory.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-store"></i></div>
                                Inventory
                            </a>
                            <a class="nav-link <?php if (strpos($currentURL, 'manageaccount.php') !== false) echo 'active'; ?>" href="manageaccount.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Manage User
                            </a>

                            <a class="nav-link <?php if (strpos($currentURL, 'checkorders.php') !== false) echo 'active'; ?>" href="checkorders.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-check"></i></div>
                                Check Orders
                            </a>

                            <a class="nav-link <?php if (strpos($currentURL, 'return.php') !== false) echo 'active'; ?>" href="return.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-undo"></i></div>
                                Return Item
                            </a>
                            
                            <a class="nav-link <?php if (
                            strpos($currentURL, 'managevoucher.php') !== false ||
                            strpos($currentURL, 'managediscount.php') !== false ||
                            strpos($currentURL, 'managecategory.php') !== false ||
                            strpos($currentURL, 'manageunit.php') !== false 
                            )
                             echo 'active'; ?>" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-tools"></i></div>
                                Maintinance
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="systemsetting.php" >
                                        System Setting
                                        
                                    </a>
                                      


                                    <a class="nav-link collapsed" href="managevoucher.php" >
                                        Manage Voucher
                                       
                                    </a>
                                    <a class="nav-link collapsed" href="managediscount.php" >
                                        Manage Discount
                                       
                                    </a>
                                    <a class="nav-link collapsed" href="managecategory.php" >
                                        Manage Category
                                    </a>
                                    <a class="nav-link collapsed" href="manageunit.php" >
                                        Manage Unit
                                    </a>  
                                    
                                    

                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Addons</div>
                            <a class="nav-link" href="charts.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Charts
                            </a>
                          
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php echo $fullname?>
                    </div>
                </nav>