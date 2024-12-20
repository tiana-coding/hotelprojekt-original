<?php
include('fct_session.php'); 

include('fct_rooms.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Zimmerreservierung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="container mt-4">
        <h1>Zimmerreservierung</h1>

        <!-- Reservierungsnachricht (Erfolg oder Fehler) -->
        <?php echo $reservation_message; ?>

        <!-- Formular für die Zimmerreservierung -->
        <form method="POST" action="site_rooms.php">
            <div class="mb-3">
                <label for="room_type" class="form-label">Zimmerkategorie</label>
                <select class="form-select" id="room_type" name="room_type" required>
                    <option value="">Wählen Sie ein Zimmer</option>
                    <option value="Einzelzimmer" <?php echo ($room_type == 'Einzelzimmer') ? 'selected' : ''; ?>>Einzelzimmer</option>
                    <option value="Doppelzimmer" <?php echo ($room_type == 'Doppelzimmer') ? 'selected' : ''; ?>>Doppelzimmer</option>
                    <option value="Suite" <?php echo ($room_type == 'Suite') ? 'selected' : ''; ?>>Suite</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="check_in" class="form-label">Anreisedatum</label>
                <input type="date" class="form-control" id="check_in" name="check_in" value="<?php echo $check_in; ?>" required>
            </div>

            <div class="mb-3">
                <label for="check_out" class="form-label">Abreisedatum</label>
                <input type="date" class="form-control" id="check_out" name="check_out" value="<?php echo $check_out; ?>" required>
            </div>

            <div class="mb-3">
                <label for="number_of_guests" class="form-label">Anzahl der Gäste</label>
                <input type="number" class="form-control" id="number_of_guests" name="number_of_guests" value="<?php echo $number_of_guests; ?>" min="1" required>
            </div>

            <button type="submit" class="btn btn-primary">Reservierung abschicken</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
