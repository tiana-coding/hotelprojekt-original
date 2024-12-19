<?php include '../include/header.php';?>

<?php
// Session starten
session_start();

// Logout-Mechanismus
if (isset($_GET['logout'])) {
    session_unset(); // Alle Session-Daten löschen
    session_destroy(); // Session zerstören
    echo "<p>Sie haben sich erfolgreich ausgeloggt.</p>";
}
?>

<div class="container-fluid hero">
  
  <div class="hero-content text-center text-white">
    <div class="container">

        <h1 class="display-5 fw-bold">Blick and Glück</h1>
        <div class="col-lg-6 mx-auto">
          <p class="lead mb-4 display-7 fw-bold">Resort und SPA Hotel</p>
        </div> 
        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
            <button type="button" class="btn btn-primary btn-lg fw-bolder px-4"><a href="?logout=true" class="text-center text-white text-decoration-none">Logout</a></button>
            
        </div>  
    </div>
  </div>
</div> 

<?php include '../include/footer.php';?>