  
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
    <div class="container-fluid">
      <div class="row vh-100">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar pt-5">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="site_dashboard.php">
                 
                  Dashboard 
                </a>
              </li>
              <?php if(isset($_SESSION['role'])&& $_SESSION['role']=='user'):?> 
              <li class="nav-item">
                <a class="nav-link" href="site_rooms.php">
        
                  Zimmerreservierung
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="site_reservation.php">
        
                  Reservierungsdetails
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                 
                 Vergangene Reservierungen
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="site_profil.php">
                
                  Profil
                </a>
              </li>
              <?php endif ;?>
              <?php if(isset($_SESSION['role'])&& $_SESSION['role']=='admin'):?> 
              <li class="nav-item">
                <a class="nav-link" href="site_upload.php">
                
                  Blogverwaltung
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="site_Reservierungsverwaltung">
                
                  Reservierungsverwaltung
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="site_Userverwaltung">
                
                Userverwaltung
                </a>
              </li>
             <?php endif;?>
             <div class="d-flex border-top mt-3 pt-3">
              <a href="fct_logout.php" class="btn btn-sm btn-outline-primary w-auto">logout</a>
             </div>
             
            </ul>
           </div>
        </nav>
      </div>
      
    </div>        


  
                

<?php include 'footer.php'; ?>     
                
                