<?php
require_once('../functions/db-conn.php');
$query = "SELECT * FROM credentials WHERE role = 'Employee'";
$result = mysqli_query($conn, $query);
session_start();
if (isset($_SESSION['role'])) { 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATLAS</title>
    <link href="../css/styles.css" rel="stylesheet" />
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 98%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
        }
        .action-button {
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
        }
        .action-button:hover {
            background-color: #ff3333;
        }
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

            /* If the screen size is 1200px wide or more, set the font-size to 80px */
@media (min-width: 1200px) {
  .responsive-font-example {
    font-size: 20px;
  }
}
/* If the screen size is smaller than 1200px, set the font-size to 80px */
@media (max-width: 1199.98px) {
  .responsive-font-example {
    font-size: 10px;
  }
}
    </style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.2/xlsx.full.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light border-bottom">
        <a class="navbar-brand" href="#">
            <img src="../images/atlas2.png" style="width:50px; height:50px;" alt="Atlas IT Solutions">
            Atlas IT Solutions
        </a>
    </nav>
    <div class="container-fluid">
        <div class="d-flex">
            <div class="text-center w-25 h-100 d-grid p-3 gap-4 col-md-auto bg-light" style="word-wrap:break-word; overflow:auto;">
                <p class="lead pt-3">Management System</p>
                <p>v1.0.0</p>
                <a class="btn btn-lg btn-light btn-block border border-3 border-dark fw-bolder" href="application.php" role="button">Application</a>
                <a class="btn btn-light btn-lg btn-block border border-3 border-dark fw-bolder" href="reports.php" role="button">Reports</a>
                <a class="btn btn-light btn-lg btn-block border border-3 border-dark fw-bolder" href="employees.php" role="button" style='background-color: #4DC8D9;'>Employees</a>
                <a class="btn btn-light btn-lg btn-block border border-3 border-dark fw-bolder" href="leaveman.php" role="button">Leave Management</a>
                <br>
                <a class="btn btn-light btn-lg btn-block border border-3 border-dark fw-bolder" href="main-page.html" role="button">Log-out</a>
                <br><br>
                <br>
            </div>
            <div class='col'>
                <div class="content">
                    <div class="header">
                        <h2 class="">Employees</h2>
                    </div>
                </div>
                
                <div class="p-3 table-responsive">
                <button class="btn btn-secondary mb-5" id="downloadexcel">Export to Excel</button>
                    <table class="table table-bordered table-striped" id="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="text-center">id</th>
                                <th scope="col" class="text-center">name</th>
                                <th scope="col" class="text-center">email</th>
                                <th scope="col" class="text-center">role</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            while($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $row['id']; ?></td>
                                <td class="text-center"><?php echo $row['name']; ?></td>
                                <td class="text-center"><?php echo $row['email']; ?></td>
                                <td class="text-center"><?php echo $row['role']; ?></td>
                                <td class="text-center">
                                    <form action="deletecode.php" method="POST">
                                        <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" name="deletedata" class="btn btn-danger">Fire Employee</button>
                                    </form>
                                </td>
                            </tr>
                        <?php
                            }
                        ?>
                        </tbody>
                    </table>
                    <script>
                document.getElementById('downloadexcel').addEventListener("click", () => {
                    var wb = XLSX.utils.table_to_book(document.querySelector('#table'), {sheet:"Sheet1"});
                    XLSX.writeFile(wb, 'emp-list.xlsx');
                });
                </script>
                </div>
            </div>
        </div>
        <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div cmodal dialog" role="document">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel"> Delete Student Data</h5>
<button type="submit" name="deletedata" class="btn btn-danger">Fire Employee</button>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>

<form action="deletecode.php" method="POST">

<div class="modal-body">
<input type="hidden" name="delete_id" id="delete_id">
<h4> Do you want to delete </h4>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismis="modal" > NO </button>
<button type="submit" name="deletedata" class="btn btn-primary"> YESS</button>
</div>
</form>
</div>
</div>
</div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>
</html>
<?php
}else{
	header("Location: ../login/login.php");
} 
?>