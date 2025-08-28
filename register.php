<?php
// Always at the top
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer files
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

// Database connection
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "expo";

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

// Get form values
$studentName = $_POST['studentName'] ?? '';
$studentAge = $_POST['studentAge'] ?? '';
$studentParticipation = $_POST['studentParticipation'] ?? '';
$parentName = $_POST['parentName'] ?? '';
$hasSibling = isset($_POST['hasSibling']) ? 1 : 0;
$siblingName = $_POST['siblingName'] ?? '';
$siblingAge = $_POST['siblingAge'] ?? '';
$siblingParticipation = $_POST['siblingParticipation'] ?? '';
$parentPhone = $_POST['parentPhone'] ?? '';
$parentEmail = $_POST['parentEmail'] ?? '';

// Prepare SQL
$stmt = $conn->prepare("INSERT INTO registrations 
    (studentName, studentAge, studentParticipation, parentName, hasSibling, siblingName, siblingAge, siblingParticipation, parentPhone, parentEmail)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param(
    "sissisisss",
    $studentName,
    $studentAge,
    $studentParticipation,
    $parentName,
    $hasSibling,
    $siblingName,
    $siblingAge,
    $siblingParticipation,
    $parentPhone,
    $parentEmail
);

if ($stmt->execute()) {
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'tnhappykids1@gmail.com';
        $mail->Password   = 'qoru vmop lczl ezsj'; // Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('tnhappykids1@gmail.com', 'Competition Team');
        $mail->addAddress($parentEmail, $parentName);

        $mail->isHTML(true);
$mail->Subject = 'Registration Successful - Drawing & Colouring Competition';
$mail->Body = '
<!DOCTYPE html>
<html>
<head>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f6f8fb;
        margin: 0;
        padding: 0;
    }
    .email-container {
        max-width: 600px;
        margin: auto;
        background-color: #ffffff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .header {
        background: linear-gradient(45deg, #ff6f61, #ffcc70);
        color: #fff;
        padding: 20px;
        text-align: center;
    }
    .header h2 {
        margin: 0;
        font-size: 24px;
    }
    .content {
        padding: 20px;
        color: #333;
    }
    .content p {
        font-size: 16px;
        line-height: 1.6;
    }
    .event-details {
        margin-top: 20px;
        padding: 15px;
        background-color: #fef3c7;
        border-left: 5px solid #f59e0b;
        font-size: 15px;
    }
    .footer {
        background-color: #f3f4f6;
        text-align: center;
        padding: 15px;
        font-size: 14px;
        color: #777;
    }
</style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h2>🎨 Drawing & Colouring Competition</h2>
        </div>
        <div class="content">
            <h3>Hi ' . htmlspecialchars($parentName) . ',</h3>
            <p>Thank you for registering <strong>' . htmlspecialchars($studentName) . '</strong> for the competition.</p>
            <p><strong>Category:</strong> ' . htmlspecialchars($studentParticipation) . '</p>
            
            <div class="event-details">
                <strong>📅 Event Date:</strong> August 15, 16, 17, 2025 <br>
                <strong>📍 Venue:</strong> Lakshmi Mahal, Tirupur
            </div>

            <p>We are excited to see your child showcase their creativity! 🌟</p>
        </div>
        <div class="footer">
            Best regards,<br>
            Competition Team
        </div>
    </div>
</body>
</html>
';


        $mail->send();
        echo "<h2>✅ Registration Successful!</h2>";
        echo "<p>📧 Email sent to $parentEmail</p>";
    } catch (Exception $e) {
        echo "<h2>✅ Registration Successful!</h2>";
        echo "<p>⚠️ Email could not be sent. Mailer Error: {$mail->ErrorInfo}</p>";
    }
} else {
    echo "❌ Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
