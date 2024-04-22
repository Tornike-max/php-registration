<?php


session_start();

// require_once __DIR__ . '/../vendor/autoload.php';

if (!isset($_SESSION['user'])) {
    header('Location: loginPage.php'); // Redirect to login if not logged in

    exit();
}

echo "Welcome, " . htmlspecialchars($_SESSION['user']['full_name']) . "!";

// Now you can use the user data

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Simple Homepage</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            /* Sets the font for the entire page */
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            /* Light grey background */
        }

        header {
            background: #333;
            /* Dark grey background for the header */
            color: #fff;
            /* White text color */
            padding: 10px 20px;
            /* Padding around the content */
            text-align: center;
            /* Centers the header text */
        }

        nav ul {
            list-style: none;
            /* Removes bullet points from the list */
            padding: 0;
            background: #555;
            /* Slightly lighter grey for the navigation bar */
            text-align: center;
            /* Center alignment of nav items */
        }

        p {
            font-size: x-large;
        }

        nav ul li {
            display: inline;
            /* Displays the list items in a row */
        }

        nav ul li a {
            text-decoration: none;
            /* Removes underline from links */
            color: white;
            /* White text color for links */
            padding: 10px 15px;
            /* Padding around the link text */
            display: inline-block;
            /* Makes padding effective */
        }

        nav ul li a:hover {
            background-color: #777;
            /* Changes background on hover */
        }

        section {
            margin: 10px;
            /* Adds margin around sections */
            padding: 15px;
            /* Adds padding inside sections */
            background: white;
            /* White background for sections */
            border-radius: 8px;
            /* Rounded corners for sections */
            box-shadow: 0 0 10px #ccc;
            /* Adds shadow to sections */
        }

        footer {
            text-align: center;
            /* Center-aligns footer text */
            padding: 10px 0;
            /* Padding top and bottom */
            background-color: #333;
            /* Dark grey background for the footer */
            color: white;
            /* White text color */
            position: fixed;
            /* Fixes footer at the bottom of the page */
            width: 100%;
            /* Full width */
            bottom: 0;
            /* At the bottom */
        }
    </style>
</head>

<body>
    <header>
        <h1>Welcome to My Homepage</h1>
        <p><?php echo $_SESSION['user']['full_name'] ?></p>
    </header>
    <nav>
        <ul>
            <li><a href="#about">About</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
    </nav>
    <section id="about">
        <h2>About Us</h2>
        <p>We are a small team dedicated to providing quality services.</p>
    </section>

    <section id="contact">
        <h2>Contact Us</h2>
        <p>Feel free to get in touch via email at <a href="mailto:info@example.com">info@example.com</a>.</p>
    </section>
    <footer>
        <p>&copy; 2024 My Simple Homepage. All rights reserved.</p>
    </footer>
</body>

</html>