<?php
session_start();
include "Database_connection.php";

if(isset($_POST['submit'])) {
    $NAME = $_POST['room_name'];
    $AVAILABILITY = $_POST['room_availability'];
    $PRICE = $_POST['room_price'];
    $RATE = $_POST['room_rating'];
    $DESC = $_POST['room_description'];
    $LOCATION = $_POST['room_location'];
    // $IMAGE = $_POST['room_image']; // Assuming you handle file uploads separately
    $sql = "INSERT INTO room (room_id, room_name, room_availability, room_price, room_rating, room_description, room_location) 
            VALUES (NULL, '$NAME', '$AVAILABILITY', '$PRICE', '$RATE', '$DESC', '$LOCATION')";
    
    if(!mysqli_query($conn, $sql)) {
        echo '<script>alert("SORRY, Try Again")</script>';
        echo '<script>window.location="http://localhost/hotel/Room_update_form.php"</script>';
    } else {
        header("location: http://localhost/hotel/Room_list.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ashton Hotel - Room Update Form</title>
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
            max-width: 1200px;
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
        .form-group input[type=file] {
            width: 100%;
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
        }
    </style>
</head>
<body>

<!-- Header Section -->
<div class="header" style="opacity: 0.7;">
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
    <h1 style="text-align: center;">ROOM ADD FORM</h1>

    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Room Name</label>
            <input type="text" name="room_name" required>
        </div>
        <div class="form-group">
            <label>Room Image</label>
            <input type="file" name="room_image" required>
        </div>
        <div class="form-group">
            <label>Room Availability</label>
            <input type="number" name="room_availability" required>
        </div>
        <div class="form-group">
            <label>Room Price(RM)</label>
            <input type="number" name="room_price" required>
        </div>
        <div class="form-group">
            <label>Room Rating</label>
            <input type="number" name="room_rating" required>
        </div>
        <div class="form-group">
            <label>Room Description</label>
            <input type="text" name="room_description" required>
        </div>
        <div class="form-group">
            <label>Room Location</label>
            <input type="text" name="room_location" required>
        </div>
        <div class="form-group" style="text-align: right;">
            <input type="submit" name="submit" value="Submit">
            <input type="reset" value="Reset">
        </div>
    </form>
</div>

</body>
</html>
