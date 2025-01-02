<?php


include 'fct_session.php';
include 'header.php';
require_once '../config/dbaccess.php' ;
$sql="SELECT *FROM rooms WHERE available = 1 ";


?>