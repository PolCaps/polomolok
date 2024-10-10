<?php
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

        // Retrieve inputs safely
        $relocatedStall = $_POST['stallSelect'] ?? null;
        $relocationDate = $_POST['relocation_date'] ?? null;
        $maintenanceDescription = $_POST['maintenanceDescription'] ?? null;
        $approvedDate = date('Y-m-d H:i:s');
        $approvalStatus = "Approved";

        // Check if all necessary fields are available before executing the query
        if ($relocatedStall && $relocationDate && $maintenanceDescription) {
            // Prepare the SQL statement to update the relocation_req table
            $stmt = $mysqli->prepare("UPDATE relocation_req SET relocated_stall = ?, relocation_date = ?, maintenance_description = ?, approval_status = ?, approval_date = ? WHERE vendor_id = ?");
            $stmt->bind_param("sssssi", $relocatedStall, $relocationDate, $maintenanceDescription, $approvalStatus, $approvedDate, $vendorID);

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
            echo "All fields are required.";
        }
    } else {
        // Handle the case where vendor_id is not set
        echo "Vendor ID is not set.";
    }
}

$mysqli->close();
?>
