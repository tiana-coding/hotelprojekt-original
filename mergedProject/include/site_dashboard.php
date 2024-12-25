  
<?php
                
 include 'header.php';
                
                
if (!isset($_SESSION['username'])) {
header('Location: fct_login.php');
                
exit();
}
                
if (isset($_SESSION['success_msg']))    
$success_msg = $_SESSION['success_msg'];
unset($_SESSION['success_msg']);
                
?>
                
                
                
                
<?php if(!empty($success_msg)): ?>
<div class="alert alert-success">
<?php echo htmlspecialchars($success_msg);?>
                
</div>  
<?php endif;?>
                
<h1 class="container text-center mt-4 py-4">Willkommen, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>

  
                

<?php include 'footer.php'; ?>     
                
                