<?php
session_start();
require_once 'database_config.php'; // Include your database connection file

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error mode to exception
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_type = $_POST['account_type'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $age = $_POST['age'];
    $contact_no = $_POST['contact_no'];
    $address = $_POST['address'];
    $email_add = $_POST['email_add'];

    // // Hash the password
    // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO users (user_type, username, password, first_name, middle_name, last_name, age, contact_no, address, email_add) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$user_type, $username, $hashed_password, $first_name, $middle_name, $last_name, $age, $contact_no, $address, $email_add]);

        $_SESSION['alert_class'] = 'alert-success';
        $_SESSION['alert_message'] = 'User created successfully!';
    } catch (PDOException $e) {
        error_log($e->getMessage()); // Log the error message for debugging
        if ($e->getCode() == 23000) { // 23000 is the code for a duplicate entry
            $_SESSION['alert_class'] = 'alert-danger';
            $_SESSION['alert_message'] = 'Username already exists. Please choose a different username.';
        } else {
            $_SESSION['alert_class'] = 'alert-danger';
            $_SESSION['alert_message'] = 'An error occurred: ' . $e->getMessage();
        }
    }

    header('Location: AMvendor.php');
    exit();
}
?>
