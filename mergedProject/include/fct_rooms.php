<?php
include('fct_session.php'); 


// Variablen für Reservierungsinformationen initialisieren
$reservation_message = '';
$room_type = '';
$check_in = '';
$check_out = '';
$number_of_guests = 1;

// Wenn das Formular abgesendet wird, verarbeite die Reservierung
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Formulardaten erhalten und validieren
    $room_type = $_POST['room_type'];
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];
    $number_of_guests = $_POST['number_of_guests'];

    // Überprüfen, ob alle Felder ausgefüllt sind
    if (empty($room_type) || empty($check_in) || empty($check_out)) {
        $reservation_message = '<p class="text-danger">Alle Felder müssen ausgefüllt werden.</p>';
    } else {
        // Reservierung erfolgreich verarbeitet
        $_SESSION['reservation'] = [
            'room_type' => $room_type,
            'check_in' => $check_in,
            'check_out' => $check_out,
            'number_of_guests' => $number_of_guests
        ];
        $reservation_message = '<p class="text-success">Ihre Reservierung wurde erfolgreich durchgeführt!</p>';
    }
}

?>
