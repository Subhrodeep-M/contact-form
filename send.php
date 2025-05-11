<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer classes
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST["message"]));

    if (!empty($name) && !empty($email) && !empty($message) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mail = new PHPMailer(true);

        try {
            // SMTP settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'sdmallick98@gmail.com';         // Your Gmail
            $mail->Password   = 'icsj aipo jtpm fzdo';            // App password (not your Gmail password)
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            // Email content
            $mail->setFrom($email, $name);
            $mail->addAddress('sdmallick98@gmail.com');          // Where you want to receive it

            $mail->Subject = 'New Contact Form Submission';
            $mail->Body    = "Name: $name\nEmail: $email\nMessage:\n$message";

            $mail->send();
            echo "Message sent successfully!";
        } catch (Exception $e) {
            echo "Message could not be sent. Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Please fill all fields correctly.";
    }
} else {
    echo "Invalid request method.";
}
