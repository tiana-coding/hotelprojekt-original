  
<?php
                
session_start();


if (!isset($_SESSION['username'])) {
    header('Location: fct_login.php');

    exit();
    }

if (isset($_SESSION['success_msg']))    
$success_msg = $_SESSION['success_msg'];
unset($_SESSION['success_msg']);

?>




<?php include '../include/header.php' ?>
<?php include '../include/nav.php' ?>
<!-- nach der erfolgreichen meldung, wird user mit verzoegerung weiter an login geleitet -->
<meta http-equiv="refresh" content="1;url=fct_login.php ">

<?php if(!empty($success_msg)): ?>
    <div class="alert alert-success">
        <?php echo htmlspecialchars($success_msg);?>

    </div>  
<?php endif;?>

<h1 class="container text-center mt-4 py-4">Willkommen, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>

<!-- <?php include 'kundendaten.php'; ?> -->



<?php include '../include/footer.php'; ?>     

