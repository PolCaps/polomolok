<?php
session_start(); // Start the session to access session variables

// Include database configuration
include('database_config.php');

// Create a connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error;
    exit();
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get the user ID from the POST request
$user_id = isset($_POST['id']) ? $_POST['id'] : null;

// Display the user ID in a plain response before proceeding
echo "User ID is set: $user_id";

// Check if the form was submitted and the file was uploaded without errors
if (isset($_FILES["profile-picture"]) && $_FILES["profile-picture"]["error"] === UPLOAD_ERR_OK) {
    // Define target directory and file path
    $targetDir = "documentProfile/"; // Change this to your desired directory
    $fileName = basename($_FILES["profile-picture"]["name"]);
    $targetFile = $targetDir . $fileName;

    // Create the target directory if it doesn't exist
    if (!is_dir($targetDir)) {
        if (!mkdir($targetDir, 0755, true)) {
            echo "Error: Failed to create directory.";
            exit();
        }
    }

    // Check if the file was uploaded
    if (is_uploaded_file($_FILES["profile-picture"]["tmp_name"])) {
        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["profile-picture"]["tmp_name"], $targetFile)) {
            // Update the SQL query to use user_id
            $sql = "UPDATE users SET picture_profile = ? WHERE id = ?";

            // Initialize prepared statement
            if ($stmt = $conn->prepare($sql)) {
                // Bind parameters: 'si' -> string (file path), integer (user ID)
                $stmt->bind_param("si", $targetFile, $user_id);

                // Execute the query
                if ($stmt->execute()) {
                    echo "Record inserted/updated successfully. File path: $targetFile";
                } else {
                    echo "Error inserting/updating record: " . $stmt->error;
                }

                // Close the statement
                $stmt->close();
            } else {
                echo "Error preparing statement: " . $conn->error;
            }
        } else {
            echo "Error: Failed to move uploaded file.";
        }
    } else {
        echo "Error: No file was uploaded.";
    }
} else {
    echo "Error: No file was uploaded or there was an upload error.";
}

// Close the connection
$conn->close();
?>
