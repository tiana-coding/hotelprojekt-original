<?php
include('fct_session.php'); 
require_once '../config/dbaccess.php';
if(!$db_obj){
  die("Es besteht keine verbindung zur Datenbank.");
}
include('header.php');
if(isset($_GET['room_id'],$_GET['success'])&& $_GET['success']==1){
    $room_id=intval(($_GET['room_id']));


//hole die infos über die reservierung aus der db
    $query="SELECT * FROM rooms WHERE id = ?";
    $stmt=$db_obj->prepare($query);
    $stmt->bind_param("i", $room_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows==0){
        die("Zimmer nicht gefunden.");
    }
    $room = $result->fetch_assoc();

}else{
    echo "Angabe nicht gültig.";
}

include('footer.php');?>
