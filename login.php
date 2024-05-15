<?php
session_start();

require_once './classes/UserManager.php';
require_once 'db.php';

// Verifica se l'utente è già autenticato
if (isset($_SESSION['adminUser'])) {
    header("Location: dashboard.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["login"])) {
        // Login utente
        $adminUser = $_POST["adminUser"];
        $password = $_POST["password"];

        $user = new UserManager($adminUser, $password, $conn);
        if ($user->login()) {
            // Autenticazione riuscita, reindirizza alla pagina protetta
            $_SESSION['adminUser'] = $adminUser;
            header("Location: dashboard.php");
            exit;
        }
    } elseif (isset($_POST["register"])) {
        // Registrazione utente
        $adminUser = $_POST["adminUser"];
        $password = $_POST["password"];

        $user = new UserManager($adminUser, $password, $conn);
        $user->register();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CinéCritique | Login</title>
        <!-- BOOTSTRAP TEMPORANEO -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/style.css">
</head>
<body>
    <div class="container">
        <?php if (!isset($_GET["register"]) && !isset($_POST["register"])): ?>
            <h2 class="text-center">Login</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label for="adminUser">Username:</label>
                    <input type="text" class="form-control" name="adminUser" id="adminUser" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
                <button type="submit" name="login" class="btn btn-primary btn-block">Log in</button>
            </form>
            <br>
            <p class="text-center">Don't have an account? <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?register=true">Sign up</a>.</p>
        <?php else: ?>
            <h2 class="text-center">Sign up!</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label for="adminUser">Username:</label>
                    <input type="text" class="form-control" name="adminUser" id="adminUser" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
                <button type="submit" name="register" class="btn btn-primary btn-block">Sign up</button>
            </form>
            <br>
            <p class="text-center">Are you a member already? <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">Log in</a>.</p>
        <?php endif; ?>
    </div>
    <!-- BOOTSTRAP TEMPORANEO -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
