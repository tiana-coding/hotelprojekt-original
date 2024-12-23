<?php
include('header.php');
include('../config/dbaccess.php');

// Prüfen, ob der Benutzer eingeloggt ist
if (!isset($_SESSION['username'])) {
    echo '<div class="container"><p class="text-danger my-3">Bitte loggen Sie sich ein oder registrieren Sie sich. Nur registrierte Kunden können Zimmer reservieren.</p></div>';
    include('footer.php');
    exit();
}

// Funktion: Verfügbare Zimmer basierend auf Kategorie und Zeitraum finden
function listAvailableRooms($db_obj, $category, $check_in_date, $check_out_date) {
    $query = "SELECT room_id, category, price_per_night
              FROM rooms
              WHERE category = ? 
              AND available = 1
              AND room_id NOT IN (
                  SELECT room_id
                  FROM reservations
                  WHERE (check_in_date < ? AND check_out_date > ?)
              )";

    $stmt = $db_obj->prepare($query);
    if (!$stmt) {
        die("Fehler beim Vorbereiten der Abfrage: " . $db_obj->error);
    }

    // Parameter binden und Abfrage ausführen
    $stmt->bind_param("sss", $category, $check_out_date, $check_in_date);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verfügbare Zimmer als Array zurückgeben
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Variablen für Eingaben und verfügbare Zimmer initialisieren
$rooms = [];
$category = $_POST['category'] ?? '';
$check_in_date = $_POST['check_in_date'] ?? '';
$check_out_date = $_POST['check_out_date'] ?? '';

// Wenn alle Eingaben vorhanden sind, verfügbare Zimmer abrufen
if (!empty($category) && !empty($check_in_date) && !empty($check_out_date)) {
    $rooms = listAvailableRooms($db_obj, $category, $check_in_date, $check_out_date);
}

?>

<!-- Formular für die Eingabe der Kategorie und der Daten -->
<div class="container mt-4">
    <h1 class="text-center mt-4 pt-4">Zimmerreservierung</h1>
    <?php if (empty($_SESSION['username'])): ?>
        <p class="text-danger my-3">Bitte loggen Sie sich ein oder registrieren Sie sich. Nur registrierte Kunden können Zimmer reservieren.</p>
    <?php endif; ?>

    <!-- Verfügbare Zimmer anzeigen, falls vorhanden -->
    <?php if (!empty($rooms)): ?>
        <h2 class="mt-5">Verfügbare Zimmer</h2>
        <form class="mx-auto mt-3" method="POST" action="site_reservation.php">
            <!-- Versteckte Felder für Check-in und Check-out -->
            <input type="date name="check_in_date" value="<?php echo htmlspecialchars($check_in_date); ?>">
            <input type="date" name="check_out_date" value="<?php echo htmlspecialchars($check_out_date); ?>">
            <div class="form-group">
                <label for="room_id" class="form-label">Zimmer auswählen</label>
                <select class="form-select" id="room_id" name="room_id" required>
                    <option value="">Bitte wählen Sie ein Zimmer</option>
                    <?php foreach ($rooms as $room): ?>
                        <!-- Anzeige der verfügbaren Zimmer -->
                        <option value="<?php echo $room['room_id']; ?>">
                            <?php echo "{$room['category']} (Zimmer-ID: {$room['room_id']}, Preis: {$room['price_per_night']} €)"; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Eingabe der Anzahl der Gäste -->
            <div class="form-group">
                <label for="guests" class="form-label">Anzahl der Gäste</label>
                <input type="number" class="form-control" id="guests" name="guests" min="1" required>
            </div>
            <div class="form-group">
            <label for="breakfast">Frühstück:</label>
            <select name="breakfast" id="breakfast" class="form-control" required>
                <option value="">Bitte wählen...</option>
                <option value="mit">Mit Frühstück</option>
                <option value="ohne">Ohne Frühstück</option>
                
            </select>
        </div>
        <div class="form-group">
            <label for="children">Kinder</label>
            <select name="children" id="children" class="form-control" required>
                <option value="">Bitte wählen...</option>
                <option value="kein">Keine</option>
                <option value="Kleinkinder">Kleinkinder</option>
                <option value="Kinder">Kinder ab 6 Jahre</option>
            </select>
        </div>
        <div class="form-group">
            <label for="pets">Haustier</label>
            <select name="pets" id="pets" class="form-control" required>
                <option value="">Bitte wählen...</option>
                <option value="keine">Keine</option>
                <option value="hund">Hund</option>
                <option value="katze">Katze</option>
                <option value="sonstige">Sonstige</option>
            </select>
        </div>
        <div class="form-group">
            <label for="parking">Parkplatz</label>
            <select name="parking" id="parking" class="form-control" required>
                <option value="">Bitte wählen...</option>
                <option value="ja">Ja</option>
                <option value="nein">Nein</option>
                
            </select>
        </div>


        <!-- Zusätzliche Wünsche -->
        <div class="form-group">
            <label for="notes">Zusätzliche Wünsche/Bemerkungen:</label>
            <textarea name="notes" id="notes" class="form-control" rows="5" placeholder="Optional"></textarea>
        </div>

            <button type="submit" class="btn btn-primary mt-3 pt-2">Reservierung abschicken</button>
        </form>
    <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <!-- Nachricht anzeigen, wenn keine Zimmer verfügbar sind -->
        <p class="text-danger mt-4">Keine Zimmer verfügbar für den angegebenen Zeitraum.</p>
    <?php endif; ?>
</div>

<?php include('footer.php'); ?>
