<?php include('fct_session.php'); ?>

<?php
session_start();
?>

<nav class="navbar navbar-expand-sm navbar-light bg-primary">
  <div class="container-fluid">
      <!-- Links -->
      <ul class="navbar-nav ms-auto me-4"> <!--ms-auto align items to the end-->
        <li class="nav-item">
          <a class="nav-link" href="index.php"><h4>Home</h4></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../pages/zimmer.php"><h4>Zimmer</h4></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../pages/blog.php"><h4>News</h4></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="include/dashboard.php" role="button" data-bs-toggle="dropdown"><h4>Login</h4></a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="../pages/fct_login.php">Kunden</a></li>
            <li><a class="dropdown-item" href="admin_login.php">Admin</a></li>
            <li><a class="dropdown-item" href="../pages/fct_register.php">Sign up</a></li>
            <li><a class="dropdown-item" href="index.php">Anonym</a></li>
          </ul>
        </li> 
</li>
        
      </ul>
      
    </div>
</nav>
