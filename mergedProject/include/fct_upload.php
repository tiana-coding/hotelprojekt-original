<?php
// Überprüfen, ob ein Bild hochgeladen wurde
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image']) && isset($_POST['title'])) {
    $upload_dir = 'uploads/news_images/';  // Ordner, in den die Datei gespeichert werden soll
    $thumbnail_dir = 'uploads/news_thumbnails/';
    
    // Sicherstellen, dass der Upload-Ordner existiert, andernfalls erstellen
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    if (!is_dir($thumbnail_dir)) {
        mkdir($thumbnail_dir, 0777, true);
    }

    $image = $_FILES['image'];
    $image_name = basename($_FILES['image']['name']);  // Dateiname (ohne Verzeichnis)
    $image_tmp = $image['tmp_name'];
    $image_size = $image['size'];
    $image_type = mime_content_type($image_tmp); // MIME-Typ prüfen

    // 1. Überprüfen, ob das Bild ein JPEG ist
    if ($image_type != 'image/jpeg') {
        $upload_message = '<p class="text-danger">Nur JPEG-Bilder sind erlaubt.</p>';
    } else {
        // 2. Bild speichern im Upload-Ordner
        $new_image_name = $upload_dir . uniqid('news_', true) . '.jpg'; // Eindeutiger Name für das Bild
        if (move_uploaded_file($image_tmp, $new_image_name)) {
            // 3. Thumbnail erstellen
            $thumbnail_name = $thumbnail_dir . basename($new_image_name);  // Thumbnail-Pfad
            if (createThumbnail($new_image_name, $thumbnail_name, 720, 480)) {
                // Erfolgreiche Nachricht
                $upload_message = '<p class="text-success">Der News-Beitrag wurde erfolgreich erstellt!</p>';
            } else {
                $upload_message = '<p class="text-danger">Fehler beim Erstellen des Thumbnails.</p>';
            }
        } else {
            if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
                // PHP-Fehlercode ausgeben
                $upload_message = '<p class="text-danger">Fehler beim Hochladen: ' . $_FILES['image']['error'] . '</p>';
            } else {
                $upload_message = '<p class="text-danger">Fehler beim Hochladen des Bildes. Bitte versuche es später noch einmal.</p>';
            }
        }
    }
}

// Funktion zum Erstellen eines Thumbnails
function createThumbnail($source_image_path, $thumbnail_path, $thumb_width, $thumb_height) {
    // Sicherstellen, dass die Quelldatei existiert
    if (!file_exists($source_image_path)) {
        return false; // Datei existiert nicht
    }

    // Originalbild laden
    $source_image = imagecreatefromjpeg($source_image_path);
    if (!$source_image) {
        return false; // Fehler beim Laden des Bildes
    }

    // Bilddimensionen ermitteln
    list($width, $height) = getimagesize($source_image_path);
    
    // Proportionale Skalierung beibehalten
    $aspect_ratio = $width / $height;
    if ($thumb_width / $thumb_height > $aspect_ratio) {
        $new_width = $thumb_height * $aspect_ratio;
        $new_height = $thumb_height;
    } else {
        $new_height = $thumb_width / $aspect_ratio;
        $new_width = $thumb_width;
    }

    // Thumbnail erstellen
    $thumbnail = imagecreatetruecolor($thumb_width, $thumb_height);

    // Bild auf das Thumbnail skalieren
    imagecopyresampled($thumbnail, $source_image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

    // Thumbnail speichern
    if (imagejpeg($thumbnail, $thumbnail_path, 90)) {
        // Aufräumen
        imagedestroy($source_image);
        imagedestroy($thumbnail);
        return true; // Erfolgreich erstellt
    }

    // Fehler beim Speichern des Thumbnails
    return false;
}
?>
