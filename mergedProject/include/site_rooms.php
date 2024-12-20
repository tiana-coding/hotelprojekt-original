<?php
include('fct_session.php'); 

include('fct_rooms.php');
include('header.php');
?>    
    
    <div class="container mt-4">
        <h1 class="text-center mt-4 pt-4">Zimmerreservierung</h1>

        <!-- Reservierungsnachricht (Erfolg oder Fehler) -->
        <?php echo $reservation_message; ?>

        <!-- Formular für die Zimmerreservierung -->
        <form class="mx-auto mt-3 pt-3" style="width:50%;" method="POST" action="site_rooms.php">
            <div class="form-group">
                <label for="room_type" class="form-label">Zimmerkategorie</label>
                <select class="form-select" id="room_type" name="room_type" required>
                    <option value="">Wählen Sie ein Zimmer</option>
                    <option value="Einzelzimmer" <?php echo ($room_type == 'Einzelzimmer') ? 'selected' : ''; ?>>Einzelzimmer</option>
                    <option value="Doppelzimmer" <?php echo ($room_type == 'Doppelzimmer') ? 'selected' : ''; ?>>Doppelzimmer</option>
                    <option value="Suite" <?php echo ($room_type == 'Suite') ? 'selected' : ''; ?>>Suite</option>
                </select>
            </div>

            <div class="form-group">
                <label for="check_in" class="form-label">Anreisedatum</label>
                <input type="date" class="form-control" id="check_in" name="check_in" value="<?php echo $check_in; ?>" required>
            </div>

            <div class="form-group">
                <label for="check_out" class="form-label">Abreisedatum</label>
                <input type="date" class="form-control" id="check_out" name="check_out" value="<?php echo $check_out; ?>" required>
            </div>

            <div class="form-group">
                <label for="number_of_guests" class="form-label">Anzahl der Gäste</label>
                <input type="number" class="form-control" id="number_of_guests" name="number_of_guests" value="<?php echo $number_of_guests; ?>" min="1" required>
            </div>
            <div class="form-group">
            <label for="breakfast">Frühstück:</label>
            <select name="breakfast" id="breakfast" class="form-control" required>
                <option value="">Bitte wählen...</option>
                <option value="with">Mit Frühstück</option>
                <option value="without">Ohne Frühstück</option>
                <option value="later">Später entscheiden</option>
            </select>
        </div>
        <div class="form-group">
            <label for="children">Kinder</label>
            <select name="children" id="children" class="form-control" required>
                <option value="">Bitte wählen...</option>
                <option value="none">Keine</option>
                <option value="toddler">Kleinkinder</option>
                <option value="teen">Kinder ab 14 Jahre</option>
            </select>
        </div>
        <div class="form-group">
            <label for="pets">Haustier</label>
            <select name="pets" id="pets" class="form-control" required>
                <option value="">Bitte wählen...</option>
                <option value="none">Keine</option>
                <option value="dog">Hund</option>
                <option value="cat">Katze</option>
                <option value="others">Sonstige</option>
            </select>
        </div>
        <div class="form-group">
            <label for="parking">Parkplatz</label>
            <select name="parking" id="parking" class="form-control" required>
                <option value="">Bitte wählen...</option>
                <option value="yes">Ja</option>
                <option value="no">Nein</option>
                
            </select>
        </div>


        <!-- Zusätzliche Wünsche -->
        <div class="form-group">
            <label for="notes">Zusätzliche Wünsche/Bemerkungen:</label>
            <textarea name="notes" id="notes" class="form-control" rows="5" placeholder="Optional"></textarea>
        </div>

        <!-- Absenden -->
            <button type="submit" class="btn btn-primary mt-3 pt-2">Reservierung abschicken</button>
        </form>
    </div>
    <?php include('footer.php');?>

