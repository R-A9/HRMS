<?php
include("../functions/db-conn.php");
session_start();

$error = '';  // Initialize error message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve and escape user input
    $myusername = mysqli_real_escape_string($conn, $_POST['email']);
    $mypassword = mysqli_real_escape_string($conn, $_POST['password']);

    // Store the email in session
    $_SESSION['gotmail'] = $myusername;

    // Query to check if the provided email and password exist in the database
    $sql = "SELECT * FROM credentials WHERE email = '$myusername' AND password = '$mypassword'";
    $result = mysqli_query($conn, $sql);

    // Check if the query returned exactly one row (user found)
    if (mysqli_num_rows($result) == 1) {
        // Fetch the user's details
        $row = mysqli_fetch_assoc($result);

        // Set session variables
        $_SESSION['name'] = $row['name'];
        $_SESSION['uid'] = $row['id'];
        $_SESSION['role'] = $row['role'];

        // Determine the role and set the appropriate redirect link
        if ($row['role'] == 'HR' || $row['role'] == 'Employee') {
            $link = '../login/verify-otp.php';
        } else {
            $link = '404.php';
        }

        // Redirect to the determined link
        header("Location: " . $link);
        exit();
    } else {
        // If no matching record was found, set an error message
        $error = "Invalid email or password. Please try again.";
    }
}
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
      	      <?php
    // Display error message if set
    if (!empty($error)) {
        echo "<p style='color:red;'>$error</p>";
    }
    ?>
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

