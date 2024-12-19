<?php
// Session starten
session_start();

// Logout-Mechanismus
if (isset($_GET['logout'])) {
    session_unset(); // Alle Session-Daten löschen
    session_destroy(); // Session zerstören
    
    // Überprüfe, ob der Benutzer noch eingeloggt ist
  if (isset($_SESSION['username'])) {
    echo "Du bist noch eingeloggt.";
  } else {
    echo "Du hast dich erfolgreich ausgeloggt.";
  }

    // Benutzer weiterleiten
    header("Location: ../index.php"); // Weiterleitung zur Startseite (oder eine andere Seite)
    exit();
}
?>

<!-- logout -->
<?php include '../include/header.php';?>

<div class="container-fluid my-5">
    <h2 class="text-center">Logout</h2>
    <div class="hero-content text-center text-white">
        <div class="container">
            <h1 class="display-5 fw-bold">Blick and Glück</h1>
            <div class="col-lg-6 mx-auto">
                <p class="lead mb-4 display-7 fw-bold">Resort und SPA Hotel</p>
            </div> 
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <button type="button" class="btn btn-primary btn-lg fw-bolder px-4">
                    <a href="index.php" class="text-center text-white text-decoration-none">Zur Startseite</a>
                </button>
            </div>  
        </div>
    </div> 
</div> 

<?php include '../include/footer.php';?>