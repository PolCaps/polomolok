<?php
include ('database_config.php');


error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json'); // Add closing quote

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
         echo json_encode(['postData' => $_POST]);

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
        $buildingtype = $_POST['building_type'];
        $buildingFloor = $_POST['building_floor'];
        $Rentals = $_POST['monthly_rentals'];
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


        // Prepare and execute user insert based on user_type
        $sqlA = "INSERT INTO users (username, password, user_type) VALUES (?, ?, ?)";
        $stmtA = $conn->prepare($sqlA);
        if (!$stmtA) {
            throw new Exception("Prepare statement failed for users: " . $conn->error);
        }
        $stmtA->bind_param('sss', $username, $password, $user_type);
        $stmtA->execute();
        if ($stmtA->affected_rows !== 1) {
            throw new Exception("Error inserting account data.");
        }
        $insertedUserId = $conn->insert_id;
       

        // Prepare and execute personal_profile insert

        // Retrieve the inserted user ID for foreign key reference (if needed)
        switch ($user_type) {
            case "VENDOR":
              $sqlB = "INSERT INTO vendors (vendor_name) VALUES (?)";
              break;
            case "ADMIN":
              $sqlB = "INSERT INTO admin (admin_name) VALUES (?)";
              break;
            case "STAFF":
              $sqlB = "INSERT INTO staff (staff_name) VALUES (?)";
              break;
            default:
              throw new Exception("Invalid user type");
          }
          
          $stmtB = $conn->prepare($sqlB);
          if (!$stmtB) {
            throw new Exception("Prepare statement failed: " . $conn->error);
          }
          
          $stmtB->bind_param('s', $full_name);
          $stmtB->execute();
          
          if ($stmtB->affected_rows !== 1) {
            throw new Exception("Error inserting " . strtolower($user_type) . " data.");
          }
          
// Retrieve the inserted user ID for foreign key reference (if needed)
        

        $sqlC = "INSERT INTO personal_profile (personal_id, first_name, middle_name, last_name, age, contact_number, address) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmtC = $conn->prepare($sqlC);
        $stmtC->bind_param('issssss', $insertedUserId, $first_name, $middle_name, $last_name, $age, $contactNumber, $address);
        $stmtC->execute();

        if ($stmtC->affected_rows !== 1) {
            throw new Exception("Error inserting personal profile.");
        }

       
        // Insert into buildings (assuming stall_number is a foreign key)
       
        $sql1 = "INSERT INTO buildings (building_floor, building_type, user_id, vendor_id) VALUES (?, ?, ?, ?)";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param('ssii', $buildingtype, $buildingFloor, $insertedUserId, $insertedIdvendor);
        $stmt1->execute();

        // Check if stall insertion was successful
        if ($stmt1->execute()) {
            $insertedbuildingtype = mysqli_insert_id($conn);  // Get the inserted stall ID
            } else {
                throw new Exception("Error inserting stalls data.");
            }

       
         $sql2 = "INSERT INTO stalls (stall_code, monthly_rentals, stall_number, user_id, building_id) VALUES (?, ?, ?, ?, ?)";
         $stmt2 = $conn->prepare($sql2);
         $stmt2->bind_param('sssii', $stallCode, $Rentals, $stallNumber, $insertedUserId, $insertedbuildingtype);
            $stmt2->execute();
         

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
           $insertedDocumentId = $stmtD->insert_id;
   
           if ($stmtD->affected_rows !== 1) {
               throw new Exception("Error inserting documents.");
           }
   
  

        // Prepare and execute payments insert
        $sqlE = "INSERT INTO monthly_payments (started_date, end_date) VALUES ( ?, ?)";
        $stmtE = $conn->prepare($sqlE);
        $stmtE->bind_param('ss',  $startDate, $endDate);
        
       // $stmtE->send_long_data(1, $receiptsDest); // Send the binary data for receipts
        $stmtE->execute();

        if ($stmtE->affected_rows !== 1) {
            throw new Exception("Error inserting payment.");
        }

        // Close prepared statements
        if (isset($stmtA)) $stmtA->close();
        if (isset($stmtB)) $stmtB->close();
        if (isset($stmtC)) $stmtC->close();
        if (isset($stmt1)) $stmt1->close();
        if (isset($stmt2)) $stmt2->close();
        if (isset($stmtD)) $stmtD->close();
     

        // Commit transaction if all inserts succeed
        $conn->commit();
        echo json_encode(['success' => true, 'message' => 'New user created successfully!']);

    } catch (Exception $e) {
        // Rollback transaction on any error
        $conn->rollback();
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    } finally {
        
        // Close connection
        $conn->close();
    }
   
}
?>
