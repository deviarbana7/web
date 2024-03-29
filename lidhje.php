<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$database = "prov";

// Create connection
$con = new mysqli($servername, $username, $password, $database);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>
