<?php include('fct_session.php'); ?>

<?php
session_start();
?>

<nav class="navbar navbar-expand-lg navbar-light bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="../pages/index.php"><img src="../res/assets/img/pct_hotel-emoji.png" height="28px"/></a>

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
        
        <?php 
        session_start();
        if (isset($_SESSION['username'])): ?>
          <li class="nav-item"><a class="nav-link" href="site_rooms.php">Zimmerreservierung</a></li>
          <li class="nav-item"><a class="nav-link" href="site_upload.php">Bildupload</a></li>
          <li class="nav-item"><a class="nav-link" href="site_logout.php">Logout</a></li>
          <li class="nav-item"><span class="navbar-text">Willkommen, <?= htmlspecialchars($_SESSION['username']); ?>!</span></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="../include/fct_login.php"><h4>Login</h4></a></li>
          <li class="nav-item"><a class="nav-link" href="../include/fct_register.php"><h4>Registrierung</h4></a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>