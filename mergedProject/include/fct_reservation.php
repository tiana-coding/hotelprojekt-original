<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('fct_session.php'); 
require_once '../config/dbaccess.php';



if(!$db_obj){
  die("Es besteht keine verbindung zur Datenbank.");
}
include('header.php');
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
//$db_obj, $room_id, $user_id, $check_in_date, $check_out_date, $guests, $breakfast, $children, $pets, $parking, $notes
function insertResevation($db_obj,$room_id, $user_id, $check_in_date,$check_out_date,$guests,$breakfast,$children,$pets,$parking,$notes,$created_at){
    $query= "INSERT INTO reservations(room_id, user_id, check_in_date,check_out_date,guests,breakfast,children,pets,parking,notes,created_at) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

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