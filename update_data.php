<?php

include('database_config.php');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the form data
$buildings = $_POST['buildings'];
$stalls = $_POST['stalls'];
$vendors = $_POST['vendors'];
$workers = $_POST['workers'];

// Update the data in the database
$sql = "UPDATE stats SET buildings = '$buildings', overall_stalls = '$stalls', vendors = '$vendors', workers = '$workers' WHERE statsID = 1";
if ($conn->query($sql) === TRUE) {
    $_SESSION['message'] = 'Record updated successfully!';
    $_SESSION['message_type'] = 'success';
} else {
    $_SESSION['message'] = 'Error updating record: ' . $conn->error;
    $_SESSION['message_type'] = 'danger';
}

header('Location: HomepageEditor.php');
exit;
?>