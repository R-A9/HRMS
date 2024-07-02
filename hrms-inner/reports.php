<?php
// Initialize database connection
require_once('../functions/db-conn.php');

// Fetch applications data
$query = "SELECT * FROM applications";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Bare - Start Bootstrap Template</title>
  <!-- Favicon-->
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="../css/styles.css" rel="stylesheet" />
  <style>
     @import url('https://fonts.googleapis.com/css2?family=Abel&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Abel&family=Passion+One:wght@400;700;900&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Abel&family=Passion+One:wght@400;700;900&family=Teko:wght@300..700&display=swap');
    .header {
                    width: 100%;
                    text-align: left;
                    padding: 10px 0;
                    background-color: #fff;
                    border-bottom: 1px solid #ccc;
                }
                .content {
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    padding: 20px;
                }

  </style>
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
      <div class="text-center w-25 h-100 d-grid p-3 gap-4 col-md-auto" style="background-color:#D9D9D9; word-wrap:break-word; overflow:auto;">
        <!-- Sidebar content here -->
        <p class="lead pt-3">Management System</p>
        <p>v1.0.0</p>
        <a class="btn btn-lg btn-block border border-3 border-dark fw-bolder" href="application.php" role="button">Application</a>
        <a class="btn btn-light btn-lg btn-block border border-3 border-dark fw-bolder" href="reports.php" role="button" style='background-color: #4DC8D9;'>Reports</a>
        <a class="btn btn-light btn-lg btn-block border border-3 border-dark fw-bolder" href="employees.php" role="button">Employees</a>
        <a class="btn btn-light btn-lg btn-block border border-3 border-dark fw-bolder" href="leaveman.php" role="button">Leave Management</a>
        <br>
        <a class="btn btn-light btn-lg btn-block border border-3 border-dark fw-bolder" href="main-page.html" role="button">Log-out</a>
        <br><br>
        <br>
      </div>

      <!-- Main content area -->
      <div class="container">
        <div class="header">
          <h2 class="p-3">Recruitment Reports</h2>
        </div>
        <div class="p-5 table-responsive">
          <table class="table table-bordered table-striped">
            <thead class="thead-dark">
              <tr>
                <th scope="col" class="text-center">ID</th>
                <th scope="col" class="text-center">Name</th>
                <th scope="col" class="text-center">E-mail</th>
                <th scope="col" class="text-center">Resume</th>
                <th scope="col" class="text-center">Role</th>
                <th scope="col" class="text-center">Contact Number</th>
                <th scope="col" class="text-center">Status</th>
                <th scope="col" class="text-center">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              while ($row = mysqli_fetch_assoc($result)) {
              ?>
                <tr id="row_<?php echo $row['id']; ?>">
                  <td class="text-center"><?php echo $row['id']; ?></td>
                  <td class="text-center"><?php echo $row['flname']; ?></td>
                  <td class="text-center"><?php echo $row['email']; ?></td>
                  <td class="text-center"><?php echo $row['date']; ?></td>
                  <td class="text-center"><?php echo $row['role']; ?></td>
                  <td class="text-center"><?php echo $row['contno']; ?></td>
                  <td class="text-center"><?php echo $row['status']; ?></td>
                  <td class="text-center">
                    <button class='btn btn-primary' onclick="updateStatus(<?php echo $row['id']; ?>, 'approved')">Approve</button>
                    <button class='btn btn-danger' onclick="updateStatus(<?php echo $row['id']; ?>, 'declined')">Decline</button>
                  </td>
                </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JS and other scripts -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
  <!-- Core theme JS-->
  <script src="js/scripts.js"></script>

  <script>
    function updateStatus(id, status) {
      var xhr = new XMLHttpRequest();
      xhr.open('POST', 'update-status.php', true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.onload = function() {
        if (xhr.status === 200) {
          alert('Status updated successfully');
          document.getElementById('row_' + id).querySelector('td:nth-child(7)').textContent = status; // Update status cell in the table
        } else {
          alert('Error updating status');
        }
      };
      xhr.send('id=' + id + '&status=' + status);
    }
  </script>
</body>
</html>

<?php
// PHP script to handle AJAX request and update status in the database

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id']) && isset($_POST['status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];

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