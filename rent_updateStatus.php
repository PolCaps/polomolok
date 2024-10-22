<?php

session_start();

date_default_timezone_set('Asia/Manila'); 

include('database_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $applicant_id = $_POST['applicant_id'];
    $status = $_POST['status'];

    $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind
    $stmt = $conn->prepare("UPDATE rent_application SET Approval = ? WHERE applicant_id = ?");
    $stmt->bind_param("si", $status, $applicant_id);

    // Execute the statement
    if ($stmt->execute()) {

        if ($status === 'APPROVED') {
            
            $notification_type = 'Ready for payment';
            $notification_message = "New Approved Rent Application";
            $time_stamp = date('Y-m-d H:i:s'); 
            $is_read = 0;

            // Insert notification for Admin
            $stmt_admin = $conn->prepare("INSERT INTO notifications (user_type, notification_type, message, time_stamp, is_read) VALUES (?, ?, ?, ?, ?)");
            $user_type = 'Cashier';

            if ($stmt_admin) {
                $stmt_admin->bind_param("ssssi", $user_type, $notification_type, $notification_message, $time_stamp, $is_read);
                $stmt_admin->execute();
                $stmt_admin->close();
            }

        }

        // Redirect back to the application page
        header("Location: AMStallApp.php");
        exit();
    } else {
        // Handle execution error
        header("Location: AMStallApp.php");
        exit();
    }

    // Close connection
    $stmt->close();
    $conn->close();
}
?>
