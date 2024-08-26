<?php
// Initialize database connection
require_once('../functions/db-conn.php');
session_start();
if (isset($_SESSION['role']) == "Employee") { 

  // Set the number of entries per page
  $entries_per_page = 10;

// Get the search query
$search_query = isset($_GET['search']) ? trim($_GET['search']) : '';

// Sanitize the search query
$search_query = mysqli_real_escape_string($conn, $search_query);

// Construct the query
$total_query = "SELECT COUNT(*) as total FROM applications WHERE flname LIKE '$search_query%'";
$query = "SELECT * FROM applications WHERE flname LIKE '$search_query%' LIMIT, $entries_per_page";


  // Get the current page number from the query string (default is 1)
  $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

  // Calculate the offset
  $offset = ($current_page - 1) * $entries_per_page;

  // Initialize the search query
  $search_query = '';
  if (isset($_GET['search'])) {
    $search_query = mysqli_real_escape_string($conn, $_GET['search']);
  }

  // Modify the query based on search input
  if (!empty($search_query)) {
    // Fetch total number of rows that match the search criteria
    $total_query = "SELECT COUNT(*) as total FROM viol WHERE name LIKE '$search_query%'";
    $query = "SELECT * FROM viol WHERE name LIKE '$search_query%' LIMIT $offset, $entries_per_page";
  } else {
    // Fetch total number of rows if no search query
    $total_query = "SELECT COUNT(*) as total FROM viol";
    $query = "SELECT * FROM viol LIMIT $offset, $entries_per_page";
  }

  $total_result = mysqli_query($conn, $total_query);
  $total_row = mysqli_fetch_assoc($total_result);
  $total_entries = $total_row['total'];

  // Calculate total number of pages
  $total_pages = ceil($total_entries / $entries_per_page);

  // Fetch entries for the current page
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
  <style>
    .header {
            width: 100%;
            text-align: left;
            padding: 10px 0;
            background-color: #fff;
            border-bottom: 1px solid #ccc;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .search-form {
            display: flex;
            align-items: center;
        }

        .search-input {
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 5px 10px;
            font-size: 16px;
        }

        .search-button {
            background-color: #252ce8;
            border: none;
            color: white;
            padding: 6px 12px;
            font-size: 16px;
            margin-left: 10px;
            border-radius: 4px;
            cursor: pointer;
        }

        .search-button:hover {
            background-color: #1e23bd;
        }

        .content {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        .table-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
            max-height: 500px; /* Adjust as needed */
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            position: sticky;
            top: 0;
            background-color: #f8f9fa;
            z-index: 1;
            cursor: pointer;
        }

        th.sort-header .sort-arrow {
            display: inline-block;
            width: 0;
            height: 0;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-top: 5px solid #333;
            vertical-align: middle;
            margin-left: 5px;
        }

        th.sort-header .sort-arrow.asc {
            border-top: none;
            border-bottom: 5px solid #333;
        }

        @media (min-width: 1200px) {
            .responsive-font-example {
                font-size: 20px;
            }
        }

        /* Show the dropdown menu when hovering over the dropdown button */
        .btn-group:hover .dropdown-menu {
            display: inline-flexbox;
            margin-top: 0; /* Ensure the dropdown doesn't jump when displayed */
        }

        /* Optional: To make the dropdown button itself respond to hover */
        .btn-group:hover .btn-light {
            background-color: #f8f9fa; /* Change this to the desired hover color */
        }
  </style>
  
</head>
<body>
<?php if ($_SESSION['role'] == 'Employee') {
    header('Location: ../emp-ms/index.php');
  }
 ?>
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
      <div class="text-center bg-light w-25 h-100 d-grid p-3 gap-4 col-md-auto" style="background-color:#D9D9D9; word-wrap:break-word; overflow:auto;">
        <p class="lead pt-3">HR Management System</p>
        <p>v1.0.0</p>
        <a class="btn btn-lg btn-light btn-block border border-3 border-dark fw-bolder" href="application.php" role="button">Application</a>
        
        <div class="btn-group">
            <a class="btn btn-light btn-lg btn-block border border-3 border-dark fw-bolder" style="background-color: #4DC8D9;" href="reports.php"role="button">Reports</a>
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
      

        <!-- Search Form -->
        <div class="container">
  <div class="header">
    <h2 class="p-3">Violations and Complaints</h2>
    <!-- Align search form to the right -->
    <div class="search-container">
      <form class="search-form" method="get" action="violations.php">
        <input type="text" class="search-input" name="search" placeholder="Search by name" value="<?php echo htmlspecialchars($search_query); ?>">
        <button class="search-button" type="submit">Search</button>
      </form>
    </div>
  </div>

        <div class="p-5 table-responsive">
          <table class="table table-bordered table-striped">
            <thead class="thead-dark">
            <tr>
                <th scope="col" class="text-center">ID</th>
                <th scope="col" class="text-center">Name</th>
                <th scope="col" class="text-center">Title</th>
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
                  <td class="text-center"><?php echo $row['title']; ?></td>
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
              <a class="page-link" href="?page=<?php echo $page; ?>&search=<?php echo $search_query; ?>"><?php echo $page; ?></a>
            </li>
            <?php endfor; ?>
            <li class="page-item <?php if ($current_page >= $total_pages) echo 'disabled'; ?>">
              <a class="page-link" href="?page=<?php echo $current_page + 1; ?>&search=<?php echo $search_query; ?>" aria-label="Next">
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
            <label for="name" class="form-label">Name of Person in Viol/Reported</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="mb-3">
            <label for="name" class="form-label">Title</label>
            <input type="text" class="form-control" id="name" name="title" required>
          </div>
          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea><br>
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
