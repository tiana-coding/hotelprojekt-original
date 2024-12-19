<?php include '../include/header.php';  ?>

<?php 
// Session starten
session_start();

// Logout-Mechanismus
if (isset($_GET['logout'])) {
    session_unset(); // Alle Session-Daten löschen
    session_destroy(); // Session zerstören
}

?>

<!-- Hero-Section für das Logout -->
<div class="container-fluid hero">
    <div class="hero-content text-center text-white">
        <div class="container">
            <h2 class="display-4">Sie haben sich erfolgreich ausgeloggt</h2>
            <p class="lead mb-4">Danke, dass Sie bei uns waren! Sie können nun zur Startseite zurück.</p>
            
            <!-- Optional: Button, um die Weiterleitung manuell zu triggern -->
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
              <button type="button" class="btn btn-primary btn-lg fw-bolder px-4">
                <a href="?logout=true" class="text-center text-white text-decoration-none">Logout</a>
              </button>
              <button type="button" class="btn btn-primary btn-lg fw-bolder px-4">
                  <a href="../index.php" class="text-center text-white text-decoration-none">Zur Startseite</a>
              </button>
            </div>  
        </div>
    </div>
</div> 

<?php 
// Footer einbinden
include '../include/footer.php';
?>
