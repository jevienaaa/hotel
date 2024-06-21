<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: owner_login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ashton Hotel - Guest Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        @font-face {
            font-family: myFont;
            src: url('jak.woff');
        }

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
            display: inline-block; /* Changed from float: left; */
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
        .flip-box {
            background-color: transparent;
            color: white;
            width: 100%;
            max-width: 600px;
            margin: 50px auto;
            perspective: 1000px;
            animation: fadeIn 2s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .flip-box-inner {
            position: relative;
            width: 100%;
            text-align: center;
            transition: transform 0.8s;
            transform-style: preserve-3d;
        }

        .flip-box:hover .flip-box-inner {
            transform: rotateY(180deg);
        }

        .flip-box-front, .flip-box-back {
            position: absolute;
            width: 100%;
            backface-visibility: hidden;
            font-family: myFont;
            color: white;
        }

        .flip-box-back {
            transform: rotateY(180deg);
        }

        h1 {
            font-size: 50px;
            /* font-weight: bold; */
        }

        @media (max-width: 767px) {
            .topnav a {
                display: block;
                text-align: center;
            }
            .audio-icon {
                float: right;
                margin: 10px;
                cursor: pointer;
            }
        }
    </style>
</head>
<body>

<div class="header" style="opacity:70%">
    <img src="header.jpg" width="100%" alt="Ashton Hotel Logo">
</div>

<div class="topnav">
<a href="adminnav.php"><img src="home-icon.png" id="home-icon" alt="Home Icon"></a>
<a href="Room_list.php">ROOM DETAILS</a>
    <a href="Admin_list.php">ADMIN DETAILS</a>
    <a href="Booking_list.php">BOOKING DETAILS</a>
    <a href="sales_report.php">REPORT</a>
    <audio id="background-audio" src="song.mp3"></audio>
    <img src="audio-icon.png" style="float: right; margin: 10px; cursor: pointer;" class="audio-icon" id="audio-icon" alt="Audio Icon" width="32" height="32">
    <a style="float:right" href="logout.php">LOGOUT</a>
    <a style="float:right" href="http://localhost/hotel/adminnav.php" class="previous">&laquo; Previous</a>
    <a style="float:right" href="http://localhost/hotel/Room_list.php" class="next">Next &raquo;</a>
</div>

<div class="content">
    <div class="flip-box">
        <div class="flip-box-inner">
            <div class="flip-box-front">
                <h1>Welcome</h1>
                <h1>
                    <?php
                    if (isset($_SESSION['owner_name'])) {
                        echo htmlspecialchars($_SESSION['owner_name']);
                    } else {
                        echo 'Owner';
                    }
                    ?>
                </h1>
                <h1>To</h1>
            </div>
            <div class="flip-box-back">
                <h1>Ashton Hotel</h1>
                <h1>Booking Management</h1>
                <h1>System</h1>
            </div>
        </div>
    </div>
</div>
<?php include "audio_control.php"; ?>

</body>
</html>
