<?php
// Include your database connection script
require_once('../functions/db-conn.php');

// Check if POST data (id and status) is received
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id']) && isset($_POST['status'])) {
    // Sanitize input to prevent SQL injection
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    // Update query
    $query = "UPDATE applications SET status = '$status' WHERE id = '$id'";

    // Execute query
    if (mysqli_query($conn, $query)) {
        // Send a success response
        http_response_code(200);
        echo "Status updated successfully";
    } else {
        // Send a server error response
        http_response_code(500);
        echo "Error updating status: " . mysqli_error($conn);
    }
} else {
    // Send a bad request response if data is not received properly
    http_response_code(400);
    echo "Bad request - id and status parameters are required";
}

// Close database connection
mysqli_close($conn);
?>