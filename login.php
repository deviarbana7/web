<?php
require("lidhje.php");
session_start();
if(isset($_SESSION['user'])){
 header("location:hyrje.html");
 die();
}
if (isset($_POST["Login"])) {
    $email = $_POST["Email"];
    $pass = $_POST["Password"];
    require_once "lidhje.php";
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($con, $sql);
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if ($user) {
        // Hash the password entered in the login form
        $hashed_password_login = password_hash($pass, PASSWORD_DEFAULT);
        // Compare the hashed password from the login form with the hashed password stored in the database
        if (password_verify($pass, $user["Password"])) {
            session_start();
            $_SESSION["user"] = "yes";
            header("Location:hyrje.html");
            die();
        } else {
            $message = "Password does not match";
        }
    } else {
        $message = "Email does not match";
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
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
        .input-box {
            position: relative;
            width: 100%;
        }

        .input-box input[type="password"] {
            margin-bottom: 15px;
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .input-box img {
            position: absolute;
            top: 52.5%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            width: 20px;
            /* Adjusted size of the eye icon */
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
        @media (max-width: 768px) {

/* Adjust form width for smaller screens */
form {
    width: 50%;
}

.form-content {
    width: 100%;
    padding-right: 0;
    /* Remove right padding for smaller screens */
}

.form-img {
    display: none;
}
}
    </style>
</head>

<body>
    <form method="post">
        <div class="form-content">
            <label for="email">Email:</label>
            <input type="email" id="email" name="Email">
            <div class="input-box">
                <label for="password">Password:</label>
                <input type="password" id="password" name="Password">
                <img src="eye-close.png" id="eyeicon">
            </div>
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

<?php if(isset($message)): ?>
    <script>
        alert("<?php echo $message; ?>");
    </script>
<?php endif; ?>
    <script>
        let eyeicon = document.getElementById("eyeicon");
        let password = document.getElementById("password");

        eyeicon.onclick = function () {
            if (password.type == "password") {
                password.type = "text";
                eyeicon.src = "eye-open.png"
            } else {
                password.type = "password";
                eyeicon.src = "eye-close.png"
            }
        };
    </script>
</body>

</html>
