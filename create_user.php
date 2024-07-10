<?php
include('database_config.php');


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
       // (eh open pag naa nasad error) echo json_encode(['postData' => $_POST]);

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
            'image/gif', 
            'application/pdf',
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
            $first_name = $_POST['first_name'];
            $middle_name = $_POST['middle_name'];
            $last_name = $_POST['last_name'];
            $full_name = trim($first_name . " " . $middle_name . " " . $last_name);

            $today = date('Y-m-d');
            
            // Generate unique filename to avoid overwriting existing files
            $targetDir = "datas/". $full_name. "/" . $today. "/";
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
        if (!$stmtA = $conn->prepare($sqlA)) {
            throw new Exception("Prepare statement failed for users: " . $conn->error);
        }
        $stmtA->bind_param('sss', $username, $password, $user_type);
        $stmtA->execute();
        if ($stmtA->affected_rows !== 1) {
            throw new Exception("Error inserting account data.");
        }

        if ($stmtA->execute()) {
            $insertedUserId = mysqli_insert_id($conn); // try ra kung effective
            } else {
                throw new Exception("Error inserting for users id.");
            }
  
        
        // Prepare and execute personal_profile insert

        $insertedIdvendor = null;
        // Retrieve the inserted user ID for foreign key reference (if needed)
        switch ($user_type) {
            case "VENDOR":
              $sqlB = "INSERT INTO vendors (vendor_name, user_id) VALUES (?,?)";
              $stmtB = $conn->prepare($sqlB);
              if (!$stmtB = $conn->prepare($sqlB)) {
                throw new Exception("Prepare statement failed for vendor: " . $conn->error);
            }
              $stmtB->bind_param('si', $full_name, $insertedUserId);
              $stmtB->execute();
              if ($stmtB->execute()) {
                $insertedIdvendor= $conn->insert_id; // try ra kung effective
                } else {
                    throw new Exception("Error inserting for users id.");
                }
              
              if ($stmtB->affected_rows !== 1) {
                throw new Exception("Error inserting " . strtolower($user_type) . " data."); //
              }
              break;
            case "ADMIN":
              $sqlB = "INSERT INTO admin (admin_name, user_id) VALUES (?,?)";
              $stmtB = $conn->prepare($sqlB);
              if (!$stmtB = $conn->prepare($sqlB)) {
                throw new Exception("Prepare statement failed for admin: " . $conn->error);
            }
              $stmtB->bind_param('si', $full_name, $insertedUserId);
              $stmtB->execute();
              if ($stmtB->affected_rows !== 1) {
                throw new Exception("Error inserting " . strtolower($user_type) . " data."); //
              }
              break;
            case "STAFF":
              $sqlB = "INSERT INTO staffs (staffs_name, user_id) VALUES (?,?)";
              $stmtB = $conn->prepare($sqlB);
              if (!$stmtB = $conn->prepare($sqlB)) {
                throw new Exception("Prepare statement failed for staff: " . $conn->error);
            }
              $stmtB->bind_param('si', $full_name, $insertedUserId);
              $stmtB->execute();
              if ($stmtB->affected_rows !== 1) {
                throw new Exception("Error inserting " . strtolower($user_type) . " data."); //
              }
              break;
            default:
              throw new Exception("Invalid user type");
          }
          
          if (!$stmtB) {
            throw new Exception("Prepare statement failed: " . $conn->error);
          }

        $sqlC = "INSERT INTO personal_profile (personal_id, first_name, middle_name, last_name, age, contact_number, address) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmtC = $conn->prepare($sqlC);
        $stmtC->bind_param('isssiis', $insertedUserId, $first_name, $middle_name, $last_name, $age, $contactNumber, $address);
        $stmtC->execute();

        if ($stmtC->affected_rows !== 1) {
            throw new Exception("Error inserting personal profile.");
        }
       
        $sql1 = "INSERT INTO buildings (building_floor, building_type, user_id, vendor_id) VALUES (?, ?, ?, ?)";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param('ssii', $buildingFloor, $buildingtype, $insertedUserId, $insertedIdvendor);
        $stmt1->execute();
        if ($stmt1->affected_rows !== 1) {
          throw new Exception("Error inserting buildings.");
      }

        // Check if stall insertion was successful
        if ($stmt1->execute()) {
            $insertedbuildingID = mysqli_insert_id($conn);  // try ra kung effective
            } else {
                throw new Exception("Error inserting stalls data.");
            }

     
       
         $sql2 = "INSERT INTO stalls (stall_code, monthly_rentals, stall_number, user_id, building_id) VALUES (?, ?, ?, ?, ?)";
         $stmt2 = $conn->prepare($sql2);
         if (!$stmt2 = $conn->prepare($sql2)) {
          throw new Exception("Prepare statement failed for stalls: " . $conn->error);
        }
         $stmt2->bind_param('sssii', $stallCode, $Rentals, $stallNumber, $insertedUserId, $insertedbuildingID);
         $stmt2->execute();
     //    if ($stmt2->affected_rows !== 1) {
        //    throw new Exception("Error inserting stalls. THE FUCK NGA ERROR HAHAAH");
       //   }
           
        
        
           // Prepare and execute documents insert
           $sqlD = "INSERT INTO documents (receipts, lease_agreements, business_permits, business_licenses, user_id) VALUES (?, ?, ?, ?, ?)";
           $stmtD = $conn->prepare($sqlD);
           $stmtD->bind_param('bbbbi', $receiptsDest, $leaseAgreementsDest, $businessPermitsDest, $businessLicensesDest, $insertedUserId);
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

      
         // $SOA = null;
        // Prepare and execute payments insert
        $sqlE = "INSERT INTO payments (receipts, started_date, end_date, document_id, user_id) VALUES ( ?, ?, ?, ?, ?)";
        $stmtE = $conn->prepare($sqlE);
        if (!$stmtE = $conn->prepare($sqlE)) {
            throw new Exception("Prepare statement failed for payments: " . $conn->error);
        }
        $stmtE->bind_param('bssii', $receiptsDest, $startDate, $endDate, $insertedDocumentId, $insertedUserId);
        $stmtE->send_long_data(0, $receiptsDest);
       // $stmtE->send_long_data(1, $receiptsDest); // Send the binary data for receipts
        $stmtE->execute();
        if ($stmtE->affected_rows !== 1) {
            throw new Exception("Error inserting payment.");
        }

        // Commit transaction if all inserts succeed
        $conn->commit();
        echo json_encode(['success' => true, 'message' => 'New user created successfully!']);
       
 
    } catch (Exception $e) {
        // Rollback transaction on any error
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        $conn->rollback();
    } finally {
        
        // Close connection

           // Close prepared statements
           if (isset($stmtA)) $stmtA->close();
           if (isset($stmtB)) $stmtB->close();
           if (isset($stmtC)) $stmtC->close();
           if (isset($stmt1)) $stmt1->close();
           if (isset($stmt2)) $stmt2->close();
           if (isset($stmtD)) $stmtD->close();
           if (isset($stmtE)) $stmtE->close();
        $conn->close();
    }
   
}
?>
