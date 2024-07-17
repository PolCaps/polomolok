
<?php

header('Content-Type: application/json');
include('database_config.php');

// Create a connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => "Connection failed: " . $conn->connect_error]));
}


// Set parameters and execute
$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];
$last_name = $_POST['last_name'];
$contact_number = $_POST['contact_number'];
$age = $_POST['age'];
$email = $_POST['email'];
$address = $_POST['address'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO rent_application (first_name, middle_name, last_name, contact_no, age, email, address) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssiss", $first_name, $middle_name, $last_name, $contact_number, $age, $email, $address);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => "New record created successfully"]);
} else {
    echo json_encode(['success' => false, 'message' => "Error: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>