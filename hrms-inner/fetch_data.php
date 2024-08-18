<?php
// fetch_data.php

// Database connection settings
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "hrms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch total applicants
$applicants_query = "SELECT COUNT(*) AS total_applicants FROM applications";
$applicants_result = $conn->query($applicants_query);
$applicants_row = $applicants_result->fetch_assoc();
$total_applicants = $applicants_row['total_applicants'];

// Fetch total employees on leave
$leave_query = "SELECT COUNT(*) AS total_leave FROM leaveapp WHERE status = 'approved'";
$leave_result = $conn->query($leave_query);
$leave_row = $leave_result->fetch_assoc();
$total_leave = $leave_row['total_leave'];

// Close connection
$conn->close();

// Return data as JSON
echo json_encode([
    'total_applicants' => $total_applicants,
    'total_leave' => $total_leave
]);
?>