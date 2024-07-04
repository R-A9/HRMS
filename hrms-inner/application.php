<?php

require_once('../functions/db-conn.php');
$query = "select * from applications";
$result = mysqli_query($conn,$query);
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
  <title>ATLAS</title>
  <!-- Favicon-->
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="../css/styles.css" rel="stylesheet" />
  <style>
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

        tbody{
          height:150px;
          overflow:auto;
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
</head>

<body>
  <!-- Responsive navbar-->
  <nav class="navbar navbar-expand-lg navbar-light border-bottom">
    <a class="navbar-brand" href="#">
        <img src="../images/atlas2.png" style="width:50px; height:50px;" alt="Atlas IT Solutions">
        Atlas IT Solutions
    </a>
</nav>
  <!-- End of untouchable code, everything below this is subject to change -->


  <!-- Page content-->
  <div class="container-fluid">
    <div class="d-flex">
        <div class="text-center w-25 h-100 d-grid p-3 gap-4 col-md-auto" style="background-color:#D9D9D9; word-wrap:break-word; overflow:auto;">
            <p class="lead pt-3">Management System</p>
            <p>v1.0.0</p>
            <a class="btn btn-lg btn-block border border-3 border-dark fw-bolder" href="application.php" role="button" style='background-color: #4DC8D9;'>Application</a>
            <a class="btn btn-light btn-lg btn-block border border-3 border-dark fw-bolder" href="reports.php" role="button">Reports</a>
            <a class="btn btn-light btn-lg btn-block border border-3 border-dark fw-bolder" href="employees.php" role="button">Employees</a>
            <a class="btn btn-light btn-lg btn-block border border-3 border-dark fw-bolder" href="leaveman.php" role="button">Leave Management</a>
            <br>
            <a class="btn btn-light btn-lg btn-block border border-3 border-dark fw-bolder" href="main-page.html" role="button">Log-out</a>
            <br><br>
            <br>
          </div>

        
      <div class='col'>

<body>
  <div class="content">
    <div class="header">
      <h2 class="">Application</h2>  
  </div>
</div>
<div class="p-5 table-responsive">
          <table class="table table-bordered table-striped">
            <thead class="thead-dark">
              <tr>
                <th scope="col" class="text-center">ID</th>
                <th scope="col" class="text-center">Name</th>
                <th scope="col" class="text-center">E-mail</th>
                <th scope="col" class="text-center">Contact Number</th>
              </tr>
            </thead>
            <tbody>
            <tr>
                
                <?php
  
                  while($row = mysqli_fetch_assoc($result))
                  {
                    ?>
                    <td class="text-center"><?php echo $row['id']; ?></td>
                    <td class="text-center"><?php echo $row['flname']; ?></td>
                    <td class="text-center"><?php echo $row['email']; ?></td>
                    <td class="text-center"><?php echo $row['contno']; ?></td>
                  </tr>
                  <?php 
                  }
                ?>
                </tr>
            </tbody>
          </table>
        </div>
</div>

<!-- Modal 1 -->
<div class="modal fade" id="statusModal1" tabindex="-1" aria-labelledby="statusModalLabel1" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="statusModalLabel1">Application Details: John Doe</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <p><strong>CV: &nbsp;</strong><button type="button" class="btn btn-primary" data-dismiss="modal">View CV</button></p>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>
</div>

</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>


  <!-- Bootstrap core JS-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Core theme JS-->
  <script src="js/scripts.js"></script>
</body>

</html>
<?php
}else{
	header("Location: ../login/login.php");
} ?>