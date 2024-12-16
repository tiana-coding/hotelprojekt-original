
<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Eingabedaten abrufen und validieren
    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $phone = htmlspecialchars(trim($_POST['phone']));
    $checkin_date = $_POST['checkin_date'];
    $checkout_date = $_POST['checkout_date'];
    $guests = (int) $_POST['guests'];
    $room_type = $_POST['room_type'];
    $notes = htmlspecialchars(trim($_POST['notes']));

    // Fehlerprüfung
    $errors = [];
    if (!$name) $errors[] = "Bitte geben Sie einen gültigen Namen ein.";
    if (!$email) $errors[] = "Bitte geben Sie eine gültige E-Mail-Adresse ein.";
    if (!$phone) $errors[] = "Bitte geben Sie eine gültige Telefonnummer ein.";
    if (!$checkin_date || !$checkout_date || $checkin_date >= $checkout_date) {
        $errors[] = "Das Abreisedatum muss nach dem Anreisedatum liegen.";
    }
    if ($guests <= 0) $errors[] = "Bitte geben Sie eine gültige Anzahl an Personen ein.";
    if (!$room_type) $errors[] = "Bitte wählen Sie einen Zimmertyp aus.";

    // Fehler anzeigen oder Daten speichern
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header('Location: zimmer.php');
        exit();
    }

    // Daten speichern oder per E-Mail versenden (Beispielhaft)
    $reservation = [
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'checkin_date' => $checkin_date,
        'checkout_date' => $checkout_date,
        'guests' => $guests,
        'room_type' => $room_type,
        'notes' => $notes,
    ];
    $_SESSION['reservation'] = $reservation;

    // Erfolgsnachricht
    $_SESSION['success'] = "Vielen Dank, Ihre Reservierung wurde erfolgreich abgeschickt!";
    header('Location: conform.php');
    exit();
}
<?php include 'include/header.php';?>

  <!-- Navbar -->

<?php include 'include/nav.php';?>

?>

<div class="container">
    <h1 class="text-center my-5">Zimmerreservierung</h1>
    <p class="text-center">Füllen Sie das Formular aus.</p>
    
    <form action="zimmerreservierung_verarbeiten.php" method="POST">
        <!-- Name -->
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Ihr Name" required>
        </div>

        <!-- E-Mail -->
        <div class="form-group">
            <label for="email">E-Mail:</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Ihre E-Mail-Adresse" required>
        </div>

        <!-- Telefonnummer -->
        <div class="form-group">
            <label for="phone">Telefonnummer:</label>
            <input type="tel" name="phone" id="phone" class="form-control" placeholder="Ihre Telefonnummer" required>
        </div>

        <!-- An- und Abreisedatum -->
        <div class="form-group">
            <label for="checkin_date">Anreisedatum:</label>
            <input type="date" name="checkin_date" id="checkin_date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="checkout_date">Abreisedatum:</label>
            <input type="date" name="checkout_date" id="checkout_date" class="form-control" required>
        </div>

        <!-- Anzahl der Personen -->
        <div class="form-group">
            <label for="guests">Anzahl der Personen:</label>
            <input type="number" name="guests" id="guests" class="form-control" placeholder="z. B. 2" min="1" required>
        </div>

        <!-- Zimmertyp -->
        <div class="form-group">
            <label for="room_type">Zimmertyp:</label>
            <select name="room_type" id="room_type" class="form-control" required>
                <option value="">Bitte wählen...</option>
                <option value="single">Einzelzimmer</option>
                <option value="double">Doppelzimmer</option>
                <option value="suite">Suite</option>
            </select>
        </div>
        <div class="form-group">
            <label for="room_type">Frühstück:</label>
            <select name="room_type" id="room_type" class="form-control" required>
                <option value="">Bitte wählen...</option>
                <option value="single">Mit Frühstück</option>
                <option value="double">Ohne Frühstück</option>
                <option value="suite">Später entscheiden</option>
            </select>
        </div>
        <div class="form-group">
            <label for="room_type">Kinder</label>
            <select name="room_type" id="room_type" class="form-control" required>
                <option value="">Bitte wählen...</option>
                <option value="single">Keine</option>
                <option value="double">Kleinkinder</option>
                <option value="suite">Kinder ab 14 Jahre</option>
            </select>
        </div>
        <div class="form-group">
            <label for="room_type">Haustier</label>
            <select name="room_type" id="room_type" class="form-control" required>
                <option value="">Bitte wählen...</option>
                <option value="single">Hund</option>
                <option value="double">Katze</option>
                <option value="suite">Songstig</option>
            </select>
        </div>
        <div class="form-group">
            <label for="room_type">Parkplatz</label>
            <select name="room_type" id="room_type" class="form-control" required>
                <option value="">Bitte wählen...</option>
                <option value="single">Ja</option>
                <option value="double">Nein</option>
                
            </select>
        </div>


        <!-- Zusätzliche Wünsche -->
        <div class="form-group">
            <label for="notes">Zusätzliche Wünsche/Bemerkungen:</label>
            <textarea name="notes" id="notes" class="form-control" rows="5" placeholder="Optional"></textarea>
        </div>

        <!-- Absenden -->
        <button type="submit" class="btn btn-primary btn-lg mt-3">Reservieren</button>
    </form>
</div>

<?php include 'include/footer.php'; ?>

