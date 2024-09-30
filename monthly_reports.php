<?php 
// Include database configuration
include('database_config.php');

// Create a connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$year = date('Y');
$month = date('m');
$date = date('Y-m-d');
$reportMonthly = $_POST['MONTHLYREPORTS'];

$sql = "INSERT INTO monthly_reports (year, month, reportsMonth, date)
VALUES ()
"

?>