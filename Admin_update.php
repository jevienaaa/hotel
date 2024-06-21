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

        /* Content Container */
        .container {
            max-width: 600px; /* Reduced maximum width for smaller form */
            margin: 20px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 10px;
        }

        .form-group {
            margin-bottom: 15px; /* Reduced margin bottom for form groups */
            overflow: hidden;
        }

        .form-group label {
            display: inline-block;
            width: 100px; /* Fixed width for labels */
            font-weight: bold;
            margin-bottom: 5px; /* Reduced margin bottom for labels */
        }

        .form-group input[type=text],
        .form-group input[type=password],
        .form-group input[type=submit],
        .form-group input[type=reset] {
            width: calc(100% - 110px); /* Adjusted width for form inputs */
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-group input[type=submit],
        .form-group input[type=reset] {
            width: auto; /* Allow buttons to size based on content */
            padding: 10px 20px;
            margin-right: 10px;
        }

        .form-group input[type=submit]:hover,
        .form-group input[type=reset]:hover {
            background-color: #0056b3;
        }

        /* Center align content */
        .center {
            text-align: center;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .topnav a {
                padding: 15px 10px;
            }

            .form-group label {
                width: auto; /* Adjust label width for smaller screens */
                display: block;
                margin-bottom: 5px;
            }

            .form-group input[type=text],
            .form-group input[type=password] {
                width: 100%; /* Full width inputs on smaller screens */
            }
        }
    </style>
</head>
<body class="body_bg">

<!-- Header Section -->
<div class="header" style="opacity: 0.7;">
    <img src="header.jpg" width="100%" alt="Ashton Logo">
</div>

<!-- Navigation Bar -->
<div class="topnav">
<a href="adminnav.php"><img src="home-icon.png" id="home-icon" alt="Home Icon"></a>
<a href="Room_list.php">ROOM DETAILS</a>
    <a href="Admin_list.php">ADMIN DETAILS</a>
    <a href="Booking_list.php">BOOKING DETAILS</a>
    <a href="sales_report.php">REPORT</a>
    <a style="float:right" href="logout.php">LOGOUT</a>
    <a style="float:right" href="http://localhost/hotel/Admin_list.php" class="previous">&laquo; Previous</a>
    <a style="float:right" href="http://localhost/hotel/Admin_update.php" class="next">Next &raquo;</a>
</div>

<!-- Main Content -->
<div class="container center">
    <h1>ADMIN REGISTRATION FORM</h1>

    <form method="post" action="http://localhost/hotel/Admin_registration.php">
        <div class="form-group">
            <label for="owner_name">Name:</label>
            <input type="text" id="owner_name" name="owner_name" required>
        </div>
        <div class="form-group">
            <label for="owner_password">Password:</label>
            <input type="password" id="owner_password" name="owner_password" required>
        </div>
        <div class="form-group" style="text-align:right">
            <input type="submit" name="submit" value="Submit" class="submit">
            <input type="reset" value="Reset" class="submit">
        </div>
    </form>
</div>

</body>
</html>
