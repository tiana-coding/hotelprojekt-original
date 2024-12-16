<?php
session_start();

if (isset($_SESSION['username'])) {
    $welcomeMessage = "Willkommen, " . $_SESSION['username'] . "!";
    $loggedIn = true;
} else {
    $welcomeMessage = "Sie sind nicht eingeloggt.";
    $loggedIn = false;
}
?>