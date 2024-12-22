<?php


include('header.php');
require_once '../config/dbaccess.php';



if(!$db_obj){
  die("Es besteht keine verbindung zur Datenbank.");
}
//prüfen, ob das formular abgesendet wurde?
if($_SERVER['REQUEST_METHOD']=='POST'){

  $category = $_POST['category'] ?? '';
  $check_in_date = $_POST['check_in_date'] ?? '';
  $check_out_date = $_POST['check_out_date'] ?? '';
  $guests = $_POST['guests'] ?? '';
  $breakfast = $_POST['breakfast'] ?? '';
  $children = $_POST['children'] ?? '';
  $pets = $_POST['pets'] ?? '';
  $parking = $_POST['parking'] ?? '';
  $notes = $_POST['notes'] ?? '';
  $user_id = $_POST['user_id'] ?? null;
}
if(empty($category) ||empty($check_in_date) ||empty($check_out_date) || empty($check_in_date)){
  echo'<p class="text-danger">Pflichtfelder, bitte ausfüllen.</p>';
} 


//funktion reservation_id durch room_id in verbindung setzen
function getReservationByRoomId($db_obj, $reservation_id){


  $query = "SELECT r.*, rm.room_id, rm.category, rm.price_per_night
  FROM reservations AS r
  JOIN rooms AS rm ON r.room_id=rm.room_id
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
//funktion 
//$db_obj, $room_id, $user_id, $check_in_date, $check_out_date, $guests, $breakfast, $children, $pets, $parking, $notes
//hinzufügen die daten in die reservations tabelle
function insertResevation($db_obj,$room_id, $user_id, $check_in_date,$check_out_date,$guests,$breakfast,$children,$pets,$parking,$notes){

//test ob daten hinzugefügt werden können
 /*function insertResevation($db_obj,$room_id = 1,// Beispielwert
 $user_id = 1, // Beispielwert
 $check_in_date = '2024-12-25',
 $check_out_date = '2024-12-30',
 $guests = 2,
 $breakfast = 'mit',
 $children = 'kein',
 $pets = 'keine',
 $parking = 'ja',
 $notes = 'Testanmerkung'){*/
  
    $query= "INSERT INTO reservations(room_id, user_id, check_in_date,check_out_date,guests,breakfast,children,pets,parking,notes,created_at) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt=$db_obj->prepare($query);

    if(!$stmt){
        echo("Fehler" . $db_obj->error);
        exit();
    }
    $stmt->bind_param("iississsss", $room_id, $user_id, $check_in_date,$check_out_date,$guests,$breakfast,$children,$pets,$parking,$notes);

    if($stmt->execute()){
        return $stmt->insert_id;//(ID der Reservierung wird zurückgegeben);
    }else{
        echo("Fehler" . $stmt->error);
        return false;
    }


}

$reservation_id=filter_input(INPUT_GET,'reservation_id', FILTER_VALIDATE_INT);
$success=filter_input(INPUT_GET,'success', FILTER_VALIDATE_INT);

if($reservation_id&&$success==1){
  $reservation=getReservationByRoomId($db_obj,$reservation_id);

  if(!$reservation){
    echo'<div class="container mt-5">
    <p class="text-center my-3">Keine Reservierung gefunden.</p><a href="site_rooms.php">Zurück</a></div>';
    exit();
  }
}else {
  echo'<div class="container mt-5">
  <p class="text-center my-3">Ungültige Anfrage.</p><a href="site_rooms.php">Zurück</a></div>';
}



 

?>