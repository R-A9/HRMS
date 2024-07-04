<?php

require_once('../functions/db-conn.php'); // Replace with your database connection file

// Initialize variables
$fullName = "";
$email = "";
$contactNo = "";
$availableDate = "";
$role = "";
$cv = "";
$status = "pending";
$errors = array(); // Array to hold registration errors

// Check if form is submitted
if (isset($_POST['register'])) {

  // Validate form data
  $fullName = trim($_POST['fullName']);
  if (empty($fullName)) {
    $errors[] = "Full name is required";
  }

  $email = trim($_POST['email']);
  if (empty($email)) {
    $errors[] = "Email address is required";
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format";
  }

  $contactNo = trim($_POST['contactNo']);
  if (empty($contactNo)) {
    $errors[] = "Contact number is required";
  }

  $availableDate = trim($_POST['availableDate']);
  if (empty($availableDate)) {
    $errors[] = "Available date is required";
  }

  $role = trim($_POST['role']);
  if ($role == "") {
    $errors[] = "Please select a role";
  }

  // Validate CV upload (replace with more robust validation)
  $cv = $_FILES['cv'];
  $allowed_extensions = array('pdf');
  if ($cv['error'] === 0) {
    $extension = pathinfo($cv['name'], PATHINFO_EXTENSION);
    if (!in_array($extension, $allowed_extensions)) {
      $errors[] = "Only PDF files are allowed for CV upload";
    }
  } else {
    $errors[] = "CV upload failed";
  }

  // If no errors, proceed with registration logic
  if (empty($errors)) {
    // Generate a random filename for uploaded CV
    $cv_filename = md5(time() . rand()) . '.' . $extension;

    // Define target directory for uploaded CVs (replace with your desired location)
    $target_dir = "uploads/";
    $target_file = $target_dir . $cv_filename;

    // Move uploaded CV to target directory
    if (move_uploaded_file($cv['tmp_name'], $target_file)) {
      // Prepare SQL query for registration (replace with your table structure)
      $sql = "INSERT INTO applications (flname, email, date, resume, role, contno, status) VALUES (?, ?, ?, ?, ?, ?, ?)";

      $stmt = mysqli_prepare($conn, $sql);
      mysqli_stmt_bind_param($stmt, "ssssss", $fullName, $email, $contactNo, $availableDate, $role, $cv_filename, $status);
      mysqli_stmt_execute($stmt);

      if (mysqli_stmt_affected_rows($stmt) == 1) {
        // Registration successful, redirect or display confirmation message
        echo "Registration successful!";
      } else {
        $errors[] = "Registration failed! Please try again.";
      }

      mysqli_stmt_close($stmt);
    } else {
      $errors[] = "Error uploading CV";
    }
  }
}

// Close database connection
mysqli_close($conn);

?>