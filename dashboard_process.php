<?php
require 'inc/dbconnect.php';

// Start or resume a session
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to the login page if not logged in
    exit();
}


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Retrieve the title
    $title = isset($_POST['title']) ? $_POST['title'] : '';

    // Check if a file is uploaded
    if (isset($_FILES['file'])) {
        
        // File details
        $file_name = $_FILES['file']['name'];
        $file_size = $_FILES['file']['size'];
        $file_tmp = $_FILES['file']['tmp_name'];
        $file_type = $_FILES['file']['type'];

        // Specify the upload directory
        $upload_directory = "uploads/";

        // Move the uploaded file to the specified directory
        $uploaded_file_path = $upload_directory . $file_name;
        move_uploaded_file($file_tmp, $uploaded_file_path);

        // Store the reference in the database using PDO
        try {
            // Assuming $pdo is your PDO connection instance from dbconnect.php
            $stmt = $pdo->prepare("INSERT INTO post (title, file_path) VALUES (:title, :file_path)");

            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':file_path', $uploaded_file_path);

            $stmt->execute();

            header('Location: dashboard.php');
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        // Display an error message if no file is uploaded
        echo "Error: No file uploaded";
    }
} else {
    // Display an error message if the form is not submitted
    echo "Error: Form not submitted";
}


// Check if a post removal is requested
if (isset($_GET['remove'])) {
$postIdToRemove = $_GET['remove'];

// Validate and process the removal as needed
$query = "DELETE FROM post WHERE id = :id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':id', $postIdToRemove);

if ($stmt->execute()) {
// Post removed successfully
header("Location: dashboard.php");
exit();
} else {
// Handle deletion error
echo "Error deleting post.";
exit();
}
}
?>