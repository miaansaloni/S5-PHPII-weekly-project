<?php
require_once './db.php';
require_once './classes/Posts.php';

// Verifica se l'utente è autenticato
session_start();
if (!isset($_SESSION['adminUser'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $director = $_POST['director'];
    $year = $_POST['year'];
    $summary = $_POST['summary'];
    $review = $_POST['review'];

    $postsManager = new Posts($conn);

    // Creazione del post nel database
    if ($postsManager->createPost($title, $director, $year, $summary, $review)) {
        // Redirect alla dashboard dopo la creazione del post
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Failed to create post.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CinéCritique | Create New Post</title>
    <!-- BOOTSTRAP TEMPORANEO -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/style.css">

</head>
<body>
    <div class="container mt-5">
        <h2>Create New Post</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="director">Director:</label>
                <input type="text" class="form-control" id="director" name="director" required>
            </div>
            <div class="form-group">
                <label for="year">Year:</label>
                <input type="number" class="form-control" id="year" name="year" required>
            </div>
            <div class="form-group">
                <label for="summary">Summary:</label>
                <textarea class="form-control" id="text" name="summary" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label for="review">Review:</label>
                <textarea class="form-control" id="text" name="review" rows="5" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>

    <!-- BOOTSTRAP TEMPORANEO -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
