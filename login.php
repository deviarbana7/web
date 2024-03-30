<?php
require("lidhje.php");
session_start();
if(isset($_SESSION['users'])){
 header("location:hyrje.php");
 die();
}
if (isset($_POST["Login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
     require_once "database.php";
     $sql = "SELECT * FROM users WHERE email = '$email'";
     $result = mysqli_query($conn, $sql);
     $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
     if ($user) {
         if (password_verify($password, $user["password"])) {
             session_start();
             $_SESSION["user"] = "yes";
             header("Location: hyrje.php");
             die();
         }else{
             echo "<div class='alert alert-danger'>Password does not match</div>";
         }
     }else{
         echo "<div class='alert alert-danger'>Email does not match</div>";
     }
 }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }

        form {
            width: 600px;
            display: flex;
            flex-wrap: wrap;
            /* Allow elements to wrap */
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-content {
            width: 48%;
            /* Adjusted width for two columns */
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-right: 20px;
            box-sizing: border-box;
        }

        .form-content label,
        .form-content input {
            margin-bottom: 15px;
            width: 100%;
        }

        .form-content input {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .form-content button {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px;
            cursor: pointer;
            width: 100%;
        }

        .form-content button:hover {
            background-color: #0056b3;
        }

        .form-img {
            position: relative;
            width: 200px;
            height: auto;
            right: 35px;
        }

        .form-links {
            width: 100%;
            text-align: center;
            margin-top: 10px;
        }

        .form-links a {
            color: #007bff;
            text-decoration: none;
        }

        .form-links a:hover {
            text-decoration: underline;
        }

        /* WhatsApp icon */
        .whatsapp-icon {
            position: fixed;
            bottom: 20px;
            left: 20px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <form method="post" id="retrieveData">
        <div class="form-content">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
            <button type="submit" name="Login" value="Login">Login</button>
            <div class="form-links">
                Don't have an account?<a href="index.html">Regjistrohu</a>
            </div>
        </div>
        <img class="form-img" src="download (1).png" alt="umsh">
    </form>
    <a class="whatsapp-icon" href="https://wa.me/+355674930586">
        <img src="1298775_whatsapp_chat_sms_social media_talk_icon.png" alt="WhatsApp">
    </a>
    <script>
        $(document).ready(function () {
            $('#retrieveData').submit(function (e) {
                e.preventDefault(); // Prevent form submission

                // Get form data
                var formData = $(this).serialize();

                // Send AJAX request to PHP script
                $.ajax({
                    type: 'POST',
                    url: 'login.php',
                    data: formData,
                    success: function (response) {
                        // Display success message
                        if (response.trim() == "Data inserted successfully") {
                            alert("Login successful!");
                            window.location.href = "jo.html";
                        } else {
                            alert(response);
                        }
                    },
                    error: function (xhr, status, error) {
                        // Display error message
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>

</body>

</html>