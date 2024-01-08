<?php 
require 'inc/dbconnect.php';


if($_SERVER['REQUEST_METHOD']  === 'POST' ){
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    try {
        $stmt = $pdo->prepare("INSERT INTO user (username, password) VALUES (?, ?)");
        $stmt->execute([$username,$password]);
        
        echo "Registration successful!";

    } 
    catch (PDOException $e) {
        echo $e->getMessage();
    }
}



?>