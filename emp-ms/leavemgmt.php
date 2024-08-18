<?php
 session_start();

 require_once('../functions/db-conn.php');

 $sql="SELECT * FROM leaveapp WHERE status='pending' OR status='approved' AND employee_name='".$_SESSION['name']."' ";
 $result = mysqli_query($conn,$sql);



 if (isset($_SESSION['role'])) {
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
  </style>
</head>

<body>
  <!-- Responsive navbar-->
  <nav class="navbar navbar-light py-0 navbar-expand-lg fixed-top pb-3">
    <div class="container-fluid">
      <img src="../images/atlas2.png" style="width: 50px; height: 50px;">
      <a class="navbar-brand" href="#">ATLAS-HRMS</a>
      <div class="d-flex order-lg-1 ml-auto pr-2">
        <!-- !!!!!!!!!!Everything below this comment, wag niyong pakikialaman!!!!!!!!!!!!!! -->
        <span class="dot" style="color:white; padding-right: 5px;"></span>
        <a href="#" class="navbar-text"><i class="fa fa-shopping-cart fa-lg" style="color: white;"></i></a>
        <ul class="navbar-nav flex-row to-hide-nav">
          <li class="nav-item mx-2 mx-lg-0">
            <a class="nav-link" href="#"></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"></a>
          </li>
        </ul>
      </div>

      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#"><span class="sr-only"></span></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- End of untouchable code, everything below this is subject to change -->

  <!-- Page content-->
  <div class="container-fluid pt-5">
    <div class="d-flex">
      <div class="text-center w-25 h-100 d-grid p-2 gap-4 col-md-auto" style="background-color:#D9D9D9; word-wrap:break-word; overflow:auto;">
        <p class="lead pt-3">Management System</p>
        <p>v1.0.0</p>
        <a class="btn btn-light btn-lg btn-block border border-3 border-dark fw-bolder" href="leave.php"  role="button">Leave Application</a>
        <a class="btn btn-light btn-lg btn-block border border-3 border-dark fw-bolder" href="leavemgmt.html" style="background-color: #4DC8D9;" role="button">Leave Mgmt.
        </a>
        <br>
        <a class="btn btn-light btn-lg btn-block border border-3 border-dark fw-bolder" href="../hrms-inner/main-page.html" role="button">Log-out</a>
        <br><br>
        <br>
      </div>

      <!-- Flex container for fieldsets -->
      <div class="flex-grow-1 p-4">
      <h1>Leave Management</h1>
      <hr>
        <!-- Start main code -->
        <div class="container d-flex justify-content-center">
          <div class="p-4 w-100" style="max-width: 700px;">

          <div class="p-5 table-responsive">
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
            <tr>
                
                <?php
  
                  while($row = mysqli_fetch_assoc($result))
                  {
                    ?>
                    <td class="text-center"><?php echo $row['id']; ?></td>
                    <td class="text-center"><?php echo $row['employee_name']; ?></td>
                    <td class="text-center"><?php echo $row['sdate']; ?></td>
                    <td class="text-center"><?php echo $row['edate']; ?></td>
                    <td class="text-center"><?php echo $row['reason']; ?></td>
                    <td class="text-center"><?php echo $row['status']; ?></td>
  

     </td>
                  </tr>
  <!-- Bootstrap core JS-->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
  <!-- Core theme JS-->
  <script src="../js/scripts.js"></script>
</body>

</html>
<?php 
}}else{
	header("Location: ../login/login.php");
} 
?>