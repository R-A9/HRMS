<?php
session_start();
include "../functions/db-conn.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['otp'])) {

    $entered_otp = $_POST['otp'];
    $email = $_SESSION['email'];

    // Fetch role from the database
    $sql = "SELECT role, name, id FROM `credentials` WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['role'] = $row['role'];

        // Check if the entered OTP matches the one stored in session
        if ($entered_otp == $_SESSION['otp']) {
            // OTP is correct, mark user as verified and redirect to the appropriate page
            $_SESSION['otp_verified'] = true;
            $_SESSION['name'] = $row['name'];
            $_SESSION['uid'] = $row['id'];

            // Redirect based on role
            if ($_SESSION['role'] == 'HR') {
                $link = '../hrms-inner/index.php';
            } elseif ($_SESSION['role'] == 'Employee') {
                $link = '../emp-ms/index.php';
            } else {
                $link = '404.php';
            }

            // Perform redirection
            header("Location: $link");
            exit(); // Ensure no further code is executed
        } else {
            $error = "Invalid OTP. Please try again.";
        }
    } else {
        $error = "User not found. Please check your email.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>OTP Verification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh">
    <form class="p-3 rounded" method="post" action="verify-otp.php" style="width: 500px;">
        <h1 class="text-center pb-5 pt-3">Enter OTP</h1>
        <?php if (isset($error)) { ?>
            <div class="alert alert-danger" role="alert">
                <?= $error ?>
            </div>
        <?php } ?>
        <div class="mb-3">
            <label for="otp" class="form-label">One-Time Password</label>
            <input type="text" class="form-control" name="otp" id="otp" placeholder="Enter OTP" required>
        </div>
        <center><button type="submit" class="btn btn-primary">Continue</button></center>
        <center><p class="pt-4">Going back to the main page? Click <a href="../hrms-inner/main-page.html">here</a></p></center>
    </form>
</div>
</body>
</html>
