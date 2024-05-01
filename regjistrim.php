<?php
require("lidhje.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . 'vendor\twilio\sdk\Twilio\autoload.php';
use Twilio\Rest\Client;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';



$emri = $_POST['Emri'];
$mbiemri = $_POST['Mbiemri'];
$email = $_POST['Email'];
$password = password_hash($_POST['Password'], PASSWORD_DEFAULT); // Hash password

// Generate random 6-digit verification code
$verification_code = rand(100000, 999999);

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
    $insert_query = "INSERT INTO users (emri, mbiemri, email, password, verification_code) VALUES (?, ?, ?, ?, ?)";
    $stmt = $con->prepare($insert_query);
    $stmt->bind_param("sssss", $emri, $mbiemri, $email, $password, $verification_code);

    // Execute SQL statement to insert new user
    if ($stmt->execute()) {
        echo "Data inserted successfully";

        // Send verification code to user's email
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'faqeshkolle1@gmail.com';
        $mail->Password = 'zehbutluyfnufoof';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('faqeshkolle1@gmail.com');
        $mail->addAddress($_POST["Email"]);
        $mail->isHTML(true);
        $mail->Subject = 'Verification Code';
        $mail->Body = 'Your verification code is: ' . $verification_code;

        if ($mail->send()) {
            echo "Verification code sent successfully";
        } else {
            echo "Error sending verification code: " . $mail->ErrorInfo;
        }
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Close database connection
$stmt->close();
$con->close();
?>
