<?php
session_name('admin_session'); // Set custom session name
// $lifetime = 604800; // 7 days in seconds
$lifetime = 604800; 
session_set_cookie_params($lifetime); // Set session cookie lifetime
session_start(); // Start the session

// Check if the user is logged in and is an admin
if (!isset($_SESSION['id']) || $_SESSION['user_type'] !== 'ADMIN') {
    header("Location: index.php");
    exit();
}

// Check if the session has expired
if (isset($_SESSION['login_time'])) {
    $time_since_login = time() - $_SESSION['login_time'];
    if ($time_since_login > $lifetime) {
        // Session expired, destroy the session and redirect to login
        session_unset();
        session_destroy();

        echo "<script>
                alert('Your session has expired. Please log in again.');
                window.location.href = 'Admin.php?session_expired=1';
              </script>";
        exit();
    }
} else {
    // If login_time is not set, set it when the session starts
    $_SESSION['login_time'] = time();
}

// Get the user ID from the session
$user_id = $_SESSION['id'];

// Include database configuration
include('database_config.php');

// Create a connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user information
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Check if user data is retrieved
if (!$user) {
    die("No user found with ID " . htmlspecialchars($user_id));
}

// Close the connection
$conn->close();
?>
