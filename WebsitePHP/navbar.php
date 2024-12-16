<?php include('fct_session.php'); ?>

<?php
session_start();
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light bg-lib">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php"><img src="pct_hotel-emoji.png" height="28px"/></a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="site_register.php">Registrierung</a></li>
        <li class="nav-item"><a class="nav-link" href="site_impressum.php">Impressum</a></li>
        <li class="nav-item"><a class="nav-link" href="site_help.php">Hilfe</a></li>
        
        <?php 
        session_start();
        if (isset($_SESSION['username'])): ?>
          <li class="nav-item"><a class="nav-link" href="site_rooms.php">Zimmerreservierung</a></li>
          <li class="nav-item"><a class="nav-link" href="site_upload.php">Bildupload</a></li>
          <li class="nav-item"><a class="nav-link" href="site_logout.php">Logout</a></li>
          <li class="nav-item"><span class="navbar-text">Willkommen, <?= htmlspecialchars($_SESSION['username']); ?>!</span></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="site_login.php">Login</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
