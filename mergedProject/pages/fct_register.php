<!--php-->

<?php 
include('../include/fct_session.php'); 

// Wenn das Formular abgesendet wurde
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Benutzereingaben validieren
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    // Einfaches Beispiel: Überprüfen, ob alle Felder ausgefüllt sind
    if (empty($username) || empty($email) || empty($password) || empty($password_confirm)) {
        echo "<p class='text-danger'>Alle Felder müssen ausgefüllt werden.</p>";
    }
    // Überprüfen, ob die Passwörter übereinstimmen
    elseif ($password !== $password_confirm) {
        echo "<p class='text-danger'>Die Passwörter stimmen nicht überein.</p>";
    }
    // E-Mail-Validierung
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<p class='text-danger'>Ungültige E-Mail-Adresse.</p>";
    } else {
        // Passwort sicher speichern (zum Beispiel Hashen)
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Benutzerdaten in der Session speichern (Simulieren eines Registrierungsprozesses ohne DB)
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $hashed_password; // Auch das Passwort wird gespeichert, aber sicher gehasht

        //echo "<p class='text-success'>Registrierung erfolgreich! Willkommen, " . htmlspecialchars($username) . ".</p>";
    }
}
?>

<!-- Sign up/Registrierungsformular -->
<?php include '../include/header.php';?>
  <!-- Navbar -->
<?php include '../include/nav.php';?>
<div  class="container-fluid my-5" style= "max-width:640px;">
  <h2 class="text-center">Kundenregistrierung</h2>
  <form class="container border rounded bg-grey border-shadow py-5 my-5" method="POST" action="site_register.php">
  
    <div class="mb-3">
      <label for="username" class="form-label">Username</label>
      <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">E-Mail</label>
      <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Passwort</label>
      <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <div class="mb-3">
      <label for="password_confirm" class="form-label">Passwort bestätigen</label>
      <input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
    </div>
    <button type="submit" class="btn btn-primary">Registrieren</button>
  </form>
</div>  
<div class="container-fluid my-5 py-4 bg-primary">
  <?php include '../include/footer.php';?>
</div>