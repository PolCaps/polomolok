<?php
session_start();
include 'database_config.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture form data
    $user_type = $_POST['account_type'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $first_name = $_POST['first_name'] ?? '';
    $middle_name = $_POST['middle_name'] ?? '';
    $last_name = $_POST['last_name'] ?? '';
    $age = $_POST['age'] ?? '';
    $contact_no = $_POST['contact_no'] ?? '';
    $address = $_POST['address'] ?? '';
    $email_add = $_POST['email_add'] ?? '';

   try {
        // Create a new PDO instance
        $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare and execute the insert statement
        $stmt = $pdo->prepare("INSERT INTO users (user_type, username, password, first_name, middle_name, last_name, age, contact_no, address, email_add) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$user_type, $username, $password, $first_name, $middle_name, $last_name, $age, $contact_no, $address, $email_add]);

        // Set success message in session
        $_SESSION['message'] = 'User created successfully!';

        // Redirect after successful insertion
        header('Location: AMUser.php');
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage(); // Display the error
    }
}
?>