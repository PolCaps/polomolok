<?php
// Start the session
session_start();

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