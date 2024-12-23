<?php




require_once '../config/dbaccess.php';



if(!$db_obj){
  die("Es besteht keine verbindung zur Datenbank.".mysqli_connect_error());
}

var_dump($room_id, $username, $check_in_date, $check_out_date, $guests, $breakfast, $children, $pets, $parking, $notes);

//funktion verfügbarkeit
function checkRoomAvailability($db_obj,$room_id, $check_in_date, $check_out_date){
  //  count zählt, wie viele Reservierungen mit der angegebenen room_id existieren, die mit dem gewünschten Zeitraum kollidieren
  $query = "SELECT COUNT(*) AS total
  FROM reservations
  WHERE room_id = ?
  AND (check_in_date <? AND check_out_date>?)";

  $stmt = $db_obj->prepare($query);

  if(!$stmt){
    die("Fehler: " .$db_obj->error);
  }

  $stmt->bind_param("iss", $room_id, $check_in_date, $check_out_date);
  $stmt->execute();
  $result = $stmt->get_result();
  $data = $result->fetch_assoc();

  return $data['total']==0;//wenn die ausgabe 0 liefert, ist das zimmer frei zum buchen
}

//hinzufügen die daten in die reservations tabelle
function insertResevation($db_obj, $username, $check_in_date,$check_out_date,$guests,$breakfast,$children,$pets,$parking,$notes, $created_at,$status){

    $query= "INSERT INTO reservations(username, check_in_date,check_out_date,guests,breakfast,children,pets,parking,notes,created_at, status) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), 'neu')";

    $stmt=$db_obj->prepare($query);

    if(!$stmt){
        die("Fehler" . $db_obj->error);
    
    }
    $stmt->bind_param("isssisssss", $username, $check_in_date,$check_out_date,$guests,$breakfast,$children,$pets,$parking,$notes);

    if($stmt->execute()){
        return $stmt->insert_id;//(ID der Reservierung wird zurückgegeben);
    }else{
        return false;
    }


}

//update verfügbatkeit, gebuchtes zimmer als nicht verfügbar aktualisieren
function updateRoomAvailability($db_obj,$room_id, $check_in_date, $check_out_date){
  $isAvailable = checkRoomAvailability($db_obj,$room_id, $check_in_date, $check_out_date);
  
  //available` basierend auf der Rückgabe von checkRoomAvailability setzen
  $available = $isAvailable ? 1 : 0;
  $query= "UPDATE rooms SET available = ? WHERE room_id = ?";
  $stmt = $db_obj->prepare($query);

  if(!$stmt){
    die("Fehler" . $db_obj->error);

}
$stmt->bind_param("ii", $available, $room_id);
return $stmt->execute();

}
  
//wenn es mehre reservierungen von einem kunden gibt, soll die neuste reservierung angezeigt werden und dann die ältere
function listReservations($db_obj,$username){

  $query = "SELECT r.*, rm.room_id, rm.price_per_night
  FROM reservations AS r
  JOIN rooms AS rm ON r.room_id = rm.room_id 
  WHERE r.username = ? 
  ORDER BY r.check_out_date DESC";

  $stmt=$db_obj->prepare($query);
  if(!$stmt){
    die("Fehler" . $db_obj->error);

}
$stmt->bind_param("s", $username);
$stmt->execute();
return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);






}
 

?>