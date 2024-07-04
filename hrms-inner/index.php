<?php 
$pdo = require "../functions/db-conn.php";
session_start();
if (isset($_SESSION['uid'])) { 
  

  
  
  ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>ATLAS HRMS</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../css/styles.css" rel="stylesheet" />
    <style>
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

    <!-- End of untouchable code, everything below this is subject to change -->


    <!-- Page content-->
    <div class="container-fluid h-100">
        <div class="text-center w-100 h-100 border">
            <div class='w-25 h-100 d-grid p-2 gap-4 row-fluid'
                style="background-color:#D9D9D9; word-wrap:break-word; position: relative; display:inline-block; overflow:auto;">
                <p class="lead pt-3">Management System</p>
                <p>v1.0.0</p>
                <a class="btn btn-light btn-lg btn-block border border-3 border-dark fw-bolder responsive-font-example" href="application.php"
                    role="button">Application</a>

                <a class="btn  btn-light btn-lg btn-block border border-3 border-dark fw-bolder responsive-font-example" href="reports.php"
                    role="button">Reports</a>

                <a class="btn btn-light btn-lg btn-block border border-3 border-dark fw-bolder responsive-font-example" href="employees.php"
                    role="button">Employees</a>
                    <a class="btn btn-light btn-lg btn-block border border-3 border-dark fw-bolder responsive-font-example" href="leaveman.php" role="button" >Leave Management</a>
                <br>
                <a class="btn btn-light btn-lg btn-block border border-3 border-dark fw-bolder responsive-font-example" href="../login/login.php"
                    role="button">Log-out</a>
                <br><br>
                <br>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
</body>

</html>

<?php 
}else{
	header("Location: login/login.php");
} 
?>