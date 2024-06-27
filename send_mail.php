<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate form data
    $name = htmlspecialchars($_POST['w3lName']);
    $email = filter_var($_POST['w3lSender'], FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars($_POST['w3lSubject']);
    $website = htmlspecialchars($_POST['w3lWebsite']);
    $message = htmlspecialchars($_POST['w3lMessage']);

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'queentouchtech.com';                   // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'info@queentouchtech.com';           // SMTP username
        $mail->Password = '8Nk2*h1m1';                        // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;      // Enable TLS encryption, `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port = 465;                                    // TCP port to connect to, use 587 for TLS

        // Recipients
        $mail->setFrom('info@queentouchtech.com', 'Mailer');
        $mail->addAddress('sathish@queentouchtech.in', 'Recipient Name');  // Add a recipient
        $mail->addReplyTo($email, $name);                   // Set reply-to address

        // Content
        $mail->isHTML(true);                                 // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = '<b>Name:</b> ' . $name . '<br><b>Email:</b> ' . $email . '<br><b>Website:</b> ' . $website . '<br><br>' . $message;
        $mail->AltBody = 'Name: ' . $name . "\r\n" . 'Email: ' . $email . "\r\n" . 'Website: ' . $website . "\r\n\r\n" . $message;

        // Send email
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
