<?php
// Define and initialize the $selectedItems array
$selectedItems = array();

// Check if any checkboxes were selected
if (isset($_POST['myCheckbox'])) {
    // Retrieve the selected checkboxes
    $selectedItems = $_POST['myCheckbox'];
}

// Check if any items were selected
if (!empty($selectedItems)) {
    // Display the selected item IDs
    foreach ($selectedItems as $selectedItemId) {
        echo "Selected item ID: " . $selectedItemId . "<br>";
    }
} else {
    // Display a message when no items are selected
    echo "No items selected.";
}


?>
