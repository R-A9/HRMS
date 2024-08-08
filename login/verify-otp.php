<?php
session_start();
if (!isset($_SESSION['otp'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Verify OTP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh">
        <form class="p-3 rounded" action="verify-otp-process.php" method="post" style="width: 500px;">
            <h1 class="text-center pb-5 pt-3">OTP Verification</h1>
            <?php if (isset($_GET['notice'])) { ?>
                <div class="alert alert-info" role="alert"><?=$_GET['notice']?></div>
            <?php } ?>
            <?php if (isset($_GET['error'])) { ?>
                <div class="alert alert-danger" role="alert"><?=$_GET['error']?></div>
            <?php } ?>
            <div class="mb-3">
                <label for="otp" class="form-label">Enter OTP</label>
                <input type="text" class="form-control" name="otp" id="otp" required>
            </div>
            <center><button type="submit" class="btn btn-primary">Verify OTP</button></center>
        </form>
    </div>
</body>
</html>