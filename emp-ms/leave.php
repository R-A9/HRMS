<?php
session_start();

if (isset($_SESSION['uid'])) {
  // Database connection
  $conn = new mysqli('localhost', 'root', '', 'hrms');

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $sdate = $_POST['sdate'];
      $edate = $_POST['edate'];
      $reason = $_POST['reason'];
      $employee_name = $_SESSION['name']; // Assuming 'employee_name' is stored in the session
      $status = "pending";

      // Prepare and bind
      $stmt = $conn->prepare("INSERT INTO leaveapp (sdate, edate, employee_name, reason, status) VALUES (?, ?, ?, ?, ?)");
      $stmt->bind_param("sssss", $sdate, $edate, $employee_name, $reason, $status);

      // Execute the query
      if ($stmt->execute()) {
          echo "<script>alert('Leave application submitted successfully!');</script>";
      } else {
          echo "<script>alert('Error: " . $stmt->error . "');</script>";
      }

      // Close statement and connection
      $stmt->close();
      $conn->close();
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
    .card {
      max-width: 700px;
      padding: 2rem;
    }
    .form-group {
      margin-bottom: 1.5rem;
    }
    .btn {
      padding: 0.75rem 1.25rem;
    }
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
      <a href="leave.php" class="nav-link text-white fw-bold active" style="background-color: #4DC8D9;">
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
      <li><a class="dropdown-item" href="../hrms-inner/main-page.html">Log-out</a></li>
    </ul>
  </div>
</div>


      <!-- Flex container for fieldsets -->
      <div class="flex-grow-1 p-4">
        <!-- Start main code -->
        <div class="container d-flex justify-content-center">
          <div class="p-4 w-100" style="max-width: 700px;">
            <form method="post" action="">
              <div class="form-group mb-3">
                <label for="start-date"><h3>Start Date:</h3></label>
                <input type="date" class="form-control" id="sdate" name="sdate" required>
              </div>
              <div class="form-group mb-3">
                <label for="end-date"><h3>End Date:</h3></label>
                <input type="date" class="form-control" id="edate" name="edate" required>
              </div>
              <div class="form-group mb-4">
                <label for="reason"><h3>Reason:</h3></label>
                <textarea class="form-control" id="reason" name="reason" placeholder="Your reason here.." required></textarea>
              </div>
              <button type="submit" class="btn btn-success btn-block">Apply</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JS-->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
  <!-- Core theme JS-->
  <script src="../js/scripts.js"></script>
</body>
</html>

<?php 
} else {
  header("Location: ../login/login.php");
} 
?>
