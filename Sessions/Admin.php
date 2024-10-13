<?php
session_name('admin_session'); // Set custom session name
$lifetime = 604800; // 7 days in seconds
session_set_cookie_params($lifetime); // Set session cookie lifetime
session_start(); // Start the session

// Check if the user is logged in and is an admin
if (!isset($_SESSION['id']) || $_SESSION['user_type'] !== 'ADMIN') {
    // Inject JavaScript for session restoration only if the session is not active
    echo "<script>
            // Check if session ID exists in local storage
            if (localStorage.getItem('session_id')) {
                // Re-authenticate or restore session using session ID
                fetch('/restore_ADMINsession.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ session_id: localStorage.getItem('session_id') }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = 'Admin.php';
                    } else {
                        window.location.href = 'index.php';
                    }
                });
            } else {
                window.location.href = 'index.php';
            }
          </script>";
    exit();
}

// If login_time is not set, set it when the session starts
if (!isset($_SESSION['login_time'])) {
    $_SESSION['login_time'] = time();
} else {
    // Check if the session has expired
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
}

// Save the session ID in local storage upon successful login
echo "<script>
        localStorage.setItem('session_id', '" . session_id() . "');
      </script>";

// Include database configuration
include('database_config.php');

// Create a connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user information
$user_id = $_SESSION['id'];
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
