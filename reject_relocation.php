<?php
// Database connection
include('database_config.php');

// Create a new MySQL connection
$mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);

date_default_timezone_set('Asia/Manila');
// Check for connection error
if ($mysqli->connect_error) {
    die("<script>
            alert('Connection error: " . $mysqli->connect_error . "' );
            window.location.href = 'AMRelReqProcessing.php';
        </script>");
}

// Check if the form is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure the request_id and vendor_id are provided
    if (isset($_POST['request_id2']) && isset($_POST['vendor_id2'])) {
        $request_id = $_POST['request_id2'];
        $current_stall = $_POST['currentstall'];
        $vendor_id = $_POST['vendor_id2'];
        $rejectionReason = $_POST['rejectReason'] ?? null; 
        $approvalStatus = "Rejected";

        // Ensure rejection reason is provided
        if ($rejectionReason) {
            // Prepare the SQL statement to update relocation request
            $stmt = $mysqli->prepare("UPDATE relocation_req SET approval_status = ?, reject_reason = ? WHERE request_id = ?");
            $stmt->bind_param("ssi", $approvalStatus, $rejectionReason, $request_id);

            // Execute the statement
            if ($stmt->execute()) {
                // Check if any rows were affected (meaning an update happened)
                if ($stmt->affected_rows > 0) {
                    echo "<script>
                            alert('Request rejected successfully.');
                            window.location.href = 'AMRelReqProcessing.php';
                        </script>";

                    // Insert notification for the Vendor
                    $notification_type = "Relocation Request Status";
                    $notification_message = "Your relocation request for Stall $current_stall has been rejected.";
                    $time_stamp = date('Y-m-d H:i:s');
                    $is_read = 0; // Mark as unread

                    $stmt_vendor_notification = $mysqli->prepare("INSERT INTO notifications (vendor_id, notification_type, message, time_stamp, is_read) VALUES (?, ?, ?, ?, ?)");

                    if ($stmt_vendor_notification) {
                        $stmt_vendor_notification->bind_param("isssi", $vendor_id, $notification_type, $notification_message, $time_stamp, $is_read);
                        $stmt_vendor_notification->execute();
                        $stmt_vendor_notification->close();
                    }

                } else {
                    // No rows affected, possible that the request_id doesn't exist
                    echo "<script>
                            alert('No records updated. Please check if the request exists.');
                            window.location.href = 'AMRelReqProcessing.php';
                        </script>";
                }
            } else {
                // Error handling if the statement fails
                echo "<script>
                        alert('Error rejecting request: " . $stmt->error . "');
                        window.location.href = 'AMRelReqProcessing.php';
                    </script>";
            }

            $stmt->close();
        } else {
            // If rejection reason is missing
            echo "<script>
                    alert('Rejection reason is required.');
                    window.location.href = 'AMRelReqProcessing.php';
                </script>";
        }
    } else {
        // If request_id or vendor_id is missing
        echo "<script>
                alert('Request ID or Vendor ID is not set.');
                window.location.href = 'AMRelReqProcessing.php';
            </script>";
    }
}

// Close the MySQL connection
$mysqli->close();
?>
