<?php
require("lidhje.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


$emri = $_POST['Emri'];
$mbiemri = $_POST['Mbiemri'];
$email = $_POST['Email'];
$password = password_hash($_POST['Password'], PASSWORD_DEFAULT); // Hash password

// Check if the email already exists in the database
$email_check_query = "SELECT * FROM users WHERE email=?";
$stmt = $con->prepare($email_check_query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Email already exists, send error message
    echo "This email is already registered. Please use a different email.";
} else {
    // Prepare SQL statement to insert new user
    $insert_query = "INSERT INTO users (emri, mbiemri, email, password) VALUES (?, ?, ?, ?)";
    $stmt = $con->prepare($insert_query);
    $stmt->bind_param("ssss", $emri, $mbiemri, $email, $password);

    // Execute SQL statement to insert new user
    if ($stmt->execute()) {
        echo "Data inserted successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Close database connection
$stmt->close();
$con->close();
?>
