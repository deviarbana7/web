<?php
require("lidhje.php");

$emri = $_POST['emri'];
$mbiemri = $_POST['mbiemri'];
$email = $_POST['email'];
$pass = $_POST['password']; // Changed variable name to avoid conflict

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
