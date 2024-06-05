<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



require 'vendor/autoload.php';

header('Content-Type: application/json');


// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'kartikdemo5@gmail.com'; // Your Gmail address
        $mail->Password   = 'rvde nvnk dmid hyuj'; // Your Gmail password or app-specific password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $fromEmail = $_POST['email'];

        //Recipients
        $mail->setFrom($fromEmail, $name); // Sender's email and name
        $mail->addAddress('info@brightlinkinfotechnologies.com', 'brightlink'); // Recipient's email and name

        $message = "Hello BrightLink Info Technologies Private Limited,\n\n";
$message .= "I hope this email finds you well. I wanted to inform you that an inquiry has been submitted through the website regarding $subject.\n\n";
$message .= "Below are the details provided :\n\n";

// Add user responses with bold titles and some spacing
$message .= "<strong>Name:</strong> " . $_POST['name'] . "\n\n";
$message .= "<strong>Email:</strong> " . $_POST['email'] . "\n\n";
$message .= "<strong>Message From the User:</strong> " . $_POST['message'] . "\n\n";
$message .= "<strong>Contact Person:</strong> " . $_POST['number'] . "\n\n";
$message .= "Please review the inquiry and respond accordingly. If you have any questions or require further information, feel free to reach out.\n\n";
$message .= "Thank you for your attention to this matter.\n\n";
$message .= "Best regards,\n";
$message .= $_POST['name'];
        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject; 
        $mail->Body    = nl2br($message); 
        

        // Send email
        $mail->send();
      
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        echo json_encode(['error' => 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo]);
    }
} else {
    // If the request method is not POST, return an error
    echo json_encode(['error' => 'Invalid request method']);
}
?>
