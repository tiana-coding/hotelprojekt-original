<?php
session_start();

$admin_username = "yueting";
$admin_password_hash = password_hash("yueting", PASSWORD_DEFAULT);

$errors = "";

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === $admin_username && password_verify($password, $admin_password_hash)) {
        // Set admin session
        $_SESSION['is_admin'] = true;
        $_SESSION['admin_username'] = $username;
        header('Location: news_upload.php');
        exit();
    } else {
        $errors = "Invalid username or password.";
    }
}
?>

<?php include("include/header.php"); ?>
<?php include("include/nav.php"); ?>
    <div class="container">
        <h1>Admin Login</h1>
        <?php if ($errors): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($errors) ?></div>
        <?php endif; ?>

        <form action="admin_login.php" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
<?php include('include/footer.php');?>