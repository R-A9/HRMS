<?php
// Initialize database connection
require_once('../functions/db-conn.php');
session_start();

if (isset($_SESSION['role']) && $_SESSION['role'] == "HR") {
    // Set the number of entries per page
    $entries_per_page = 10;

    // Get the current page number from the query string (default is 1)
    $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    // Calculate the offset
    $offset = ($current_page - 1) * $entries_per_page;

    // Fetch total number of rows
    $total_query = "SELECT COUNT(*) as total FROM applications";
    $total_result = mysqli_query($conn, $total_query);
    $total_row = mysqli_fetch_assoc($total_result);
    $total_entries = $total_row['total'];

    // Calculate total number of pages
    $total_pages = ceil($total_entries / $entries_per_page);

    // Fetch entries for the current page
    $query = "SELECT id, flname, email, date, role, status FROM applications LIMIT $offset, $entries_per_page";
    $result = mysqli_query($conn, $query);

    // Fetch summary data
    $applicants_query = "SELECT COUNT(*) AS total_applicants FROM applications";
    $applicants_result = mysqli_query($conn, $applicants_query);
    $applicants_row = mysqli_fetch_assoc($applicants_result);
    $total_applicants = $applicants_row['total_applicants'];

    $leave_query = "SELECT COUNT(*) AS total_leave FROM leaveapp WHERE status = 'approved'";
    $leave_result = mysqli_query($conn, $leave_query);
    $leave_row = mysqli_fetch_assoc($leave_result);
    $total_leave = $leave_row['total_leave'];

    $pending_query = "SELECT COUNT(*) AS pending_applications FROM applications WHERE status = 'pending'";
    $pending_result = mysqli_query($conn, $pending_query);
    $pending_row = mysqli_fetch_assoc($pending_result);
    $pending_applications = $pending_row['pending_applications'];

    $approved_query = "SELECT COUNT(*) AS approved_applications FROM applications WHERE status = 'approved'";
    $approved_result = mysqli_query($conn, $approved_query);
    $approved_row = mysqli_fetch_assoc($approved_result);
    $approved_applications = $approved_row['approved_applications'];

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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    .charts-container {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
    }

    .chart-container {
      flex: 1;
      min-width: 300px;
    }

    canvas {
      background-color: #fff;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .summary-card {
      padding: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
  </style>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <!-- Responsive navbar-->
  <nav class="navbar navbar-expand-lg navbar-light border-bottom">
    <a class="navbar-brand" href="#">
      <img src="../images/atlas2.png" style="width:50px; height:50px;" alt="Atlas IT Solutions">
      Atlas IT Solutions
    </a>
  </nav>

  <!-- Page content-->
  <div class="container-fluid">
    <div class="d-flex">
      <!-- Sidebar -->
      <div class="text-center w-25 h-100 d-grid p-3 gap-4 col-md-auto bg-light">
        <p class="lead pt-3">Management System</p>
        <p>v1.0.0</p>
        <a class="btn btn-lg btn-light btn-block border border-3 border-dark fw-bolder" href="application.php" role="button">Application</a>
        
        <div class="btn-group">
          <a class="btn btn-light btn-lg btn-block border border-3 border-dark fw-bolder" style="background-color: #4DC8D9;" role="button">Reports</a>
          <button type="button" class="btn btn-light border-dark border border-3 dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
              <span class="visually-hidden">Toggle Dropdown</span>
          </button>
          <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="violations.php">Violations and Complaints</a></li>
              <li><a class="dropdown-item" href="recruitment-reports.php">Recruitment Reports</a></li>
          </ul>
        </div>
        
        <a class="btn btn-light btn-lg btn-block border border-3 border-dark fw-bolder" href="employees.php" role="button">Employees</a>
        <a class="btn btn-light btn-lg btn-block border border-3 border-dark fw-bolder" href="leaveman.php" role="button">Leave Management</a>
        <br>
        <a class="btn btn-light btn-lg btn-block border border-3 border-dark fw-bolder" href="main-page.html" role="button">Log-out</a>
        <br><br>
      </div>

      <!-- Main content area -->
      <div class="container">
        <div class="header">
          <h2 class="p-3">Reports</h2>
        </div>

        <!-- Dashboard Content -->
        <div class="row">
          <!-- Top Section: Summary Cards -->
          <div class="col-md-12 mb-4">
            <div class="d-flex flex-wrap justify-content-between">
              <div class="col-md-3 summary-card">
                <h3>Total Applicants</h3>
                <p id="totalApplicants"><?php echo $total_applicants; ?></p>
              </div>
              <div class="col-md-3 summary-card">
                <h3>Employees on Leave</h3>
                <p id="employeesOnLeave"><?php echo $total_leave; ?></p>
              </div>
              <div class="col-md-3 summary-card">
                <h3>Pending Applications</h3>
                <p id="pendingApplications"><?php echo $pending_applications; ?></p>
              </div>
              <div class="col-md-3 summary-card">
                <h3>Approved Applications</h3>
                <p id="approvedApplications"><?php echo $approved_applications; ?></p>
              </div>
            </div>
          </div>

          <!-- Middle Section: Charts -->
          <div class="col-md-12 charts-container">
            <div class="chart-container">
              <canvas id="employeeChart"></canvas>
            </div>
            <div class="chart-container">
              <canvas id="applicationChart"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JS and other scripts -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
  <!-- Core theme JS-->
  <script src="js/scripts.js"></script>
  <script>
    // Chart.js Data and Configuration for Employee Chart
    var employeeCtx = document.getElementById('employeeChart').getContext('2d');
    var employeeChart = new Chart(employeeCtx, {
      type: 'bar',
      data: {
        labels: ['Total Applicants', 'Employees on Leave'],
        datasets: [{
          label: 'Employees',
          data: [
            <?php echo $total_applicants; ?>, 
            <?php echo $total_leave; ?>
          ],
          backgroundColor: ['#4CAF50', '#FF5722']
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false
      }
    });

    // Chart.js Data and Configuration for Application Chart
    var applicationCtx = document.getElementById('applicationChart').getContext('2d');
    var applicationChart = new Chart(applicationCtx, {
      type: 'pie',
      data: {
        labels: ['Pending Applications', 'Approved Applications'],
        datasets: [{
          label: 'Applications',
          data: [
            <?php echo $pending_applications; ?>, 
            <?php echo $approved_applications; ?>
          ],
          backgroundColor: ['#03A9F4', '#FFC107']
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false
      }
    });
  </script>
</body>
</html>

<?php
} else {
    header("Location: ../login/login.php");
    exit();
}

// PHP script to handle AJAX request and update status in the database
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id']) && isset($_POST['status'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    // Update status in the database
    $query = "UPDATE applications SET status = '$status' WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        http_response_code(200); // Success
    } else {
        http_response_code(500); // Server error
    }
} else {
    http_response_code(400); // Bad request
}
?>