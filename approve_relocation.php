<?php
// submit_relocation.php

// Database connection
include('database_config.php');

// Create a connection
$mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($mysqli->connect_error) {
    die('Connection error: ' . $mysqli->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the vendor_id is set in the POST request
    if (isset($_POST['vendor_id'])) {
        $vendorID = $_POST['vendor_id']; // Retrieve the vendor ID from the hidden input

        // Now you can use $vendorID in your SQL queries or logic
        // Example: Update the relocation_req table
        $relocatedStall = $_POST['stallSelect']; // assuming you have this input
        $relocationDate = $_POST['relocation_date']; // assuming you have this input
        $maintenanceDescription = $_POST['maintenanceDescription']; // retrieve maintenance description
        $approvedDate = date('Y-m-d H:i:s'); // Get the current timestamp

        // Prepare the SQL statement to insert into the relocation_req table
        $stmt = $mysqli->prepare("UPDATE relocation_req SET relocated_stall = ?, relocation_date = ?, maintenance_description = ?, approval_date = ? WHERE vendor_id = ?");
        $stmt->bind_param("ssssi", $relocatedStall, $relocationDate, $maintenanceDescription, $approvedDate, $vendorID);

        // Execute the statement
        if ($stmt->execute()) {
            // Success message or further logic
            echo "Relocation request updated successfully.";
        } else {
            // Error handling
            echo "Error updating record: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        // Handle the case where vendor_id is not set
        echo "Vendor ID is not set.";
    }
}

$mysqli->close();
?>