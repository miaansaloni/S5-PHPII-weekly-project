<?php
session_start();

require_once './classes/UserManager.php';
require_once './db.php';
require_once './classes/Posts.php';

// Verifica se l'utente è autenticato
if (!isset($_SESSION['adminUser'])) {
    header("Location: login.php");
    exit;
}
$adminUser = $_SESSION['adminUser'];

// Crea un'istanza del gestore utente
$userManager = new UserManager($adminUser, null, $conn);

// Gestione del logout al click
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["logout"])) {
    $userManager->logout();
}

// Crea un'istanza della classe Posts
$postsManager = new Posts($conn);

// Gestione dell'eliminazione del post
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_id"])) {
    $delete_id = $_POST["delete_id"];
    if ($postsManager->deletePost($delete_id)) {
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Error deleting post.";
    }
}

// Ottieni tutti i post dal database
$posts = $postsManager->getAllPosts();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CinéCritique | Admin Dashboard</title>
    <!-- BOOTSTRAP TEMPORANEO -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/style.css">

</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <h2>Welcome, <?php echo $adminUser; ?>!</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <button type="submit" name="logout" class="btn btn-danger">Logout</button>
            </form>
        </div>
        
        <a href="createPost.php" class="btn btn-primary mt-3">Create New Post</a>
        
        
        
        <div class="mt-3">

            <h3>Post List</h3>
            
                <?php foreach ($posts as $post): ?>
                    <div class="row mb-2"> 
                        <div class="col"><h6><?php echo $post['title']; ?></h6></div>
                        <div class="col">
                            <a href="ViewPost.php?id=<?php echo $post['id']; ?>" class="btn btn-primary">View</a> 
                            <a href="updatePost.php?id=<?php echo $post['id']; ?>" class="btn btn-warning">Edit</a>
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" style="display: inline;">
                                <input type="hidden" name="delete_id" value="<?php echo $post['id']; ?>">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            
        </div>
    </div>

<!-- BOOTSTRAP TEMPORANEO -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
