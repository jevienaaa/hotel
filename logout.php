<?php
// Start the session
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page after logout
header("Location: homepage.php");
exit();
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
        /* Style the body */
            body
        {
            background-repeat: no-repeat;
            background: rgb(134,87,79);
            background: radial-gradient(circle, rgba(134,87,79,1) 30%, rgba(60,51,94,1) 100%);
            height: 1200px;
            margin: 0;
		}

        /* Style the header */
		    .header 
          {
            background-color: transparent;
            padding: 5px;
            text-align: center;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
            background: #000000;
		    }

        /* Set customised font family */
        @font-face
        {
            font-family: myFont;
            src: url(jak.woff);
        }

        div 
        {
            font-family: myFont;
        }
        
        /* Style flip box */
        .flip-box 
        {
            background-color: transparent;
            width: 300px;
            height: 200px;
            border: transparent;
            perspective: 1000px;
            position: center;
            margin: auto;
            width: 60%;
            padding: 40px;
        }

        .flip-box-inner 
        {
            position: relative;
            width: 100%;
            height: 100%;
            text-align: center;
            transition: transform 0.8s;
            transform-style: preserve-3d;
        }

        .flip-box:hover .flip-box-inner 
        {
            transform: rotateY(180deg);
        }

        .flip-box-front, .flip-box-back 
        {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
        }

        .flip-box-front 
        {
            background-color: transparent;
            color: black;
        }

        .flip-box-back 
        {
            background-color: transparent;
            color: black;
            transform: rotateY(180deg);
        }

        * {
            box-sizing: border-box;
        }

        input[type=button] 
        {
            background: transparent;
            color: black;
            padding: 10px;
            text-align: center;
            display: inline-block;
            font-size: 37px;
            margin: 4px;
            transition-duration: 0.4s;
            cursor: pointer;
            margin: 0;
		    }

        input[type=button]:hover 
        {
            opacity: 0.6;
            background-color:hsla(290,60%,70%,0.3);
            color: black;

		    }
                /* Style the top navigation bar */
                .topnav 
        {
            overflow: hidden;
            background-color: black;  
            opacity:70%;
            
        }

        /* Style the topnav links */
        .topnav a 
        {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 20px 30px;
            text-decoration: none;
        }

        /* Change color on hover */
        .topnav a:hover 
        {
            background-color: #9f6060 ;
            color: white;
        }

        /* Create three unequal columns that floats next to each other */

        /* Middle column */
        .column.middle {
        width: 100%;
        }

        /* Clear floats after the columns */
        .row:after {
        content: "";
        display: table;
        clear: both;
        }

        /* Responsive layout - makes the three columns stack on top of each other instead of next to each other */
        @media screen and (max-width: 600px) {
        .column.side, .column.middle {
            width: 100%;
        }
        }

        p{
            font-family: Garamond, sans-serif;
        }

        h1{
            font-size: 60px;
        }

		</style>
	</head>

	<body>

		<div class="header" style="opacity:70%">
		    <img src="header.jpg" width="100%" alt="ashton logo">
		</div>

        <div class="topnav" style="font-family: Garamond, serif;">
			<a href="homepage.php">HOMEPAGE</a>
            <a href="customer_login.php">GUEST</a>
            <a href="owner_login.php">ADMIN</a>
            <a style="float:right" href="logout.php">LOGOUT</a>


            <audio controls autoplay>
                <source style="float:right" src="song.mp3" type="audio/mpeg">
            </audio>

        </div>
        <div class="column middle">

        <div class="flip-box">

        <div class="flip-box-inner">

        <div class="flip-box-front">

            <h1>Thank You</h1>
            <h1>For Choosing</h1>
            <h1>Ashton Hotel</h1>

        </div>

        <div class="flip-box-back">

            <h1>Your</h1>
            <h1>Place To Stay</h1>

        </div>

        </div>
    </div>

        </div>
    </body>
</html>

