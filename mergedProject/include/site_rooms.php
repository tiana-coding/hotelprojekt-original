<?php


include('header.php');
include('../config/dbaccess.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



if(!isset($_SESSION['username'])){

       echo '<div class="container"><p class="text-danger my-3">Bitte loggen Sie sich ein oder registrieren Sie sich. Nur registriete Kunden können Zimmerreservierung durchführen</p></div>';
       include ('footer.php');


    exit();

    }?>


<!-- Formular für die Zimmerreservierung -->   
    <div class="container mt-4">
        <h1 class="text-center mt-4 pt-4">Zimmerreservierung</h1>
        <?php if (!isset($_SESSION['username'])): ?>
                <p class="text-danger my-3">Bitte loggen Sie sich ein oder registrieren Sie sich. Nur registriete Kunden können Zimmerreservierung durchführen</p>
        <?php endif; ?>

        
        <form class="mx-auto mt-3 pt-3" style="width:50%;" method="POST" action="site_reservation.php">
            <!-- Hidden-Feld für room_id -->
            <input type="hidden" name="room_id" value="<?php echo htmlspecialchars($room_id); ?>">
            
            <div class="form-row d-flex justify-content-between">
                <div class="form-group col-md-6 px-2">
                    <label for="check_in_date" class="form-label">Anreisedatum</label>
                    <input type="date" class="form-control" id="check_in_date" name="check_in_date" value="<?php echo htmlspecialchars($check_in_date); ?>" required>
                    
                </div>

                <div class="form-group col-md-6 px-2">
                    <label for="check_out_date" class="form-label">Abreisedatum</label>
                    <input type="date" class="form-control" id="check_out_date" name="check_out_date" value="<?php echo htmlspecialchars($check_out_date) ; ?>" required>
                    
                </div>
            </div>    
    
            <div class="form-group">
                <label for="guests" class="form-label">Anzahl der Gäste</label>
                <input type="number" class="form-control" id="guests" name="guests" value="<?php echo $guests; ?>" min="1" required>
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

        <!-- Absenden -->
            <button type="submit" class="btn btn-primary mt-3 pt-2">Reservierung abschicken</button>
            
        </form>
    
    </div>
<?php include('footer.php');?>

