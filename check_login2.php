<?php
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

    // Escape input data to prevent SQL injection
    $username = $conn->real_escape_string($username);

    // Check in the `users` table
    $query_users = "SELECT * FROM users WHERE username = ?";
    if ($stmt_users = $conn->prepare($query_users)) {
        $stmt_users->bind_param('s', $username);
        $stmt_users->execute();
        $result_users = $stmt_users->get_result();

        if ($result_users->num_rows > 0) {
            // User found in the `users` table
            $user = $result_users->fetch_assoc();

            // Check password directly (not secure!)
            if ($password === $user['password']) {
                $role = $user['user_type'];

                // Set distinct session names based on user role
                session_name(strtolower($role) . '_session');
                session_start();

                // Clear previous session data if any
                session_unset();

                // Set session variables for users
                $_SESSION['id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['user_type'] = $role;

                // Redirect based on user role
                if ($role === 'ADMIN') {
                    header('Location: Admin.php');
                    exit();
                } elseif ($role === 'CASHIER') {
                    header('Location: Cashier.php');
                    exit();
                } elseif ($role === 'DOCUMENT_HANDLER') {
                    header('Location: DocumentHandler.php');
                    exit();
                } elseif ($role === 'CUSTOMER_SERVICE') {
                    header('Location: CustomerService.php');
                    exit();
                } // Added closing parenthesis here
            } else {
                $_SESSION['status'] = "Invalid Username or Password";
                header("Location: index.php");
                exit();
            }
        }
    } else {
        echo "Failed to prepare statement for users.";
    }

    // Check in the `vendors` table if not found in users
    $query_vendors = "SELECT * FROM vendors WHERE username = ?";
    if ($stmt_vendors = $conn->prepare($query_vendors)) {
        $stmt_vendors->bind_param('s', $username);
        $stmt_vendors->execute();
        $result_vendors = $stmt_vendors->get_result();

        if ($result_vendors->num_rows > 0) {
            $vendor = $result_vendors->fetch_assoc();

            // Check vendor password directly (not secure!)
            if ($password === $vendor['password']) {
                session_name('vendor_session');
                session_start();

                // Clear previous session data if any
                session_unset();

                // Set session variables for vendors
                $_SESSION['vendor_id'] = $vendor['vendor_id'];
                $_SESSION['username'] = $vendor['username'];

                header('Location: Vendor.php');
                exit();
            } else {
                $_SESSION['status'] = "Invalid Username or Password";
                header("Location: index.php");
                exit();
            }
        } else {
            $_SESSION['status'] = "Invalid Username or Password";
            header("Location: index.php");
            exit();
        }
    } else {
        echo "Failed to prepare statement for vendors.";
    }
}
?>
