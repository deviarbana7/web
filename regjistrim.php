<?php
require("lidhje.php");

$emri = $_POST['emri'];
$mbiemri = $_POST['mbiemri'];
$email = $_POST['email'];
$pass = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password

// Prepare SQL statement to prevent SQL injection
$stmt = $con->prepare("INSERT INTO users (emri, mbiemri, email, password) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $emri, $mbiemri, $email, $pass);

// Execute SQL statement
if ($stmt->execute()) {
    echo "Data inserted successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close database connection
$con->close();
?>
