<?php
require 'inc/dbconnect.php';

// Start or resume a session
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate user credentials
    $query = "SELECT * FROM user WHERE username = :username";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Set session variables
        $_SESSION['username'] = $user['username'];

        // Redirect to the dashboard
        header('Location: dashboard.php');
        exit();
    } else {
        echo 'Invalid username or password';
    }
}
?>