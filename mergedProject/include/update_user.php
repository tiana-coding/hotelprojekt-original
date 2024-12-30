<?php
include 'header.php';
require_once '../config/dbaccess.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!$_SESSION['role'] || $_SESSION['role'] !== 'admin') {
    echo '<div class="alert alert-danger">Sie haben keine Berechtigung.</div>';
    exit();
}

// Überprüfen, ob user_id über GET übergeben wurde
if (!isset($_GET['user_id']) || intval($_GET['user_id']) <= 0) {
    die("Ungültige Benutzer-ID.");
}

$user_id = intval($_GET['user_id']);

// Benutzerinformationen aus der Datenbank abrufen
$sql = "SELECT user_id, username, useremail, role, status FROM users WHERE user_id = ?";
$stmt = $db_obj->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    die("Benutzer nicht gefunden.");
}

$user = $result->fetch_assoc();

// Formularverarbeitung
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $useremail = $_POST['useremail'] ?? '';
    $status = $_POST['status'] ?? '';

    if (!filter_var($useremail, FILTER_VALIDATE_EMAIL)) {
        echo '<div class="alert alert-danger">Ungültige E-Mail-Adresse.</div>';
    } elseif (!in_array($status, ['active', 'inactive'], true)) {
        echo '<div class="alert alert-danger">Ungültiger Status.</div>';
    } else {
        $update_sql = "UPDATE users SET useremail = ?, status = ? WHERE user_id = ?";
        $update_stmt = $db_obj->prepare($update_sql);
        $update_stmt->bind_param("ssi", $useremail, $status, $user_id);

        if ($update_stmt->execute()) {
            echo '<div class="alert alert-success">Benutzerdaten erfolgreich aktualisiert.</div>';
            header('Refresh: 2; URL=site_userverwaltung.php');
        } else {
            echo '<div class="alert alert-danger">Fehler beim Aktualisieren der Benutzerdaten.</div>';
        }

        $update_stmt->close();
    }
}

$stmt->close();
?>

<div class="container mt-5" style="max-width: 600px;">
    <h3 class="text-center mb-4">Benutzer bearbeiten</h3>
    <form method="POST" action="">
        <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['user_id']); ?>">

        <div class="mb-3">
            <label for="username" class="form-label">Benutzername</label>
            <input type="text" class="form-control" id="username" value="<?= htmlspecialchars($user['username']); ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="useremail" class="form-label">E-Mail-Adresse</label>
            <input type="email" class="form-control" id="useremail" name="useremail" value="<?= htmlspecialchars($user['useremail']); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label d-block">Status</label>
            <div class="form-check form-check-inline">
                <input type="radio" id="active" name="status" value="active" 
                       class="form-check-input" <?= $user['status'] === 'active' ? 'checked' : ''; ?>>
                <label for="active" class="form-check-label">Aktiv</label>
            </div>
            <div class="form-check form-check-inline">
                <input type="radio" id="inactive" name="status" value="inactive" 
                       class="form-check-input" <?= $user['status'] === 'inactive' ? 'checked' : ''; ?>>
                <label for="inactive" class="form-check-label">Inaktiv</label>
            </div>
        </div>
        <div class="mb-3">
            <a href="fct_pw_reset.php?user_id=<?= htmlspecialchars($user['user_id']); ?>" class="btn btn-secondary">Passwort zurücksetzen</a>
        </div>
        <button type="submit" class="btn btn-primary">Speichern</button>
        <a href="site_userverwaltung.php" class="btn btn-secondary">Zurück</a>
    </form>
</div>

<?php include 'footer.php'; ?>
