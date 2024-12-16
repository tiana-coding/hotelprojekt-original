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
        header('Location: zimmerreservierungsformular.php');
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
    header('Location: reservierung_bestaetigung.php');
    exit();
}
header('Location: zimmerreservierungsformular.php');
exit();
