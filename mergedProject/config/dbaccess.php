<?php
$servername = "localhost";
$username = "root";
$password = "Bingki!2020$!";
$dbname = "users";

// Create connection
$db_obj = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($db_obj->connect_error) {
  die("Connection failed: " . $conn->connect_error);
  
}

//wenn es keine fehlermeldung gibt->dann ist die datenbank erfolgreich verbunden
//wenn session nicht gesetzt ist, soll es starten
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}