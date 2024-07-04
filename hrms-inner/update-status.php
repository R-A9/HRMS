<?php
// Initialize database connection
require_once('../functions/db-conn.php');

// PHP script to handle AJAX request and update status in the database
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id']) && isset($_POST['status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];

    // Update status in the database
    $query = "UPDATE applications SET status = '$status' WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if ($status == 'approved' && isset($_POST['flname']) && isset($_POST['email']) && isset($_POST['role']) && isset($_POST['contno'])) {
            $flname = $_POST['flname'];
            $email = $_POST['email'];
            $role = 'Employee'; // Set role to Employee
            $contno = $_POST['contno'];

            // Insert data into credentials table with password set to '1234'
            $password = '1234';
            $query = "INSERT INTO credentials (email, password, name, role, contno) VALUES ('$email', '$password', '$flname', '$role', '$contno')";
            $result = mysqli_query($conn, $query);

            if ($result) {
                http_response_code(200); // Success
            } else {
                http_response_code(500); // Server error
            }
        } else {
            http_response_code(200); // Success for status update only
        }
    } else {
        http_response_code(500); // Server error
    }
} else {
    http_response_code(400); // Bad request
}
?>