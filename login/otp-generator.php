<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Check if email is posted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'])) {
    $email = $_POST['email'];

    // Generate a random OTP
    $otp = rand(000000, 999999);

    // Store OTP in session
    $_SESSION['otp'] = $otp;
    $_SESSION['email'] = $email;

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                      // Disable verbose debug output
        $mail->isSMTP();                           // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';      // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                  // Enable SMTP authentication
        $mail->Username   = 'ic.wilkins.custodio@cvsu.edu.ph';  // Your email address
        $mail->Password   = 'bvmi hjni mwbk tbkf';   // Your app-specific password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
        $mail->Port       = 587;                   // TCP port to connect to

        // Recipients
        $mail->setFrom('your-email@gmail.com', 'Atlas IT Solutions'); // Your email address
        $mail->addAddress($email); // Add recipient email address

        // Content
        $mail->isHTML(true);                      // Set email format to HTML
        $mail->Subject = 'Your OTP Code';
        $mail->Body    = "Your OTP code is <b>$otp</b>. Please do not share it with anyone.";
        $mail->AltBody = "Your OTP code is $otp. Please do not share it with anyone.";

        // Send the email
        $mail->send();

        // Redirect to OTP verification page
        header("Location: verify-otp.php");
        exit();
    } catch (Exception $e) {
        $otperror = "Failed to send OTP. Please try again. Mailer Error: {$mail->ErrorInfo}";
    }
}





?>

