<?php
require("lidhje.php");
session_start(); // Start session

$isLoggedIn = false; // Default value for login status

// Check if session variable is set to indicate user is logged in
if (isset($_SESSION['user'])) {
    $isLoggedIn = true;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Contact</title>
    <style>
        /* styles.css */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background-color: #333;
            color: #fff;
        }

        .navbar-logo a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            font-size: 24px;
        }

        .navbar-links a {
            color: #fff;
            text-decoration: none;
            margin-right: 20px;
        }

        .navbar-avatar img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
        }

        .avatar-dropdown {
            position: absolute;
            top: 50px;
            right: 0;
            background-color: #333;
            min-width: 120px;
            display: none;
            z-index: 1;
            /* Ensures dropdown is on top of other content */
        }

        .navbar-avatar:hover .avatar-dropdown,
        .avatar-dropdown:hover {
            display: block;
        }

        .navbar-avatar,
        .avatar-dropdown {
            transition-delay: 0.2s;
            /* Add a slight delay before hiding the dropdown */
        }

        .hidden {
            display: none;
        }

        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form {
            width: 300px;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 30px 30px -30px rgba(27, 26, 26, 0.315);
        }

        .form .title {
            color: royalblue;
            font-size: 30px;
            font-weight: 600;
            letter-spacing: -1px;
            line-height: 30px;
            margin-bottom: 20px;
            text-align: center;
        }

        .form input,
        .form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .form textarea {
            height: 100px;
        }

        .form button {
            width: 100%;
            padding: 10px;
            background-color: royalblue;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="navbar-logo">
            <a href="#">Logo</a>
        </div>
        <div class="navbar-links">
            <a href="#">Home</a>
            <a href="#">About</a>
            <a href="contact.php">Contact</a>
        </div>
        <div id="user-options" class="hidden">
            <div class="navbar-avatar">
                <img src="avatar.jpg" alt="Avatar">
                <div class="avatar-dropdown">
                    <a href="#">Profile</a>
                    <a href="#">Settings</a>
                    <a href="#">Sign Out</a>
                </div>
            </div>
        </div>
        <div id="login-section"<?php if ($isLoggedIn) { echo ' style="display: none;"'; } ?>>
            <!-- Button for login -->
            <a href="login.php"><button id="signin-btn">Sign In</button></a>
        </div>
        <div id="user-options"<?php if (!$isLoggedIn) { echo ' class="hidden"'; } ?>>
            <div class="navbar-avatar">
                <img src="avatar.jpg" alt="Avatar">
                <div class="avatar-dropdown">
                    <a href="#">Profile</a>
                    <a href="#">Settings</a>
                    <a href="logout.php">Sign Out</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="form-container">
        <form action="https://api.web3forms.com/submit" method="POST" class="form">
            <div class="title">Contact us</div>
            <input type="hidden" name="access_key" value="11786ee1-23d0-4a38-b793-e10b89c77ee1">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <textarea name="message" placeholder="Your message" required></textarea>
            <button type="submit">Submit</button>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("signin-btn").addEventListener("click", function () {
                // Redirect to login.php
                window.location.href = "logout.php";
            });
            const loginSection = document.getElementById("login-section");
            const userOptions = document.getElementById("user-options");

            // Function to simulate login
            function login(username) {
                // Simulated login logic
                // Show user options and hide login section
                loginSection.classList.add("hidden");
                userOptions.classList.remove("hidden");
                // Display user information
                document.getElementById("user-info").textContent = `Logged in as ${username}`;
            }

            // Event listener for sign in button
            document.getElementById("signin-btn").addEventListener("click", function () {
                // Simulated sign in
                login("User");
            });

            // Event listener for sign out button
            document.getElementById("signout-btn").addEventListener("click", function () {
                // Simulated sign out
                loginSection.classList.remove("hidden");
                userOptions.classList.add("hidden");
            });
        });
    </script>
</body>

</html>
