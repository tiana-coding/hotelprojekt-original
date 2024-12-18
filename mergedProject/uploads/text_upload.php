<?php
$uploadDir = 'uploads/';
$uploadFile = $uploadDir . basename($_FILES['uploaded_file']['name']);

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true); // Ordner erstellen, falls er nicht existiert
}

if (move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $uploadFile)) {
    echo "Datei erfolgreich hochgeladen: " . htmlspecialchars($uploadFile);
} else {
    echo "Fehler beim Hochladen.";
}
?>
