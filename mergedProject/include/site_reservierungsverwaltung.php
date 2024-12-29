<?php
include 'fct_session.php';
require_once '../config/dbaccess.php';
include 'header.php';

// Prüfen, ob der Benutzer Adminrechte hat (Optional)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_GET['message'])) {
    switch ($_GET['message']) {
        case 'success':
            echo '<div class="alert alert-success">Reservierungsstatus wurde erfolgreich aktualisiert.</div>';
            break;
        case 'error':
            echo '<div class="alert alert-danger">Fehler beim Aktualisieren des Reservierungsstatus.</div>';
            break;
        case 'invalid':
            echo '<div class="alert alert-warning">Ungültige Eingabe. Bitte versuchen Sie es erneut.</div>';
            break;
    }
}

// Abfrage der Reservierungen
$sql = "SELECT reservation_id, username, room_id, check_in_date, check_out_date, guests, status, created_at, bearbeitet_von, bearbeitet_am FROM reservations ORDER BY created_at DESC";
$stmt = $db_obj->prepare($sql);

if (!$stmt) {
    die('<div class="alert alert-danger">Fehler beim Abrufen der Reservierungen: ' . htmlspecialchars($db_obj->error) . '</div>');
}

$stmt->execute();
$result = $stmt->get_result();
$reservations = $result->fetch_all(MYSQLI_ASSOC);

$stmt->close();
?>

<div class="container mt-5">
    <h1 class="text-center my-3">Alle Reservierungen</h1>

    <?php if (!empty($reservations)): ?>
        <table class="table table-bordered mt-3">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Reservierungs-ID</th>
                    <th>Benutzername</th>
                    <th>Zimmer-ID</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Gäste</th>
                    <th>Status</th>
                    <th>Erstellt am</th>
                    <th>Bearbeitet von</th>
                    <th>Bearbeitet am</th>
                    <th>Aktionen</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservations as $index => $reservation): ?>
                    <tr>
                        <th scope="row"><?= $index + 1 ?></th>
                        <td><?= htmlspecialchars($reservation['reservation_id'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($reservation['username'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($reservation['room_id'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($reservation['check_in_date'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($reservation['check_out_date'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($reservation['guests'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($reservation['status'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($reservation['created_at'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($reservation['bearbeitet_von'] ?? 'N/A', ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($reservation['bearbeitet_am'] ?? 'N/A', ENT_QUOTES, 'UTF-8') ?></td>
                        <td>
                            <!-- Status ändern -->
                            <form method="POST" action="site_update_reservation.php">
                                <input type="hidden" name="reservation_id" value="<?= htmlspecialchars($reservation['reservation_id'], ENT_QUOTES, 'UTF-8') ?>">
                                <select name="status" class="form-select mb-2">
                                    <option value="Neu" <?= $reservation['status'] === 'Neu' ? 'selected' : '' ?>>Neu</option>
                                    <option value="Bestätigt" <?= $reservation['status'] === 'Bestätigt' ? 'selected' : '' ?>>Bestätigt</option>
                                    <option value="Storniert" <?= $reservation['status'] === 'Storniert' ? 'selected' : '' ?>>Storniert</option>
                                </select>
                                <button type="submit" class="btn btn-primary btn-sm">Speichern</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">Keine Reservierungen gefunden.</div>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
