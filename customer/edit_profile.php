<?php
include "../administrator/connection.php";

$fname = $lname = $email = $phone = $address = "";
$fnameErr = $lnameErr = $emailErr = $phoneErr = $addressErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["fname"])) {
        $fnameErr = "First name is required";
    } else {
        $fname = $_POST["fname"];
    }
    
    if (empty($_POST["lname"])) {
        $lnameErr = "Last name is required";
    } else {
        $lname = $_POST["lname"];
    }
    
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = $_POST["email"];
    }
    
    if (empty($_POST["phone"])) {
        $phoneErr = "Contact number is required";
    } else {
        $phone = $_POST["phone"];
    }
    
    if (empty($_POST["address"])) {
        $addressErr = "Address is required";
    } else {
        $address = $_POST["address"];
    }
    
    // File upload handling
    $imagePath = "";
    if (isset($_FILES["emp_image"]) && $_FILES["emp_image"]["error"] === UPLOAD_ERR_OK) {
        $targetDirectory = "../upload_img/"; // Specify the directory to save uploaded images
        $imageName = $_FILES["emp_image"]["name"];
        $imagePath = $targetDirectory . $imageName;
        
        // Move the uploaded file to the target directory
        move_uploaded_file($_FILES["emp_image"]["tmp_name"], $imagePath);
    }
    
    // If all fields are filled, update the data in the database
    if ($fname && $lname && $email && $phone && $address) {
        // Prepare the update statement
        $stmt = $connections->prepare("UPDATE account SET acc_fname=?, acc_lname=?, acc_email=?, acc_contact=?, emp_image=?, emp_address=? WHERE acc_id=?");
        
        // Bind the parameters to the statement
        $stmt->bind_param("ssssssi", $fname, $lname, $email, $phone, $imagePath, $address, $acc_id);
        
        // Set the acc_id value based on the account ID or session
        // Replace $acc_id with the appropriate value from your code
        $acc_id = 1; // Example: using a hard-coded account ID of 1
        
        // Execute the statement
        if ($stmt->execute()) {
            // Update successful
            echo "Profile updated successfully.";
        } else {
            // Update failed
            echo "Error updating profile: " . $stmt->error;
        }
        
        // Close the statement
        $stmt->close();
    }
}
?>
