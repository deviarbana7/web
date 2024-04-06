<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Faqe</title>
    <style>
        /* Hide the default scrollbar */
        body::-webkit-scrollbar {
            width: 8px; /* Width of the scrollbar */
        }

        /* Track */
        body::-webkit-scrollbar-track {
            background: #333; /* Color of the scrollbar track, matching the navbar background color */
        }

        /* Handle */
        body::-webkit-scrollbar-thumb {
            background: #888; /* Color of the scrollbar handle */
            border-radius: 6px; /* Rounded corners for the scrollbar handle */
        }

        /* Handle on hover */
        body::-webkit-scrollbar-thumb:hover {
            background: #555; /* Color of the scrollbar handle on hover */
        }

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
            top: 63px;
            right: 0;
            background-color: #333;
            min-width: 120px;
            display: none;
            z-index: 1;
            /* Ensures dropdown is on top of other content */
            flex-direction: column; /* Change direction to vertical */
        }

        .avatar-dropdown a {
            display: block;
            padding: 10px;
            color: #fff;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .avatar-dropdown a:hover {
            background-color: #555;
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
            flex-direction: column;
        }

        .form {
            width: 300px;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 30px 30px -30px rgba(27, 26, 26, 0.315);
            margin-bottom: 20px;
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

        .form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
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
            <a href="hyrje.php">Home</a>
            <a href="#">About</a>
            <a href="contact.php">Contact</a>
        </div>
        <div id="user-options" class="hidden">
            <div class="navbar-avatar">
                <img src="avatar2.png" alt="Avatar">
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
                <img src="avatar2.png" alt="Avatar">
                <div class="avatar-dropdown">
                    <a href="#">Profile</a>
                    <a href="settings.php">Settings</a>
                    <a href="logout.php">Sign Out</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="form-container">
        <form action="change_password.php" method="POST" class="form">
            <div class="title">Change Password</div>
            <input type="password" name="current_password" placeholder="Current Password" required>
            <input type="password" name="new_password" placeholder="New Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm New Password" required>
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
