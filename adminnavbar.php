
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

        @media print {
                .noPrint{
                display:none;
            }
            }

		</style>
	</head>

	<body>
        <div class= "noPrint">
		<div class="header" style="opacity:70%">
		    <img src="header.jpg" width="100%" alt="ashton logo">
		</div>

        <div class="topnav" style="font-family: Garamond, serif;">
        <a href="adminnav.php"><img src="home-icon.png" id="home-icon" alt="Home Icon"></a>
        <a href="Room_list.php">ROOM DETAILS</a>
            <a href="Admin_list.php">ADMIN DETAILS</a>
            <a href="Booking_list.php">BOOKING DETAILS</a>
            <a href="sales_report.php">REPORT</a>
            <a  style="float:right" href="logout.php">LOGOUT</a>
            <a style="float:right"href="http://localhost/hotel/adminnav.php" class="previous">&laquo; Previous</a>
            <a style="float:right" href="http://localhost/hotel/sales_report.php" class="next">Next&raquo;</a>
         
            <audio controls autoplay>
                <source style="float:right" src="song.mp3" type="audio/mpeg">
            </audio>

        </div>
        </div>
    </body>
</html>

