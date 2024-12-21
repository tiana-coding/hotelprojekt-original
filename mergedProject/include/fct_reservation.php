<?php
include('fct_session.php'); 
require_once '../config/dbaccess.php';
if(!$db_obj){
  die("Es besteht keine verbindung zur Datenbank.");
}
function getReservationByRoomId($db_obj, $reservation_id){
    $query = "SELECT r.*, rm.room_id, rm.category, rm.price_per_night
    FROM reservations AS r
    JOIN rooms AS rm ON r.room_id=rm.id
    WHERE r.id = ? LIMIT 1";
    $stmt=$db_obj->prepare($query);
    
    if(!$stmt){
        die("Fehrler bei der Abfrage: " .$db_obj->error
    ); }
    $stmt->bind_param("i", $reservation_id);
    $stmt->execute();
    $result=$stmt->get_result();
    
    if($result->num_rows == 0){
        echo "Keine Reservierung gefunden";
        return null; //keine reservierung gefunden
    }
    return $result->fetch_assoc();
}
?>
