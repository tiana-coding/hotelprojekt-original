<?php
session_start();

// Anmeldeprozess
if (isset($_POST['username']) && isset($_POST['password'])) {
    // Hier wird angenommen, dass du den Benutzernamen und das Passwort überprüfst
    // Beispiel:
    if ($_POST['username'] == 'admin' && $_POST['password'] == '1234') {
        $_SESSION['username'] = $_POST['username'];  // Speichern des Benutzernamens in der Session
        // Nach erfolgreichem Login Weiterleitung zu index.php
        header('Location: index.php');
        exit();
    } else {
        echo "Ungültige Anmeldedaten.";
    }
}
?>


<h2>Login</h2>
<form method="POST" action="site_login.php">
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

