<?php
include('database_config.php');

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);
                      
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

$username = $_POST['username'];
$password = $_POST['password'];

if ($username && $password) {
    $query = "SELECT * FROM users_account WHERE username='$username' AND password='$password'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $_SESSION['username'] = $username;

        // Redirect based on user role
        switch ($user['user_type']) {
            case 'Admin':
                header("Location: Admin.html");
                exit();
            case 'Vendor':
                header("Location: Vendor.html");
                exit();
            case 'Staff':
                header("Location: Staff.html");
                exit();
            default:
                // If user role is not recognized, redirect to a generic page or display an error message
                $_SESSION['error'] = "Unauthorized access";
                header("Location: index.php");
                exit();
        }
    } else {
        $_SESSION['status'] = "Invalid Username or Password";
        header("location: index.php");
    }
}

// Close the database connection
$conn->close();
?>