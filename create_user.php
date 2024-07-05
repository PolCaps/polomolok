<?php
include ('database_config.php');



header('Content-Type: application/json');

// Connect to the database
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    try {
        // Start transaction
        $conn->begin_transaction();

        // This will help to ensure that all fields are received correctly.
        // echo json_encode(['postData' => $_POST]);

        $user_type = $_POST['user_type'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $last_name = $_POST['last_name'];
        $age = $_POST['age'];
        $contactNumber = $_POST['contact_number']; 
        $address = $_POST['address'];
        $stallNumber = $_POST['stall_number'];
        $stallCode = $_POST['stall_code'];
        $buildingCode = $_POST['building_code'];
        $buildingFloor = $_POST['building_floor'];
        $monthlyPayment = $_POST['monthly_payments'];
        $startDate = $_POST['started_date'];
        $endDate = $_POST['end_date'];


        $leaseAgreements = $_FILES['lease_agreements'];
        $businessPermits = $_FILES['business_permits'];
        $businessLicenses = $_FILES['business_licenses'];
        $receipts = $_FILES['receipts'];

        $full_name = trim($first_name . " " . $middle_name . " " . $last_name);

        // File upload validation
        $fileErrors = [];
        $allowedTypes = [
            'image/jpeg',
            'image/png',
            'image/gif', // Add more image types
            '*/*',
            'application/pdf',
            'application/msword', // Add document types
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document', // docx
          ];

        function validate_and_handle_file($fileKey, $allowedTypes, &$fileErrors) {
            if (!isset($_FILES[$fileKey]) || $_FILES[$fileKey]['error'] !== UPLOAD_ERR_OK) {
                $fileErrors[] = "Error uploading $fileKey file.";
                return null;
            } elseif (!in_array($_FILES[$fileKey]['type'], $allowedTypes)) {
                $fileErrors[] = "Invalid file type for $fileKey.";
                return null;
            }

            // $fileContent = file_get_contents($_FILES[$fileKey]['tmp_name']); // Read file content as binary
            // return $fileContent;

            $username = $_POST['username'];
            $today = date('Y-m-d');
            
            // Generate unique filename to avoid overwriting existing files
            $targetDir = "datas/". $username. "/" . $today. "/";
            // Create directories if they don't exist (using mkdir with recursion)
            if (!is_dir($targetDir)) {
                if (!mkdir($targetDir, 0755, true)) {
                $fileErrors[] = "Error creating directory: $targetDir";
                return null;
                }
            }
            $targetFile = $targetDir . basename($_FILES[$fileKey]["name"]);
            
            if (move_uploaded_file($_FILES[$fileKey]["tmp_name"], $targetFile)) {
                return $targetFile; // Return path to the uploaded file
            } else {
                $fileErrors[] = "Error moving $fileKey file to destination.";
                return null;
            }
        }

        // Validate and handle each file upload
        $receiptsDest = validate_and_handle_file('receipts', $allowedTypes, $fileErrors);
        $leaseAgreementsDest = validate_and_handle_file('lease_agreements', $allowedTypes, $fileErrors);
        $businessPermitsDest = validate_and_handle_file('business_permits', $allowedTypes, $fileErrors);
        $businessLicensesDest = validate_and_handle_file('business_licenses', $allowedTypes, $fileErrors);

        // Handle file upload errors
        if (!empty($fileErrors)) {
            throw new Exception(implode("\n", $fileErrors));
        }

        // Insert into stalls
        $sql1 = "INSERT INTO stalls (stall_number, stall_code) VALUES (?, ?)";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param('is', $stallNumber, $stallCode);

        // Check if stall insertion was successful
        if ($stmt1->execute()) {
        $insertedStallId = $stmt1->insert_id;  // Get the inserted stall ID
        } else {
            throw new Exception("Error inserting stalls data.");
        }

        // Insert into buildings (assuming stall_number is a foreign key)
        if (isset($insertedStallId)) { // Only insert if stall was inserted successfully
        $sql2 = "INSERT INTO buildings (building_code, building_floor, stall_number) VALUES (?, ?, ?)";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param('sss', $buildingCode, $buildingFloor, $insertedStallId);
        $stmt2->execute();
        } else {
            throw new Exception("Error inserting building data.");
        }


        // Prepare and execute user insert based on user_type
        $sqlA = "INSERT INTO users (username, password, user_type) VALUES (?, ?, ?)";
        $stmtA = $conn->prepare($sqlA);
        $stmtA->bind_param('sss', $username, $password, $user_type);
        $stmtA->execute();

        if ($stmtA->affected_rows !== 1) {
            throw new Exception("Error inserting account data.");
        }

        // Prepare and execute personal_profile insert
        $insertedUserId = mysqli_insert_id($conn);
        // Retrieve the inserted user ID for foreign key reference (if needed)
        $insertedUserId = mysqli_insert_id($conn);
        switch ($user_type) {
            case "VENDOR":
                $sql2 = "INSERT INTO vendor (vendor_name, user_id) VALUES (?, ?)";
                $stmt2 = $conn->prepare($sql2);
                $stmt2->bind_param('si', $full_name, $insertedUserId);  // Use the inserted user ID
                $stmt2->execute();
                break;
            case "ADMIN":
                $sql2 = "INSERT INTO admin (admin_name, user_id) VALUES (?, ?)";
                $stmt2 = $conn->prepare($sql2);
                $stmt2->bind_param('si', $full_name, $insertedUserId);  // Use the inserted user ID
                $stmt2->execute();
                break;
            case "STAFF":
                $sql2 = "INSERT INTO staff (staff_name, user_id) VALUES (?, ?)";
                $stmt2 = $conn->prepare($sql2);
                $stmt2->bind_param('si', $full_name, $insertedUserId);  // Use the inserted user ID
                $stmt2->execute();
                break;
            default:
                echo "Invalid user type";
                break;
}

        $sqlB = "INSERT INTO personal_profile (user_id, first_name, middle_name, last_name, age, contact_number, address) VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmtB = $conn->prepare($sqlB);
        $stmtB->bind_param('issssss', $insertedUserId, $first_name, $middle_name, $last_name, $age, $contactNumber, $address);
        $stmtB->execute();

        if ($stmtB->affected_rows !== 1) {
            throw new Exception("Error inserting personal profile.");
        }

        // Prepare and execute payments insert
        $sqlC = "INSERT INTO payments (monthly_payments, receipts, started_date, end_date) VALUES (?, ?, ?, ?)";
        $stmtC = $conn->prepare($sqlC);
        $stmtC->bind_param('sbss', $monthlyPayment, $receiptsDest, $startDate, $endDate);
        
        $stmtC->send_long_data(2, $receiptsDest); // Send the binary data for receipts
        $stmtC->execute();

        if ($stmtC->affected_rows !== 1) {
            throw new Exception("Error inserting payment.");
        }
        // Prepare and execute documents insert
        $sqlD = "INSERT INTO documents (receipts, lease_agreements, business_permits, business_licenses) VALUES (?, ?, ?, ?)";
        $stmtD = $conn->prepare($sqlD);
        $stmtD->bind_param('bbbb', $receiptsDest, $leaseAgreementstDest, $businessPermitsDest, $businessLicensesDest);
         // Assuming successful preparation...
         $stmtD->send_long_data(0, $receiptsDest);
         $stmtD->send_long_data(1, $leaseAgreementsDest);
         $stmtD->send_long_data(2, $businessPermitsDest);
         $stmtD->send_long_data(3, $businessLicensesDest);

        $stmtD->execute();        
        $insertedDocumentId = mysqli_insert_id($conn);

        if ($stmtD->affected_rows !== 1) {
            throw new Exception("Error inserting documents.");
        }

        if (isset($_POST['payment_id'])) { // Check if payment ID is provided
            $sqlE = "INSERT INTO payments (payment_id, document_id) VALUES (?, ?)";
            $stmtE = $conn->prepare($sqlE);
            $stmtE->bind_param('ii', $_POST['payment_id'], $insertedDocumentId);
            $stmtE->execute();
          }

        // Commit transaction if all inserts succeed
        $conn->commit();
        echo json_encode(['success' => true, 'message' => 'New user created successfully!']);

    } catch (Exception $e) {
        // Rollback transaction on any error
        $conn->rollback();
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }

    // Close statements and connection
    if (isset($stmt1)) $stmt1->close();
    if (isset($stmt2)) $stmt2->close();
    if (isset($stmtA)) $stmtA->close();
    if (isset($stmtB)) $stmtB->close();
    if (isset($stmtC)) $stmtC->close();
    if (isset($stmtD)) $stmtD->close();
    if (isset($stmtE)) $stmtE->close();
    $conn->close();
} else {
    // echo json_encode(['success' => false, 'error' => 'Invalid request method or missing submit parameter.']);
    echo json_encode(['success' => false, 'error' => 'Invalid request method or missing submit parameter.']);
    // echo json_encode(['postData' => $_POST]);
}
?>
