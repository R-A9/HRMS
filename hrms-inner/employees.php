<?php
require_once('../functions/db-conn.php');
$query = "SELECT * FROM credentials";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management System</title>
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
    </style>
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
            <div class="text-center w-25 h-100 d-grid p-3 gap-4 col-md-auto" style="background-color:#D9D9D9; word-wrap:break-word; overflow:auto;">
                <p class="lead pt-3">Management System</p>
                <p>v1.0.0</p>
                <a class="btn btn-lg btn-block border border-3 border-dark fw-bolder" href="application.html" role="button">Application</a>
                <a class="btn btn-light btn-lg btn-block border border-3 border-dark fw-bolder" href="reports.php" role="button">Reports</a>
                <a class="btn btn-light btn-lg btn-block border border-3 border-dark fw-bolder" href="employees.html" role="button" style='background-color: #4DC8D9;'>Employees</a>
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
                <div class="p-5 table-responsive">
                    <table class="table table-bordered table-striped">
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
                </div>
            </div>
        </div>
        <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal dialog" role="document">
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