<?php
require 'inc/dbconnect.php';

// Retrieve the title from the query parameter
$title = isset($_GET['title']) ? urldecode($_GET['title']) : '';

// Fetch additional details for the selected title
try {
    $stmt = $pdo->prepare("SELECT * FROM post WHERE title = :title");
    $stmt->bindParam(':title', $title);
    $stmt->execute();
    $file = $stmt->fetch(PDO::FETCH_ASSOC);
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
    <title><?php echo $title; ?></title>
</head>

<body>



    <div class="container mt-5">
        <h2><?php echo $title; ?></h2>

        <?php if ($file): ?>
        <div class="card">
            <?php if (pathinfo($file['file_path'], PATHINFO_EXTENSION) === 'pdf'): ?>
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="<?php echo $file['file_path']; ?>" frameborder="0"></iframe>
            </div>
            <?php else: ?>
            <p>File Path: <?php echo $file['file_path']; ?></p>
            <?php endif; ?>
            <div class="card-body">
                <!-- Add more details as needed -->
            </div>
        </div>
        <?php else: ?>
        <p>No file found for the specified title.</p>
        <?php endif; ?>

    </div>

</body>

</html>