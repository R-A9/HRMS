<?php 
   session_start();
   if (!isset($_SESSION['username']) && !isset($_SESSION['id'])) { 

  ?>
<!DOCTYPE html>
<html>
<head>
	<title>multi-user role-based-login-system</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<script src="https://kit.fontawesome.com/91f04e1fcd.js" crossorigin="anonymous"></script>
<style>

</style>
</head>

<body>


      <div class="container d-flex justify-content-center align-items-center"
      style="min-height: 100vh">

      	<form class=" p-3  rounded"
      	      action="otp-generator.php" 
      	      method="post" 
      	      style="width: 500px;">
      	      <h1 class="text-center pb-5 pt-3">Atlas IT Solutions Login</h1>
      	      <?php if (isset($_GET['error'])) { ?>
      	      <div class="alert alert-danger" role="alert">
				  <?=$_GET['error']?>
			  </div>
			  <?php } ?>
		  <div class="mb-3">
		    <label for="username" 
		           class="form-label">E-mail</label>
		    <input type="text" 
		           class="form-control" 
		           name="email" 
		           id="username">
		  </div>
		  <div class="mb-3">
		    <label for="password" 
		           class="form-label">Password</label>
		    <input type="password" 
		           name="password" 
		           class="form-control" 
		           id="password">
		  </div>
		 
		  <center><button type="submit" 
		          class="btn btn-primary">LOGIN</button></center>

				<center><p class="pt-4">Going back to main page? Click <a href="../hrms-inner/main-page.html">here</a></></center>
		</form>
      </div>

</body>
</html>
<?php 
}else{
	header("Location: home.php");
}


?>