<?php
session_start();
include "Database_connection.php";

if(isset($_POST['submit'])) {
    $CID = $_POST['booking_cid'];
    $COD = $_POST['booking_cod'];
    $BOOKINGNO = $_POST['no_booking'];
    $RID = $_POST['room_id'];

    // Insert data into booking table
    $sql = "INSERT INTO booking (booking_id, booking_cid, booking_cod, no_booking, room_id) 
            VALUES (NULL,'$CID','$COD','$BOOKINGNO', '$RID')";
    
    if(!mysqli_query($conn, $sql)) {
        echo '<script>alert("SORRY, Try Again")</script>';
        echo '<script>window.location="http://localhost/hotel/Booking_update.php"</script>';
    } else {
        header("location: http://localhost/hotel/Booking_list.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Ashton Hotel - Booking Update Form</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            max-width: 800px; /* Adjusted for form width */
            margin: 20px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 10px;
        }

        .form-group {
            margin-bottom: 20px;
            overflow: hidden;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .form-group input[type=text],
        .form-group input[type=number],
        .form-group input[type=file],
        .form-group input[type=date] {
            width: calc(100% - 22px); /* Adjusted width for input fields */
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-group input[type=file] {
            padding: 8px 0; /* Adjust vertically for file input */
        }

        .form-group input[type=submit],
        .form-group input[type=reset] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-right: 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-group input[type=submit]:hover,
        .form-group input[type=reset]:hover {
            background-color: #0056b3;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .topnav a {
                padding: 15px 10px;
            }
            .container {
                padding: 10px;
            }
        }
    </style>
</head>

<body>

<!-- Header Section -->
<div class="header">
    <img src="header.jpg" alt="Ashton Logo">
</div>

<!-- Navigation Bar -->
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
    <a style="float:right" href="http://localhost/hotel/Admin_list.php" class="next">Next &raquo;</a>
</div>

<!-- Main Content -->
<div class="container">
    <h1 style="text-align: center;">BOOKING UPDATE FORM</h1>

    <form method="post">
        <div class="form-group">
            <label>Check in Date</label>
            <input type="date" name="booking_cid" required>
        </div>
        <div class="form-group">
            <label>Check out Date</label>
            <input type="date" name="booking_cod" required>
        </div>
        <div class="form-group">
            <label>Booking No</label>
            <input type="number" name="no_booking" required>
        </div>
        <div class="form-group">
            <label>Room ID</label>
            <input type="number" name="room_id" required>
        </div>
        <div class="form-group" style="text-align: right;">
            <input type="submit" name="submit" value="Submit">
            <input type="reset" value="Reset">
        </div>
    </form>
</div>

</body>
</html>
