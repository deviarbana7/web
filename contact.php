<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <title>Contact</title>
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f3f3f3;
            /* Background color for demonstration purposes */
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
        .form {
            position: relative;
            display: flex;
            align-items: center;
            /* Center items vertically */
            flex-direction: column;
            gap: 10px;
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
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            /* Make the title occupy full width */
        }

        .form input,
        .form textarea {
            outline: 0;
            border: 1px solid rgb(219, 213, 213);
            padding: 10px;
            /* Adjusted padding */
            border-radius: 8px;
            width: calc(100% - 20px);
            /* Adjusted width */
            box-sizing: border-box;
            /* Include padding and border in the width */
        }

        .form textarea {
            height: 100px;
            resize: none;
        }

        .form button {
            align-self: flex-end;
            padding: 8px;
            outline: 0;
            border: 0;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            background-color: royalblue;
            color: #fff;
            cursor: pointer;
        }

        @media (max-width: 768px) {
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
    <nav class="navbar">
        <div class="navbar-logo">
            <a href="#">Logo</a>
        </div>
        <div class="navbar-links">
            <a href="#">Home</a>
            <a href="#">About</a>
            <a href="contact.html">Contact</a>
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
    <a href="logout.php" class="btn btn-warning">Logout</a>

    <form action="https://api.web3forms.com/submit" method="POST" class="form">
        <div class="title">Contact us</div>
        <input type="hidden" name="access_key" value="11786ee1-23d0-4a38-b793-e10b89c77ee1">
        <input type="text" name="name" class="input" placeholder="Full Name " required>
        <input type="email" name="email" class="input" placeholder="Your Email" required>
        <textarea name="message" placeholder="Your message" required></textarea>
        <button type="submit">Submit</button>
    </form>
    

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