<?php
// Database connection
include('database_config.php');

// Create a connection
$mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($mysqli->connect_error) {
    die("<script>
            alert('Connection error: " . $mysqli->connect_error . "');
            window.location.href = 'AMRelReqProcessing.php';
        </script>");
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the vendor_id is set in the POST request
    if (isset($_POST['request_id'])) {
        $request_id = $_POST['request_id']; 

        // Retrieve inputs safely
        $relocatedStall = $_POST['stallSelect'] ?? null;
        $relocationDate = $_POST['relocation_date'] ?? null;
        $maintenanceDescription = $_POST['maintenanceDescription'] ?? null;
        $approvedDate = date('Y-m-d H:i:s');
        $approvalStatus = "Approved";

        // Check if all necessary fields are available before executing the query
        if ($relocatedStall && $relocationDate && $maintenanceDescription) {
            // Prepare the SQL statement to update the relocation_req table
            $stmt = $mysqli->prepare("UPDATE relocation_req SET relocated_stall = ?, relocation_date = ?, maintenance_description = ?, approval_status = ?, approval_date = ? WHERE request_id = ?");
            $stmt->bind_param("sssssi", $relocatedStall, $relocationDate, $maintenanceDescription, $approvalStatus, $approvedDate, $request_id);

            // Execute the statement
            if ($stmt->execute()) {
                // Success message
                echo "<script>
                        alert('Updated successfully.');
                        window.location.href = 'AMRelReqProcessing.php';
                    </script>";
            } else {
                // Error handling
                echo "<script>
                        alert('Error updating record: " . $stmt->error . "');
                        window.location.href = 'AMRelReqProcessing.php';
                    </script>";
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "<script>
                    alert('All fields are required.');
                    window.location.href = 'AMRelReqProcessing.php';
                </script>";
        }
    } else {
        // Handle the case where vendor_id is not set
        echo "<script>
                alert('Vendor ID is not set.');
                window.location.href = 'AMRelReqProcessing.php';
            </script>";
    }
}

$mysqli->close();
?>
