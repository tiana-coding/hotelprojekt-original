
    
<?php
                
session_start();
include'include/header.php';
    


// wenn Cookie existiert

// weder Session noch Cookie ist gesetzt weiterleiten
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
    }
$kundendaten = $_SESSION['kundendaten'];

?>




<?php include 'include/header.php'; ?>
<?php include 'include/nav.php'; ?>
<h1 class="container text-center">Willkommen, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
<?php include 'kundendaten.php'; ?>



<?php include 'finclude/ooter.php'; ?>     

