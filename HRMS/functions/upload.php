<?php
// Define allowed file extensions
$allowedExtensions = ["pdf", "doc", "docx"];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Check if a file was uploaded
  if (isset($_FILES['file'])) {
    $fileName = $_FILES['file']['name'];
    $fileSize = $_FILES['file']['size'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $uploadDir = 'uploads/';

    // Check for upload errors
    if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
      echo "Upload error: " . $_FILES['file']['error'];
      exit();
    }

    // Check file size limit (optional)
    if ($fileSize > 5000000) { // 5 MB limit
      echo "Sorry, your file is too large.";
      exit();
    }

    // Check allowed file types
    if (!in_array($fileType, $allowedExtensions)) {
      echo "Sorry, only PDF, DOC, and DOCX files are allowed.";
      exit();
    }

    // Create uploads directory if it doesn't exist
    if (!is_dir($uploadDir)) {
      mkdir($uploadDir, 0755, true);
    }

    // Generate a unique filename to prevent conflicts
    $newFileName = uniqid('', true) . '.' . $fileType;
    $uploadFile = $uploadDir . $newFileName;

    // Move uploaded file to the destination directory
    if (move_uploaded_file($fileTmpName, $uploadFile)) {
      echo "The file " . htmlspecialchars($fileName) . " has been uploaded successfully.";
      // You can further process the uploaded file here (e.g., store filename in database)
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  } else {
    echo "No file selected.";
  }
} else {
  echo "Invalid request method.";
}
?>