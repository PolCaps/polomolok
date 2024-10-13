<?php
// Start the session with the specific session name
session_name('vendor_session');

// Set session cookie parameters for 7 days (1 week)
$lifetime = 604800; 
session_set_cookie_params($lifetime);
session_start();

// Check if vendor_id exists in the session
if (!isset($_SESSION['vendor_id'])) {
    // Redirect to login if vendor_id is not set
    header("Location: Vendor.php");
    exit();
}

// Check if the session has expired (1 week after login)
if (isset($_SESSION['login_time'])) {
    $time_since_login = time() - $_SESSION['login_time'];
    if ($time_since_login > $lifetime) {
        // Session expired, destroy the session and redirect to login with an alert
        session_unset();
        session_destroy();

        // Use a simple HTML page with an alert to show session expired message
        echo "<script>
                alert('Your session has expired. Please log in again.');
                window.location.href = 'Vendor.php?session_expired=1';
              </script>";
        exit();
    }
} else {
    // If login_time is not set, set it when the session starts
    $_SESSION['login_time'] = time();
}

// Get the vendor ID from the session
$vendor_id = $_SESSION['vendor_id'];
?>