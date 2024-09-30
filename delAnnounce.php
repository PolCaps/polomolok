<?php
include 'database_config.php';

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);

    $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

    // Delete announcement from database
    $stmt = $conn->prepare("DELETE FROM announcements WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'error';
    }

    $stmt->close();
    $conn->close();
}
?>
