<?php

$dbhost="localhost";
$dbuser="root";
$dbpass="";
$dbname="mfa_car_wash";

// Create connection
$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// Check connection
if (!$con) {
    die("Failed to connect: " . mysqli_connect_error());
}

?>