<?php
// Session starten
session_start();

// Logout-Mechanismus
if (isset($_GET['logout'])) {
    session_unset(); // Alle Session-Daten löschen
    session_destroy(); // Session zerstören
    echo "<p>Sie haben sich erfolgreich ausgeloggt.</p>";
}
?>
<a href="?logout=true">Logout</a>