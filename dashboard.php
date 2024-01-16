<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to the login page if not logged in
    exit();
}

require 'inc/dbconnect.php';
include 'inc/css.php';

// Fetch existing posts from the database
$query = "SELECT * FROM post";
$stmt = $pdo->query($query);
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <h3>Maak een item aan</h3>
    <form action="dashboard_process.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Titel</label>
            <input name="title" type="text" class="form-control" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Bestand uploaden</label>
            <input name="file" class="form-control" type="file" id="formFile">
        </div>
        <button type="submit" class="btn btn-primary">Verzenden</button>
    </form>

    <!-- Display existing posts with remove option -->
    <h3>Bestaande items</h3>
    <ul>
        <?php foreach ($posts as $post): ?>
        <li>
            <?php echo $post['title']; ?>
            <a href="dashboard_process.php?remove=<?php echo $post['id']; ?>">Remove</a>
        </li>
        <?php endforeach; ?>
    </ul>
</div>