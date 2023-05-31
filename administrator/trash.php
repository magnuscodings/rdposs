<?php 
include "connection.php";

include "navigation.php";

include "back_maintinance.php";
if(isset($_SESSION["acc_id"])){
  $acc_id = $_SESSION["acc_id"];
  
  $get_record = mysqli_query ($connections,"SELECT * FROM account where acc_id='$acc_id' ");
  $row = mysqli_fetch_assoc($get_record);
  $acc_type = $row ["acc_type"];
  if($acc_type =="customer"){
           //redirect administrator
           echo "<script>window.location.href='../customer/home.php'</script>";	
} if($acc_type =="delivery person"){
           //redirect administrator
              echo "<script>window.location.href='../delivery/';</script>";	      
} if($acc_type =="cashier"){
           //redirect administrator
              echo "<script>window.location.href='../cashier/';</script>";	         
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <title>System Maintinance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <style>
        .center-div {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>

<body>
<form method="POST" enctype="multipart/form-data">
<div class="container-fluid">
        <div class="row justify-content-center" > <!-- Center the row -->
            <div class="col-9">
                <div class="container-fluid d-flex justify-content-center mb-2">
                    <div class="card w-100">
                        <div class="card-body" style='background-color:rgb(25,25,25,0.8); color:white; border-radius:20px;'>
                            <h5 class="card-title" style="text-align: center;" >System Maintenance</h5>
                            <div class="container">
                            
                            
                            </div>
                        </div>
                        <div class="card" style='background-color:rgb(25,25,25,0.5);'>
                            <div class="card-body" >
                              
                                    <div class="container" style='background-color:white; border-radius:15px; width:40%;'>
                                        <div class="mb-3">
                                            <center>
                                                <h5 class="card-title" style="text-align: center;">Store Name</h5>
                                                <input style="width: 50%;" type="text" class="form-control" value="<?php echo $db_system_name?>" name="storename" placeholder="Example: Ardeleon Poultry Supplies">
                                                <span class='error'><?php echo $storenameErr?></span>   <br><br>
                                                <button type="submit" name="btnStorename" class="btn btn-primary btn-sm">UPDATE STORE NAME</button>
                                                
                                            </center>
                                        </div>
                                        <hr>
                     
                           </div>
                           
                           <center>
  <div class="mb-3">
    <div class="container" style='background-color:white; border-radius:15px; width:40%;'> <h5 class="card-title" style="text-align: center;">Store Banner</h5>
    <div id="drag-drop-area">
      <div class="drag-drop-text">
        <img src="../upload_system/<?php echo $db_system_banner; ?>" alt="system_banner" style="border: 5px solid; max-width: 80%; border-radius: 15px;">
      </div>
      <input type="file" name="banner" />
    </div>
    <span class="error">
     
    </span>
    <br>
    <button type="submit" name="btnBanner" class="btn btn-primary btn-sm">UPDATE BANNER</button>
  </div>
</center>
<hr>

   
                   
                        <center>
                    <div class="mb-3">
                    <div style='background-color:white; border-radius:15px; width:40%;'>
                      <h5 class="card-title" style="text-align: center;">Logo</h5>
                 </div>
                    <div id="drag-drop-area">
                <div class="drag-drop-text" >
                    <img src='../upload_system/<?php echo $db_system_logo ?>' alt='logo' style=' border:5px solid;  max-width: 40%;'>
                </div>
                <input type="file" name='logo' />
                      <br>
                    </div>
                    </div><!-- $db_system_gcashNumber-->
                        <button type="submit"  name='btnLogo' class="btn btn-primary btn-sm">UPDATE QR</button></center>
                    <hr>
                    <div class="mb-3">
                    <div class="container" style='background-color:white; border-radius:15px; width:40%;'>   <h5 class="card-title" style="text-align: center;">Upload Gcash Qr</h5></div>
                    <center>
                        <div id="drag-drop-area">
                <div class="drag-drop-text">
                    <img src='../upload_system/<?php echo $db_system_GcashQr ?>' alt='Gcash QR' style='border:5px solid; max-width: 40%;'>
                </div>
                <input type="file" name='GcashQr' />
                      <br>
                    </div>
                    <center><button type="submit"  name='btnGcashQr' class="btn btn-primary btn-sm">UPDATE GCASH QR</button></center>
                    <br>
                    <hr>
                    <div style='background-color:white; border-radius:15px; width:40%;'>
                    <div class="mb-3"  >
                    <h5 class="card-title" style="text-align: center;">Gcash Number</h5>
                     <Center>   <input style='width:40%;' type="text" class="form-control"  name="Gnumber" value="<?php echo $db_system_gcashNumber ?>" placeholder="Example: 0945-445-477-44"></center>
                       
                    </div>
                    <center><button type="submit"  name='btnGnumber' class="btn btn-primary btn-sm">UPDATE</button></center>
                    <br><span class="error"><h2><?php echo $GnumberErr?></h2></span>
                    <hr>
                    </div>
                    <div style='background-color:white; border-radius:15px; width:40%;'>
                         <h5 class="card-title" style="text-align: center;">Store Address</h5>
                    <div class="mb-3">
                     <center>   <textarea style='width:60%;' name="store_address" class="form-control" rows="3"  placeholder="Example: Sta.Rosa 2 Marilao Bulacan"><?php echo $db_system_address ?></textarea></center>
                     
                    </div>
                    <center><button type="submit"  name='btnStore_address' class="btn btn-primary btn-sm">UPDATE</button></center>
                    <br>
                    <span class='error'><?php echo $store_addressErr?></span>
                    <hr>
                    </div>
                    <div style='background-color:white; border-radius:15px; width:40%;'>
                    <div class="mb-3">
                    <h5 class="card-title" style="text-align: center;">Store Contact</h5>
                     <Center>   <input style='width:40%;' type="text" class="form-control"  name="scontact" value="<?php echo  $db_system_contact ?>" placeholder="Example: 0945-445-477-44"></center>
                       
                    </div>
                    <center><button type="submit"  name='btnscontact' class="btn btn-primary btn-sm">UPDATE</button></center>
                    <br>
                    <span class='error'><h2><?php echo $scontactErr?></h2></span>
                    <hr>
                
                    </div>
                    <div style='background-color:white; border-radius:15px; width:40%;'>
                    <div class="mb-3">
                    <h5 class="card-title" style="text-align: center;">Update Tax</h5>
                    <center>    <input style='width:40%;' type="text" class="form-control" name='updatetax'  value="<?php echo  $db_system_tax?>" placeholder="Example : 0.02"></center>
                      
                    </div>  <center><button type="submit"  name='btnupdatetax' class="btn btn-primary btn-sm">UPDATE</button></center>
                    <br>
                    <span class='error'><h2><?php echo $updatetaxErr?></h2></span>
                    <hr>
                    </div>


                    
                    <div style='background-color:white; border-radius:15px; width:40%;'>
                    <div class="mb-3">
                    <h5 class="card-title" style="text-align: center;">Update Unit</h5>
                    <center>
                   
                    <div class="dropdown">
    <select class="btn btn-secondary dropdown-toggle btn-sm" name="utype" onchange="updateInputValue(this)">
        <option value="">Select</option>
        <?php 
        $view_query = mysqli_query($connections, "SELECT * FROM unit"); 

        while($row = mysqli_fetch_assoc($view_query)) {
            $unit_id = $row["unit_id"];
            $db_unit_name = $row["unit_name"];
            ?>
            <option value="<?php echo $unit_id ?>" class="dropdown-item"><?php echo $db_unit_name ?></option>
        <?php } ?>      
    </select>   
    <input id="selectedOption" name='unit' style="width:40%;" type="text" class="form-control" value="" placeholder="Example: kg">
    <span class='error'><h3><?php echo $unitErr?></h3></span>
    <br>
    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    Action
  </button>
  <div class="collapse" id="collapseExample">
  <div class="card card-body">
    <button type="submit" name="btnUpdateUnit" class="btn btn-success btn-green"><b>UPDATE UNIT</b></button>
   
    <button type="submit" name="btnAddUnit" class="btn btn-primary btn-green"><b>ADD UNIT</b></button>
  
    <button type="submit" name="btnRemUnit" class="btn btn-primary btn-danger"><b>REMOVE UNIT</b></button>
    </div>
</div>
</div>



                    </center> 
                  
                    </div>
                    
                    <hr></div>

                    <div style='background-color:white; border-radius:15px; width:40%;'>
                    <div class="mb-3">
                    <h5 class="card-title" style="text-align: center;">Update Category</h5>
                    <center>
                      
                      
                        <div class="dropdown">
                            <select class="btn btn-secondary dropdown-toggle btn-sm" name="utype" onchange="updateInputCategory(this)">
                                <option value="">Select</option> 
                                <?php 
                        $view_query = mysqli_query($connections,"SELECT * from category "); 
                        // where account_type='0'
                        
                        while($row = mysqli_fetch_assoc($view_query)){ //<-- ginagamit tuwing kukuha ng database
                            
                            $category_id  = $row["category_id"];
                            $db_category_name = $row["category_name"];
                        ?>
                                <option value="<?php echo $category_id?>" class="dropdown-item" ><?php echo  $db_category_name?></option>
                         <?php } ?>      
                              
                            </select>   
                            <input id="selectedOptionCategory" name='category' style="width:40%;" type="text" class="form-control" value="" placeholder="Example: Food">
                            <span class='error'><h3><?php echo $categoryErr?></h3></span>
                            <br>
    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#dropdownCategory" aria-expanded="false" aria-controls="collapseExample">
    Action
  </button>
  <div class="collapse" id="dropdownCategory">
  <div class="card card-body">
                            <button type="submit"  name='btnUpdateCat' class="btn btn-success btn-green"><b>UPDATE CATEGORY</b></button>
                     
                        <button type="submit"  name='btnAddCat' class="btn btn-primary btn-green"><b>ADD CATEGORY</b></button>
                
                        <button type="submit"  name='btnRemCat' class="btn btn-primary btn-danger"><b>REMOVE CATEGORY</b></button>
                        </div>
                        </div>
                        </div>
                     
                       
<script>
    function updateInputCategory(selectElement) {
  var selectedOptionCategory = selectElement.options[selectElement.selectedIndex];
  var category_id = selectedOptionCategory.value;
  var categoryName = selectedOptionCategory.text;
  document.getElementById("selectedOptionCategory").value = categoryName;

  // Update URL with category_id
  var currentUrl = window.location.href;
  var updatedUrl = updateURLParameter(currentUrl, 'category_id', category_id);
  window.history.pushState({ path: updatedUrl }, '', updatedUrl);
}

function updateInputValue(selectElement) {
  var selectedOption = selectElement.options[selectElement.selectedIndex];
  var unitId = selectedOption.value;
  var unitName = selectedOption.text;
  document.getElementById("selectedOption").value = unitName;

  // Update URL with unit_id
  var currentUrl = window.location.href;
  var updatedUrl = updateURLParameter(currentUrl, 'unit_id', unitId);
  window.history.pushState({ path: updatedUrl }, '', updatedUrl);
}

// Function to update URL parameters
function updateURLParameter(url, param, paramValue) {
  var newUrl;
  if (url.indexOf(param + '=') >= 0) {
    var prefix = url.substring(0, url.indexOf(param));
    var suffix = url.substring(url.indexOf(param)).substring(url.indexOf('=') + 1);
    suffix = suffix.indexOf('&') >= 0 ? suffix.substring(suffix.indexOf('&')) : '';
    newUrl = prefix + param + '=' + paramValue + suffix;
  } else {
    if (url.indexOf('?') >= 0) {
      newUrl = url + '&' + param + '=' + paramValue;
    } else {
      newUrl = url + '?' + param + '=' + paramValue;
    }
  }
  return newUrl;
}


</script>
                    </center> 
                  
                    </div>
                    <hr></div>
                    
                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
   
</body>
</html>