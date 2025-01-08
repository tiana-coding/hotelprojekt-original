<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (isset($_SESSION['role']) || isset($_SESSION['username'])) {
    $welcomeMessage = isset($_SESSION['username']) ? "Willkommen, " . $_SESSION['username'] . "!" : "Willkommen, Gast!";
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