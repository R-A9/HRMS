<?php
require_once('../functions/db-conn.php');

session_start();

if (isset($_SESSION['role'])=="HR")  {

    // Select all pending leaves for the logged-in employee
    $sql = "SELECT * FROM leaveapp WHERE status='pending'";
    $result = mysqli_query($conn, $sql);
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>ATLAS</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
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
            @media (min-width: 1200px) {
                .responsive-font-example {
                    font-size: 20px;
                }
            }
            @media (max-width: 1199.98px) {
                .responsive-font-example {
                    font-size: 10px;
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
    <nav class="navbar navbar-expand-lg navbar-light border-bottom">
        <a class="navbar-brand" href="#">
            <img src="../images/atlas2.png" style="width:50px; height:50px;" alt="Atlas IT Solutions">
            Atlas IT Solutions
        </a>
    </nav>

    <div class="container-fluid">
        <div class="d-flex">
            <div class="text-center bg-light w-25 h-100 d-grid p-3 gap-4 col-md-auto" style="word-wrap:break-word; overflow:auto;">
                <p class="lead pt-3">HR Management System</p>
                <p>v1.0.0</p>
                <a class="btn btn-lg btn-light btn-block border border-3 border-dark fw-bolder" href="application.php" role="button">Application</a>
                <a class="btn btn-light btn-lg btn-block border border-3 border-dark fw-bolder" href="reports.php" role="button">Reports</a>
                <a class="btn btn-light btn-lg btn-block border border-3 border-dark fw-bolder" href="employees.php" role="button">Employees</a>
                <a class="btn btn-light btn-lg btn-block border border-3 border-dark fw-bolder" href="leaveman.php" role="button" style='background-color: #4DC8D9;'>Leave Management</a>
                <br>
                <a class="btn btn-light btn-lg btn-block border border-3 border-dark fw-bolder responsive-font-example" href="../login/sess-dest.php"
                    role="button">Log-out</a>
                <br><br>
                <br>
            </div>

            <!-- Flex container for fieldsets -->
            <div class="container">
                <div class="content">
                    <div class="header">
                        <h2 class="">Leave Management</h2>
                    </div>
                </div>

                <!-- Add the Export to Excel button -->
                <div class="p-3 table-responsive">
                    <button class="btn btn-secondary mb-3" id="downloadexcel">Export to Excel</button>

                    <table id="table" class="table table-bordered table-striped">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="text-center">ID</th>
                            <th scope="col" class="text-center">Name</th>
                            <th scope="col" class="text-center">Start Date</th>
                            <th scope="col" class="text-center">End Date</th>
                            <th scope="col" class="text-center">Reason</th>
                            <th scope="col" class="text-center">Status</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $row['id']; ?></td>
                                <td class="text-center"><?php echo $row['employee_name']; ?></td>
                                <td class="text-center"><?php echo $row['sdate']; ?></td>
                                <td class="text-center"><?php echo $row['edate']; ?></td>
                                <td class="text-center"><?php echo $row['reason']; ?></td>
                                <td class="text-center"><?php echo $row['status']; ?></td>

                                <td class="text-center">
                                    <form action="leaveman.php" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>"/>
                                        <button type="submit" class='btn btn-primary' href="leaveman.php" name="approve">Approve</button>
                                        <button type="submit" class='btn btn-danger' href="leaveman.php" name="delete">Decline</button>
                                    </form>
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

        <script>
            document.getElementById('downloadexcel').addEventListener("click", () => {
                var table2excel = new Table2Excel();
                table2excel.export(document.querySelectorAll('#table'));
            });
        </script>

        <!-- Bootstrap JS and dependencies -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
    </html>

    <?php
} else {
    header("Location: ../login/login.php");
    exit;
}

if (isset($_POST['approve'])) {
    $id = $_POST['id'];
    $update = "UPDATE leaveapp SET status = 'approved' WHERE id = '$id'";
    $result = mysqli_query($conn, $update);
    if ($result) {
        header("location:leaveman.php");
    } else {
        echo "<script>alert('Error approving leave request');</script>";
    }
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $update = "UPDATE leaveapp SET status = 'declined' WHERE id = '$id'";
    $result = mysqli_query($conn, $update);
    if ($result) {
        header("location:leaveman.php");
    } else {
        echo "<script>alert('Error declining leave request');</script>";
    }
}
?>