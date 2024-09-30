<?php
// Include database configuration
include('database_config.php');

// Create a connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error;
    exit();
}

// Get userId from URL parameters
$userId = isset($_GET['userId']) ? (int)$_GET['userId'] : 0;

// Debug: Print the userId to ensure it's being retrieved correctly
error_log("Retrieved userId: $userId"); // Use error_log to output to PHP error log

if ($userId > 0) {
    // Prepare the SQL statement to retrieve the image
    $sql = "SELECT picture FROM users WHERE id = ?";

    // Initialize prepared statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters
        $stmt->bind_param("i", $userId);

        // Execute the query
        $stmt->execute();
        $stmt->bind_result($imageData);
        $stmt->fetch();

        // Check if image data was retrieved
        if ($imageData) {
            // Set the content type header based on the image format
            header("Content-Type: image/jpeg"); // Change as needed (image/png, image/gif, etc.)
            echo $imageData;
        } else {
            echo "No image found for this user.";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
} else {
    echo "Invalid user ID.";
}

// Close the connection
$conn->close();
?>
