<?php
require("lidhje.php");

$emri = $_POST['Emri'];
$mbiemri = $_POST['Mbiemri'];
$email = $_POST['Email'];
$pass = password_hash($_POST['Password'], PASSWORD_DEFAULT); // Hash password
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

