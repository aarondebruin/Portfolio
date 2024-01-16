<?php
require 'inc/dbconnect.php';

// Fetch titles from the database
try {
    $stmt = $pdo->prepare("SELECT title FROM post");
    $stmt->execute();
    $titles = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Index Page</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Aaron de Bruin</a>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <!-- Add other navigation items here if needed -->
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Titles</h2>

        <?php foreach ($titles as $title): ?>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">
                    <a href="view_page.php?title=<?php echo urlencode($title['title']); ?>">
                        <?php echo $title['title']; ?>
                    </a>
                </h5>
            </div>
        </div>
        <?php endforeach; ?>

    </div>

</body>

</html>