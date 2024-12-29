<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
;
include 'fct_session.php';
require_once '../config/dbaccess.php';
include 'header.php';


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Feedback-Meldungen
if (isset($_GET['message'])) {
    switch ($_GET['message']) {
        case 'success':
            echo '<div class="alert alert-success">Aktion erfolgreich ausgeführt.</div>';
            break;
        case 'deleted':
            echo '<div class="alert alert-success">Benutzer wurde erfolgreich gelöscht.</div>';
            break;
        case 'password_reset':
            echo '<div class="alert alert-success">Das Passwort wurde erfolgreich zurückgesetzt.</div>';
            break;
        case 'error':
            echo '<div class="alert alert-danger">Fehler bei der Ausführung der Aktion.</div>';
            break;
        case 'invalid_request':
            echo '<div class="alert alert-warning">Ungültige Anfrage. Bitte versuchen Sie es erneut.</div>';
            break;
    }
    echo "<script>window.history.replaceState(null, null, window.location.pathname);</script>";
}

// Benutzerliste abrufen
$sql = "SELECT user_id, username, role, anrede, vorname, nachname, status, created_at, updated_at FROM users ORDER BY created_at DESC";
$stmt = $db_obj->prepare($sql);
if (!$stmt) {
    die('<div class="alert alert-danger">Fehler beim Abrufen der Benutzerdaten: ' . htmlspecialchars($db_obj->error) . '</div>');
}
$stmt->execute();
$result = $stmt->get_result();
$users = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<div class="container mt-5">
    <h1 class="text-center my-3">Benutzerverwaltung</h1>
    <?php if (!empty($users)): ?>
        <table class="table table-bordered mt-3">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Benutzer-ID</th>
                    <th>Benutzername</th>
                    <th>Rolle</th>
                    <th>Anrede</th>
                    <th>Vorname</th>
                    <th>Nachname</th>
                    <th>Status</th>
                    <th>Erstellt am</th>
                    <th>Aktualisiert am</th>
                    <th>Status ändern</th>
                    <th>Passwort zurücksetzen</th>
                    <th>Benutzer löschen</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $index => $user): ?>
                    <tr>
                        <th scope="row"><?= $index + 1 ?></th>
                        <td><?= htmlspecialchars($user['user_id'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($user['role'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($user['anrede'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($user['vorname'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($user['nachname'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($user['status'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($user['created_at'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($user['updated_at'], ENT_QUOTES, 'UTF-8') ?></td>

                        <!-- Spalte: Status ändern -->
                        <td>
                            <form method="POST" action="update_user.php">
                                <input type="hidden" name="action" value="update_status">
                                <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['user_id'], ENT_QUOTES, 'UTF-8') ?>">
                                <select name="status" class="form-select mb-2">
                                    <option value="active" <?= $user['status'] === 'active' ? 'selected' : '' ?>>Active</option>
                                    <option value="inactive" <?= $user['status'] === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                                </select>
                                <button type="submit" class="btn btn-primary btn-sm btn-custom">Speichern</button>
                            </form>
                        </td>

                        <!-- Spalte: Passwort zurücksetzen -->
                        <td>
                            <form method="POST" action="update_user.php">
                                <input type="hidden" name="action" value="reset_password">
                                <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['user_id'], ENT_QUOTES, 'UTF-8') ?>">
                                <input type="password" name="new_password" placeholder="Neues Passwort" class="form-control mb-2" required>
                                <button type="submit" class="btn btn-primary btn-sm btn-custom">Pw zurücksetzen</button>
                            </form>
                        </td>

                        <!-- Spalte: Benutzer löschen -->
                        <td>
                            <?php if ($user['status'] === 'inactive' && $user['role'] === 'user'): ?>
                                <form method="POST" action="update_user.php" onsubmit="return confirm('Sind Sie sicher, dass Sie diesen Benutzer löschen möchten?');">
                                    <input type="hidden" name="action" value="delete_user">
                                    <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['user_id'], ENT_QUOTES, 'UTF-8') ?>">
                                    <button type="submit" class="btn btn-danger btn-sm btn-custom">Löschen</button>
                                </form>
                            <?php else: ?>
                                <span class="text-muted">Nicht erlaubt</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">Keine Benutzer gefunden.</div>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
