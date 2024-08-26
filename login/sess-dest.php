<?php
session_start();
unset($_SESSION['otp_verified']);
unset($_SESSION['otp']);
session_destroy();
header("Location: ../hrms-inner/main-page.html");

?>