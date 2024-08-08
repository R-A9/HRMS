<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Adjust path to vendor/autoload.php as needed
require '../vendor/autoload.php';

function generateOTP($length = 6) {
    $characters = '0123456789';
    $otp = '';
    for ($i = 0; $i < $length; $i++) {
        $otp .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $otp;
}

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $otp = generateOTP();
    
    $_SESSION['otp'] = $otp;
    $_SESSION['otp_email'] = $email;
    
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Set the SMTP server to send through
        $mail->SMTPAuth   = true;
        $mail->Username   = ''; // SMTP username
        $mail->Password   = ''; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        
        //Recipients
        $mail->setFrom('no-reply@yourdomain.com', 'BURATSEC');
        $mail->addAddress($email);
        
        // Content
        $mail->isHTML(false);
        $mail->Subject = 'Your OTP Code';
        $mail->Body    = "Your OTP code is: $otp";
        
        $mail->send();
        header('Location: verify-otp.php?notice=An OTP has been sent to your email.');
    } catch (Exception $e) {
        header('Location: login.php?error=Failed to send OTP. Please try again.');
    }
    exit();
}
?>