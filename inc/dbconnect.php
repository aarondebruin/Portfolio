<?php 

$host = 'localhost';
$dbname = 'portfolio';
$username = 'root';
$password = 'root';

try {
    // Establish a connection to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>