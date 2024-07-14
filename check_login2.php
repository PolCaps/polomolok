<?php
session_start();
include 'database_config.php'; // Include the database connection

// Create a new MySQLi connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check in the `users` table
    $query_users = "SELECT * FROM users WHERE username = ? AND password = ?";
    if ($stmt_users = $conn->prepare($query_users)) {
        $stmt_users->bind_param('ss', $username, $password);
        $stmt_users->execute();
        $result_users = $stmt_users->get_result();

        if ($result_users->num_rows > 0) {
            // User found in the `users` table
            $user = $result_users->fetch_assoc();
            $role = $user['user_type'];
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_type'] = $role;

            // Redirect based on user role
            if ($role === 'ADMIN') {
                header('Location: Admin.php');
                exit();
            } elseif ($role === 'STAFF') {
                header('Location: Staff.php');
                exit();
            }
        } else {
            // Check in the `vendors` table
            $query_vendors = "SELECT * FROM vendors WHERE username = ? AND password = ?";
            if ($stmt_vendors = $conn->prepare($query_vendors)) {
                $stmt_vendors->bind_param('ss', $username, $password);
                $stmt_vendors->execute();
                $result_vendors = $stmt_vendors->get_result();

                if ($result_vendors->num_rows > 0) {
                    // Vendor found in the `vendors` table
                    $vendor = $result_vendors->fetch_assoc();
                    $_SESSION['vendor_id'] = $vendor['vendor_id'];
                    $_SESSION['username'] = $vendor['username'];
                    header('Location: Vendor.php');
                    exit();
                } else {
                    // Invalid credentials
                    $_SESSION['status'] = "Invalid Username or Password";
                    header("location: index.php");
                }
            } else {
                echo "Failed to prepare vendor statement.";
            }
        }
    } else {
        echo "Failed to prepare user statement.";
    }
}
?>