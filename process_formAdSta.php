<?php
session_start();
require_once 'database_config.php'; // Include your database connection file

header('Content-Type: application/json'); // Set content type to JSON

$response = ['success' => false, 'message' => ''];

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error mode to exception
} catch (PDOException $e) {
    $response['message'] = "Connection failed: " . $e->getMessage();
    echo json_encode($response);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_type = isset($_POST['account_type']) ? $_POST['account_type'] : '';
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
    $middle_name = isset($_POST['middle_name']) ? $_POST['middle_name'] : '';
    $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
    $age = isset($_POST['age']) ? $_POST['age'] : '';
    $contact_no = isset($_POST['contact_no']) ? $_POST['contact_no'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $email_add = isset($_POST['email_add']) ? $_POST['email_add'] : '';

    // Hash the password if required
    // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO users (user_type, username, password, first_name, middle_name, last_name, age, contact_no, address, email_add) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$user_type, $username, $password, $first_name, $middle_name, $last_name, $age, $contact_no, $address, $email_add]);

        $response['success'] = true;
        $response['message'] = 'User created successfully!';
    } catch (PDOException $e) {
        error_log($e->getMessage()); // Log the error message for debugging
        $response['message'] = 'An error occurred: ' . $e->getMessage(); // Generic error message
    }

    echo json_encode($response);
    header('Location: AMvendor.php');
    exit();
}
?>
