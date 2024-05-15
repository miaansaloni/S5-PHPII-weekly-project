<?php
session_start();

require_once './db.php';
require_once './classes/Posts.php';

// Verifica se l'utente è autenticato
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Verifica se l'ID del post è stato passato correttamente
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

// Crea un'istanza della classe Posts
$postsManager = new Posts($conn);

// Ottieni l'ID del post dalla query string
$postId = $_GET['id'];

// Verifica se il form è stato inviato
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se tutti i campi sono stati compilati
    if (isset($_POST['title']) && isset($_POST['director']) && isset($_POST['year']) && isset($_POST['summary']) && isset($_POST['review'])) {
        $title = $_POST['title'];
        $director = $_POST['director'];
        $year = $_POST['year'];
        $summary = $_POST['summary'];
        $review = $_POST['review'];

        // Aggiorna il post nel database
        if ($postsManager->updatePost($postId, $title, $director, $year, $summary, $review)) {
            // Redirect alla dashboard dopo l'aggiornamento del post
            header("Location: dashboard.php");
            exit;
        } else {
            // Gestisci eventuali errori
            $error = "Errore durante l'aggiornamento del post.";
        }
    } else {
        $error = "Si prega di compilare tutti i campi.";
    }
}

// Ottieni le informazioni del post dal database
$post = $postsManager->readPost($postId);

// Verifica se il post esiste
if (!$post) {
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Post</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/style.css">

</head>
<body>
    <div class="container mt-5">
        <h2>Update Post</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $postId; ?>" method="post">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($post['title']); ?>">
            </div>
            <div class="form-group">
                <label for="director">Director:</label>
                <input type="text" class="form-control" id="director" name="director" value="<?php echo htmlspecialchars($post['director']); ?>">
            </div>
            <div class="form-group">
                <label for="year">Year:</label>
                <input type="text" class="form-control" id="year" name="year" value="<?php echo htmlspecialchars($post['year']); ?>">
            </div>
            <div class="form-group">
                <label for="summary">Summary:</label>
                <textarea class="form-control" id="summary" name="summary"><?php echo htmlspecialchars($post['summary']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="review">Review:</label>
                <textarea class="form-control" id="review" name="review"><?php echo htmlspecialchars($post['summary']); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
