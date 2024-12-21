<?php
include('fct_session.php'); 
include('fct_rooms.php');
include('fct_reservation.php');
include('header.php');
  
$reservation_message='';//initialisiere Reservation msg

if ($_SERVER['REQUEST_METHOD']== 'POST'){
    $category=$_POST['category'];
    $check_in_date=$_POST['check_in_date'];
    $check_out_date=$_POST['check_out_date'];
    $guests=$_POST['guests'];
    $breakfast=$_POST['breakfast'];
    $children=$_POST['children'];
    $pets=$_POST['pets'];
    $parking=$_POST['parking'];
    $notes=$_POST['notes'];


$availableRooms=  getAvailableRooms($db_obj);
$room_id=null;
foreach($availableRooms as $room){
    if($room['category']==$category){
        $room_id=$room['id'];
        break;
    }
}
if($room_id){
    $reservation_message = reserveRoom(
        $db_obj, 
        $room_id,
        $check_in_date, 
        $check_out_date, 
        $guests, 
        $breakfast, 
        $children, 
        $pets, 
        $parking, 
        $notes
    );
 
    header("Location: site_reservation.php?room_id=" . urlencode($room_id) . "&success=1");
    exit();
    }   else{
        $reservation_message ="Das ausgewählte Zimmer ist ausgebucht.";
        echo"<div class= 'alert alert-danger text-center'>$reservation_message</div>";
    }

}
?>      
    <div class="container mt-4">
        <h1 class="text-center mt-4 pt-4">Zimmerreservierung</h1>
        <?php if (!isset($_SESSION['role'])): ?>
                <p class="text-danger my-3">Bitte loggen Sie sich ein oder registrieren Sie sich. Nur registriete Kunden können Zimmerreservierung durchführen.</p>
        <?php endif; ?>

        <!-- Formular für die Zimmerreservierung -->
        <form class="mx-auto mt-3 pt-3" style="width:50%;" method="POST" action="site_reservation.php">
            <div class="form-group">
                <label for="category" class="form-label">Zimmerkategorie</label>
                <select class="form-select" id="category" name="category" required>
                    <option value="">Wählen Sie ein Zimmer</option>

                    <option value="Einzelzimmer" <?php echo ($category == 'Einzelzimmer') ? 'selected' : ''; ?>>Einzelzimmer</option>

                    <option value="Doppelzimmer" <?php echo ($category == 'Doppelzimmer') ? 'selected' : ''; ?>>Doppelzimmer</option>
                    
                    <option value="Suite" <?php echo ($category == 'Suite') ? 'selected' : ''; ?>>Suite</option>
                </select>
            </div>

            <div class="form-group">
                <label for="check_in_date" class="form-label">Anreisedatum</label>
                <input type="date" class="form-control" id="check_in_date" name="check_in_date" value="<?php echo $check_in_date; ?>" required>
            </div>

            <div class="form-group">
                <label for="check_out_date" class="form-label">Abreisedatum</label>
                <input type="date" class="form-control" id="check_out_date" name="check_out_date" value="<?php echo $check_out_date; ?>" required>
            </div>

            <div class="form-group">
                <label for="guests" class="form-label">Anzahl der Gäste</label>
                <input type="number" class="form-control" id="guests" name="guests" value="<?php echo $guests; ?>" min="1" required>
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
            <button type="submit" class="btn btn-primary mt-3 pt-2"<?php echo (!isset($_SESSION['role']) ? 'disabled' : '');?>>Reservierung abschicken</button>
            
        </form>
    
    </div>
    <?php include('footer.php');?>

