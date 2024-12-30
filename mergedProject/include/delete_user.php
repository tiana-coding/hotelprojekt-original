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
$sql = "SELECT status FROM users WHERE user_id = ?";
$stmt = $db_obj->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    die("Benutzer nicht gefunden.");
}

$user = $result->fetch_assoc();

if($user['status']!=='inactive'){
    echo'<div class="alert alert-danger">Nur inaktive benutzer können gelöscht werden!</div>';
    header:('Location: site_userverwaltung.php');
}
$delete_sql = "DELETE FROM users WHERE user_id = ?";
$delete_stmt = $db_obj->prepare($delete_sql);
$delete_stmt->bind_param("i", $user_id);

if ($delete_stmt->execute()) {
    echo '<div class="alert alert-success">Benutzer erfolgreich gelöscht.</div>';
    header('Location: site_userverwaltung.php?message=deleted');
    exit();
} else {
    echo '<div class="alert alert-danger">Fehler beim Löschen des Benutzers.</div>';
}

$delete_stmt->close();
$stmt->close();
$db_obj->close();
?>
