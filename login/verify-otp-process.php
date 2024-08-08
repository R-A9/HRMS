<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['otp'])) {
        $enteredOtp = $_POST['otp'];
        
        if (isset($_SESSION['otp']) && $_SESSION['otp'] == $enteredOtp) {
            // OTP is correct
            unset($_SESSION['otp']); // Optionally clear the OTP session
            header('Location: ../hrms-inner/index.php'); // Redirect to the desired page after successful verification
            exit();
        } else {
            // OTP is incorrect
            header('Location: verify-otp.php?error=Invalid OTP. Please try again.');
            exit();
        }
    } else {
        header('Location: verify-otp.php?error=Please enter the OTP.');
        exit();
    }
} else {
    header('Location: verify-otp.php');
    exit();
}
?> 