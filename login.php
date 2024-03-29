<?php
require("lidhje.php");
session_start();
if(isset($_SESSION['users'])){
 header("location:jo.html");
 die();
}
$mesazh="";
if (isset($_POST['Login'])){
 if(isset($_POST['email']) && isset($_POST['password'])){
 $email=$_POST['email'];
 $password=$_POST['password'];

 // Prepare SQL statement to prevent SQL injection
 $stmt = $con->prepare("SELECT * FROM users WHERE email=?");
 $stmt->bind_param("s", $email);
 $stmt->execute();

 $result = $stmt->get_result();
 $rresht = $result->fetch_array(MYSQLI_ASSOC);

 // Verify password
 if (password_verify($password, $rresht['password'])) {
     $_SESSION['users']=$rresht[0];
     header("location:jo.html");
 } else {
     $mesazh="Te dhenat jo te sakta";
 }
 }
}
mysqli_close($con);
?>
