<?php
// Start the session
session_start();

date_default_timezone_set('Asia/Manila');
// Include database configuration
include('database_config.php');

// Create a connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Insert data into the inquiry table
    $query = "INSERT INTO inquiry (name, email_add, subject, message) VALUES ('$name', '$email', '$subject', '$message')";

    if ($conn->query($query) === TRUE) {
        // Set session variables for success message
        $_SESSION['alert_class'] = 'alert-success';
        $_SESSION['alert_message'] = 'Your message has been sent successfully!';

        // Prepare notification insertion for Admin and Customer Service
        $notification_type = 'New Inquiry';
        $notification_message = "New inquiry submitted by $name with subject: '$subject'.";
        $time_stamp = date('Y-m-d H:i:s'); // Current timestamp
        $is_read = 0; // Set to 0 for unread

        // Insert notification for Admin
        $stmt_admin = $conn->prepare("INSERT INTO notifications (user_type, notification_type, message, time_stamp, is_read) VALUES (?, ?, ?, ?, ?)");
        $user_type_admin = 'Admin';

        if ($stmt_admin) {
            $stmt_admin->bind_param("ssssi", $user_type_admin, $notification_type, $notification_message, $time_stamp, $is_read);
            $stmt_admin->execute();
            $stmt_admin->close();
        }

        // Insert notification for Customer Service
        $stmt_customer_service = $conn->prepare("INSERT INTO notifications (user_type, notification_type, message, time_stamp, is_read) VALUES (?, ?, ?, ?, ?)");
        $user_type_customer_service = 'Customer Service';

        if ($stmt_customer_service) {
            $stmt_customer_service->bind_param("ssssi", $user_type_customer_service, $notification_type, $notification_message, $time_stamp, $is_read);
            $stmt_customer_service->execute();
            $stmt_customer_service->close();
        }

    } else {
        // Set session variables for error message
        $_SESSION['alert_class'] = 'alert-danger';
        $_SESSION['alert_message'] = 'An error occurred while sending your message. Please try again later.';
    }

    // Close the database connection
    $conn->close();

    // Redirect back to the index page
    header('Location: index.php?#contact');
    exit();
}
?>
