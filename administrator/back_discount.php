<?php
include("connection.php");

$discountName = $discountRate = "";
$discountNameErr = $discountRateErr = "";

if (isset($_POST["btn_save_discount"])) {
    if (empty($_POST["discountName"])) {
        $discountNameErr = "Discount Name is required!";
    } else {
        $discountName = $_POST["discountName"];
    }

    if (empty($_POST["discountRate"])) {
        $discountRateErr = "Discount Rate is required!";
    } elseif (!is_numeric($_POST["discountRate"])) {
        $discountRateErr = "Discount Rate must be a number!";
    } else {
        $discountRate = $_POST["discountRate"];
    }

    if ($discountName && $discountRate) {
        $query = "INSERT INTO discount (discount_name, discount_rate, discount_status) VALUES (?, ?, '1')";
        $stmt = mysqli_prepare($connections, $query);
        mysqli_stmt_bind_param($stmt, "sd", $discountName, $discountRate);
        mysqli_stmt_execute($stmt);

        echo '
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
        <script>
            swal({
                title: "Success!",
                text: "Add Discount Successful",
                icon: "success",
                html: true
            }).then((value) => {
                if (value) {
                    window.location.href = "managediscount.php";
                } else {
                    window.location.reload();
                }
            });
        </script>
        ';
    }
}


if (isset($_POST["btn_discount_remove"])) {
    $discount_id = $_POST['discount_id'];

   
        // Perform the database update
        $query = "DELETE FROM `discount` WHERE `discount_id` = '$discount_id'";

        // Execute the delete statement
        if (mysqli_query($connections, $query)) {
            // Deletion successful
            echo '
            <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
            <script>
                swal({
                    title: "Success!",
                    text: "Remove Success",
                    icon: "success",
                    html: true
                }).then((value) => {
                    if (value) {
                        window.location.href = "managediscount.php";
                    } else {
                        window.location.reload();
                    }
                });
            </script>
            ';
        } else {
            echo "Error deleting record: " . mysqli_error($connections);
        }
    }




?>
