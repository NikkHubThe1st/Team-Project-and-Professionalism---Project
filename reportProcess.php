<?php
session_start();
require_once 'functions.php';

// Check if the user is logged in
sessionCheck();

// Database connection
$conn = getConnection();

// Get logged-in user ID
$user_id = $_SESSION['user_id'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category = $_POST['category'];
    $description = $_POST['description'];
    $attachment_path = null;

    // Handle file upload
    if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/'; // Ensure this directory exists and is writable
        $attachment_path = $upload_dir . basename($_FILES['attachment']['name']);
        
        if (!move_uploaded_file($_FILES['attachment']['tmp_name'], $attachment_path)) {
            die('File upload failed. Please try again.');
        }
    }

    // Insert report into the database
    $sql = "INSERT INTO reports (user_id, category, description, attachment_path) VALUES (:user_id, :category, :description, :attachment_path)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':category', $category, PDO::PARAM_STR);
    $stmt->bindParam(':description', $description, PDO::PARAM_STR);
    $stmt->bindParam(':attachment_path', $attachment_path, PDO::PARAM_STR);

    if ($stmt->execute()) {
        echo "Report submitted successfully.";
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Failed to submit the report. Please try again.";
    }
} else {
    echo "Invalid request.";
}