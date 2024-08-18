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
      $title = $_POST['title'];
      $reason = $_POST['complaint'];
      $name = $_SESSION['name']; // Assuming 'employee_name' is stored in the session
      $date = date("Y/m/d");

      // Prepare and bind
      $stmt = $conn->prepare("INSERT INTO viol (name, title, description, date) VALUES (?, ?, ?, ?)");
      $stmt->bind_param("ssss", $name, $title, $reason, $date);

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
  <!-- Responsive navbar-->
  <nav class="navbar navbar-light py-0 navbar-expand-lg fixed-top pb-3">
    <div class="container-fluid">
      <img src="../images/atlas2.png" style="width: 50px; height: 50px;">
      <a class="navbar-brand" href="#">ATLAS-HRMS</a>
      <div class="d-flex order-lg-1 ml-auto pr-2">
        <!-- !!!!!!!!!!Everything below this comment, wag niyong pakikialaman!!!!!!!!!!!!!! -->
        <span class="dot" style="color:white; padding-right: 5px;"></span>
        <a href="#" class="navbar-text"><i class="fa fa-shopping-cart fa-lg" style="color: white;"></i></a>
        <ul class="navbar-nav flex-row to-hide-nav">
          <li class="nav-item mx-2 mx-lg-0">
            <a class="nav-link" href="#"></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"></a>
          </li>
        </ul>
      </div>

      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#"><span class="sr-only"></span></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- End of untouchable code, everything below this is subject to change -->

  <!-- Page content-->
  <div class="container-fluid pt-5">
    <div class="d-flex">
      <div class="text-center w-25 h-100 d-grid p-2 gap-4 col-md-auto" style="background-color:#D9D9D9; word-wrap:break-word; overflow:auto;">
        <p class="lead pt-3">Management System</p>
        <p>v1.0.0</p>
        <a class="btn btn-light btn-lg btn-block border border-3 border-dark fw-bolder" href="leave.php" role="button">Leave Application.</a>
        <a class="btn btn-light btn-lg btn-block border border-3 border-dark fw-bolder" href="leavemgmt.php" role="button">Leave Mgmt.</a>
        <a class="btn btn-light btn-lg btn-block border border-3 border-dark fw-bolder" href="complsub.php" style="background-color: #4DC8D9;" role="button">Submit a Complaint</a>
        <br>
        <a class="btn btn-light btn-lg btn-block border border-3 border-dark fw-bolder" href="../hrms-inner/main-page.html" role="button">Log-out</a>
        <br><br>
        <br>
      </div>

      <!-- Flex container for fieldsets -->
      <div class="flex-grow-1 p-4">
      <h1>Submit a Complaint</h1>
      <hr>
        <!-- Start main code -->
        <div class="container d-flex justify-content-center">
          <div class="p-4 w-100" style="max-width: 700px;">
            <form method="post" action="">
              <div class="form-group mb-4">
                <label for="reason"><h3>Title:</h3></label>
                <textarea class="form-control" id="reason" name="title" placeholder="Your reason here.." required></textarea>
              </div>
              <div class="form-group mb-4">
                <label for="complaint"><h3>Complaint:</h3></label>
                <textarea class="form-control" id="complaint" name="complaint" placeholder="Your complaint here.." required></textarea>
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