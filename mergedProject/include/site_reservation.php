<?php
include('fct_session.php'); 
require_once '../config/dbaccess.php';
if(!$db_obj){
  die("Es besteht keine verbindung zur Datenbank.");
}
include('header.php');
if($_SERVER['REQUEST_METHOD']=='POST'){
    header("Location: site_reservation.php?room_id=" . urlencode($room_id) . "&success=1");
    exit();
}?>
<div class="container mt-4">
    <h1 class="text-center">Reservierung erfolgreich!</h1>
    <p class="text-center">Wir werden umgehend Ihre Reservierung bearbeiten.</p>
    
</div>



<?php include('footer.php');?>

