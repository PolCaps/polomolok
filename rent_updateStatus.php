<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $applicant_id = $_POST['applicant_id'];
    $status = $_POST['status'];

    include('database_config.php');

                  // Create a connection
                  $conn = new mysqli($db_host, $db_user, $db_password, $db_name);


    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind
    $stmt = $conn->prepare("UPDATE rent_application SET Approval = ? WHERE applicant_id = ?");
    $stmt->bind_param("si", $status, $applicant_id);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: AMVendorApproval.php");
    } else {
        header("Location: AMVendorApproval.php");
    }

    // Close connection
    $stmt->close();
    $conn->close();
}
?>