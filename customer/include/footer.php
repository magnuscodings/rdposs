<style>
    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      margin: 0;
    }

    main {
      flex: 1;
    }
  </style>

  
<footer class="text-center text-lg-start text-dark" style="background-color: #ECEFF1;">
    <section class="d-flex justify-content-between p-4 text-white" style="background-color: #6D0F0F;"></section>

    <?php 
      $view_product_query = mysqli_query($connections, "SELECT * FROM maintinance");
      while ($maitinance_row = mysqli_fetch_assoc($view_product_query)) {
        $db_system_id = $maitinance_row["system_id"];
        $db_system_name = $maitinance_row["system_name"];
        $db_system_banner = $maitinance_row["system_banner"];
        $db_system_logo = $maitinance_row["system_logo"];
        $db_system_address = $maitinance_row["system_address"];
        $db_system_contact = $maitinance_row["system_contact"];
        $db_system_tax = $maitinance_row["system_tax"];
    ?>

    <section class="">
      <div class="container bg text-center text-md-start mt-5">
        <div class="row mt-3">
          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <h6 class="text-uppercase fw-bold">ADDRESS</h6>
            <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
            <p><i class="fas fa-home mr-3"></i><?php echo $db_system_address?></p>
          </div>
          <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4"></div>
          <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4"></div>
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            <h6 class="text-uppercase fw-bold">CONTACT</h6>
            <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
            <p><i class="fas fa-phone mr-3"></i><?php echo $db_system_contact?></p>
          </div>
          <?php }?>
        </div>
      </div>
    </section>
    
    <div class="text-center p-3 text-light" style="background-color: #6D0F0F;">
      <span>&copy; 2023</span>
      <a class="text-light text-decoration-none" href="#"><?php echo $db_system_name ?></a>
    </div>
  </footer>