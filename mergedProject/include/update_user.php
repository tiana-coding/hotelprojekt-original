<?php


include 'fct_session.php';
require_once '../config/dbaccess.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'], $_POST['user_id'])) {
    $action = $_POST['action'];
    $user_id = intval($_POST['user_id']);

    // Benutzer löschen
    if ($action === 'delete_user') {
        // Benutzer-Daten prüfen
        $check_sql = "SELECT role FROM users WHERE user_id = ?";
        $check_stmt = $db_obj->prepare($check_sql);
        $check_stmt->bind_param("i", $user_id);
        $check_stmt->execute();
        $user_data = $check_stmt->get_result()->fetch_assoc();
        if ($user_data['role'] === 'admin') {
            header('Location: site_userverwaltung.php?message=not_allowed');
            exit();
        }
    }
    
    if ($action === 'delete_user') {
        // Überprüfen, ob der Benutzer inaktiv ist und keine Admin-Rolle hat
        $check_sql = "SELECT status, role FROM users WHERE user_id = ?";
        $check_stmt = $db_obj->prepare($check_sql);

        if (!$check_stmt) {
            die('<div class="alert alert-danger">Datenbankfehler: ' . htmlspecialchars($db_obj->error) . '</div>');
        }

        $check_stmt->bind_param("i", $user_id);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows === 1) {
            $user = $check_result->fetch_assoc();

            if ($user['status'] === 'inactive' && $user['role'] === 'user') {
                // Benutzer löschen
                $delete_sql = "DELETE FROM users WHERE user_id = ?";
                $delete_stmt = $db_obj->prepare($delete_sql);

                if (!$delete_stmt) {
                    die('<div class="alert alert-danger">Datenbankfehler: ' . htmlspecialchars($db_obj->error) . '</div>');
                }

                $delete_stmt->bind_param("i", $user_id);

                if ($delete_stmt->execute()) {
                    header('Location: site_userverwaltung.php?message=deleted');
                } else {
                    header('Location: site_userverwaltung.php?message=error');
                }

                $delete_stmt->close();
            } else {
                // Benutzer kann nicht gelöscht werden
                header('Location: site_userverwaltung.php?message=not_allowed');
            }
        } else {
            header('Location: site_userverwaltung.php?message=user_not_found');
        }

        $check_stmt->close();
        exit();
    }

    // Weitere Aktionen wie Status ändern oder Passwort zurücksetzen können hier ergänzt werden.
}

// Fallback bei ungültigen Anfragen
header('Location: site_userverwaltung.php?message=invalid_request');
exit();
?>
