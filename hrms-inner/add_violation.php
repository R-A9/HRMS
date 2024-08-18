<?php
require_once('../functions/db-conn.php');
session_start();

if (isset($_SESSION['role']) == "Employee") {
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $date = date("Y/m/d");
    $query = "INSERT INTO viol (name, title, description, date) VALUES ('$name', '$title', '$description', '$date')";

    if (mysqli_query($conn, $query)) {
      header("Location: violations.php?success=1");
    } else {
      echo "Error: " . mysqli_error($conn);
    }
  }
} else {
  header("Location: ../login/login.php");
}
?>