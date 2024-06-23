<?php
// Start or resume session
session_start();

// Validate session
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirect to login page if session is not valid
    header('Location: customer_login.php');
    exit();
}

// Prevent caching of this page
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Ashton Hotel</title>
    <!-- Bootstrap -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        @font-face {
            font-family: myFont;
            src: url('jak.woff');
            font-weight: normal; /* Ensure the font is not bold */
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
            font-weight: normal; /* Ensure the text is not bold */

        }
        .topnav a {
            display: inline-block; /* Changed from float: left; */
            color: white;
            text-align: center;
            padding: 20px 30px;
            text-decoration: none;
            font-weight: 400;
            font-weight: normal; /* Ensure the text is not bold */
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
            font-size: 40px;
            font-weight: normal; /* Ensure the font weight is normal */
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

<div class="topnav" style="font-weight: normal">
">
    <a href="guestnav.php"><img src="home-icon.png" id="home-icon" alt="Home Icon"></a>
    <a href="Room_list_2.php" >ROOM DETAILS</a>
    <a href="Room_search.php">ROOM SEARCH</a>
    <audio id="background-audio" src="song.mp3"></audio>
    <img src="audio-icon.png" style="float: right; margin: 10px; cursor: pointer;" class="audio-icon" id="audio-icon" alt="Audio Icon" width="32" height="32">
    <a style="float:right" href="logout.php">LOGOUT</a>
    <a style="float:right" href="http://localhost/hotel/guestnav.php" class="previous">&laquo; Previous</a>
    <a style="float:right" href="http://localhost/hotel/Room_list_2.php" class="next">Next&raquo;</a>
</div>

<div class="column middle">
    <div class="flip-box">
        <div class="flip-box-inner">
            <div class="flip-box-front">
                <h1>Welcome</h1>
                <h1><?php echo htmlspecialchars($_SESSION['cus_name']); ?></h1>
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

<script>
    document.getElementById('audio-icon').addEventListener('click', function() {
        var audio = document.getElementById('background-audio');
        if (audio.paused) {
            audio.play();
            this.src = 'audio-on-icon.png'; // Change to your "audio on" icon
        } else {
            audio.pause();
            this.src = 'audio-off-icon.png'; // Change to your "audio off" icon
        }
    });
</script>

</body>
</html>
