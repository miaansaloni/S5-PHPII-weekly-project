<?php
session_start();

require_once './classes/UserManager.php';
require_once './db.php';
require_once './classes/Posts.php';


// Crea un'istanza della classe Posts
$postsManager = new Posts($conn);

// Ottieni tutti i post dal database
$posts = $postsManager->getAllPosts();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CinéCritique</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

    <div class="container mt-5">
    <h1>Welcome to CinéCritique</h1>
        <!-- <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <button type="submit" name="logout" class="btn btn-danger">Logout</button>
        </form> -->
        
        <a href="login.php" class="btn btn-primary mt-3">Login</a>
        
        <div class="mt-3">
            <h3>Post List</h3>

            <?php foreach ($posts as $post): ?>
                    <div class="row mb-2"> 
                        <div class="col"><h6><?php echo $post['title']; ?></h6></div>
                        <div class="col">
                            <a href="ViewPost.php?id=<?php echo $post['id']; ?>" class="btn btn-primary">View</a> 
                        </div>
                    </div>
                <?php endforeach; ?>
          
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
