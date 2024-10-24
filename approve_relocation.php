<?php

include('database_config.php');

$mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($mysqli->connect_error) {
    die("<script>
            alert('Connection error: " . $mysqli->connect_error . "'');
            window.location.href = 'AMRelReqProcessing.php';
        </script>");
}

date_default_timezone_set('Asia/Manila');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['request_id'])) {
        $request_id = $_POST['request_id']; 
        $vendor_id = $_POST['vendor_id'];

  
        $relocatedStall = $_POST['stallSelect'] ?? null;
        $relocationDate = $_POST['relocation_date'] ?? null;
        $maintenanceDescription = $_POST['maintenanceDescription'] ?? null;
        $approvedDate = date('Y-m-d H:i:s');
        $approvalStatus = "Approved";

 
        if ($relocatedStall && $relocationDate && $maintenanceDescription) {

            $stmt = $mysqli->prepare("UPDATE relocation_req SET relocated_stall = ?, relocation_date = ?, maintenance_description = ?, approval_status = ?, approval_date = ? WHERE request_id = ?");
            $stmt->bind_param("sssssi", $relocatedStall, $relocationDate, $maintenanceDescription, $approvalStatus, $approvedDate, $request_id);

       
            if ($stmt->execute()) {

                $notification_type = 'Relocation Request Status';
                $notification_message = "Congrats! Your relocation request for Stall $relocatedStall has been approved.";
                $time_stamp = date('Y-m-d H:i:s');
                $is_read = 0; 


                $stmt_notify = $mysqli->prepare("INSERT INTO notifications (vendor_id, notification_type, message, time_stamp, is_read) VALUES (?, ?, ?, ?, ?)");

                if ($stmt_notify) {
                    $stmt_notify->bind_param("isssi", $vendor_id, $notification_type, $notification_message, $time_stamp, $is_read);
                    $stmt_notify->execute();
                    $stmt_notify->close();
                }

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
        // Handle the case where request_id is not set
        echo "<script>
                alert('Request ID is not set.');
                window.location.href = 'AMRelReqProcessing.php';
            </script>";
    }
}

$mysqli->close();
?>
