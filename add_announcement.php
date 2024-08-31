<!-- save_announcement.php -->
<?php
include 'database_config.php';

// Create a new MySQLi connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0; // Get the ID from the form, if any
    $title = $_POST['title'];
    $description = $_POST['description'];
    $building = $_POST['building'];
    $stall = $_POST['stall'];

    // Handle image upload
    $image = $_FILES['image'];
    $target_dir = "announcements/";
    $target_file = $target_dir . basename($image["name"]);

    // Move the uploaded file to the target directory
    if (move_uploaded_file($image["tmp_name"], $target_file)) {
        $image_path = $target_file;
    } else {
        $image_path = ""; // Handle this case if image upload fails
    }

    // Insert or update announcement based on the existence of an ID
    if ($id > 0) {
        // Update existing announcement
        $query = "UPDATE announcements SET title=?, description=?, image_path=?, building=?, stall=? WHERE id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssssi", $title, $description, $image_path, $building, $stall, $id);
    } else {
        // Insert a new announcement
        $query = "INSERT INTO announcements (title, description, image_path, building, stall) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssss", $title, $description, $image_path, $building, $stall);
    }

    // Check if prepare() was successful
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Execute the prepared statement
    $stmt->execute();

    // Close the statement and connection
    $stmt->close();
    $conn->close();

    // Redirect back to the editor or homepage
    header("Location: HomepageEditor.php");
    exit();
}
?>
