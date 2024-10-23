<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

// Include database connection

// Get the JSON input
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id']) && isset($data['email']) && isset($data['message'])) {
    $inquiryId = $data['id']; // Get the inquiry ID
    $emailAddress = $data['email'];
    $replyMessage = $data['message'];

    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; 
        $mail->SMTPAuth = true;
        $mail->Username = 'polomolokpublicmarket@gmail.com'; 
        $mail->Password = 'tsgxftoeulzixxyv'; 
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('polomolokpublicmarket@gmail.com', 'Polomolok South Cotabato');
        $mail->addAddress($emailAddress); 

        $mail->isHTML(true);
        $mail->Subject = 'Replied to Your Question In Polomolok Public Market';
        $mail->Body    = nl2br(htmlspecialchars($replyMessage)); // Use nl2br to handle line breaks

        // Send the email
        $mail->send();
        
        include('database_config.php');

        // Create a new MySQLi connection
        $conn = new mysqli($db_host, $db_user, $db_password, $db_name);
        
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        // Update the inquiry status to "Replied"
        $stmt = $conn->prepare("UPDATE inquiry SET status = 'Replied', archived = 1 WHERE inq_id = ?");
        $stmt->bind_param("i", $inquiryId);
        $updateSuccess = $stmt->execute();

        if ($updateSuccess) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Email sent, but failed to update inquiry status.']);
        }

    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $mail->ErrorInfo]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
}

// Close the database connection
$conn->close();
?>
