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
    $password = $conn->real_escape_string($password);

    // Check in the `users` table
    $query_users = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result_users = $conn->query($query_users);

    if ($result_users->num_rows > 0) {
        // User found in the `users` table
        $user = $result_users->fetch_assoc();
        $role = $user['user_type'];

        // Set distinct session names based on user role
        if ($role === 'ADMIN') {
            session_name('admin_session');
        } elseif ($role === 'CASHIER') {
            session_name('cashier_session');
        } elseif ($role === 'DOCUMENT_HANDLER') {
            session_name('docuhandler_session');
        } elseif ($role === 'CUSTOMER_SERVICE') {
            session_name('customerservice_session');
        }
        session_start();

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
        }
    } else {
        // Check in the `vendors` table if not found in `users`
        $query_vendors = "SELECT * FROM vendors WHERE username = ? AND password = ?";
        if ($stmt_vendors = $conn->prepare($query_vendors)) {
            $stmt_vendors->bind_param('ss', $username, $password);
            $stmt_vendors->execute();
            $result_vendors = $stmt_vendors->get_result();

            if ($result_vendors->num_rows > 0) {
                $vendor = $result_vendors->fetch_assoc();

                // Set distinct session name for vendors
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
                echo "<script>alert('Invalid Username or Password'); window.location.href = 'index.php';</script>";
                exit();
            }
        } else {
            echo "<script>alert('Failed sql'); window.location.href = 'index.php';</script>";
                exit();
        }
    }
}
?>
