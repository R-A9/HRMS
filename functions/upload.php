<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hrms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['flname']);
    $email = htmlspecialchars($_POST['email']);
    $date = htmlspecialchars($_POST['date']);
    $uploadDir = 'uploads/';

    // Ensure the uploads directory exists
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $uploadFile = $uploadDir . basename($_FILES['resume']['name']);
    $fileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

    // Check if the file is a valid type
    $validTypes = array('pdf', 'doc', 'docx');
    if (in_array($fileType, $validTypes)) {
        if (move_uploaded_file($_FILES['resume']['tmp_name'], $uploadFile)) {
            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO applications (name, email, date, resume) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("sss", $name, $email, $date, $uploadFile);

            if ($stmt->execute()) {
                echo "The file " . htmlspecialchars(basename($_FILES['resume']['name'])) . " has been uploaded and data inserted into the database.<br>";
                echo "Name: $name<br>Email: $email<br>";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "Invalid file type. Only PDF, DOC, and DOCX files are allowed.";
    }
} else {
    echo "Invalid request method.";
}

$conn->close();
?>