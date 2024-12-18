<?php
session_start();

// Anmeldeprozess
if (isset($_POST['username']) && isset($_POST['password'])) {
    // Hier wird angenommen, dass du den Benutzernamen und das Passwort überprüfst
    // Beispiel:
    if ($_POST['username'] == 'username' && $_POST['password'] == 'password') {
        $_SESSION['username'] = $_POST['username'];  // Speichern des Benutzernamens in der Session
        // Nach erfolgreichem Login Weiterleitung zu index.php
        header('Location: index.php');
        exit();
    } else {
        echo "Ungültige Anmeldedaten.";
    }
}
?>

<!-- login -->
<?php include '../include/header.php';?>
<?php include '../include/nav.php';?>
<div class="container-fluid my-5" >
  <h2 class="text-center">Login</h2>
  <form class="container border rounded bg-grey border-shadow py-5 my-5" style= "max-width:640px;" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div class="mb-3">
      <label for="username" class="form-label">Username</label>
      <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Passwort</label>
      <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
  </form>
</div> 
<div class="container-fluid my-5 py-4 bg-primary">
  <?php include '../include/footer.php';?>
</div>
