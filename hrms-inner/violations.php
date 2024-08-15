<?php
// Initialize database connection
require_once('../functions/db-conn.php');
session_start();
if (isset($_SESSION['role']) == "Employee") { 

  // Set the number of entries per page
  $entries_per_page = 10;

  // Get the current page number from the query string (default is 1)
  $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

  // Calculate the offset
  $offset = ($current_page - 1) * $entries_per_page;

  // Fetch total number of rows
  $total_query = "SELECT COUNT(*) as total FROM viol";
  $total_result = mysqli_query($conn, $total_query);
  $total_row = mysqli_fetch_assoc($total_result);
  $total_entries = $total_row['total'];

  // Calculate total number of pages
  $total_pages = ceil($total_entries / $entries_per_page);

  // Fetch entries for the current page
  $query = "SELECT * FROM viol LIMIT $offset, $entries_per_page";
  $result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
<?php if (isset($_GET['success'])): ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    New entry added successfully!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif; ?>

  <title>Violations and Complaints</title>
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="../css/styles.css" rel="stylesheet" />
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
        <br>
      </div>

      <!-- Main content area -->
      <div class="container">
        <div class="header">
          <h2 class="p-3">Violations and Complaints</h2>
        </div>
        <div class="p-5 table-responsive">
          <table class="table table-bordered table-striped">
            <thead class="thead-dark">
              <tr>
                <th scope="col" class="text-center">ID</th>
                <th scope="col" class="text-center">Name</th>
                <th scope="col" class="text-center">Description</th>
                <th scope="col" class="text-center">Date</th>
              </tr>
            </thead>
            <tbody>
              <?php
              while ($row = mysqli_fetch_assoc($result)) {
              ?>
                <tr>
                  <td class="text-center"><?php echo $row['id']; ?></td>
                  <td class="text-center"><?php echo $row['name']; ?></td>
                  <td class="text-center"><?php echo $row['description']; ?></td>
                  <td class="text-center"><?php echo $row['date']; ?></td>
                </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
        </div>

        <!-- Pagination Controls -->
        <nav aria-label="Page navigation">
          <ul class="pagination justify-content-center">
            <li class="page-item <?php if ($current_page <= 1) echo 'disabled'; ?>">
              <a class="page-link" href="?page=<?php echo $current_page - 1; ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li>
            <?php for ($page = 1; $page <= $total_pages; $page++): ?>
            <li class="page-item <?php if ($page == $current_page) echo 'active'; ?>">
              <a class="page-link" href="?page=<?php echo $page; ?>"><?php echo $page; ?></a>
            </li>
            <?php endfor; ?>
            <li class="page-item <?php if ($current_page >= $total_pages) echo 'disabled'; ?>">
              <a class="page-link" href="?page=<?php echo $current_page + 1; ?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li>
          </ul>
        </nav>

          <!-- Fill Up Button -->
    <div class="d-flex justify-content-center mt-4">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#fillUpModal">
            Add Entry
        </button>
    </div>
</div>

      </div>
    </div>
  </div>

  <!-- Bootstrap core JS and other scripts -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
  <!-- Core theme JS-->
  <script src="../js/scripts.js"></script>

  <!-- Modal -->
<div class="modal fade" id="fillUpModal" tabindex="-1" aria-labelledby="fillUpModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="fillUpModalLabel">Add New Violation/Complaint</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="add_violation.php" method="post">
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
          </div>
          <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" class="form-control" id="date" name="date" required>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>

<?php
} else {
  header("Location: ../login/login.php");
} 
?>