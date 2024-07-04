<?php
// Configuration
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'polomolokpublicmarket';

// Create connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

// Get form data
$usertype = $_POST['usertype'];
$username = $_POST['username'];
$password = $_POST['password'];
$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];
$last_name = $_POST['last_name'];
$age = $_POST['age'];
$contact_number = $_POST['contact_number'];
$address = $_POST['address'];
$store_number = $_POST['store_number'];
$lease_agreements = $_FILES['lease_agreements'];
$business_permits = $_FILES['business_permits'];
$supporting_docu = $_FILES['supporting_docu'];
$monthly_payment = $_POST['monthly_payment'];
$building_type = $_POST['building_type'];
$started_date = $_POST['started_date'];
$end_date = $_POST['end_date'];

if (isset($_POST['lease_agreements'])) {
    $lease_agreements = $_POST['lease_agreements'];
} else {
    $lease_agreements = null; // or handle it as needed
}

// Check if the 'business_permits' key exists in the $_POST array before accessing it
if (isset($_POST['business_permits'])) {
    $business_permits = $_POST['business_permits'];
} else {
    $business_permits = null; // or handle it as needed
}

// Check if the 'supporting_docu' key exists in the $_POST array before accessing it
if (isset($_POST['supporting_docu'])) {
    $supporting_docu = $_POST['supporting_docu'];
} else {
    $supporting_docu = null; // or handle it as needed
}
// Insert data into database
$sql = "INSERT INTO users_account (user_type, username, password, first_name, middle_name, last_name, age, contact_number, address, store_number, lease_agreements, business_permits, supporting_docu, monthly_payment, building_type, started_date, end_date)
VALUES ('$usertype', '$username', '$password', '$first_name', '$middle_name', '$last_name', '$age', '$contact_number', '$address', '$store_number', '$lease_agreements', '$business_permits', '$supporting_docu', '$monthly_payment', '$building_type', '$started_date', '$end_date')";


if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>