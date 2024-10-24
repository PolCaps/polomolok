<?php
header('Content-Type: application/json');
include('database_config.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

// Create a new MySQL connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => "Connection failed: " . $conn->connect_error]));
}

// Fetch form data
$applicant_id = $_POST['applicant_id'] ?? null;
$applicant_name = $_POST['applicant_name'] ?? null;
$email = $_POST['email'] ?? null;
$payment_status = $_POST['payment_status'] ?? null;
$OR_no = $_POST['OR_no'] ?? null;
$payment_date = $_POST['payment_date'] ?? null;
$proof_of_payment = $_FILES['proof_of_payment'] ?? null;

// Validate required fields
if (!$applicant_id || !$payment_status) {
    die(json_encode(['success' => false, 'message' => "Applicant ID and Payment Status are required."]));
}

// Handle file upload if proof_of_payment is provided
$proof_of_payment_path = null;
if ($proof_of_payment) {
    $target_dir = "../payment_proofs/rent_application/";
    $file_name = basename($proof_of_payment['name']);
    $target_file = $target_dir . uniqid() . '_' . $file_name;
    
    // Move the uploaded file to the target directory
    if (move_uploaded_file($proof_of_payment['tmp_name'], $target_file)) {
        $proof_of_payment_path = $target_file; // Store the file path in the database
    } else {
        die(json_encode(['success' => false, 'message' => 'Failed to upload proof of payment.']));
    }
}

// Prepare the SQL query
$query = "UPDATE rentapp_payment 
          SET payment_status = ?, OR_no = ?, payment_date = ?, proof_of_payment = ?
          WHERE applicant_id = ?";

$stmt = $conn->prepare($query);

if ($stmt === false) {
    die(json_encode(['success' => false, 'message' => "Prepare failed: " . $conn->error]));
}

// Bind the parameters and execute
$stmt->bind_param("sssss", $payment_status, $OR_no, $payment_date, $proof_of_payment_path, $applicant_id);

if ($stmt->execute()) {
    // Prepare notification insertion for Admin
    $notification_type = 'Ready For Drawlots';
    $notification_message = "Rent Applicant: $applicant_name";
    $time_stamp = date('Y-m-d H:i:s'); // Current timestamp
    $is_read = 0; // Set to 0 for unread

    // Insert notification for Admin
    $stmt_admin = $conn->prepare("INSERT INTO notifications (user_type, notification_type, message, time_stamp, is_read) VALUES (?, ?, ?, ?, ?)");
    $user_type_admin = 'Admin';

    if ($stmt_admin) {
        $stmt_admin->bind_param("ssssi", $user_type_admin, $notification_type, $notification_message, $time_stamp, $is_read);
        $stmt_admin->execute();
        $stmt_admin->close();
    }

    // Send email notification using PHPMailer
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; 
        $mail->SMTPAuth = true;
        $mail->Username = 'polomolokpublicmarket@gmail.com'; 
        $mail->Password = 'tsgxftoeulzixxyv'; // Use environment variables for security
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        // Recipients
        $mail->setFrom('polomolokpublicmarket@gmail.com', 'Polomolok Public Market');
        $mail->addAddress($email); // Add recipient


        $payment_date = $_POST['payment_date'] ?? null;

        if ($payment_date) {
            $dateTime = new DateTime($payment_date, new DateTimeZone('Asia/Manila'));
            $formatted_date = $dateTime->format('F j, Y, g:i A');
        } else {
            $formatted_date = 'N/A';
        }
        
        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Congratulations!';
        $mail->Body    = "Dear $applicant_name,<br><br>Your Payment for your Rent Application has been Acknowledged.<br>OR Number: $OR_no<br>Payment Date: $formatted_date<br><br>You are now Ready for Drawlots. Please wait for further instructions.<br><br>Best Regards,<br>Polomolok Public Market";

        // Send the email
        $mail->send();
        echo json_encode(['success' => true, 'message' => 'Payment details updated successfully. A notification email has been sent.']);
    } catch (Exception $e) {
        echo json_encode(['success' => true, 'message' => 'Payment details updated successfully. However, failed to send email notification: ' . $mail->ErrorInfo]);
    }

} else {
    echo json_encode(['success' => false, 'message' => "Execute failed: " . $stmt->error]);
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
