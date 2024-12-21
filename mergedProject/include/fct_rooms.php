<?php
include('fct_session.php'); 
require_once '../config/dbaccess.php';//datenbank in fct_rooms.php einbinden
if(!$db_obj){
  die("Es besteht keine verbindung zur Datenbank.");
}
//check ob der "kunden" schon unsere customer ist(bereits in db angelegt, wenn nicht hat er keine rechte reservierungen durchzuführen)


//function verfügbarkeit prüfen
function getAvailableRooms($db_obj) {
    $query = "SELECT id, room_number, category, price_per_night, description FROM rooms WHERE is_available = 1";

    $result = $db_obj->query($query);
    $rooms = [];
    if($result->num_rows>0) {
        while($row = $result->fetch_assoc()){
            $rooms[]=$row;//ergebnis speichern
        }
    }
    return $rooms; //rooms die noch verfügbar sind werde ermittelt
}

//function reserveRoom, wenn rooms noch gibt kann kunden es reservieren
function reserveRoom($db_obj, $room_id, $check_in_date, $check_out_date, $guests, $breakfast, $children, $pets, $parking, $notes){

$query ="SELECT is_available FROM rooms WHERE id = ? LIMIT 1"   ;
//abrufen die informationen

$stmt = $db_obj->prepare($query);
if(!$stmt){
    return "Fehler bei der Bearbeitung" . $db_obj->error;

}
$stmt -> bind_param("i", $room_id);//room_id (integer) binden
$stmt ->execute();
$stmt->bind_result($is_available);
$stmt->fetch();
$stmt->close();

if(!$is_available){
    return "Das ausgewählte Zimmer ist ausgebucht.";

}
//sonst die reservierung durchgeführt und gespeichert in table reservations
$insertQuery = "INSERT INTO reservations (room_id, check_in_date, check_out_date, guests, breakfast, children, pets, parking, notes, created_at)VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt= $db_obj->prepare($insertQuery);

if(!$stmt){
    return "Fehler bei der Bearbeitung" . $db_obj->error;

}
$created_at = date('Y-m-d H:i:s');
$stmt->bind_param("ississssss", $room_id, $check_in_date, $check_out_date, $guests, $breakfast, $children, $pets, $parking, $notes, $created_at);

//nach dem executen werden table mit neuen hinzugefügten werten aktualisiert
if($stmt->execute()) {

    $reservation_id=$stmt->insert_id;
    //wenn das zimmer gebucht wurde, setzt is_available auf 0/false
    $updateQuery= "UPDATE rooms Set is_available = 0 WHERE id = ?";
    $updateStmt=$db_obj->prepare($updateQuery);

    if(!$updateStmt){
        return "Fehler bei der Bearbeitung" . $db_obj->error;
    
    }
    $updateStmt->bind_param("i", $room_id);
    $updateStmt->execute();
    $updateStmt->close();

    return "$reservation_id";

    }else{
        return "Fehler: " .$stmt->error;

    }


}



?>
