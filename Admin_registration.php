<?php
session_start();
include "Database_connection.php";

if (isset($_POST['submit'])) {
    $ID = $_POST['owner_id'];
    $NAME = $_POST['owner_name'];
    $PASSWORD = $_POST['owner_password'];

    // Hash the password
    $hashed_password = password_hash($PASSWORD, PASSWORD_DEFAULT);

    // Check the hashed password
    echo "Hashed Password: " . $hashed_password . "<br>";

    $sql = "INSERT INTO owner (owner_id, owner_name, owner_password) VALUES (?, ?, ?)";

    // Using prepared statement to prevent SQL injection
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $ID, $NAME, $hashed_password);

    if ($stmt->execute()) {
        $last_id = $stmt->insert_id; // Retrieve the auto-generated ID
        echo '<script>alert("Registration is Successful. Your Admin ID is: ' . $last_id . '")</script>';
        header("Location: http://localhost/hotel/owner_login.php");
        exit();
    } else {
        echo '<script>alert("SORRY, Try Again")</script>';
        echo '<script>window.location="http://localhost/hotel/admin_registration.php"</script>';
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ashton Hotel - Admin Registration</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>

body {
            margin: 0;
            font-family: 'Montserrat', sans-serif;
            background: radial-gradient(circle, rgba(60,51,94,1) 30%, rgba(134,87,79,1) 100%);
            background-size: cover;
            color: #333; /* Dark text color */
        }

        /* Header styles */
        .header {
            padding: 5px;
            text-align: center;
            background-color: black;
            opacity: 0.9;
        }
        .header img {
            width: 100%;
            height: auto;
        }

        /* Navigation bar styles */
        .topnav {
            overflow: hidden;
            background-color: rgba(0, 0, 0, 0.5); /* Translucent black background */
            font-family: 'Montserrat', sans-serif;
        }
        .topnav a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 20px 30px;
            text-decoration: none;
        }
        .topnav a:hover {
            background-color: #9f6060;
        }
        .topnav a img {
            height: 18px; /* Adjust this value as needed */
            vertical-align: middle;
        }

        .audio-icon {
            float: right;
            margin: 12px;
            cursor: pointer;
            vertical-align: middle;
        }



        /* Main content container */
        .container {
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8); /* Translucent white background */
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .container h2 {
            font-size: 2.5em;
            border-bottom: 4px solid #9f6060; /* Change to desired color */
            margin-bottom: 20px;
            padding-bottom: 10px;
        }
        .container form {
            margin-top: 20px;
            text-align: left;
        }
        .container .form-group {
            margin-bottom: 20px;
        }
        .container label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333; /* Label text color */
        }
        .container input {
            width: 100%;
            padding: 12px;
            font-size: 1em;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s ease;
        }
        .container input:focus {
            outline: none;
            border-color: #4CAF50; /* Green border color on focus */
        }
        .container .submit-btn {
            width: 100%;
            background-color: #4CAF50; /* Green background color */
            color: white; /* Text color */
            border: none;
            padding: 12px;
            font-size: 1.2em;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease; /* Smooth transition on hover */
        }
        .container .submit-btn:hover {
            background-color: #45A049; /* Darker green on hover */
        }
        .container .psw {
            margin-top: 15px;
            font-size: 0.9em;
        }
        .container .psw a {
            color: #4CAF50; /* Link color */
        }
        .container .psw a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    
    <!-- Header -->
    <div class="header">
        <img src="header.jpg" alt="Ashton Hotel Logo">
    </div>

    <!-- Navigation bar -->
    <div class="topnav">
        <a href="homepage.php"><img src="home-icon.png" id="home-icon" alt="Home Icon"></a>
        <a href="customer_login.php">GUEST</a>
        <a href="owner_login.php">ADMIN</a>
        <img src="audio-icon.png" class="audio-icon" id="audio-icon" alt="Audio Icon" width="32" height="32">
        <audio id="background-audio" src="song.mp3"></audio>
    </div>

    <!-- Main content -->
    <div class="container">
        <h2>ADMIN REGISTRATION FORM</h2>

        <form method="post" action="admin_registration.php">
            <div class="form-group">
                <label for="owner_id">Admin ID:</label>
                <input type="text" class="form-control" id="owner_id" name="owner_id" required>
            </div>
            <div class="form-group">
                <label for="owner_name">Admin Name:</label>
                <input type="text" class="form-control" id="owner_name" name="owner_name" required>
            </div>
            <div class="form-group">
                <label for="owner_password">Password:</label>
                <input type="password" class="form-control" id="owner_password" name="owner_password" required>
            </div>
            <button type="submit" name="submit" class="submit-btn">Register</button>
        </form>
    </div>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>
