<?php
session_start();
if (isset($_SESSION['role'])&& isset(($_SESSION['username']))) {
    $welcomeMessage = "Willkommen, " . $_SESSION['username'] . "!";
    $loggedIn = true;
} if (!isset($_SESSION['role'])) {
    $_SESSION['role'] = 'anonym';
    header("Location:index.php");
    exit();
}
else {
    $welcomeMessage = "Sie sind nicht eingeloggt.";
    $loggedIn = false;
}

?>