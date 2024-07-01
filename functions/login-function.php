<?php
include("db-conn.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {

  $myusername = mysqli_real_escape_string($conn,$_POST['email']);
  $mypassword = mysqli_real_escape_string($conn,$_POST['password']);

  $sql = "SELECT * FROM credentials WHERE email = '$myusername' and password = '$mypassword'";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
  $active = isset($row['active']);
  $count = mysqli_num_rows($result);

  $role = isset($row['role']);

    if($role == 'HR'){
        $link = '../hrms-inner/index.php';
    }
    elseif($role == 'Employee'){
        $link = '../emp-ms/index.php';
    }
    else{
        $link = '404.php';
    }

  if($count == 1) {
    $_SESSION['name'] = $row['name'];
        		$_SESSION['uid'] = $row['id'];
        		$_SESSION['role'] = $row['role'];

    header("Location: ".$link."");
    exit(); 
  }else {
     $error = "Your Login Name or Password is invalid";
  }
}
?>