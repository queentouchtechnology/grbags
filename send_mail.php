// send_mail.php

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

function sendMail() {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'queentouchtech.com';                     // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'info@queentouchtech.com';           // SMTP username
        $mail->Password = '8Nk2*h1m1';              // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;      // Enable TLS encryption, `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port = 465;                                    // TCP port to connect to, use 587 for TLS

        // Recipients
        $mail->setFrom('info@queentouchtech.com', 'Mailer');
        $mail->addAddress('sathish@queentouchtech.in', 'Recipient Name');     // Add a recipient
        $mail->addReplyTo('info@queentouchtech.com', 'Information');

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Here is the subject';
        $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
