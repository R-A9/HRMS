<?php
session_start();
require_once('../functions/db-conn.php');



// Define the number of results per page
$results_per_page = 5;

// Find out the number of results stored in the database
$sql = "SELECT COUNT(*) AS total FROM leaveapp WHERE status IN('approved', 'declined', 'pending') AND employee_name='" . $_SESSION['name'] . "'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$total_results = $row['total'];

// Determine the number of total pages available
$total_pages = ceil($total_results / $results_per_page);

// Determine which page number the visitor is currently on
if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

// Determine the starting limit number for the results on the displaying page
$starting_limit = ($page - 1) * $results_per_page;

// Retrieve the selected results from the database
$sql = "SELECT * FROM leaveapp WHERE status IN('approved', 'declined', 'pending') AND employee_name='" . $_SESSION['name'] . "' LIMIT $starting_limit, $results_per_page";
$result = mysqli_query($conn, $sql);

if (isset($_SESSION['role']) && $_SESSION['role'] == "Employee") {
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

    @media (max-width: 992px) {
    .sidebar {
    position: fixed;
    top: 0;
    left: -250px;
    width: 250px;
    height: 100%;
    transition: all 0.3s;
  }

  .sidebar.active {
    left: 0;
  }

  .main-content {
    margin-left: 0;
  }
}

@media (min-width: 993px) {
  .sidebar {
    width: 250px;
    height: 100vh;
    position: fixed;
  }

  .main-content {
    margin-left: 250px;
  }
}

.sidebar .nav-link.active {
  background-color: #4DC8D9 !important;
}

.sidebar .dropdown-menu {
  position: static !important;
  float: none;
  margin-top: 1rem;
}
    

    .table th, .table td {
      white-space: nowrap;
      padding: 200px;
    }
  </style>
</head>

<body>


  <!-- Sidebar -->
  <button class="btn btn-dark sidebar-toggle d-lg-none" type="button">
  <i class="fas fa-bars"></i>
</button>
<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 250px; height: 100vh; position: fixed;">
  <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
    <img src="../images/atlas2.png" alt="ATLAS" width="40" height="40" class="me-2">
    <span class="fs-4">ATLAS-EMPMS</span>
  </a>
  <hr>
  <ul class="nav nav-pills flex-column mb-auto">
    <li class="nav-item">
      <a href="leave.php" class="nav-link text-white fw-bold">
        Leave Application
      </a>
    </li>
    <li>
      <a href="leavemgmt.html" class="nav-link text-white fw-bold active" style="background-color: #4DC8D9;">
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
      <li><a class="dropdown-item" href="logout.php" >Log-out</a></li>
    </ul>
  </div>
</div>

      <!-- Flex container for fieldsets -->
      <div class="flex-grow-1 pt-4">
        <!-- Start main code -->
        <div class="container d-flex justify-content-center">
          <div class="p-4 w-100" style="max-width: 700px;">
            <div class="p-3">
              <table id="table" class="table table-bordered table-striped">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col" class="text-center">ID</th>
                    <th scope="col" class="text-center">Name</th>
                    <th scope="col" class="text-center">Start Date</th>
                    <th scope="col" class="text-center">End Date</th>
                    <th scope="col" class="text-center">Reason</th>
                    <th scope="col" class="text-center">Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    while($row = mysqli_fetch_assoc($result)) {
                  ?>
                  <tr>
                    <td class="text-center"><?php echo $row['id']; ?></td>
                    <td class="text-center"><?php echo $row['employee_name']; ?></td>
                    <td class="text-center"><?php echo $row['sdate']; ?></td>
                    <td class="text-center"><?php echo $row['edate']; ?></td>
                    <td class="text-center"><?php echo $row['reason']; ?></td>
                    <td class="text-center"><?php echo $row['status']; ?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>

            <!-- Pagination -->
            <nav aria-label="Page navigation">
              <ul class="pagination justify-content-center">
                <?php
                  // Display the previous button
                  if ($page > 1) {
                    echo '<li class="page-item"><a class="page-link" href="leavemgmt.php?page=' . ($page - 1) . '">«</a></li>';
                  }

                  // Display the page numbers
                  for ($i = 1; $i <= $total_pages; $i++) {
                    if ($i == $page) {
                      echo '<li class="page-item active"><a class="page-link" href="#">' . $i . '</a></li>';
                    } else {
                      echo '<li class="page-item"><a class="page-link" href="leavemgmt.php?page=' . $i . '">' . $i . '</a></li>';
                    }
                  }

                  // Display the next button
                  if ($page < $total_pages) {
                    echo '<li class="page-item"><a class="page-link" href="leavemgmt.php?page=' . ($page + 1) . '">»</a></li>';
                  }
                ?>
              </ul>
            </nav>

          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JS-->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
  var sidebarToggle = document.querySelector(".sidebar-toggle");
  var sidebar = document.querySelector(".sidebar");

  sidebarToggle.addEventListener("click", function() {
    sidebar.classList.toggle("active");
  });
});
</script>
  <!-- Core theme JS-->
  <script src="../js/scripts.js"></script>
</body>

</html>
<?php 
}else{
    header("Location: ../login/login.php");
} 
?>
