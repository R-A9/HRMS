<?php
require_once('../functions/db-conn.php');
session_start();
session_regenerate_id(true);

if (isset($_SESSION['role'])=="HR")  {

    // Set the number of entries per page
    $entries_per_page = 10;

    // Get the current page number from the query string (default is 1)
    $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    if ($current_page < 1) $current_page = 1;

    // Get the search query
    $search_query = isset($_GET['search']) ? trim($_GET['search']) : '';

    // Sanitize the search query
    $search_query = mysqli_real_escape_string($conn, $search_query);

    // Calculate the offset
    $offset = ($current_page - 1) * $entries_per_page;

    // Fetch total number of rows
    $total_query = "SELECT COUNT(*) as total FROM applications WHERE flname LIKE '{$search_query}%'";
    $total_result = mysqli_query($conn, $total_query);
    if (!$total_result) {
        die('Query Failed: ' . mysqli_error($conn));
    }
    $total_row = mysqli_fetch_assoc($total_result);
    $total_entries = $total_row['total'];

    // Calculate total number of pages
    $total_pages = ceil($total_entries / $entries_per_page);

    // Fetch entries for the current page
    $query = "SELECT * FROM applications WHERE flname LIKE '{$search_query}%' LIMIT $offset, $entries_per_page";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die('Query Failed: ' . mysqli_error($conn));
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Your existing HTML head content -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>ATLAS</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
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
            background-color: #1e23bd ;
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
        }

        @media (min-width: 1200px) {
            .responsive-font-example {
                font-size: 20px;
            }
        }
    </style>
    <script src="table2excel.js"></script>
</head>
<body>
<?php if ($_SESSION['role'] == 'Employee') {
    header('Location: ../emp-ms/index.php');
  }
 ?>
    <!-- Your existing HTML body content -->
    <nav class="navbar navbar-expand-lg navbar-light border-bottom">
        <a class="navbar-brand" href="#">
            <img src="../images/atlas2.png" style="width:50px; height:50px;" alt="Atlas IT Solutions">
            Atlas IT Solutions
        </a>
    </nav>

    <div class="container-fluid">
        <div class="d-flex">
            <div class="text-center w-25 h-100 d-grid p-3 gap-4 col-md-auto bg-light"
                style="word-wrap:break-word; overflow:auto;">
                <p class="lead pt-3">HR Management System</p>
                <p>v1.0.0</p>
                <a class="btn btn-lg btn-block border border-3 border-dark fw-bolder" href="application.php"
                    role="button" style='background-color: #4DC8D9;'>Application</a>
                <a class="btn btn-light btn-lg btn-block border border-3 border-dark fw-bolder" href="reports.php"
                    role="button">Reports</a>
                <a class="btn btn-light btn-lg btn-block border border-3 border-dark fw-bolder" href="employees.php"
                    role="button">Employees</a>
                <a class="btn btn-light btn-lg btn-block border border-3 border-dark fw-bolder" href="leaveman.php"
                    role="button">Leave Management</a>
                <br>
                <a class="btn btn-light btn-lg btn-block border border-3 border-dark fw-bolder responsive-font-example" href="../login/sess-dest.php"
                    role="button">Log-out</a>
                <br><br>
                <br>
            </div>

            <div class='col'>
                <div class="content">
                    <div class="header">
                        <h2 class="">Application</h2>
                        <form class="search-form" method="get" action="application.php">
                            <input type="text" class="search-input" name="search" placeholder="Search by name" value="<?php echo htmlspecialchars($search_query); ?>">
                            <button class="search-button" type="submit">Search</button>
                        </form>
                    </div>
                </div>
                <div class="p-3"><button class="search-button bg-secondary" id="downloadexcel">Export to Excel</button></div>
                <div class="table-container">
                    <div class="table-wrapper">
                        <table class="table table-bordered table-striped" id="example-table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="text-center">ID</th>
                                    <th scope="col" class="text-center">Name</th>
                                    <th scope="col" class="text-center">E-mail</th>
                                    <th scope="col" class="text-center">Contact Number</th>
                                    <th scope="col" class="text-center">CV</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $row['id']; ?></td>
                                    <td class="text-center"><?php echo $row['flname']; ?></td>
                                    <td class="text-center"><?php echo $row['email']; ?></td>
                                    <td class="text-center"><?php echo $row['contno']; ?></td>
                                    <td class="text-center"><button class="btn btn-xs btn-block border border-3 border-dark fw-bolder"  onclick="window.open('../<?php echo $row['resume']; ?>')"
                                    role="button" style='background-color: #4DC8D9;'>Download CV</></button></td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <script>
        document.getElementById('downloadexcel').addEventListener("click", () => {
            var table2excel = new Table2Excel();
            table2excel.export(document.querySelectorAll('#example-table'));
        })
    </script>
                    </div>
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <li class="page-item <?php if ($current_page <= 1) echo 'disabled'; ?>">
                            <a class="page-link" href="?page=<?php echo $current_page - 1; ?>&search=<?php echo htmlspecialchars($search_query); ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php for ($page = 1; $page <= $total_pages; $page++): ?>
                        <li class="page-item <?php if ($page == $current_page) echo 'active'; ?>">
                            <a class="page-link" href="?page=<?php echo $page; ?>&search=<?php echo htmlspecialchars($search_query); ?>"><?php echo $page; ?></a>
                        </li>
                        <?php endfor; ?>
                        <li class="page-item <?php if ($current_page >= $total_pages) echo 'disabled'; ?>">
                            <a class="page-link" href="?page=<?php echo $current_page + 1; ?>&search=<?php echo htmlspecialchars($search_query); ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>
</html>

<?php
} else {
    header("Location: ../login/login.php");
    exit;
}
?>