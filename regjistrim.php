<?php
$emri = $_POST['emri'];
$mbiemri = $_POST['mbiemri'];
$email = $_POST['email'];
$pass = $_POST['password']; // Changed variable name to avoid conflict

$servername = "localhost";
$username = "root"; 
$password = ""; 
$database = "prov";

$con = mysqli_connect($servername, $username, $password, $database) or die('Provo perseri');

$sql = "INSERT INTO users (emri, mbiemri, email, password) VALUES ('$emri', '$mbiemri', '$email', '$pass')"; // Fixed password variable usage

// Execute SQL statement
if ($con->query($sql) === TRUE) {
    echo "Data inserted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}

// Close database connection
$con->close();
?>
