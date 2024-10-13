<?php
// Start the session with the specific session name
session_name('customerservice_session');

// Set session cookie parameters for 7 days (1 week)
$lifetime = 60 * 60 * 24 * 7; // 7 days in seconds
session_set_cookie_params($lifetime);
session_start();

// Check if the user is logged in and is in customer service
if (!isset($_SESSION['id']) || $_SESSION['user_type'] !== 'CUSTOMER_SERVICE') {
    header("Location: index.php");
    exit();
}

// Check if the session has expired (1 week after login)
if (isset($_SESSION['login_time'])) {
    $time_since_login = time() - $_SESSION['login_time'];
    if ($time_since_login > $lifetime) {
        // Session expired, destroy the session and redirect to login
        session_unset();
        session_destroy();

        // Use a simple HTML page with an alert to show session expired message
        echo "<script>
                alert('Your session has expired. Please log in again.');
                window.location.href = 'index.php?session_expired=1';
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
    die("No User found with ID " . htmlspecialchars($user_id));
}

// Close the connection
$conn->close();
?>