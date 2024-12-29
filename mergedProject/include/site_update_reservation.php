<?php

include 'fct_session.php';
require_once '../config/dbaccess.php';
include 'header.php';

// Prüfen, ob der Benutzer Adminrechte hat (Optional)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reservation_id'], $_POST['status'])) {
    $reservation_id = intval($_POST['reservation_id']);
    $status = $_POST['status'];

    // Gültige Statuswerte definieren
    $valid_statuses = ['Neu', 'Bestätigt', 'Storniert'];

    if (!in_array($status, $valid_statuses, true)) {
        echo '<div class="alert alert-warning">Ungültiger Statuswert übergeben!</div>';
        exit();
    }

    // Status aktualisieren mit Prepared Statements
    $sql = "UPDATE reservations SET status = ? WHERE reservation_id = ?";
    $stmt = $db_obj->prepare($sql);

    if (!$stmt) {
        die('<div class="alert alert-danger">Datenbankfehler: ' . htmlspecialchars($db_obj->error) . '</div>');
    }

    $stmt->bind_param("si", $status, $reservation_id);

    if ($stmt->execute()) {
        echo '<div class="alert alert-success">Reservierungsstatus wurde erfolgreich aktualisiert.</div>';
    } else {
        echo '<div class="alert alert-danger">Fehler beim Aktualisieren des Reservierungsstatus.</div>';
    }

    $stmt->close();
} else {
    echo '<div class="alert alert-info">Es wurden keine Daten übermittelt.</div>';
}

include 'footer.php';
?>
