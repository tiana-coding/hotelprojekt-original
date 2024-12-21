<?php
// Datenbankverbindung
require_once '../config/dbaccess.php';

if (!$db_obj) {
    die("Es besteht keine Verbindung zur Datenbank.");
}

// SQL-Abfrage für das Update
$sql = "UPDATE `reservations` 
        SET `breakfast` = 'mit', 
            `children` = 'keine', 
            `pets` = 'keine', 
            `parking` = 'ja' 
        WHERE `reservations`.`id` = 4;";

// Abfrage ausführen
if ($db_obj->query($sql) === TRUE) {
    echo "Die Reservierung wurde erfolgreich aktualisiert.";
} else {
    echo "Fehler beim Aktualisieren der Reservierung: " . $db_obj->error;
}

// Verbindung schließen
$db_obj->close();
?>
