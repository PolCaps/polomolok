<?php

include('database_config.php');

// Create a connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    echo "<script>
        alert('Connection failed: " . $conn->connect_error . "');
        window.location.href = 'VMRelocation.php';
    </script>";
    exit();
}

// Get data from POST request
$vendor_id = $_POST['vendor_id'];
$vendor_name = $_POST['vendor_name'];
$reason = $_POST['message'];
$current_stall = $_POST['currentStall'];

// Prepare and bind for relocation request insertion
$stmt = $conn->prepare("INSERT INTO relocation_req (vendor_id, reason, current_stall) VALUES (?, ?, ?)");

if ($stmt) {
    $stmt->bind_param("iss", $vendor_id, $reason, $current_stall);

    // Execute the statement for relocation request
    if ($stmt->execute()) {
        // Get the ID of the newly inserted relocation request
        $relocation_id = $stmt->insert_id;

        // Prepare data for the notification
        $user_type = 'Admin'; // Example user type who should receive the notification
        $notification_type = 'Relocation Request'; // Type of notification
        // $message = "A new relocation request has been submitted by vendor ID: $vendor_id.";
        $message = "New Relocation Request by $vendor_name";
        $time_stamp = date('Y-m-d H:i:s'); // Current timestamp
        $is_read = 0; // Set to 0 for unread notifications

        // Insert notification into the notifications table
        $stmt_notification = $conn->prepare("INSERT INTO notifications (user_type, notification_type, message, time_stamp, is_read) VALUES (?, ?, ?, ?, ?)");

        if ($stmt_notification) {
            $stmt_notification->bind_param("ssssi", $user_type, $notification_type, $message, $time_stamp, $is_read);

            if ($stmt_notification->execute()) {
                echo "<script>
                window.location.href = 'VMRelocation.php';
            </script>";
            } else {
                echo "<script>
                    alert('Relocation request sent successfully, but failed to create notification.');
                    window.location.href = 'VMRelocation.php';
                </script>";
            }

            $stmt_notification->close();
        } else {
            echo "<script>
                alert('Relocation request sent successfully, but error preparing notification statement.');
                window.location.href = 'VMRelocation.php';
            </script>";
        }
    } else {
        echo "<script>
            alert('Error: " . $stmt->error . "');
            window.location.href = 'VMRelocation.php';
        </script>";
    }

    $stmt->close();
} else {
    echo "<script>
        alert('Error preparing statement: " . $conn->error . "');
        window.location.href = 'VMRelocation.php';
    </script>";
}

// Close the connection
$conn->close();
?>
