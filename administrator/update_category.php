<?php
include "connection.php";
$category_id = $category_name = $critical_lvl = "";
// Check if the request is a POST request
if (isset($_POST["btn_update_category"])) {
  // Retrieve the form data
  $category_id = $_POST['category_id'];
  $category_name = $_POST['category_name'];
  $critical_lvl = $_POST['critical_level'];

  // Perform the database update
  $query = "UPDATE `category` SET 
            `category_name` = '$category_name',
            `critical_level` = '$critical_lvl'
            WHERE `category_id` = '$category_id'";

  // Prepare the update statement
  if (mysqli_query($connections, $query)) {
    // Update successful
    echo '
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script>
      swal({
        title: "Success!",
        text: "Update voucher Successful",
        icon: "success",
        content: true // Use the "content" option instead of "html"
      }).then((value) => {
        if (value) {
          window.location.href = "managecategory.php";
          // Display the print receipt code here
        } else {
          window.location.reload();
        }
      });
    </script>';
  } else {
    // Error occurred while updating
    echo "Error updating record: " . mysqli_error($connections);
  }
}
?>
