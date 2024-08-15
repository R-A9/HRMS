<?php
require_once('../functions/db-conn.php');
session_start();

if (isset($_SESSION['role']) == "Employee") {
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);

    $query = "INSERT INTO viol (name, description, date) VALUES ('$name', '$description', '$date')";

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