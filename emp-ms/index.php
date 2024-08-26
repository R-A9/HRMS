<?php
session_start();

// Redirect HR users to HRMS inner index page
if (isset($_SESSION['role']) && $_SESSION['role'] == "HR") {
    header('Location: ../hrms-inner/index.php');
    exit(); // Ensure no further code is executed after redirection
}

// Redirect users who are not authenticated to the login page
if (!isset($_SESSION['role'])) {
    header("Location: ../login/login.php");
    exit(); // Ensure no further code is executed after redirection
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>ATLAS</title>
  <!-- Favicon-->
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="../css/styles.css" rel="stylesheet" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Abel&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Abel&family=Passion+One:wght@400;700;900&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Abel&family=Passion+One:wght@400;700;900&family=Teko:wght@300..700&display=swap');
  </style>
</head>

<body>
<!-- Sidebar -->
<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 250px; height: 100vh; position: fixed;">
  <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
    <img src="../images/atlas2.png" alt="ATLAS" width="40" height="40" class="me-2">
    <span class="fs-4">ATLAS-HRMS</span>
  </a>
  <hr>
  <ul class="nav nav-pills flex-column mb-auto">
    <li class="nav-item">
      <a href="leave.php" class="nav-link text-white fw-bold">
        Leave Application
      </a>
    </li>
    <li>
      <a href="leavemgmt.php" class="nav-link text-white fw-bold">
        Leave Management
      </a>
    </li>
    <li>
      <a href="complsub.php" class="nav-link text-white fw-bold">
        Submit a Complaint
      </a>
    </li>
  </ul>
  <hr>
  <div class="dropdown">
  <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
      <img src="../assets/pfp.jpg" alt="" width="32" height="32" class="rounded-circle me-2">
      <strong><?php echo $_SESSION['name']; ?></strong>
    </a>
    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
      <li><a class="dropdown-item" href="#">Profile</a></li>
      <li><a class="dropdown-item" href="#">Settings</a></li>
      <li><hr class="dropdown-divider"></li>
      <li><a class="dropdown-item" href="../login/sess-dest.php">Log-out</a></li>
    </ul>
  </div>
</div>

  <!-- Bootstrap core JS-->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
  <!-- Core theme JS-->
  <script src="js/scripts.js"></script>
</body>

</html>
<?php 
?>
