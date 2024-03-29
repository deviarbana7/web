<?php      
require("lidhje.php");

    $email = $_POST['email'];  
    $pass = $_POST['password'];  
      
        //to prevent from mysqli injection  
        $email = stripcslashes($username);  
        $pass = stripcslashes($pass);  
        $username = mysqli_real_escape_string($con, $email);  
        $pass = mysqli_real_escape_string($con, $pass);  
      
        $sql = "select *from users where email = '$email' and password = '$pass'";  
        $result = mysqli_query($con, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  
          
        if($count == 1){  
            echo " Login successful ";  
        }  
        else{  
            echo " Login failed. Invalid username or password.";  
        }     
?>  