<?php include('fct_session.php'); ?>

<nav class="navbar navbar-expand-lg navbar-light bg-primary">
 
  <div class="container-fluid">
    <a class="navbar-brand" href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', $_SERVER['DOCUMENT_ROOT'] . '/hotelprojekt-original/mergedProject/index.php'); ?>">
      <img src="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', $_SERVER['DOCUMENT_ROOT'] . '/hotelprojekt-original/mergedProject/res/assets/img/pct_hotel-emoji.png'); ?>" alt="hotel-emoji" height="28px"/></a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', $_SERVER['DOCUMENT_ROOT'] . '/hotelprojekt-original/mergedProject/index.php'); ?>">
            <h4>Home</h4></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', $_SERVER['DOCUMENT_ROOT'] . '/hotelprojekt-original/mergedProject/include/site_blog.php'); ?>">
            <h4>News</h4></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', $_SERVER['DOCUMENT_ROOT'] . '/hotelprojekt-original/mergedProject/include/site_impressum.php'); ?>">
            <h4>Impressum</h4></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', $_SERVER['DOCUMENT_ROOT'] . '/hotelprojekt-original/mergedProject/include/site_help.php'); ?>">
            <h4>Hilfe</h4></a>
        </li>
        
       
        
          
          <li class="nav-item">
            <a class="nav-link" href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', $_SERVER['DOCUMENT_ROOT'] . '/hotelprojekt-original/mergedProject/include/fct_register.php'); ?>">
              <h4>Registrierung</h4></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', $_SERVER['DOCUMENT_ROOT'] . '/hotelprojekt-original/mergedProject/include/fct_login.php'); ?>">
              <h4>Login</h4></a>
          </li>
      <?php 
      // user oder admin können sich ausloggen
      if (isset($_SESSION['role'])&& $_SESSION['role']=='user'): ?>   
      <div class="dropdown">
        <button class="btn btn-warning dropdown-toggle" id="dropdownMenubutton" data-bs-toggle="dropdown" aria-expanded="false">Willkommen, <?= htmlspecialchars($_SESSION['username']); ?>!</button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenubutton">
            <li><a class="dropdown-item" href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', $_SERVER['DOCUMENT_ROOT'] . '/hotelprojekt-original/mergedProject/include/site_dashboard.php'); ?>">Kundenprofil</a></li> 
          
             <!-- loggout -->
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', $_SERVER['DOCUMENT_ROOT'] . '/hotelprojekt-original/mergedProject/include/fct_logout.php'); ?>">
                Logout</a></li>
        </ul>
       </div>        
        <?php endif; ?>   

        <!-- admin können Bildupload -->
        <?php if(isset($_SESSION['role'])&& $_SESSION['role']=='admin'):?> 
          <div class="dropdown">
          <button class="btn btn-warning dropdown-toggle" id="dropdownMenubutton" data-bs-toggle="dropdown" aria-expanded="false">Willkommen, <?= htmlspecialchars($_SESSION['role']); ?>!</button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenubutton">
            <li><a class="dropdown-item" href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', $_SERVER['DOCUMENT_ROOT'] . '/hotelprojekt-original/mergedProject/include/site_dashboard.php'); ?>">Adminkonto</a></li>
        
             <!-- loggout -->
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', $_SERVER['DOCUMENT_ROOT'] . '/hotelprojekt-original/mergedProject/include/fct_logout.php'); ?>">
                Logout</a></li>
          </ul> 
          </div>        
          <?php endif; ?>
               
             
      
      </ul>
    </div>
  </div>
</nav>