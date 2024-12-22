<!-- include('fct_rooms.php'); -->
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
<!-- rooms.php -->