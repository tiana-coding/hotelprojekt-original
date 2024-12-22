<?php include 'fct_reservation.php';
  

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
        <td>Zimmernummer</td>
        <td><?php echo htmlspecialchars($reservation['room_id']);?></td>
      </tr>
      <tr>
        <th scope="row">2</th>
        <td>Zimmer</td>
        <td><?php echo htmlspecialchars($reservation['category']);?></td>
      </tr>
      <tr>
        <th scope="row">3</th>
        <td>Preis pro Nacht</td>
        <td><?php echo htmlspecialchars($reservation['price_per_night']);?></td>
      </tr>
      <tr>
        <th scope="row">4</th>
        <td>Check-in Datum</td>
        <td><?php echo htmlspecialchars($reservation['check_in_date']);?></td>
      </tr>
      <tr>
        <th scope="row">5</th>
        <td>Check-out Datum</td>
        <td><?php echo htmlspecialchars($reservation['check_out_date']);?></td>
      </tr>
    
      <!-- $room_id, $check_in_date, $check_out_date, $guests, $breakfast, $children, $pets, $parking, $notes, $created_at -->
      <tr>
        <th scope="row">6</th>
        <td>Anzahl der Gäste</td>
        <td><?php echo htmlspecialchars($reservation['guests']);?></td>
      </tr>
      <tr>
        <th scope="row">7</th>
        <td>Frühstück Option</td>
        <td><?php echo htmlspecialchars($reservation['breakfast']);?></td>
      </tr>
      <tr>
        <th scope="row">8</th>
        <td>Kinder</td>
        <td><?php echo htmlspecialchars($reservation['children']);?></td>
      </tr>
      <tr>
        <th scope="row">9</th>
        <td>Haustier</td>
        <td><?php echo htmlspecialchars($reservation['pets']);?></td>
      </tr>
      <tr>
        <th scope="row">10</th>
        <td>Parkplatz</td>
        <td><?php echo htmlspecialchars($reservation['parking']);?></td>
      </tr>
      <tr>
        <th scope="row">11</th>
        <td>Sonstige</td>
        <td><?php echo htmlspecialchars($reservation['notes']);?></td>
      </tr>
      <tr>
        <th scope="row">12</th>
        <td>Bearbeitet</td>
        <td><?php echo htmlspecialchars($reservation['created_at']);?></td>
      </tr>
      
      

    </tbody>
  </table>
</div>



<?php include('footer.php');?>

