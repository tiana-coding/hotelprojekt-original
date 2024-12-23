<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('header.php');


$guests = $breakfast = $children = $pets = $parking = $notes = $check_in_date = $check_out_date = '';


  if($_SERVER['REQUEST_METHOD']=='POST'){

    
    $check_in_date = $_POST['check_in_date'] ?? '';
    $check_out_date = $_POST['check_out_date'] ?? '';
    $guests = $_POST['guests'] ?? '';
    $breakfast = $_POST['breakfast'] ?? '';
    $children = $_POST['children'] ?? '';
    $pets = $_POST['pets'] ?? '';
    $parking = $_POST['parking'] ?? '';
    $notes = $_POST['notes'] ?? '';
  
  }

$username=$_SESSION['username'];

//debugging
//var_dump($room_id, $username, $check_in_date, $check_out_date, $guests, $breakfast, $children, $pets, $parking, $notes);


  
  //debugging
  


  $error_msg=[];
  //Validierung
  //pflichtfelder check
  if(empty($check_in_date) ||empty($check_out_date)){
    $error_msg[]="Pflichtfelder, bitte ausfüllen.";
  } 


  //datum soll nicht in der vergangenkeit liegen
  $today=date('Y-m-d');
  if(!empty($check_in_date) && !empty($check_out_date)){
  
    
    if($check_in_date<$today || $check_out_date<$today){
      $error_msg[]="Datum liegt in der Vergangenheit!";
    
    }
  
    if($check_out_date<=$check_in_date){
        $error_msg[]="Aufenthalt zu kurz!";
      }


    if(!empty($error_msg)){
      echo'<div class="alert alert-warning">';
      foreach($error_msg as $error){
        echo"<p>$error</p>";
      }
      
    }
  
    
    
  } 

?>
<!-- reservation tabel ausgeben -->
<div class="container mt-5">
  <h1 class="text-center my-3">Ihre Reservierung ist bei uns eingegangen.</h1>
  <table class="table table-bordered mt-3 p-3">
    <thead class="thead-light">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Feld</th>
        <th scope="col">Details</th>
      </tr>
    </thead>
    <tbody>
      
      
      <tr>
        <th scope="row">1</th>
        <td>Check-in Datum</td>
        <td><?php echo htmlspecialchars($check_in_date);?></td>
      </tr>
      <tr>
        <th scope="row">2</th>
        <td>Check-out Datum</td>
        <td><?php echo htmlspecialchars($check_out_date);?></td>
      </tr>
    
      <!-- $room_id, $check_in_date, $check_out_date, $guests, $breakfast, $children, $pets, $parking, $notes, $created_at -->
      <tr>
        <th scope="row">3</th>
        <td>Anzahl der Gäste</td>
        <td><?php echo htmlspecialchars($guests);?></td>
      </tr>
      <tr>
        <th scope="row">4</th>
        <td>Frühstück Option</td>
        <td><?php echo htmlspecialchars($breakfast);?></td>
      </tr>
      <tr>
        <th scope="row">5</th>
        <td>Kinder</td>
        <td><?php echo htmlspecialchars($children);?></td>
      </tr>
      <tr>
        <th scope="row">6</th>
        <td>Haustier</td>
        <td><?php echo htmlspecialchars($pets);?></td>
      </tr>
      <tr>
        <th scope="row">7</th>
        <td>Parkplatz</td>
        <td><?php echo htmlspecialchars($parking);?></td>
      </tr>
      <tr>
        <th scope="row">8</th>
        <td>Sonstige</td>
        <td><?php echo htmlspecialchars($notes);?></td>
      </tr>
    
    </tbody>
  </table>
</div>



<?php include('footer.php');?>

