
<?php

include('header.php');
include('../config/dbaccess.php');

if(isset($_SESSION['success'])) {   
    
    echo'<div class="alert alert-success" role="alert"><p class="text-center">' . htmlspecialchars($_SESSION['success']) . '</p></div>';
    
    unset($_SESSION['success']);

}



?>
<div class="container">
    <h1 class="text-center">Kundendaten</h1>
    <p class="text-center">Hier können Sie Ihre Daten bearbeiten</p>
</div>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Kunden </th>
      <th scope="col">Anrede</th>
      <th scope="col">Vorname</th>
      <th scope="col">Nachname</th>
      <th scope="col">Username</th>
      <th scope="col">E-Mail</th>
      <th scope="col">Passwort</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td><?php echo htmlspecialchars($kundendaten['sex']); ?></td>
      <td><?php echo htmlspecialchars($kundendaten['vorname']); ?></td>
      <td><?php echo htmlspecialchars($kundendaten['nachname']); ?></td>
      <td><?php echo htmlspecialchars($kundendaten['username']); ?></td>
      <td><?php echo htmlspecialchars($kundendaten['email']); ?></td>
      <td><?php echo htmlspecialchars($kundendaten['passwort']); ?></td>
    </tr>
   </tbody>
</table> 
<a href="site_profileverwaltung.php" class="btn btn-lg btn-primary">Daten bearbeiten</a></button>
<a href="fct_logout.php" class="btn btn-lg btn-primary">Abmelden</a>

<?php include('footer.php'); ?>
