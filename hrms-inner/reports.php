<?php

require_once('../functions/db-conn.php');
$query = "select * from applications";
$result = mysqli_query($conn,$query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Bare - Start Bootstrap Template</title>
  <!-- Favicon-->
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
  <!-- Core theme CSS (includes Bootstrap)-->
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
        <a class="btn btn-lg btn-block border border-3 border-dark fw-bolder" href="application.html" role="button">Application</a>
        <a class="btn btn-light btn-lg btn-block border border-3 border-dark fw-bolder" href="reports.html" role="button" style='background-color: #4DC8D9;'>Reports</a>
        <a class="btn btn-light btn-lg btn-block border border-3 border-dark fw-bolder" href="employees.html" role="button">Employees</a>
        <a class="btn btn-light btn-lg btn-block border border-3 border-dark fw-bolder" href="leaveman.html" role="button">Leave Management</a>
        <br>
        <a class="btn btn-light btn-lg btn-block border border-3 border-dark fw-bolder" href="main-page.html" role="button">Log-out</a>
        <br><br>
        <br>
      </div>

      <!-- Flex container for fieldsets -->
      <div class="container">
        <div class="content">
        <div class="header">
          <h2 class="">Recruitment Reports</h2>  
      </div>
    </div>
        <div class="p-5 table-responsive">
          <table class="table table-bordered table-striped">
            <thead class="thead-dark">
              <tr>
                <th scope="col" class="text-center">ID</th>
                <th scope="col" class="text-center">Name</th>
                <th scope="col" class="text-center">E-mail</th>
                <th scope="col" class="text-center">Resume</th>
                <th scope="col" class="text-center">Role</th>
                <th scope="col" class="text-center">Contact Number</th>
                <th scope="col" class="text-center">Status</th>
                <th scope="col" class="text-center"></th>
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
                    <td class="text-center"><?php echo $row['date']; ?></td>
                    <td class="text-center"><?php echo $row['resume']; ?></td>
                    <td class="text-center"><?php echo $row['role']; ?></td>
                    <td class="text-center"><?php echo $row['contno']; ?></td>
                    <td class="text-center"><?php echo $row['status']; ?></td>
  
  
                    <td class="text-center">
      <form action="reports.php" method="POST">
      <input type="hidden" name="id" value="<?php echo $row['id']; ?>"/>
      <input type="submit" class='btn btn-primary' name="approve" value="approve">  
       <input type="submit" class='btn btn-danger' name="delete" value="decline"> 
  
      </form>
     </td>
                  </tr>
                  <?php 
                  }
                ?>
                </tr>
            </tbody>
          </table>
        </div>
      </div>
    
    

  <!-- Bootstrap core JS-->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
  <!-- Core theme JS-->
  <script src="js/scripts.js"></script>
</body>

</html>

<?php /*
}else{
	header("Location: ../login/login.php");
} */

 
if(isset($_POST['approve'])){

	$id = $_POST['id'];
	$select = "UPDATE applications SET status = 'approved' WHERE id = '$id' ";
	$resut = mysqli_query($conn,$select);
}


if(isset($_POST['delete'])){

	$id = $_POST['id'];
	$select = "UPDATE applications SET status = 'declined' WHERE id = '$id' ";
	$resut = mysqli_query($conn,$select);
}

 ?>