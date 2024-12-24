<?php 

/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

include('header.php');
require_once '../config/dbaccess.php';
include('fct_reservation.php');


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
    
      <!--$check_in_date, $check_out_date, $guests, $breakfast, $children, $pets, $parking, $notes, $created_at -->
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
        <td>Haustier</td>
        <td><?php echo htmlspecialchars($pets);?></td>
      </tr>
      <tr>
        <th scope="row">6</th>
        <td>Parkplatz</td>
        <td><?php echo htmlspecialchars($parking);?></td>
      </tr>
      <tr>
        <th scope="row">7</th>
        <td>Sonstige</td>
        <td><?php echo htmlspecialchars($notes);?></td>
      </tr>
      
    
    </tbody>
  </table>
  <!-- Button für Status Check -->
  <form action="status_check.php" method="GET">
    <input type="hidden" name="reservation_id" value="<?php echo $reservation_id; ?>"> <!-- Beispiel ID -->
    <button type="submit" class="btn btn-primary mt-3">Status abrufen</button>
  </form>
</div>
</div>



<?php include('footer.php');?>

