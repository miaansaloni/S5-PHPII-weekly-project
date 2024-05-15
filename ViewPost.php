<?php
require_once './classes/UserManager.php';
require_once './db.php';
require_once './classes/Posts.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$id = $_GET['id'];

// Crea un'istanza della classe Posts
$postsManager = new Posts($conn);

// Ottieni il post dal database
$post = $postsManager->readPost($id);

if (!$post) {
    // Se il post non esiste, reindirizza alla dashboard
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Post</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/style.css">

</head>
<body>
    <div class="container mt-5">
        <h2><?php echo $post['title']; ?></h2>
        <p><strong>Director:</strong> <?php echo $post['director']; ?></p>
        <p><strong>Year:</strong> <?php echo $post['year']; ?></p>
        <p><?php echo $post['text']; ?></p>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
