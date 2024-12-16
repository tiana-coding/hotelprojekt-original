<?php 
include('fct_session.php'); 

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

<!DOCTYPE html>
<html>
<head>
<title>Hotel Projekt</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel= "stylesheet" href="style.css">
</head>
<body>
<?php include 'navbar.php';?>
<h1>Registrierung</h1>
<?php include 'fct_register.php';?>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
