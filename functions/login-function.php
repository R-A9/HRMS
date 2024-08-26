<?php
include("db-conn.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve and escape user input
    $myusername = mysqli_real_escape_string($conn, $_POST['email']);
    $mypassword = mysqli_real_escape_string($conn, $_POST['password']);

    // Store the email in session
    $_SESSION['gotmail'] = $myusername;

    // Query to check if the provided email and password exist in the database
    $sql = "SELECT * FROM credentials WHERE email = '$myusername' AND password = '$mypassword'";
    $result = mysqli_query($conn, $sql);

    // Check if the query returned exactly one row (user found)
    if(mysqli_num_rows($result) == 1) {
        // Fetch the user's details
        $row = mysqli_fetch_assoc($result);

        // Set session variables
        $_SESSION['name'] = $row['name'];
        $_SESSION['uid'] = $row['id'];
        $_SESSION['role'] = $row['role'];

        // Determine the role and set the appropriate redirect link
        if($row['role'] == 'HR') {
            $link = '../login/verify-otp.php';
        } elseif($row['role'] == 'Employee') {
            $link = '../login/verify-otp.php';
        } else {
            $link = '404.php';
        }

        // Redirect to the determined link
        header("Location: ".$link."");
        exit();
    } else {
        // If no matching record was found, set an error message
        $error = "Your Login Name or Password is invalid";
    }
}
?>
