<?php

include('database_config.php');

// Create a connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    // Use JavaScript alert and redirect
    echo "<script>
        alert('Connection failed: " . $conn->connect_error . "');
        window.location.href = 'VMRelocation.php';
    </script>";
    exit();
}

// Get data from POST request
$vendor_id = $_POST['vendor_id'];
$reason = $_POST['message'];
$current_stall = $_POST['currentStall'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO relocation_req (vendor_id, reason, current_stall) VALUES (?, ?, ?)");

if ($stmt) {
    $stmt->bind_param("iss", $vendor_id, $reason, $current_stall);

    // Execute the statement
    if ($stmt->execute()) {
        // Use JavaScript alert and redirect
        echo "<script>
            alert('New record created successfully');
            window.location.href = 'VMRelocation.php';
        </script>";
    } else {
        // Use JavaScript alert and redirect for error
        echo "<script>
            alert('Error: " . $stmt->error . "');
            window.location.href = 'VMRelocation.php';
        </script>";
    }

    // Close the statement
    $stmt->close();
} else {
    // Use JavaScript alert and redirect for statement preparation error
    echo "<script>
        alert('Error preparing statement: " . $conn->error . "');
        window.location.href = 'VMRelocation.php';
    </script>";
}

// Close the connection
$conn->close();
?>
