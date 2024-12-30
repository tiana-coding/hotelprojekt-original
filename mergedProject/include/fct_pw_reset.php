<?php
include 'header.php';
require_once '../config/dbaccess.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Prüfen, ob der angemeldete Benutzer Adminrechte hat
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo '<div class="alert alert-danger">Sie haben keine Berechtigung, Benutzerpasswörter zurückzusetzen.</div>';
    exit();
}

// Überprüfen, ob die `user_id` über GET übergeben wurde
if (!isset($_GET['user_id']) || intval($_GET['user_id']) <= 0) {
    die("Ungültige Benutzer-ID.");
}

$user_id = intval($_GET['user_id']);

// Benutzerinformationen aus der Datenbank abrufen
$sql = "SELECT username FROM users WHERE user_id = ?";
$stmt = $db_obj->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    die("Benutzer nicht gefunden.");
}

$user = $result->fetch_assoc();
$stmt->close();

// Formularverarbeitung
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_password = $_POST['new_password'] ?? '';

    if (empty($new_password)) {
        echo '<div class="alert alert-danger">Das Passwort darf nicht leer sein.</div>';
    } else {
        // Passwort hashen
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

        // Passwort in der Datenbank aktualisieren
        $update_sql = "UPDATE users SET password = ? WHERE user_id = ?";
        $update_stmt = $db_obj->prepare($update_sql);

        if (!$update_stmt) {
            echo '<div class="alert alert-danger">Datenbankfehler: ' . htmlspecialchars($db_obj->error) . '</div>';
            exit();
        }

        $update_stmt->bind_param("si", $hashed_password, $user_id);

        if ($update_stmt->execute()) {
            echo '<div class="alert alert-success">Das Passwort wurde erfolgreich zurückgesetzt.</div>';
            echo '<p><strong>Benutzer:</strong> ' . htmlspecialchars($user['username']) . '</p>';
        } else {
            echo '<div class="alert alert-danger">Fehler beim Zurücksetzen des Passworts.</div>';
        }

        $update_stmt->close();
    }
}
?>

<div class="container mt-5" style="max-width: 600px;">
    <h3 class="text-center mb-4">Passwort zurücksetzen</h3>
    <p>Benutzer: <strong><?= htmlspecialchars($user['username']); ?></strong></p>
    <form method="POST" action="fct_pw_reset.php?user_id=<?= htmlspecialchars($user_id); ?>">
        <div class="mb-3">
            <label for="new_password" class="form-label">Neues Passwort</label>
            <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Neues Passwort eingeben" required>
        </div>
        <button type="submit" class="btn btn-primary">Passwort speichern</button>
        <a href="site_userverwaltung.php" class="btn btn-secondary">zurück</a>
    </form>
</div>

<?php include 'footer.php'; ?>
